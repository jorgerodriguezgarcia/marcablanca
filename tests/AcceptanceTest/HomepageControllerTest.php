<?php


namespace App\Tests\AcceptanceTest;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\NativeHttpClient;

class HomepageControllerTest extends WebTestCase
{
    public function testCerdasResponseIsSuccessful(): void
    {
        $client = new NativeHttpClient();

        // Request a specific page
        $response = $client->request('GET', 'http://www.cerdas.com?XDEBUG_SESSION_START=PHPSTORM');

        // Validate a successful response and some content
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame (1, preg_match("/cerdas/i", $response->getContent(false)));
    }

    public function testBabosasResponseIsSuccessful(): void
    {
        $client = new NativeHttpClient();

        // Request a specific page
        $response = $client->request('GET', 'http://www.babosas.com?XDEBUG_SESSION_START=PHPSTORM');

        // Validate a successful response and some content
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame (1, preg_match("/babosas/i", $response->getContent(false)));
    }

    public function testConejoxResponseIsSuccessful(): void
    {
        $client = new NativeHttpClient();

        // Request a specific page
        $response = $client->request('GET', 'http://www.conejox.com?XDEBUG_SESSION_START=PHPSTORM');

        // Validate a successful response and some content
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame (1, preg_match("/conejox/i", $response->getContent(false)));
    }
}//class