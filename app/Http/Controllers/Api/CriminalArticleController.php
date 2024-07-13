<?php

namespace App\Http\Controllers\Api;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CriminalArticleCategoryResource;
use App\Http\Resources\Api\CriminalArticleResource;
use App\Models\CriminalArticle;
use App\Services\ArticleFilterService;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;

class CriminalArticleController extends Controller
{

    private ArticleFilterService $filterService;

    public function __construct()
    {
        $this->filterService = new ArticleFilterService(request()->route('type'));
    }

    public function index()
    {
        if ($this->filterService->getType() == 'kk')
            can_user(PermissionEnum::MODULE_KK->value);
        elseif ($this->filterService->getType() == 'kpk')
            can_user(PermissionEnum::MODULE_KPK->value);

        $articles = $this->filterService->getArticles();

        return CriminalArticleResource::collection($articles);
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $items = [];

        if ($q)
            $items = CriminalArticle::select(['id', 'article_category_id', 'name', 'type', 'date'])
                ->where('name', 'like', "%{$q}%")
                ->orderBy('date', 'DESC')
                ->limit(50)
                ->get();

        return \Response::json(['data' => $items]);
    }

    public function show(CriminalArticle $criminalArticle)
    {
        can_user(PermissionEnum::LEGAL_BASE->value);

        return $criminalArticle;
    }

    public function categories()
    {
        $categories = $this->filterService->getCategories()->first()->children;

        return CriminalArticleCategoryResource::collection($categories);
    }

    public function exportDoc(Request $request, CriminalArticle $article)
    {
        can_user(PermissionEnum::EXPORT_PAGE->value);

        $templateProcessor = new TemplateProcessor(resource_path('data/template.docx'));

        $ppTable = new Table();
        $ppTable->addRow();
        $cell = $ppTable->addCell();
        \PhpOffice\PhpWord\Shared\Html::addHtml($cell, '<h1>ПП</h1>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($cell, $article->pp);
        $templateProcessor->setComplexBlock('pp', $ppTable);
        $statyaKkTable = new Table();
        $statyaKkTable->addRow();
        $cell = $statyaKkTable->addCell();
        \PhpOffice\PhpWord\Shared\Html::addHtml($cell, '<h1>Судове рішення</h1>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($cell, $article->statya_kk);
        $templateProcessor->setComplexBlock('statya_kk', $statyaKkTable);

        $templateProcessor->saveAs('php://output');

        \Response::download('php://output', $article->getExportableFileName(), [
            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ]);

//        $phpWord = new \PhpOffice\PhpWord\PhpWord();
//        $phpWord->addTitleStyle(1, 'Heading1', ['alignment' => 'center']);
//
//        $pp = $phpWord->addSection();
//        $pp->addTitle('ПП');
//        \PhpOffice\PhpWord\Shared\Html::addHtml($pp, $article->pp, false, false);
//
//        $statya_kk = $phpWord->addSection();
//        $statya_kk->addTitle('Судове рішення');
//        \PhpOffice\PhpWord\Shared\Html::addHtml($statya_kk, $article->statya_kk, false, false);
//
//        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord);
//        $objectWriter->save('php://output');
//
//        \Response::download('php://output', $article->getProgramTitle() . '.docx', [
//            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'
//        ]);

        exit(200);
    }

}
