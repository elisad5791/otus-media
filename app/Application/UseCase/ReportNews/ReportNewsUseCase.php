<?php

namespace App\Application\UseCase\ReportNews;

use App\Domain\Repository\NewsRepositoryInterface;
use DOMDocument;

class ReportNewsUseCase
{
    public function __construct(
        private readonly NewsRepositoryInterface $newsRepository,
    ) {}

    public function __invoke(ReportNewsRequest $request): ReportNewsResponse
    {
        $ids = $request->ids;

        $news = $this->newsRepository->findByIds($ids);

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $html = $dom->createElement('html');
        $dom->appendChild($html);

        $head = $dom->createElement('head');
        $html->appendChild($head);
        $metaCharset = $dom->createElement('meta');
        $metaCharset->setAttribute('charset', 'UTF-8');
        $head->appendChild($metaCharset);
        $title = $dom->createElement('title', 'Список новостей');
        $head->appendChild($title);

        $body = $dom->createElement('body');
        $html->appendChild($body);
        $h1 = $dom->createElement('h1', 'Сводный отчет');
        $body->appendChild($h1);
        $ul = $dom->createElement('ul');
        $body->appendChild($ul);

        foreach ($news as $item) {
            $li = $dom->createElement('li');
            $ul->appendChild($li);

            $a = $dom->createElement('a', $item['title']);
            $a->setAttribute('href', $item['url']);
            $li->appendChild($a);
        }
        
        $filename = 'report' . uniqid() . '.html';
        $dom->save($filename);
        
        $link = env('APP_URL'). '/' . $filename;
        return new ReportNewsResponse($link);
    }
}