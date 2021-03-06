<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "brands_v";
        $this->load->model("brand_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index(){
        $viewData = new stdClass();

        /** tablodan verilerin getirilmesi */
        $items = $this->brand_model->get_all(
            array(),"rank ASC"
        );

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items         = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){
        $viewData = new stdClass();

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $this->load->model("portfolio_category_model");

        $viewData->categories = $this->portfolio_category_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save(){
        $this->load->library("form_validation");

        // kurallar yazılır
        $this->form_validation->set_rules("title","Sınıf Adı","required|trim");
        $this->form_validation->set_rules("mevcut","Sınıf Mevcudu","required|trim");
        $this->form_validation->set_rules("category_id","Sınıf Mevcudu","required|trim");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız.."
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();
        if($validate){

                $insert = $this->brand_model->add(
                    array(
                        "title"        => $this->input->post("title"),
                        "mevcut"       => $this->input->post("mevcut"),
                        "category_id"  => $this->input->post("category_id"),
                        "rank"         => 0,
                        "isActive"     => 1,
                        "createdAt"    => date("Y-m-d H:i:s ")
                    )
                );

                //TODO alert sistemi eklenecek
                if($insert){
                    $alert = [
                        "title"    => "İşlem Başarılı",
                        "message"  => "İşleminiz Başarılı Bir Şekilde Yapıldı",
                        "type"     => "success"
                    ];
                }else{
                    $alert = [
                        "title"    => "Bir Hata Oluştu!!!",
                        "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                        "type"     => "error"
                    ];
                }


            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("brands"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_form($id){
        $viewData = new stdClass();

        /** Tablodan verilerin getirilmesi ..*/
        $item  =  $this->brand_model->get(
            array(
                "id" => $id
            )
        );

        $this->load->model("portfolio_category_model");

        $viewData->categories = $this->portfolio_category_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id){
        $this->load->library("form_validation");

        // kurallar yazılır
        $this->form_validation->set_rules("title","Sınıf Adı","required|trim");
        $this->form_validation->set_rules("mevcut","Sınıf Mevcudu","required|trim");
        $this->form_validation->set_rules("category_id","Sınıf Mevcudu","required|trim");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız.."
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $data =  array(
                "title"       => $this->input->post("title"),
                "mevcut"       => $this->input->post("mevcut"),
                "category_id"  => $this->input->post("category_id")
            );

            $update = $this->brand_model->update(array("id" => $id), $data);

            //TODO alert sistemi eklenecek
            if($update){
                $alert = [
                    "title"    => "İşlem Başarılı",
                    "message"  => "İşleminiz Başarılı Bir Şekilde Yapıldı",
                    "type"     => "success"
                ];
            }else{
                $alert = [
                    "title"    => "Bir Hata Oluştu!!!",
                    "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                    "type"     => "error"
                ];
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("brands"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item  =  $this->brand_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){
        delete_picture("brand_model", $id, "350x216");
        $delete = $this->brand_model->delete(
            array(
                "id" => $id
            )
        );

        if($delete){
            //TODO alert sistemi eklenecek
            $alert = [
                "title"    => "İşlem Başarılı",
                "message"  => "İşleminiz Başarılı Bir Şekilde Yapıldı",
                "type"     => "success"
            ];
        }else{

            $alert = [
                "title"    => "Bir Hata Oluştu!!!",
                "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                "type"     => "error"
            ];

        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("brands"));
    }

    public function isActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->brand_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive,
                )
            );
        }
    }



}