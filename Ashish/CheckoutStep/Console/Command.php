<?php

/*
 * Created By: Ashish Ranade On : 18 Dec, 2019 3:06:16 PM
 * Project: Training
 * File: Command.php
 */

namespace Ashish\CheckoutStep\Console;

use Symfony\Component\Console\Command\Command as CLICommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Description of Command
 *
 * @author Ashish
 */
class Command
        extends CLICommand
{

    /**
     * Variable name
     */
    const NAME = 'name';

    /**
     * Set cli command
     */
    protected function configure()
    {
        $options = [
            new InputOption(
                    self::NAME,
                    null,
                    InputOption::VALUE_OPTIONAL,
                    'Name'
            )
        ];

        $this->setName('ashish:testCommand')
                ->setDescription('Test Command for Skeleton Cli')
                ->setDefinition($options);

        parent::configure();
    }

    /**
     * execute cli command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return $this
     */
    protected function execute(InputInterface $input,
            OutputInterface $output)
    {
        if ($name = $input->getOption(self::NAME)) {
            $output->writeln("Hello " . $name);
        } else {
            $output->writeln("Hello World");
        }
        return $this;
    }

}
