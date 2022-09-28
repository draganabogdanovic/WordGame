<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthJWT extends WebTestCase
{
    public static function createAuthenticatedClient(
        $email = "dragana@uns.com",
        $setAuthorizationHeader = true,
    ): KernelBrowser {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login/login_user',
            [],
            [],
            ['CONTENT-TYPE'=>'application/json'],
            json_encode([
                'email' => $email,
            ])
        );

        if($setAuthorizationHeader) {
          $responseBody = json_decode($client->getResponse()->getContent(), false);
          $client->setServerParameter('HTTP_AUTHORIZATION', "Bearer {$responseBody->token}");
        }

        return $client;
    }

    public static function createNonAuthenticatedClient(
        $email = "dana@uns.com",
        $setAuthorizationHeader = true,
    ): KernelBrowser {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login/login_user',
            [],
            [],
            ['CONTENT-TYPE'=>'application/json'],
            json_encode([
              'email' => $email,
            ])
        );

        if($setAuthorizationHeader) {
            $responseBody = json_decode($client->getResponse()->getContent(), false);
        }

        return $client;
    }
}
