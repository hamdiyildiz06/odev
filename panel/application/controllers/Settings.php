<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "settings_v";
        $this->load->model("settings_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $item = $this->settings_model->get(
            array()
        );


        if ($item)
            $viewData->subViewFolder = "update";
        else
            $viewData->subViewFolder = "no_content";


        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;

        $viewData->item         = $item;

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


        if ($_FILES["logo"]["name"] == ""){
            $alert = [
                "title"    => "Bir Hata Oluştu!!!",
                "message"  => "İşleminiz Tamamlanamadı Lütfen Bir Görsel Seçiniz ve Tekrar Deneyiniz",
                "type"     => "error"
            ];

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("settings/new_form"));
            die();
        }

        // kurallar yazılır
        $this->form_validation->set_rules("company_name","Şirket Adı","required|trim");
        $this->form_validation->set_rules("phone_1","Telefon 1","required|trim");
        $this->form_validation->set_rules("email","E-Posta","required|trim|valid_email");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "valid_email" => "Lütfen Geçerli Bir <strong>{field}</strong> Adresi Giriniz.."
            )
        );


        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $file_name = convertToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $image_150x35 = upload_picture($_FILES["logo"]["tmp_name"], "uploads/{$this->viewFolder}", 150,35, $file_name);

            if($image_150x35){

                $insert = $this->settings_model->add(
                    array(
                        "company_name"  => $this->input->post("company_name"),
                        "phone_1"       => $this->input->post("phone_1"),
                        "phone_2"       => $this->input->post("phone_2"),
                        "fax_1"         => $this->input->post("fax_1"),
                        "fax_2"         => $this->input->post("fax_1"),
                        "address"       => $this->input->post("address"),
                        "about_us"      => $this->input->post("about_us"),
                        "mission"       => $this->input->post("mission"),
                        "vision"        => $this->input->post("vision"),
                        "email"         => $this->input->post("email"),
                        "facebook"      => $this->input->post("facebook"),
                        "twitter"       => $this->input->post("twitter"),
                        "instagram"     => $this->input->post("instagram"),
                        "linkedin"      => $this->input->post("linkedin"),
                        "logo"          => $file_name,
                        "createdAt"     => date("Y-m-d H:i:s ")
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
                redirect(base_url("settings/new_form"));
                die();

            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("settings"));

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
        $item  =  $this->settings_model->get(
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
        $this->form_validation->set_rules("company_name","Şirket Adı","required|trim");
        $this->form_validation->set_rules("phone_1","Telefon 1","required|trim");
        $this->form_validation->set_rules("email","E-Posta","required|trim|valid_email");

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız..",
                "valid_email" => "Lütfen Geçerli Bir <strong>{field}</strong> Adresi Giriniz.."
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            if ($_FILES["logo"]["name"] !== ""){


                $eskiLogoSil = $this->settings_model->get(
                    array(
                        "id" => $id
                    )
                );

                if ($eskiLogoSil){
                    unlink("uploads/{$this->viewFolder}/150x35/$eskiLogoSil->logo");
                }


                $file_name = convertToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $image_150x35 = upload_picture($_FILES["logo"]["tmp_name"], "uploads/{$this->viewFolder}", 150,35, $file_name);

                if($image_150x35){

                    $data = array(
                        "company_name"  => $this->input->post("company_name"),
                        "phone_1"       => $this->input->post("phone_1"),
                        "phone_2"       => $this->input->post("phone_2"),
                        "fax_1"         => $this->input->post("fax_1"),
                        "fax_2"         => $this->input->post("fax_1"),
                        "address"       => $this->input->post("address"),
                        "about_us"      => $this->input->post("about_us"),
                        "mission"       => $this->input->post("mission"),
                        "vision"        => $this->input->post("vision"),
                        "email"         => $this->input->post("email"),
                        "facebook"      => $this->input->post("facebook"),
                        "twitter"       => $this->input->post("twitter"),
                        "instagram"     => $this->input->post("instagram"),
                        "linkedin"      => $this->input->post("linkedin"),
                        "logo"          => $file_name,
                        "updatedAt"     => date("Y-m-d H:i:s ")
                    );

                }else{
                    $alert = [
                        "title"    => "Bir Hata Oluştu!!!",
                        "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                        "type"     => "error"
                    ];

                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("settings/update_form/{$id}"));
                    die();

                }

            }else{
                $data = array(
                    "company_name"  => $this->input->post("company_name"),
                    "phone_1"       => $this->input->post("phone_1"),
                    "phone_2"       => $this->input->post("phone_2"),
                    "fax_1"         => $this->input->post("fax_1"),
                    "fax_2"         => $this->input->post("fax_1"),
                    "address"       => $this->input->post("address"),
                    "about_us"      => $this->input->post("about_us"),
                    "mission"       => $this->input->post("mission"),
                    "vision"        => $this->input->post("vision"),
                    "email"         => $this->input->post("email"),
                    "facebook"      => $this->input->post("facebook"),
                    "twitter"       => $this->input->post("twitter"),
                    "instagram"     => $this->input->post("instagram"),
                    "linkedin"      => $this->input->post("linkedin"),
                    "updatedAt"     => date("Y-m-d H:i:s ")
                );
            }

            $update = $this->settings_model->update(array("id" => $id), $data);

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

            // Session Update İşlemi
            $settings = $this->settings_model->get();
            $this->session->set_userdata("settings",$settings);


            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("settings"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item  =  $this->settings_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

}