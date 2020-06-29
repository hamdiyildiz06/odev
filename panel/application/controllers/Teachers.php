<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachers extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "teachers_v";
        $this->load->model("teacher_model");
        $this->load->model("ogrenci_model");

        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index(){

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $items = $this->teacher_model->get_all(
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
        $this->load->model("brand_model");

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $viewData->brands = $this->brand_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save(){
        $this->load->library("form_validation");

        // kurallar yazılır
        $this->form_validation->set_rules("title","İsim Soyisim","required|trim");
        $this->form_validation->set_rules("tc","tc","required|trim");
//        $this->form_validation->set_rules("brands_id","Sınıf","required|trim");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı boş bırakılamaz"
            )
        );


        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){
            $insert = $this->teacher_model->add(
                array(
                    "url"          => convertToSEO($this->input->post("title")),
                    "title"        => $this->input->post("title"),
                    "brands_id"  => $this->input->post("brands_id"),
                    "tc"  => $this->input->post("tc"),
                    "rank"          => 0,
                    "isActive"     => 1,
                    "createdAt"    => date("Y-m-d H:i:s ")
                )
            );

            //TODO alert sistemi eklenecek
            if($insert){

                $update = $this->ogrenci_model->update(
                    array(
                        "brands_id" => $this->input->post("brands_id")
                    ),
                    array(
                        "vteacher" => $this->db->insert_id()
                    )
                );


                if ($update){

                    $alert = [
                        "title"    => "İşlem Başarılı",
                        "message"  => "İşleminiz Başarılı Bir Şekilde Yapıldı",
                        "type"     => "success"
                    ];

                }else{

                    $alert = [
                        "title"    => "Bir Hata Oluştu!!!",
                        "message"  => "Vekil öğretmen atamasında bir problem yaşandı",
                        "type"     => "error"
                    ];

                }

            }else{

                $alert = [
                    "title"    => "Bir Hata Oluştu!!!",
                    "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                    "type"     => "error"
                ];

            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("teachers"));

        }else{

            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->model("brand_model");
            $viewData->brands = $this->brand_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_form($id){
        $viewData = new stdClass();
        $this->load->model("brand_model");

        /** Tablodan verilerin getirilmesi ..*/
        $item  =  $this->teacher_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->brands = $this->brand_model->get_all(
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
        $this->form_validation->set_rules("title","İsim Soyisim","required|trim");
        $this->form_validation->set_rules("tc","tc","required|trim");
//        $this->form_validation->set_rules("brands_id","Sınıf","required|trim");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı boş bırakılamaz"
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){
            $update = $this->teacher_model->update(
                array(
                    "id"          => $id
                ),
                array(
                    "url"          => convertToSEO($this->input->post("title")),
                    "title"        => $this->input->post("title"),
                    "brands_id"    => $this->input->post("brands_id"),
                    "tc"           => $this->input->post("tc"),
                )
            );

            if($update){

                $update1 = $this->ogrenci_model->update(
                    array(
                        "brands_id" => $this->input->post("brands_id")
                    ),
                    array(
                        "vteacher" => $id
                    )
                );

                if ($update1){
                    $alert = [
                        "title"    => "İşlem Başarılı",
                        "message"  => "İşleminiz Başarılı Bir Şekilde Yapıldı",
                        "type"     => "success"
                    ];
                }else{
                    $alert = [
                        "title"    => "Bir Hata Oluştu!!!",
                        "message"  => "Vekil öğretmen atamasında bir problem yaşandı",
                        "type"     => "error"
                    ];
                }

                
            }else{

                $alert = [
                    "title"    => "Bir Hata Oluştu!!!",
                    "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                    "type"     => "error"
                ];

            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("teachers"));
        }else{
            $viewData = new stdClass();

            /** Tablodan verilerin getirilmesi ..*/
            $viewData->item  =  $this->teacher_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->model("brand_model");
            $viewData->brands = $this->brand_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;


            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){

        $delete = $this->teacher_model->delete(
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
        redirect(base_url("teachers"));
    }

    public function isActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->teacher_model->update(
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