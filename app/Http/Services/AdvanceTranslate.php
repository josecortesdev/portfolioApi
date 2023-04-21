<?php
namespace App\Http\Services;

use App\Contracts\LanguageDetection;
use App\Contracts\TraductionGenerator;
use CurlHandle;

class AdvanceTranslate implements TraductionGenerator, LanguageDetection {

    public function setup(): CurlHandle {
        //
    }

    public function setContent(CurlHandle $setup, string $information): CurlHandle {
        //
    }

    public function getTraduction(CurlHandle $setup): string {
        //
    }

    public function detectLanguage(string $information): string
    {
        //
    }
}