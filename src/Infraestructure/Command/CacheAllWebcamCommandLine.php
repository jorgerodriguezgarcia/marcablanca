<?php

namespace App\Infraestructure\Command;

use App\Application\CacheAllWebcam\CacheAllWebcamCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:cache-all-webcams',
    description: 'Cache webcams from API',
)]
class CacheAllWebcamCommandLine extends Command
{

    public function __construct(private CommandBus $bus, private LoggerInterface $logger) {
        parent::__construct('app:cache-all-webcams');
    }


    protected function configure(): void { $this; }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->bus->dispatch(new CacheAllWebcamCommand());

            $io->success('The command has been successfully executed');

            return Command::SUCCESS;
        }
        catch (\Throwable $e) {
            $reference = md5(uniqid());
            $this->logger->critical("$reference:: {$e->getMessage()}  ({$e->getFile()}:{$e->getLine()}");
            $io->error("The command has made an error, please contact the administrator. Reference $reference");

            return Command::FAILURE;
        }
    }
}
