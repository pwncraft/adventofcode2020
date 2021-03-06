<?php 
require_once "vendor/autoload.php";

use Garden\Cli\Cli;
use pwnstar\AdventOfCode2020\Advent;

$cli = new Cli();
$advent = new Advent();

$cli->command('run')
    ->description('Run Advent of Code 2020 Challenges')
    ->opt('day:d', 'Specify a day to run/test', false, 'integer')
    ->command('test')
    ->description('Test Advent of Code 2020 Challenges')
    ->opt('day:d', 'Specify a day to run/test', false, 'integer');
try {
    $args = $cli->parse($argv, true);
} catch (Exception $e) {
}

if (isset($args)) {
    switch ($args->getCommand()) {
        case 'run':
            if (!empty($args->getOpt('day'))) {
                $advent->runDay($args->getOpt('day'));
            } else {
                $doneDays = 6;
                for ($i = 1; $i <= $doneDays; $i++) {
                    $advent->runDay($i);
                }
            }
        break;
        case 'test':
            if (!empty($args->getOpt('day'))) {
                $day = 'Day' . sprintf('%02d', $args->getOpt('day'));
                echo "*** TESTING DAY $day ***" . PHP_EOL;
                system("\"vendor/bin/phpunit\" --testdox advent/{$day}/{$day}Test.php");
            } else {
                $doneDays = 6;
                for ($i = 1; $i <= $doneDays; $i++) {
                    $day = 'Day' . sprintf('%02d', $i);
                    system("\"vendor/bin/phpunit\" --testdox advent/{$day}/{$day}Test.php");
                }
            }
        break;
    }
}



