<?php

namespace Av\Swarm;

use Amp\Promise;
use Av\Swarm\Worker;

class Hive
{
    /**
     * @var Worker[]
     */
    private $requests;

    /**
     * @var Promise $allWorkerPromise
     */
    private $allWorkerPromise;

    /**
     * @param Worker[] $requests
     */
    public function __construct(array $requests)
    {
        $this->requests = $requests;
    }

    /**
     * @param callable $request
     * @return Promise
     */
    public function launch(callable $request) : Promise
    {
        return \Amp\resolve( $request() );
    }

    /**
     * @return Promise
     */
    public function swarm() : Promise
    {
        $promises = [];
        foreach($this->requests as $req) {
            $promises[] = $this->launch(function() use ($req) {
                return $req->launch();
            });
        }

        $this->allWorkerPromise = \Amp\all($promises);
        return $this->allWorkerPromise;
    }

    public function wait()
    {
        \Amp\wait($this->allWorkerPromise);
    }
}
