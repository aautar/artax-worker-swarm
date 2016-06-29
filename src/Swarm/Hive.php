<?php

namespace Av\Swarm;

class Hive
{
    /**
     *
     * @var Worker[]
     */
    private $requests;

    public function __construct(array $requests)
    {
        $this->requests = $requests;
    }

    public function swarm()
    {
        $promises = [];
        foreach($this->requests as $req) {
            $promises[] = $req->launch();
        }

        $singlePromise = \Amp\all($promises);
        return $singlePromise;
    }

}
