<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userop extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "users_v";
        $this->load->model("ogrenci_model");

    }

    public function login(){

        if (get_active_user()){
            redirect(base_url());
        }

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $items = $this->ogrenci_model->get_all(
            array()
        );

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function do_login(){

        if (get_active_user()){
            redirect(base_url());
        }


        $this->load->library("form_validation");

        // kurallar yazılır
        $this->form_validation->set_rules("title","isim soyisim","required|trim");
        $this->form_validation->set_rules("user_password","tc","required|trim|min_length[3]|max_length[3]");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required"    => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "min_length"  => "<strong>{field}</strong> Alanına Minimum <strong> 11 </strong> Karakter Girmelisiniz",
                "max_length"  => "<strong>{field}</strong> Alanına Maksimum <strong> 11 </strong> Karakter Girmelisiniz",
            )
        );

        if($this->form_validation->run() == FALSE){
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }else{
            $user = $this->ogrenci_model->get(
                array(
                    "title"    => $this->input->post("title"),
                    "tc" => $this->input->post("user_password")
                )
            );

            if($user){

                $alert = [
                    "title"    => "İşlem Başarılı",
                    "message"  => "{$user->title}, Hoş geldiniz",
                    "type"     => "success"
                ];

                $this->session->set_userdata("user", $user);
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url());
            }else{
                $alert = [
                    "title"    => "Bir Hata Oluştu!!!",
                    "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                    "type"     => "error"
                ];

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("login"));
            }
        }

    }

    public function logout(){
        $this->session->unset_userdata("user");
        $this->session->unset_userdata("settings");
        redirect(base_url("login"));
    }





























}