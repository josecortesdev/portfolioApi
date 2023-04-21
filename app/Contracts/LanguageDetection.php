<?php
namespace App\Contracts;

interface LanguageDetection {
    public function detectLanguage(string $information): string;
}