<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 18:24
 */

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ArticleService
 * @package App\Service
 */
class ArticleService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ArticleService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $title
     * @param $text
     * @param null $slug
     * @return Article
     */
    public function create($title, $text, $slug = null)
    {
        $article = new Article();
        $article->setTitle($title);
        $article->setText($text);
        if($slug) {
            $article->setSlug($slug);
        }

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $article;
    }
}