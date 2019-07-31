<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Console\Command;

use Joaosalless\Dates\Dates;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetHolidaysCommand
 *
 * @package Joaosalless\Dates\Console\Command
 */
class GetHolidaysCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('events:get-holidays')
            ->setDescription('Return holidays of a date.')
            ->setDefinition(
                new InputDefinition([
                    new InputArgument('country', InputArgument::REQUIRED),
                    new InputOption('date', 'd', InputOption::VALUE_OPTIONAL),
                    new InputOption('state', 's', InputOption::VALUE_OPTIONAL),
                    new InputOption('city', 'c', InputOption::VALUE_OPTIONAL),
                    new InputOption('grouped', 'g', InputOption::VALUE_OPTIONAL),
                ])
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = $input->getOption('date') ?? 'All year';

        $payload = [
            'country' => $input->getArgument('country'),
            'date' => $input->getOption('date') ?? 'now',
            'state' => $input->getOption('state') ?? null,
            'city' => $input->getOption('city') ?? null,
        ];

        $output->writeln("Holidays:\n");
        $output->writeln("Date: {$date}");
        $output->writeln("Country {$payload['country']}");
        $output->writeln("State {$payload['state']}");
        $output->writeln("City {$payload['city']}\n");

        $dates = new Dates('BR');

        $holidays = $dates->getHolidays(
            $payload['date'],
            $payload['state'],
            $payload['city']
        );

        $output->writeln(json_encode($holidays, JSON_PRETTY_PRINT));
    }
}
