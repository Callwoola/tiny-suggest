<?php

namespace Tiny\Command;

use Tiny\Proccess;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Stop extends SymfonyCommand
{
    use Command;

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('stop')
            ->setDescription('stop suggest processing server');
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    protected function fire()
    {
        $this->output->writeln('<info>stop</info>');

        //$proccess = new Proccess($this->preparing);

        //return $proccess;
    }
}