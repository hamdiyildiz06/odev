<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ogrenci extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "ogrenci_v";
        $this->load->model("ogrenci_model");
        $this->load->model("portfolio_model");
        $this->load->model("portfolio_image_model");
        $this->load->model("portfolio_category_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index(){

        $viewData = new stdClass();


        /** tablodan verilerin getirilmesi */
        $items = $this->ogrenci_model->get_all(
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
        $viewData->categories = $this->portfolio_category_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $viewData->bolumler = $this->portfolio_model->get_all(
            array(
                "category_id" => 1
            )
        );

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
        $this->form_validation->set_rules("category_id","Fakülte","required|trim");
        $this->form_validation->set_rules("portfolyo_id","Bölüm","required|trim");
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


            $insert = $this->ogrenci_model->add(
                array(
                    "url"          => convertToSEO($this->input->post("title")),
                    "title"        => $this->input->post("title"),
                    "category_id"  => $this->input->post("category_id"),
                    "portfolyo_id"  => $this->input->post("portfolyo_id"),
                    "brands_id"  => $this->input->post("brands_id"),
                    "rank"          => 0,
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
            redirect(base_url("ogrenci"));

        }else{

            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $viewData->categories = $this->portfolio_category_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            $viewData->bolumler = $this->portfolio_model->get_all(
                array(
                    "category_id" => 1
                )
            );

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
        $item  =  $this->ogrenci_model->get(
            array(
                "id" => $id
            )
        );

        $categories = $this->portfolio_category_model->get_all(
            array(
                "isActive" => 1,
            )
        );

        $viewData->bolumler = $this->portfolio_model->get_all(
            array(
                "category_id" => $item->category_id
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
        $viewData->categories = $categories;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id){
        $this->load->library("form_validation");

        // kurallar yazılır
        $this->form_validation->set_rules("title","İsim Soyisim","required|trim");
        $this->form_validation->set_rules("category_id","Fakülte","required|trim");
        $this->form_validation->set_rules("portfolyo_id","Bölüm","required|trim");
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
            $update = $this->ogrenci_model->update(
                array(
                    "id"          => $id
                ),
                array(
                    "url"          => convertToSEO($this->input->post("title")),
                    "title"        => $this->input->post("title"),
                    "category_id"  => $this->input->post("category_id"),
                    "portfolyo_id"  => $this->input->post("portfolyo_id"),
                    "brands_id"  => $this->input->post("brands_id")
                )
            );

            if($update){
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
            redirect(base_url("ogrenci"));
        }else{
            $viewData = new stdClass();

            /** Tablodan verilerin getirilmesi ..*/
            $viewData->item  =  $this->ogrenci_model->get(
                array(
                    "id" => $id
                )
            );

            $viewData->bolumler = $this->portfolio_model->get_all(
                array(
                    "category_id" => 1
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

            $viewData->categories = $this->portfolio_category_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){

        $delete = $this->ogrenci_model->delete(
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
        redirect(base_url("portfolio"));
    }

    public function imageDelete($id, $parent_id){
        $fileName =  $this->portfolio_image_model->get(
            array(
                "id" => $id
            )
        );

        $delete = $this->portfolio_image_model->delete(
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
            unlink("uploads/{$this->viewFolder}/255x157/{$fileName->img_url}");
            unlink("uploads/{$this->viewFolder}/1080x426/{$fileName->img_url}");
        }else{

            $alert = [
                "title"    => "Bir Hata Oluştu!!!",
                "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                "type"     => "error"
            ];

        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("portfolio/image_form/{$parent_id}"));
    }

    public function isActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->ogrenci_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive,
                )
            );
        }
    }

    public function imageIsActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->portfolio_image_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive,
                )
            );
        }
    }

    public function isCoverSetter($id, $parend_id){
        if ($id && $parend_id){
            $isCover = ($this->input->post("data") === "true") ? 1 : 0;

            // Kapak Yapılmak istenen kayıt
            $this->portfolio_image_model->update(
                array(
                    "id"         => $id,
                    "portfolio_id" => $parend_id
                ),
                array(
                    "isCover" => $isCover,
                )
            );

            //kapak yapılmayan diğer kayıtlar
            $this->portfolio_image_model->update(
                array(
                    "id !="      => $id,
                    "portfolio_id" => $parend_id
                ),
                array(
                    "isCover" => 0,
                )
            );

            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "image";

            $viewData->item_images = $this->portfolio_image_model->get_all(
                array(
                    "portfolio_id" => $parend_id
                ),"rank ASC"
            );

            $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
            echo $render_html;

        }
    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id ){
            $update = $this->ogrenci_model->update(
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

    public function imageRankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id ){
            $update = $this->portfolio_image_model->update(
                array(
                    "id"      => $id,
                    "rank !=" => $rank
                ),
                array(
                    "rank" => $rank
                )
            );
        }
    }

    public function image_form($id){
        $viewData = new stdClass();

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item = $this->ogrenci_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item_images = $this->portfolio_image_model->get_all(
            array(
                "portfolio_id" => $id
            ),"rank ASC"
        );

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function image_update($id){
        $file_name = convertToSEO(pathinfo($_FILES['file']['name'], PATHINFO_FILENAME)) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        $image_255x157 = upload_picture($_FILES["file"]["tmp_name"], "uploads/{$this->viewFolder}", 255,157, $file_name);
        $image_1080x426 = upload_picture($_FILES["file"]["tmp_name"], "uploads/{$this->viewFolder}", 1080,426, $file_name);

        if($image_255x157 && $image_1080x426){

            $this->portfolio_image_model->add(
                array(
                    "portfolio_id" => $id,
                    "img_url" => $file_name,
                    "rank" => 0,
                    "isActive" => 1,
                    "createdAt" => date("Y-m-d H:i:s")
                )
            );

        }else{
            $alert = [
                "title"    => "Bir Hata Oluştu!!!",
                "message"  => "İşleminiz Tamamlanamadı Lütfen Tekrar Deneyiniz",
                "type"     => "error"
            ];
            echo "üzgünün lütfen tekrar dene";
        }
    }

    public function refresh_image_list($id){
        $viewData = new stdClass();

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item_images = $this->portfolio_image_model->get_all(
            array(
                "portfolio_id" => $id
            ),"rank ASC"
        );

        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
        echo $render_html;
    }

    public function categoriSec($id){
        if ($id){

            $bolumler = $this->portfolio_model->get_all(
                array(
                    "category_id" => $id
                )
            );

            foreach ($bolumler as $bolum ){
                echo "<option value='$bolum->id'>".$bolum->title."</option>";
            }
        }
    }

}