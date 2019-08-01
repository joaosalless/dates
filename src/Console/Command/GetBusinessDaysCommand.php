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
 * Class GetWeekDaysCommand
 *
 * @package Joaosalless\Dates\Console\Command
 */
class GetBusinessDaysCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('events:get-business-days')
            ->setDescription('Return week days.')
            ->setDefinition(
                new InputDefinition([
                    new InputArgument('country', InputArgument::REQUIRED),
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
        ];

        $output->writeln("Get Business Days:\n");

        $weekConfig = [
            'week' => [
                'office_hours_start' => '09:00',
                'office_hours_end' => '18:00',
                'check_office_hours' => false,
                'days' => [
                    'sun' => [
                        'business_day' => false,
                    ],
                    'mon' => [
                        'business_day' => true,
                    ],
                    'tue' => [
                        'business_day' => true,
                    ],
                    'wed' => [
                        'business_day' => false,
                    ],
                    'thu' => [
                        'business_day' => true,
                    ],
                    'fri' => [
                        'business_day' => true,
                    ],
                    'sat' => [
                        'business_day' => false,
                        'office_hours_start' => '09:00',
                        'office_hours_end' => '14:00',
                    ],
                ]
            ]
        ];

        $dates = new Dates('BR', $weekConfig);

        $workDate = $dates->getBusinessDays();

        $output->writeln(json_encode($workDate, JSON_PRETTY_PRINT));
    }
}
