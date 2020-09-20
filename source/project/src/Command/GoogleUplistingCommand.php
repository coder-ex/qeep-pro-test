<?php

namespace App\Command;

use App\Service\GoogleService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GoogleUplistingCommand extends Command
{
    protected static $defaultName = 'app:google-uplisting';

    /** @var GoogleService */
    private $googleService;

    public function __construct(GoogleService $service) {
        parent::__construct();
        $this->googleService = $service;
    }

    protected function configure()
    {
        $this
            ->setDescription('Команда запуска обновления листинга Google Play store')
            ->addArgument('keyword', InputArgument::REQUIRED, 'ключь для поиска, обязательный аргумент')
            ->addArgument('depth', InputArgument::OPTIONAL, 'глубина поиска в количестве выдачи данных, по умолчанию 10')
            //->addOption('depth', null, InputOption::VALUE_NONE, 'глубина поиска в количестве выдачи данных, по умолчанию 10')
        ;
    }

    /**
     * @Route("/google", name="scraper")
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $key = $input->getArgument('keyword');
        $depth = $input->getArgument('depth');

        if(!$depth)
            $depth = 10;

        if($key)
            $io->note(sprintf('параметры запуска [ключь: %s, глубина: %s]', $key, $depth));

        $result = $this->googleService->serialize(['keyword' => $key, 'depth' => $depth], './public/js/google_parser.js', 5);
        $header = [];
        $rows = [];
        $size = count($result) + 1;
        $size_t = count($result[0]);
        for($row = 0; $row < $size; $row++) {
            $rows_t = [];
            for($col = 0; $col < $size_t; $col++) {
                if($row == 0) {
                    $header[] = $result[0][$col]['name'];
                    continue;
                }
                $rows_t[] = $result[$row - 1][$col]['strim'];
            }
            $rows[] = $rows_t;
        }

        $table = new Table($output);
        $table->setHeaders($header)->setRows($rows);
        $table->render();

        return Command::SUCCESS;
    }
}
