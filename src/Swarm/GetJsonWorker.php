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

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function launch()
    {
        echo "\n\n---Making req \n\n";

        $client = new HttpClient();

        // yield for async work
        $response = yield $client->request($this->url);
        $this->data = json_decode($response->getBody());
        return $this->data;
    }

    public function getData()
    {
        return $this->data;
    }
}
