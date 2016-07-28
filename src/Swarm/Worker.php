<?php

namespace Av\Swarm;

use Amp\Promise;

interface Worker
{
    public function launch();
    public function getData();
}
