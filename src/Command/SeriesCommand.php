<?php

namespace App\Command;

use App\Utils\SeriesCalculator;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class SeriesCommand extends Command
{
    protected static $defaultName = "app:calculate-series";

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Podaj dane: ');
        $question->setValidator(function($values) {
            $lines = preg_split("/\r\n|\n|\r/", $values);
            if (count($lines) > 10) {
                throw new RuntimeException("Nieprawidłowa ilość danych, podaj nie więcej niż 10 liczb, każda w nowej linii.");
            }
            foreach ($lines as $line) {
                if (!is_numeric($line) || intval($line) != $line || $line < 1 || $line > 99999) {
                    throw new RuntimeException("{$line} nie jest liczbą naturalną z zakresu [1, 99999].");
                }
            }

            return $values;
        });

        $data = $helper->ask($input, $output, $question);
        $lines = preg_split("/\r\n|\n|\r/", $data);

        $table = new Table($output);
        $table->setHeaders(['Input', 'Output']);

        foreach ($lines as $line) {
            $table->addRow([$line, SeriesCalculator::getMax(intval($line))]);
        }
        $table->render();
    }
}