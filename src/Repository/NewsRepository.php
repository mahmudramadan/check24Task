<?php

namespace App\Repository;

use App\Entity\News;

class NewsRepository
{
    private object $news;

    public function __construct(object $news)
    {
        $this->news = $news;
    }

    /**
     * @return array
     */
    public function getNewsArray(): array
    {
        $allNews = [];
        foreach ($this->news as $newsItem) {
            $newsObject = new News();
            $newsObject->setId($newsItem->id);
            $newsObject->setTitle($newsItem->title);
            $newsObject->setAuthor($newsItem->author);
            $newsObject->setDescription($newsItem->description);
            $newsObject->setActive($newsItem->active);
            $newsObject->setCreatedAt($newsItem->created_at);
            array_push($allNews, $newsObject);
        }
        return $allNews;
    }
}