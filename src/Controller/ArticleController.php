<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 18:06
 */

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/news/{slug}", name="article_show")
     *
     * @param Article $article
     * @return mixed
     */
    public function showAction(Article $article)
    {
        if (!$article) {
            throw $this->createNotFoundException('The article does not exist');
        }

        return $this->render('views/article/show.html.twig', [
            'article' => $article,
            ]);
    }
}