<?php
return [
    'home' => ["requestMethod" => "get", "controllerClass" => "App\Controllers\HomeController", "methodName" => "index"],
    'login' => ["requestMethod" => "get", "controllerClass" => "App\Controllers\Admin\AuthController", "methodName" => "index"],
    'login-user' => ["requestMethod" => "post", "controllerClass" => "App\Controllers\Admin\AuthController", "methodName" => "loginUser"],
    'logout-user' => ["requestMethod" => "get", "controllerClass" => "App\Controllers\Admin\AuthController", "methodName" => "logoutUser"],
    'admin-page' => ["requestMethod" => "get", "controllerClass" => "App\Controllers\Admin\News\NewsController", "methodName" => "index"],
    'delete-news-item' => ["requestMethod" => "delete", "controllerClass" => "App\Controllers\Admin\News\NewsController", "methodName" => "delete"],
    'add-news-item' => ["requestMethod" => "post", "controllerClass" => "App\Controllers\Admin\News\NewsController", "methodName" => "add"],
    '404' => ["requestMethod" => "get","controllerClass" => "App\Controllers\PageNotFoundController", "methodName" => "index"]
];
