<?php
namespace App\Http\Services;

use App\Contracts\TraductionGenerator;
use CurlHandle;

class RapidTranslate implements TraductionGenerator {
    public function __construct() {
        $this->setup();
    }

    public function setup(): CurlHandle {
        $setup = curl_init();
        return $setup;
    }

    public function setContent(CurlHandle $setup, string $information): CurlHandle {
        
        curl_setopt_array($setup, [
            CURLOPT_URL => "https://rapid-translate-multi-traduction.p.rapidapi.com/t",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r
            \"from\": \"es\",\r
            \"to\": \"en\",\r
            \"e\": \"\",\r
            \"q\": \"$information\"\r
            \r
        }",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: " . env('RAPIDAPI_HOST', null),
                "X-RapidAPI-Key: " . env('RAPIDAPI_KEY', null),
                "content-type: application/json"
            ],
        ]);

        return $setup;
    }

    public function getTraduction(CurlHandle $setup): string {

        $response = curl_exec($setup);
        $err = curl_error($setup);
        
        curl_close($setup);

        return str_replace(["\"", "[", "]", "{\"information\":\"", "\"}"], "", $response);
        
    }
}