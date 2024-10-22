<?php

namespace App\Services;

use App\Models\CriminalArticle;
use App\Models\File;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;

class ExportDocument
{

    public static function download(File|CriminalArticle $model): never
    {
        $templateProcessor = new TemplateProcessor(resource_path('data/template.docx'));

        $ppTable = new Table();
        $ppTable->addRow();
        $cell = $ppTable->addCell();
        \PhpOffice\PhpWord\Shared\Html::addHtml($cell, '<h1>ПП</h1>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($cell, self::getClearHtml($model->pp));
        $templateProcessor->setComplexBlock('pp', $ppTable);
        $statyaKkTable = new Table();
        $statyaKkTable->addRow();
        $cell = $statyaKkTable->addCell();
        \PhpOffice\PhpWord\Shared\Html::addHtml($cell, '<h1>Судове рішення</h1>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($cell, self::getClearHtml($model->statya_kk));
        $templateProcessor->setComplexBlock('statya_kk', $statyaKkTable);


        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header("Content-Disposition: attachment; filename=\"{$model->getExportableFileName()}\"");
        $templateProcessor->saveAs('php://output');
        exit;
    }

    private static function getClearHtml(string $html): string
    {
        return preg_replace('/<img[^>]*>/i', '', preg_replace('/<a\s+[^>]*>(.*?)<\/a>/is', '$1', str_replace(['<br>', "\r\n", '&nbsp;'], ['<br />', ''], $html)));
    }

}
