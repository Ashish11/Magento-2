<?php

namespace MyFirstModule\Mymodule\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class MyFirstCommand extends Command
{
    const NAME = 'name';

    /**
     * Configure
     */
    protected function configure()
    {
        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            )
        ];

        $this->setName('ashish:firstcommand')
            ->setDescription('This is my first CLI command')
            ->setDefinition($options);

        parent::configure();
    }

    /**
     * Execute function
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($name = $input->getOption(self::NAME)) {
            $output->writeln("Hello " . $name);
        } else {
            $output->writeln("Hello World");
        }

        return $this;
    }
}
