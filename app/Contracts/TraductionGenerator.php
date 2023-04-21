<?php
namespace App\Contracts;

use CurlHandle;

interface TraductionGenerator {
    public function setup(): CurlHandle;
    public function setContent(CurlHandle $setup, string $information): CurlHandle;
    public function getTraduction(CurlHandle $setup): string;
}