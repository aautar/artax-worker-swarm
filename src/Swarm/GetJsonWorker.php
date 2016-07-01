<?php

namespace Av\Swarm;

use Amp\Promise;
use Amp\Artax\Client as HttpClient;

class GetJsonWorker implements Worker
{
    /**
     * @var stdClass
     */
    private $data;

    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function launch() : Promise
    {
        return \Amp\resolve($this->doWork());
    }

    public function doWork()
    {
        echo "\n\n---Making req \n\n";

        $client = new HttpClient();
        $response = yield $client->request($this->url);
        $this->data = json_decode($response->getBody());
        return $this->data;
    }

    public function getData()
    {
        return $this->data;
    }
}
