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
 * Class CalculateBusinessDaysCommand
 *
 * @package Joaosalless\Dates\Console\Command
 */
class CalculateBusinessDaysCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('events:calculate-business-days')
            ->setDescription('Return a work date.')
            ->setDefinition(
                new InputDefinition([
                    new InputArgument('country', InputArgument::REQUIRED),
                    new InputArgument('work-days', InputArgument::REQUIRED),
                    new InputOption('date', 'd', InputOption::VALUE_OPTIONAL),
                    new InputOption('state', 's', InputOption::VALUE_OPTIONAL),
                    new InputOption('city', 'c', InputOption::VALUE_OPTIONAL),
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
        $payload = [
            'country' => $input->getArgument('country'),
            'date' => $input->getOption('date') ?? 'now',
            'work-days' => (int) $input->getArgument('work-days'),
            'state' => $input->getOption('state') ?? null,
            'city' => $input->getOption('city') ?? null,
        ];

        $output->writeln("Calculate Business Days:\n");
        $output->writeln("Date: {$payload['date']}");
        $output->writeln("Work days: {$payload['work-days']}");
        $output->writeln("Country {$payload['country']}");
        $output->writeln("State {$payload['state']}");
        $output->writeln("City {$payload['city']}\n");

        $dates = new Dates('BR');

        $workDate = $dates->calculateBusinessDays(
            $payload['work-days'],
            $payload['date'],
            $payload['state'],
            $payload['city']
        );

        $output->writeln(json_encode($workDate, JSON_PRETTY_PRINT));
    }
}
