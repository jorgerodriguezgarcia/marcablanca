<?php


namespace App\Tests\IntegrationTest;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\NativeHttpClient;

class CheckIfApiIsUpTest extends KernelTestCase
{

    private $client;

    protected function setUp(): void
    {
        $this->client = new NativeHttpClient();
    }

    public function testCheckIfApiIsUp(){
        $response = $this->client->request($_ENV["METHOD_API_MARCABLANCA"], $_ENV["URL_API_MARCABLANCA"]);

        $this->assertSame(200, $response->getStatusCode());
    }
}//class