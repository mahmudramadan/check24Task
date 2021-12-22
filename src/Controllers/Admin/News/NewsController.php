<?php
declare(strict_types=1);

namespace App\Controllers\Admin\News;

use App\Controllers\BaseController;
use App\Interfaces\ResourcesInterface;
use App\Models\NewsModel;
use App\Repository\AuthorRepository;
use App\Repository\NewsRepository;

class NewsController extends BaseController implements ResourcesInterface
{
    public function __construct()
    {
        if (!isset($_SESSION['isLogged'])) {
            header('Location: /login ');
        }
    }

    public function index()
    {
        $newsData = NewsModel::getAll();
        $allNews = [];
        if ($newsData != null) {
            $newsRepository = new NewsRepository($newsData);
            $allNews = $newsRepository->getNewsArray();
        }
        $authersData = NewsModel::getAllAuthors();
        $allAuthers = [];
        if ($authersData != null) {
            $autherRepository = new AuthorRepository($authersData);
            $allAuthers = $autherRepository->getAuthorArray();
        }
        $data = ['title' => "admin news page", "News" => $allNews, "allAuthers" => $allAuthers];
        $this->view("admin/news/index", $data);
    }

    public function add()
    {
        $dataEnterArray = ['title', 'author', 'active', 'description'];
        $data = [];
        foreach ($dataEnterArray as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                echo json_encode(["success" => false, "message" => "$field is required"]);
                die;
            }
            $data[$field] = strip_tags($_POST[$field]);
        }
        try {
            $id = NewsModel::insertNewsItem($data);
            $data = NewsModel::getAll(['id'=>$id]);
            echo json_encode(["success" => true, "message" => "item added successfully", "result" => $data]);
        } catch (\Exception $exception) {
            echo json_encode(["success" => false, "message" => $exception->getMessage()]);
        }

    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete(array $params)
    {
        if (count($params) == 0) {
            echo json_encode(['success' => false, 'message' => "kindly contact company"]);
        } else {
            $id = $params[0];
            try {
                NewsModel::deleteNewsItem((int)$id);
                echo json_encode(["success" => true, "message" => "item deleted successfully"]);
            } catch (\Exception $exception) {
                echo json_encode(["success" => false, "message" => $exception->getMessage()]);
            }
        }
    }
}