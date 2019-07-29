<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Console\Command\Sync;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SyncEventsCommand
 *
 * @package Joaosalless\Dates\Console\Command
 */
class SyncEventsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('events:sync')
            ->setDescription('Sync events from remote Dates API.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Not implemented...");
    }
}
