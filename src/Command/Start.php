<?php

namespace Tiny\Command;

use Tiny\Proccess;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Start extends SymfonyCommand
{
    use Command;

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('start')
            ->setDescription('Start a suggest processing server');
    }

    /**
     * @return string
     */
    protected function fire()
    {
        $this->output->writeln('<info>tiny-search Starting...</info>');

        $pid = shell_exec('tiny-suggest server > /dev/null &');

        $this->output->writeln('<info>SUCCESS</info>');

        return $pid;
    }
}