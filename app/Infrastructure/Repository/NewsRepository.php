<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\News;
use App\Domain\Repository\NewsRepositoryInterface;
use App\Domain\ValueObject\Id;
use Illuminate\Support\Facades\DB;
use ReflectionProperty;

class NewsRepository implements NewsRepositoryInterface
{
    public function findAll(): iterable
    {
        $data = DB::table('news')->orderBy('created_at', 'desc')->get();
        $news = [];
        foreach ($data as $item) {
            $news[] = [
                'id' => $item->id,
                'url' => $item->url,
                'title' => $item->title,
                'created_at' => $item->created_at,
            ];
        }
        return $news;
    }

    public function findByIds(array $ids): iterable
    {
        $data = DB::table('news')->whereIn('id', $ids)->orderBy('created_at', 'desc')->get();
        $news = [];
        foreach ($data as $item) {
            $news[] = [
                'url' => $item->url,
                'title' => $item->title,
            ];
        }
        return $news;
    }

    public function save(News $news): void
    {
        $id = DB::table('news')->insertGetId([
            'title' => $news->getTitle()->getValue(),
            'url' => $news->getUrl()->getValue(),
            'created_at' => $news->getCreationDate()->getValue(),
        ]);

        $reflectionProperty = new ReflectionProperty(News::class, 'id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($news, new Id($id));
    }
}