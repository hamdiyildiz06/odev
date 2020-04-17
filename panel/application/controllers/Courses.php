<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "courses_v";
        $this->load->model("course_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $items = $this->course_model->get_all(
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

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save(){
        $this->load->library("form_validation");

        if ($_FILES["img_url"]["name"] == ""){
            $alert = [
                "title"    => "Bir Hata Oluştu!!!",
                "message"  => "İşleminiz Tamamlanamadı Lütfen Bir Görsel Seçiniz ve Tekrar Deneyiniz",
                "type"     => "error"
            ];

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("courses/new_form"));
            die();
        }

        // kurallar yazılır
        $this->form_validation->set_rules("title","Başlık","required|trim");
        $this->form_validation->set_rules("event_date","Eğitim Tarihi","required|trim");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız.."
            )
        );


        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $file_name = convertToSEO(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)) . "." . pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);

            $image_255x157 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/{$this->viewFolder}", 255,157, $file_name);
            $image_1140x705 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/{$this->viewFolder}", 1140,705, $file_name);

            if($image_255x157 && $image_1140x705){

                $insert = $this->course_model->add(
                    array(
                        "title"       => $this->input->post("title"),
                        "description" => $this->input->post("description"),
                        "url"         => convertToSEO($this->input->post("title")),
                        "img_url"     => $file_name,
                        "event_date"  => $this->input->post("event_date"),
                        "rank"        => 0,
                        "isActive"    => 1,
                        "createdAt"   => date("Y-m-d H:i:s ")
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


            }else{

                $alert = [
                    "title"    => "Bir Hata Oluştu!!!",
                    "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                    "type"     => "error"
                ];

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("courses/new_form"));
                die();

            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("courses"));

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
        $item  =  $this->course_model->get(
            array(
                "id" => $id
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
        $this->form_validation->set_rules("title","Başlık","required|trim");
        $this->form_validation->set_rules("event_date","Eğitim Tarihi","required|trim");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız.."
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            if ($_FILES["img_url"]["name"] !== ""){

                $file_name = convertToSEO(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)) . "." . pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
                $image_255x157 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/{$this->viewFolder}", 255,157, $file_name);
                $image_1140x705 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/{$this->viewFolder}", 1140,705, $file_name);

                if($image_255x157 && $image_1140x705){
                    delete_picture("course_model", $id, "255x157");
                    delete_picture("course_model", $id, "1140x705");

                    $data =  array(
                        "title"       => $this->input->post("title"),
                        "description" => $this->input->post("description"),
                        "event_date"  => $this->input->post("event_date"),
                        "url"         => convertToSEO($this->input->post("title")),
                        "img_url"   => $file_name,
                    );

                }else{
                    $alert = [
                        "title"    => "Bir Hata Oluştu!!!",
                        "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                        "type"     => "error"
                    ];

                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("courses/update_form/{$id}"));
                    die();

                }

            }else{
                $data =  array(
                    "title"       => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                    "event_date"  => $this->input->post("event_date"),
                    "url"         => convertToSEO($this->input->post("title")),
                );
            }

            $update = $this->course_model->update(array("id" => $id), $data);

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
            redirect(base_url("courses"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item  =  $this->course_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){

        delete_picture("course_model", $id, "255x157");
        delete_picture("course_model", $id, "1140x705");
        $delete = $this->course_model->delete(
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
        redirect(base_url("courses"));
    }

    public function isActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->course_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive,
                )
            );
        }
    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id ){
            $update = $this->course_model->update(
                array(
                    "id"      => $id,
                    "rank !=" =>  $rank
                ),
                array(
                    "rank" => $rank
                )
            );
        }
    }

}