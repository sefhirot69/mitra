<?php

namespace App\Tests\e2e\Controller\Client;

use App\Controller\Client\ClientCreatorController;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ClientCreatorControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /**
     * @test
     */
    public function shouldCreateClientAndReturn201() : void {

        $this->client->request('POST','client', [
            'id' => 'feb21714-b84a-11ec-82de-0242ac1f0002',
            'name' => 'Pepillo',
            'surname' => 'Huevo Frito',
        ]);

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(201);

    }


}
