<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function province_get(){
        $id = $this->get( 'id' );
        if ( $id === null ){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: b0953e7e7ca5742d5e0569c113ad19bd"
            ),
            ));
            $response = curl_exec($curl);
            $province = json_decode($response, true);
            curl_close($curl);

            $this->response( $province, 200 );
        }else{
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: b0953e7e7ca5742d5e0569c113ad19bd"
            ),
            ));
            $response = curl_exec($curl);
            $provincebyid = json_decode($response, true);
            curl_close($curl);
            $this->response( $provincebyid, 200 );
        }
    }

    public function country_get(){
        $id = $this->get( 'id' );
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=".$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: b0953e7e7ca5742d5e0569c113ad19bd"
        ),
        ));
        $response = curl_exec($curl);
        $country = json_decode($response, true);
        curl_close($curl);

        $this->response( $country, 200 );
    }

    public function cost_post(){
        $origin = $this->post('origin');
        $destination = $this->post('destination');
        $weight = $this->post('weight');
        $courier = $this->post('courier');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$courier,
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded",
              "key: b0953e7e7ca5742d5e0569c113ad19bd"
            ),
          ));
        $response = curl_exec($curl);
        $cost = json_decode($response, true);
        curl_close($curl);

        $this->response( $cost, 200 );
    }
}