<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $viewFolder = "";

//    public $user;
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "dashboard_v";
        $this->load->model("ogrenci_model");
        $this->load->model("brand_model");
        $this->load->model("course_model");
        $this->load->model("portfolio_model");
        $this->load->model("portfolio_category_model");
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
	{
        $viewData = new stdClass();



        /** tablodan verilerin getirilmesi */
        $items = $this->ogrenci_model->get_all(
            array(),"rank ASC"
        );

        $viewData->courses = $this->course_model->get(
            array(
                "isActive" => 1
            )
        );


        /** Listeler için gerekli */
        $viewData->fakulte = count($this->portfolio_category_model->get_all());
        $viewData->bolum = count($this->portfolio_model->get_all());
        $viewData->sinif = count($this->brand_model->get_all());
        $viewData->ogren = count($this->ogrenci_model->get_all());


        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items         = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

    public function sinavkaristir()
    {
        $viewData = new stdClass();

        $this->load->model("brand_model");
        $this->load->model("ogrenci_model");

        $viewData->fakulte = count($this->portfolio_category_model->get_all());
        $viewData->bolum = count($this->portfolio_model->get_all());
        $viewData->sinif = count($this->brand_model->get_all());
        $viewData->ogren = count($this->ogrenci_model->get_all());


        $siniflar = $this->brand_model->get_all();
        $ogrenci = $this->ogrenci_model->get_all();
//        shuffle($ogrenci);



        $this->ogrenci_model->update(
            array(
                "sec" => 1,
            ),
            array(
                "sec" => 0,
                "sbrands" => 0
            )
        );

        foreach ($siniflar as $sinif){

            $orrenci = $this->ogrenci_model->get_alll(
                array(
                    "isActive"  => 1,
                    "category_id" => $sinif->category_id,
                    "sec" => 0
                ), "rand()", array("start" => 0, "count" =>$sinif->mevcut)
            );
            $sira = 1;
            foreach ($orrenci as $oren){

                $update = $this->ogrenci_model->update(
                    array(
                        "category_id" => $sinif->category_id,
                        "sec" => 0,
                        "id" => $oren->id
                    ),
                    array(
                        "sbrands" => $sinif->id,
                        "sec" => 1,
                        "sira" => $sira
                    )
                );
                $sira++;
            }

        }






 //       print_r($orrenci);
//        print_r($orrenci[0]->id);

//        $this->ogrenci_model->update(
//            array(
//                "sec" => 0,
//            ),
//            array(
//                "sec" => 0,
//                "sbrands" => 0
//            )
//        );
//
//die();
//        foreach ($siniflar as $sinif){
//            for ($x = 1; $sinif->mevcut >= $x; $x++){
//
//                $orrenci = $this->ogrenci_model->get_alll(
//                    array(
//                        "isActive"  => 1,
//                        "category_id" => $sinif->category_id,
//                        "sec" => 0
//                    ), "rand()", array("start" => 0, "count" =>$sinif->mevcut)
//                );
//
//                foreach ($orrenci as $oren){
//
//                    $update = $this->ogrenci_model->update(
//                        array(
//                            "category_id" => $sinif->category_id,
//                            "sec" => 0,
//                            "id" => $oren->id
//                        ),
//                        array(
//                            "sbrands" => $sinif->id,
//                            "sec" => 1
//                        )
//                    );
//                }
//            }
//        }

//        for($s = 1; $siniflar->mevcut > $s;  $s++ ){
//            $update = $this->ogrenci_model->update(
//                array(
//                    "category_id" => 1,
//                    "sbrands" => 0,
//                    "id" => rand()
//                ),
//                array(
//                    "sbrands" => 2
//                )
//            );
//        }


//        $update = $this->ogrenci_model->update(
//            array(
//                "category_id" => 1
//            ),
//            array(
//                "sbrands" => 0
//            )
//        );




//        if ($update){
//            echo "işlem başarılı";
//        }else{
//            echo "işlem olmadı";
//        }

//        foreach ($siniflar as $sinif){
//            $id =+ 1;
//            $category =+ 1;
//        }
//
//        $update = $this->ogrenci_model->update(
//            array(
//                "category_id" => 1,
//                "sbrands" => 0,
//                "id" => rand()
//            ),
//            array(
//                "sbrands" => 2
//            )
//        );










//        foreach ($siniflar as $sinif){
//
//            $this->product_model->get_alll(
//                array(
//                    "isActive"  => 1,
//                    "id !="     => $viewData->product->id
//                ), "rand()", array("start" => 0, "count" => 3)
//            );
//
//        }






//        $this->product_model->get_alll(
//            array(
//                "isActive"  => 1,
//                "id !="     => $viewData->product->id
//            ), "rand()", array("start" => 0, "count" => 3)
//        );


//        /** tablodan verilerin getirilmesi */
//        $items = $this->ogrenci_model->get_all(
//            array(),"rank ASC"
//        );


//        $update = $this->ogrenci_model->update(
//            array(
//                "id"          => $id
//            ),
//            array(
//                "url"          => convertToSEO($this->input->post("title")),
//                "title"        => $this->input->post("title"),
//                "category_id"  => $this->input->post("category_id"),
//                "portfolyo_id"  => $this->input->post("portfolyo_id"),
//                "brands_id"  => $this->input->post("brands_id")
//            )
//        );


        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items         = $ogrenci;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function profilim(){
        $viewData = new stdClass();

        $viewData->fakulte = count($this->portfolio_category_model->get_all());
        $viewData->bolum = count($this->portfolio_model->get_all());
        $viewData->sinif = count($this->brand_model->get_all());
        $viewData->ogren = count($this->ogrenci_model->get_all());

        /** View'e Gönderilecek değişkenlerin set edilmesi ..*/
        $viewData->viewFolder    = $this->viewFolder;
        $viewData->subViewFolder = "profilim";
       // $viewData->items         = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }
}
