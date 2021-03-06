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

    protected function fire()
    {
        $this->output->writeln('<info>tiny-suggest\'s server has been stop</info>');
        
        $process = $this->process('sudo kill -9 $(ps -aux |grep "tiny-suggest"|awk \'{print $2}\')');
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}