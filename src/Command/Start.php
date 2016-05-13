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

    protected function fire()
    {
        // start shell : nohup php http.php > log.txt &
        $this->output->writeln('<info>Starting...</info>');

        $process = $this->process('nohup php suggest server & >out.log');

        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }
}