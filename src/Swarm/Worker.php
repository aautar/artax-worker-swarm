<?php

namespace Av\Swarm;

interface Worker
{
    public function launch();
    public function getData();
}