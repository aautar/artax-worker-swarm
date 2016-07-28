<?php

namespace Av\Main;

use \Av\Swarm\Hive;
use \Av\Swarm\GetJsonWorker;

require "../vendor/autoload.php";

class Main
{
    public function run()
    {
        //\Amp\run(function() {

            echo 'starting...\n';

            // Create Workers
            $workers = [];
            $workers[] = new GetJsonWorker('http://netflixroulette.net/api/api.php?actor=Nicolas%20Cage');
            $workers[] = new GetJsonWorker('http://netflixroulette.net/api/api.php?title=Attack%20on%20titan');
            $workers[] = new GetJsonWorker('http://netflixroulette.net/api/api.php?title=The%20Avengers');
            $workers[] = new GetJsonWorker('http://netflixroulette.net/api/api.php?title=Breaking%20Bad');

            try {

                // Create Hive for workers
                $hive = new Hive($workers);

                // Tell the workers in the hive to swarm
                $hive->swarm(); // yield for the swarm

                $hive->wait();
                
                var_dump($workers);

            } catch (\Exception $e) {
                var_dump($e);
            }
        //});
    }
}

$m = new Main();
$m->run();
