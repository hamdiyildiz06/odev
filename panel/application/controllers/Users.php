<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "users_v";
        $this->load->model("user_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $items = $this->user_model->get_all(
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
        $this->form_validation->set_rules("user_name","Kullanıcı Adı","required|trim|is_unique[users.user_name]");
        $this->form_validation->set_rules("full_name","Ad Soyad","required|trim");
        $this->form_validation->set_rules("email","E-Posta","required|trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password","Şifre","required|trim|min_length[4]|max_length[8]");
        $this->form_validation->set_rules("re_password","Şifre Tekrarı","required|trim|min_length[4]|max_length[8]|matches[password]");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required"    => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "valid_email" => "Lütfen Geçerli Bir E-Posta Adresi Giriniz",
                "is_unique"   => "<strong>{field}</strong> Alanı Daha Önceden Kullanılmış",
                "matches"     => "<strong>Şifre</strong> ve <strong>Şifre Tekrarı</strong> Alanları Uyuşmuyor",
                "min_length"  => "<strong>{field}</strong> Alanına Minimum <strong> 4 </strong> Karakter Girmelisiniz",
                "max_length"  => "<strong>{field}</strong> Alanına Maksimum <strong> 8 </strong> Karakter Girmelisiniz"
            )
        );


        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $insert = $this->user_model->add(
                array(
                    "user_name"   => $this->input->post("user_name"),
                    "full_name"   => $this->input->post("full_name"),
                    "email"       => $this->input->post("email"),
                    "password"    => md5($this->input->post("password")),
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

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("users"));
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
        $item  =  $this->user_model->get(
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
        $item  =  $this->user_model->get(
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

        $oldUser = $this->user_model->get(
            array(
                "id" => $id
            )
        );

        // kurallar yazılır
        if ($oldUser->user_name != $this->input->post("user_name")){
            $this->form_validation->set_rules("user_name","Kullanıcı Adı","required|trim|is_unique[users.user_name]");
        }

        if ($oldUser->email != $this->input->post("email")){
            $this->form_validation->set_rules("email","E-Posta","required|trim|valid_email|is_unique[users.email]");
        }

        $this->form_validation->set_rules("full_name","Ad Soyad","required|trim");


        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required"    => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "valid_email" => "Lütfen Geçerli Bir E-Posta Adresi Giriniz",
                "is_unique"   => "<strong>{field}</strong> Alanı Daha Önceden Kullanılmış",
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $update = $this->user_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "user_name"       => $this->input->post("user_name"),
                    "full_name"       => $this->input->post("full_name"),
                    "email"       => $this->input->post("email")
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
            redirect(base_url("users"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item  =  $this->user_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_password($id){
        $this->load->library("form_validation");


        $this->form_validation->set_rules("password","Şifre","required|trim|min_length[4]|max_length[8]");
        $this->form_validation->set_rules("re_password","Şifre Tekrarı","required|trim|min_length[4]|max_length[8]|matches[password]");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required"    => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "matches"     => "<strong>Şifre</strong> ve <strong>Şifre Tekrarı</strong> Alanları Uyuşmuyor",
                "min_length"  => "<strong>{field}</strong> Alanına Minimum <strong> 4 </strong> Karakter Girmelisiniz",
                "max_length"  => "<strong>{field}</strong> Alanına Maksimum <strong> 8 </strong> Karakter Girmelisiniz"
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $update = $this->user_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "password" => md5($this->input->post("password")),
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
            redirect(base_url("users"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "Password";
            $viewData->form_error = true;

            $viewData->item  =  $this->user_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){
        $delete = $this->user_model->delete(
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
        redirect(base_url("users"));
    }

    public function isActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->user_model->update(
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