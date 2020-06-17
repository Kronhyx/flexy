<?php


namespace App\Tests\Controller;


use App\Controller\ProductController;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductControllerTest
 * @package App\Tests\Controller
 * @coversDefaultClass ProductController
 */
class ProductControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private KernelBrowser $client;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
    }

    /**
     * @covers ProductController::index
     * @param string $url
     * @testWith ["/product/"]
     */
    public function testIndex(string $url): void
    {
        $this->client->request(Request::METHOD_GET, $url);
        $response = $this->client->getResponse();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @covers ProductController::new
     * @param string $url
     * @testWith ["/product/new"]
     */
    public function testNew(string $url): void
    {
        $this->client->request(Request::METHOD_POST, $url);
        $response = $this->client->getResponse();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
