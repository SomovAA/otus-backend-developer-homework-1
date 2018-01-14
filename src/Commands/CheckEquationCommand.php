<?php

namespace Homework\Commands;

use Hitenok\ValidatorAlgebraicEquation;
use Homework\FileSystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckEquationCommand extends Command
{
    /**
     * @var ValidatorAlgebraicEquation
     */
    private $validatorAlgebraicEquation;

    /**
     * @var FileSystem
     */
    private $fileSystem;

    /**
     * CheckEquationCommand constructor.
     *
     * @param ValidatorAlgebraicEquation $validatorAlgebraicEquation
     * @param FileSystem $fileSystem
     */
    public function __construct(
        ValidatorAlgebraicEquation $validatorAlgebraicEquation,
        FileSystem $fileSystem
    ) {
        parent::__construct();

        $this->fileSystem = $fileSystem;
        $this->validatorAlgebraicEquation = $validatorAlgebraicEquation;
    }

    protected function configure()
    {
        $this
            ->setName('checkEquation')
            ->setDescription('Check Equation a file')
            ->addArgument(
                'pathToFile',
                InputArgument::REQUIRED,
                'file with equal'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pathToFile = $input->getArgument('pathToFile');

        try {
            $string = $this->fileSystem->getContent($pathToFile);

            if ($this->validatorAlgebraicEquation->isCorrectnessParentheses($string)) {
                echo 'There are no errors in the expression';
            } else {
                echo 'There are errors in the expression';
            }
        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
        }
    }
}