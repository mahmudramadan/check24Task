<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as DB;

class NewsModel
{
    public static function getAll(array $conditions = [], string $orderBy = "id", string $orderType = "DESC", int $limit = 10, int $offset = 0): ?object
    {
        $query = DB::table('news');
        if (count($conditions) > 0 ){
            foreach ($conditions as $key=>$value){
                $query->where($key,$value);
            }
        }
        $query->orderBy($orderBy,$orderType);
        $query->limit($limit);
        $query->offset($offset);
        return $query->get();
    }

    public static function insertNewsItem(array $data)
    {
        if(DB::table('news')->insert($data)){
         return DB::getPdo()->lastInsertId();
        }
        return false;
    }
    public static function deleteNewsItem(int $id):void
    {
        DB::table("news")->where("id","=",$id)->delete();
    }
    public static function getAllAuthors(): ?object
    {
        return DB::table('authors')->where('active', "=", 1)->get();
    }
}