<?php

namespace Tiny\Command;

use Tiny\Proccess;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Server extends SymfonyCommand
{
    use Command;

    protected $preparing;

    public function __construct($preparing)
    {
        parent::__construct();

        $this->preparing = $preparing;
    }

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('server')
            ->setDescription('server a suggest processing server');
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    protected function fire()
    {
        $this->output->writeln('<info>Running daemon...</info>');

        return new Proccess($this->preparing);
    }
}