<?php

namespace AdFinemSimpleFormBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AttachmentControllerTest extends WebTestCase
{
    public function testDownload()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/attachment/download/{id}');
    }

}
