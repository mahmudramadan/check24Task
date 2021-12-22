<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Models\NewsModel;
use App\Repository\NewsRepository;

class HomeController extends \App\Controllers\BaseController
{
    public function __construct()
    {
    }

    public function index(array $params = [])
    {
        $newsItems = NewsModel::getAll(['active' => true]);
        $allNews = [];
        if ($newsItems != null) {
            $newsRepository = new NewsRepository($newsItems);
            $allNews = $newsRepository->getNewsArray();
        }
        $data = ['title' => "home page", "News" => $allNews];
        $this->view("home/index", $data);
    }

}