<?php
declare(strict_types=1);

namespace Entity;

use App\Entity\News;
use PHPUnit\Framework\TestCase;

/**
 * UsersEntityTest
 * test setter and getter of News data
 */
final class NewsEntityTest extends TestCase
{

    private object $news;

    /**
     * test setter functions
     */
    protected function setUp(): void
    {
        $this->news = new News();
            $this->news->setTitle("News Title 1");
        $this->news->setAuthor("Mahmoud Ramadan");
        $this->news->setDescription("Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.");
        $this->news->setActive(true);
    }

    /**
     * test Getter functions
     */
    public function testGetter(): void
    {
        self::assertSame("News Title 1", $this->news->getTitle());
        self::assertSame("Mahmoud Ramadan", $this->news->getAuthor());
        self::assertSame("Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.", $this->news->getDescription());
        self::assertSame(true, $this->news->isActive());
    }

    /**
     *
     * @dataProvider newsProvoder
     * @param string $title
     * @param string $description
     * @param string $author
     * @param bool $active
     * @return void
     * @throws \Exception
     */
    public function testData(string $title, string $description, string $author, bool $active): void
    {
        $this->news->setTitle($title);
        $this->news->setDescription($description);
        $this->news->setAuthor($author);
        $this->news->setActive($active);
        self::assertEquals($title, $this->news->getTitle());
        self::assertEquals($description, $this->news->getDescription());
        self::assertEquals($author, $this->news->getAuthor());
        self::assertEquals($active, $this->news->isActive());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function newsProvoder(): array
    {
        return [

            [
                "title" => "News title 1",
                "description" => "News description 1",
                "auther" => "Mahmoud Ramadan",
                "active" => true,
            ], [
                "title" => "News title 2",
                "description" => "News description 2",
                "auther" => "Felix Kakrow",
                "active" => true,
            ], [
                "title" => "News title 3",
                "description" => "News description 3",
                "auther" => "Mahmoud Ali",
                "active" => false,
            ], [
                "title" => "News title 4",
                "description" => "News description 4",
                "auther" => "Mahmoud Ramadans",
                "active" => false,
            ],

        ];
    }
}