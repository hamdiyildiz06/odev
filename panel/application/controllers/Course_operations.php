<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_operations extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "course_operations_v";
        $this->load->model("lesson_model");
        $this->load->model("course_operation_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){
        $viewData = new stdClass();
        $student_user_id = get_active_user();

        /** tablodan verilerin getirilmesi */
        $items = $this->course_operation_model->get_all(
            array(
                "student_id" => $student_user_id->id
            )
        );

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items         = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){
        $viewData = new stdClass();
        $items = $this->lesson_model->get_all(
            array()
        );
        $viewData->stdid = $this->uri->segment(3);

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save($item_id = "", $user_id = "", $master = false){

            $bul = $this->course_operation_model->get(
                array(
                    "lesson_id" => $item_id,
                    "student_id" => $user_id
                )
            );


            if($bul){

                $alert = [
                    "title"    => "Bir Hata Oluştu!!!",
                    "message"  => "Secmiş olduğunuz ders daha önce eklenmiş olmalı, Lütfen kontrol ediniz",
                    "type"     => "error"
                ];


            }else{

                $insert = $this->course_operation_model->add(
                    array(
                        "lesson_id"   => $item_id,
                        "student_id"  => $user_id,
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
            }

            $this->session->set_flashdata("alert", $alert);
            if ($master == false){
                redirect(base_url("course_operations"));
            }else{
                redirect(base_url("dashboard/student_classes/{$user_id}"));
            }

    }

    public function update_form($id){
        $viewData = new stdClass();

        /** Tablodan verilerin getirilmesi ..*/
        $item  =  $this->course_operation_model->get(
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

        //Hata mesajlarının Oluşturulması
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> Alanını Boş Bırakmayınız.."
            )
        );

        // form_validation çalıştırılır
        $validate = $this->form_validation->run();

        if($validate){

            $update = $this->course_operation_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "title"       => $this->input->post("title"),
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
            redirect(base_url("course_operations"));

        }else{
            $viewData = new stdClass();

            /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
            $viewData->viewFolder    = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item  =  $this->course_operation_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){
        $delete = $this->course_operation_model->delete(
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
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function isActiveSetter($id){
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->course_operation_model->update(
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