<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailsettings extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "email_settings_v";
        $this->load->model("emailsettings_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $items = $this->emailsettings_model->get_all(
            array()
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

        // kurallar yazılır
        $this->form_validation->set_rules("protocol","Protocol Numarası","required|trim");
        $this->form_validation->set_rules("host","E-Posta Sunucusu","required|trim");
        $this->form_validation->set_rules("port","Port Numarası","required|trim");
        $this->form_validation->set_rules("user_name","Kullanıcı Adı","required|trim");
        $this->form_validation->set_rules("user","E-Posta (User)","required|trim|valid_email");
        $this->form_validation->set_rules("from","Kimden Gidecek (From)","required|trim|valid_email");
        $this->form_validation->set_rules("to","Kime Gidecek (To)","required|trim|valid_email");
        $this->form_validation->set_rules("password","Şifre","required|trim");


        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required"    => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "valid_email" => "Lütfen Geçerli Bir E-Posta Adresi Giriniz",
            )
        );


        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $insert = $this->emailsettings_model->add(
                array(
                    "protocol"  => $this->input->post("protocol"),
                    "host"      => $this->input->post("host"),
                    "port"      => $this->input->post("port"),
                    "user_name" => $this->input->post("user_name"),
                    "user"      => $this->input->post("user"),
                    "from"      => $this->input->post("from"),
                    "to"        => $this->input->post("to"),
                    "password"  => $this->input->post("password"),
                    "isActive"  => 1,
                    "createdAt" => date("Y-m-d H:i:s ")
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
            redirect(base_url("emailsettings"));
            die();
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
        $item  =  $this->emailsettings_model->get(
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

    public function update_password_form($id){
        $viewData = new stdClass();

        /** Tablodan verilerin getirilmesi ..*/
        $item  =  $this->emailsettings_model->get(
            array(
                "id" => $id
            )
        );

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "password";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id){
        $this->load->library("form_validation");

        // kurallar yazılır
        $this->form_validation->set_rules("protocol","Protocol Numarası","required|trim");
        $this->form_validation->set_rules("host","E-Posta Sunucusu","required|trim");
        $this->form_validation->set_rules("port","Port Numarası","required|trim");
        $this->form_validation->set_rules("user_name","Kullanıcı Adı","required|trim");
        $this->form_validation->set_rules("user","E-Posta (User)","required|trim|valid_email");
        $this->form_validation->set_rules("from","Kimden Gidecek (From)","required|trim|valid_email");
        $this->form_validation->set_rules("to","Kime Gidecek (To)","required|trim|valid_email");
        $this->form_validation->set_rules("password","Şifre","required|trim");



        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required"    => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "valid_email" => "Lütfen Geçerli Bir E-Posta Adresi Giriniz",
            )
        );


        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $update = $this->emailsettings_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "protocol"  => $this->input->post("protocol"),
                    "host"      => $this->input->post("host"),
                    "port"      => $this->input->post("port"),
                    "user_name" => $this->input->post("user_name"),
                    "user"      => $this->input->post("user"),
                    "from"      => $this->input->post("from"),
                    "to"        => $this->input->post("to"),
                    "password"  => $this->input->post("password"),
                )
            );

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
            redirect(base_url("emailsettings"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item  =  $this->emailsettings_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){
        $delete = $this->emailsettings_model->delete(
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
        redirect(base_url("emailsettings"));
    }

    public function isActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->emailsettings_model->update(
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