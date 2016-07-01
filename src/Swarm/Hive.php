<?php

namespace Av\Swarm;

use Amp\Promise;

class Hive
{
    /**
     * @var Worker[]
     */
    private $requests;

    public function __construct(array $requests)
    {
        $this->requests = $requests;
    }

    public function swarm() : Promise
    {
        $promises = [];
        foreach($this->requests as $req) {
            $promises[] = $req->launch();
        }

        $singlePromise = \Amp\all($promises);
        return $singlePromise;
    }

}
