<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use PhpOffice\PhpWord\IOFactory;

class FileService
{

    static function getDocumentContent(UploadedFile $document): string
    {
        $phpWord = IOFactory::load($document->path());

        $content = '';

        foreach($phpWord->getSections() as $section) {
            foreach($section->getElements() as $element) {
                if(method_exists($element,'getText')) {
                    $content .= $element->getText() . "<br>";
                }
            }
        }

        return $content;
    }

}
