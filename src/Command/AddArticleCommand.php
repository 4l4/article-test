<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 18:21
 */

namespace App\Command;

use App\Service\ArticleService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AddArticleCommand
 * @package App\Command
 */
class AddArticleCommand extends Command
{
    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * AddArticleCommand constructor.
     * @param ArticleService $articleService
     * @param null $name
     */
    public function __construct(ArticleService $articleService, $name = null)
    {
        $this->articleService = $articleService;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('app:add-article')
            ->setDescription('Adds a new article.')
            ->setHelp('This command allows you to add a new article.')
            ->addArgument('title', InputArgument::REQUIRED, 'Article title.')
            ->addArgument('text', InputArgument::REQUIRED, 'Article text.')
            ->addArgument('slug', InputArgument::OPTIONAL, 'Article slug.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $title = $input->getArgument('title');
        $text = $input->getArgument('text');
        $slug = $input->getArgument('slug');
        $article = $this->articleService->create($title, $text, $slug);
        $output->writeln([
            'Created article',
            "====================",
        ]);

        $output->writeln('Title: ' . $article->getTitle());
        $output->writeln('Text: ' . $article->getText());
        $output->writeln('Slug: /' . $article->getSlug());
    }
}