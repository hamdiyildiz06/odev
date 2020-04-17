<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userop extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "users_v";
        $this->load->model("user_model");

    }

    public function login(){

        if (get_active_user()){
            redirect(base_url());
        }

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $items = $this->user_model->get_all(
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
        $this->form_validation->set_rules("user_email","E-Posta","required|trim|valid_email");
        $this->form_validation->set_rules("user_password","Şifre","required|trim|min_length[4]|max_length[8]");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required"    => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "valid_email" => "Lütfen Geçerli Bir E-Posta Adresi Giriniz",
                "min_length"  => "<strong>{field}</strong> Alanına Minimum <strong> 4 </strong> Karakter Girmelisiniz",
                "max_length"  => "<strong>{field}</strong> Alanına Maksimum <strong> 8 </strong> Karakter Girmelisiniz"
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
            $user = $this->user_model->get(
                array(
                    "email"    => $this->input->post("user_email"),
                    "password" => md5($this->input->post("user_password")),
                    "isActive" => 1,
                )
            );

            if($user){

                $alert = [
                    "title"    => "İşlem Başarılı",
                    "message"  => "{$user->full_name}, Hoş geldiniz",
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

    public function send_email(){

        $config = array(
            "protocol" => "smtp",
            "smtp_host" => "ssl://smtp.gmail.com",
            "smtp_port" => "465",
            "smtp_user" => "denizyemek06@gmail.com",
            "smtp_pass" => "deniz1987",
            "starttls" => true,
            "charset" => "utf-8",
            "mailtype" => "html",
            "wordwrap" => true,
            "newline" => "\r\n",
        );

        $this->load->library("email", $config);

        $this->email->from("denizyemek06@gmail.com","CMS");
        $this->email->to("hamdiyildiz06@gmail.com");
        $this->email->subject("CMS için Email Çalışmaları");
        $this->email->message("Deneme e-postası...");


        if ($this->email->send()){
            echo "E-posta başarılı bir şekilde gönderildi";
        }else{
            echo $this->email->print_debugger();
        }


    }

    public function forget_password(){
        $viewData = new stdClass();

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "forget_password";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function reset_password(){
        $this->load->library("form_validation");

        // kurallar yazılır
        $this->form_validation->set_rules("email","E-Posta","required|trim|valid_email");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required"    => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "valid_email" => "Lütfen Geçerli Bir <strong>{field}</strong> Adresi Giriniz",
            )
        );

        if ($this->form_validation->run() === false){
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "forget_password";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }else{
            $user = $this->user_model->get(
                array(
                    "isActive" => 1,
                    "email" => $this->input->post("email"),
                )
            );

            if ($user){

                $this->load->helper("string");
                $temp_password = random_string();

                $send = send_email($user->email, "Şifremi unuttum","CMS'e geçici Olarak <strong> {$temp_password} </strong> ile Giriş Yapabilirsiniz...");

                if ($send){

                    echo "E-posta başarılı bir şekilde gönderildi";

                    $this->user_model->update(
                        array(
                            "id" => $user->id
                        ),
                        array(
                            "password" => md5($temp_password),
                        )
                    );

                    $alert = [
                        "title"    => "İşlem Başarılı",
                        "message"  => "Şifreniz Başarılı Bir Şekilde Güncellendi, Lütfen E-Postanızı Kontrol Ediniz...",
                        "type"     => "success"
                    ];

                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("login"));
                    die();

                }else{
//                    echo $this->email->print_debugger();
                    $alert = [
                        "title"    => "Bir Hata Oluştu!!!",
                        "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                        "type"     => "error"
                    ];

                    $this->session->set_flashdata("alert",$alert);
                    redirect(base_url("login"));
                }


            }else{

                $alert = [
                    "title"    => "Bir Hata Oluştu!!!",
                    "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                    "type"     => "error"
                ];

                $this->session->set_flashdata("alert",$alert);
                redirect(base_url("login"));
            }
        }


    }



























}