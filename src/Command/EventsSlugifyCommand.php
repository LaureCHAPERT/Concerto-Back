<?php

namespace App\Command;

use App\Repository\EventRepository;
use App\Service\MySlugger;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class EventsSlugifyCommand extends Command
{
    protected static $defaultName = 'app:events:slugify';
    protected static $defaultDescription = 'Slugifies events titles in the database';

    // Nos services
    private $eventRepository;
    private $mySlugger;
    private $entityManager;

    public function __construct(EventRepository $eventRepository, MySlugger $mySlugger, ManagerRegistry $doctrine)
    {
        $this->eventRepository = $eventRepository;
        $this->mySlugger = $mySlugger;
        $this->entityManager = $doctrine->getManager();

        parent::__construct();
    }

    protected function configure(): void
    {
        
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $io->info('Mise à jour des slugs');

        $events = $this->eventRepository->findAll();

        foreach ($events as $event) {

            $event->setSlug($this->mySlugger->slugify($event->getName()));
        }

        $this->entityManager->flush();

        $io->success('Les slugs ont été mis à jour');

        return Command::SUCCESS;
    }
}
