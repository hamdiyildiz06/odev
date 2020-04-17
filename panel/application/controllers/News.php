<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "news_v";
        $this->load->model("news_model");
//        $this->load->model("news_image_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index(){

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $items = $this->news_model->get_all(
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

        $news_type = $this->input->post("news_type");

        if ($news_type == "image"){

            if ($_FILES["img_url"]["name"] == ""){
                $alert = [
                    "title"    => "Bir Hata Oluştu!!!",
                    "message"  => "İşleminiz Tamamlanamadı Lütfen Bir Görsel Seçiniz ve Tekrar Deneyiniz",
                    "type"     => "error"
                ];

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("news/new_form"));
            }

        }else if ($news_type == "video"){

            $this->form_validation->set_rules("video_url","Video URL","required|trim");

        }

        // kurallar yazılır
        $this->form_validation->set_rules("title","Başlık","required|trim");


        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız.."
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            if ($news_type == "image"){

                $file_name = convertToSEO(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)) . "." . pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
                $image_513x289 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/{$this->viewFolder}", 513,289, $file_name);
                $image_730x411 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/{$this->viewFolder}", 730,411, $file_name);

                if($image_513x289 && $image_730x411){

                    $data =  array(
                        "title"       => $this->input->post("title"),
                        "description" => $this->input->post("description"),
                        "url"         => convertToSEO($this->input->post("title")),
                        "news_type"   => $news_type,
                        "img_url"   => $file_name,
                        "video_url"   => "#",
                        "rank"        => 0,
                        "isActive"    => 1,
                        "createdAt"   => date("Y-m-d H:i:s ")
                    );

                }else{
                    $alert = [
                        "title"    => "Bir Hata Oluştu!!!",
                        "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                        "type"     => "error"
                    ];

                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("news/new_form"));
                    die();

                }



            }else if ($news_type == "video"){

                $data =  array(
                    "title"       => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                    "url"         => convertToSEO($this->input->post("title")),
                    "news_type"   => $news_type,
                    "img_url"   => "#",
                    "video_url"   => $this->input->post("video_url"),
                    "rank"        => 0,
                    "isActive"    => 1,
                    "createdAt"   => date("Y-m-d H:i:s ")
                );

            }

            $insert = $this->news_model->add($data);

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
            redirect(base_url("news"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $viewData->news_type = $news_type;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_form($id){
        $viewData = new stdClass();

        /** Tablodan verilerin getirilmesi ..*/
        $item  =  $this->news_model->get(
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

        $news_type = $this->input->post("news_type");

         if ($news_type == "video"){

            $this->form_validation->set_rules("video_url","Video URL","required|trim");

        }

        // kurallar yazılır
        $this->form_validation->set_rules("title","Başlık","required|trim");


        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız.."
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            if ($news_type == "image"){

                if ($_FILES["img_url"]["name"] !== ""){

                    $file_name = convertToSEO(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)) . "." . pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
                    $image_513x289 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/{$this->viewFolder}", 513,289, $file_name);
                    $image_730x411 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/{$this->viewFolder}", 730,411, $file_name);

                    if($image_513x289 && $image_730x411){

                        delete_picture("news_model",$id,"513x289");
                        delete_picture("news_model",$id,"730x411");

                        $data =  array(
                            "title"       => $this->input->post("title"),
                            "description" => $this->input->post("description"),
                            "url"         => convertToSEO($this->input->post("title")),
                            "news_type"   => $news_type,
                            "img_url"   => $file_name,
                            "video_url"   => "#",
                        );



                    }else{
                        $alert = [
                            "title"    => "Bir Hata Oluştu!!!",
                            "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                            "type"     => "error"
                        ];

                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url("news/update_form/{$id}"));
                        die();

                    }

                }else{
                    $data =  array(
                        "title"       => $this->input->post("title"),
                        "description" => $this->input->post("description"),
                        "url"         => convertToSEO($this->input->post("title")),
                        "news_type"   => $news_type,
                        "video_url"   => "#",
                    );
                }

            }else if ($news_type == "video"){

                $data =  array(
                    "title"       => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                    "url"         => convertToSEO($this->input->post("title")),
                    "news_type"   => $news_type,
                    "img_url"   => "#",
                    "video_url"   => $this->input->post("video_url"),
                );
            }

            $update = $this->news_model->update(array("id" => $id), $data);

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
            redirect(base_url("news"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->news_type = $news_type;

            $viewData->item  =  $this->news_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){

        delete_picture("news_model",$id,"513x289");
        delete_picture("news_model",$id,"730x411");

        $delete = $this->news_model->delete(
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
        redirect(base_url("news"));
    }

    public function isActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->news_model->update(
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
            $update = $this->news_model->update(
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