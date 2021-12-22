<?php

namespace App\Repository;

use App\Entity\Author;

class AuthorRepository
{
    private object $author;

    public function __construct(object $author)
    {
        $this->author = $author;
    }

    /**
     * @return array
     */
    public function getAuthorArray(): array
    {
        $allAuthers = [];
        foreach ($this->author as $authorItem) {
            $authorObject = new Author();
            $authorObject->setId($authorItem->id);
            $authorObject->setName($authorItem->name);
            array_push($allAuthers, $authorObject);
        }
        return $allAuthers;
    }
}