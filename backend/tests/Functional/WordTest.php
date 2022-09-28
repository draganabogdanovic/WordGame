<?php

namespace App\Tests\Functional;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WordTest extends WebTestCase
{
    private const EXPIRED_JWT_TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTcyNzg3MjcsImV4cCI6MTY1NzI4MjMyNywicm9sZXMiOltdLCJ1c2VybmFtZSI6IjEifQ.Kdq3w9l1xP_wEY-AQ_6F_vAwFJxT6VJFneT--8YVjWHxGdqus5ZiIz2OGEwfZhnTObjpzHgWT332_zSoQrs--s2OhwwKRraZyoI8UGh6KXOn4UqBEhZ1Kz5Bc6O3kFpK9ZuJz3MKiYAUYbP3BYjaG3nZg6KEiLQuNEzfapzB7ypKLbYQNmm06rh1aMBcZTmYh0KjH7oPJUE9L0ATFKHF8PvCDO_08OPooqN7LJ3bBYVWRIJBOAJbHWIo8Ej5a6ykyCDf8hYAKEg-AxXbbn9OMh2R2ET9NzJYncgTKfsuY_c-HZAwbdpBiEnI8CRroxu681eaB3F7XExYP0q1CGx_uQ";

    public function testAuthenticatedJwtTokenCookieExpired(): void
    {
        $client = static::createClient();

        $jwtToken = new Cookie('BEARER', self::EXPIRED_JWT_TOKEN);
        $client->getCookieJar()->set($jwtToken);
        $client->request('GET', 'api/entry/user_words');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testLoginResponseStatus200(): void
    {
        AuthJWT::createAuthenticatedClient();

        $this->assertResponseStatusCodeSame(200);
    }

    public function testLoginResponseJwtToken(): void
    {
        $client = AuthJWT::createAuthenticatedClient();

        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $response);
    }

    public function testUserLoginReturnTokenWithInvalidEmail(): void
    {
        AuthJWT::createNonAuthenticatedClient();
        $this->assertResponseStatusCodeSame(400);
    }

    public function testShowWordForUserResponse200(): void
    {
        $client = AuthJWT::createAuthenticatedClient();

        $client->request('GET', '/api/entry/user_words');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testCreateScoreReturnScore4IfTextWithOneLetter(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'a'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(4, $response);
    }

    public function testCreateScoreReturnScore4IfTextWithTwoLetters(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'aa'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(4, $response);
    }

    public function testCreateScoreReturnScore4IfTextWithThreeLetters(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'aaa'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(4, $response);
    }

    public function testCreateScoreReturnStatusCode400IfTextContainsNumbers(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'mom3'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("A word can not contain numbers.", $response);
    }

    public function testCreateScoreReturnStatusCode400IfTextWithNumbersOnly(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => '123'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("A word can not contain numbers.", $response);
    }

    public function testCreateScoreReturnStatusCode400IfNumbersOnly(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 5
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("A word can not contain numbers.", $response);
    }

    public function testCreateScoreReturnStatusCode200IfTextWithBoolValue(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'true'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(4, $response);
    }

    public function testCreateScoreReturnStatusCode400IfBoolOnly(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => true
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("A word can not contain numbers.", $response);
    }

    public function testCreateScoreReturnStatusCode400IfBoolValue(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => false
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("Word must have at least one character.", $response);
    }

    public function testCreateScoreReturnStatusCode200IfTextWithBoolOnly(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'false'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(5, $response);
    }

    public function testCreateScoreStatusCode200IfWordIsFromEnglishDictionary(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'palindrome'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(10, $response);
    }

    public function testCreateScoreStatusCode400IfWordIsNotFromEnglishDictionary(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'majka'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("A word is not from english dictionary.", $response);
    }

    public function testCreateScoreReturnStatusCode400IfTextWithSpecialCharactersOnly(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => '?'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("A word can not contain special characters.", $response);
    }

    public function testCreateScoreReturnStatusCode400IfTextWithSpecialCharacters(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'mom!'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("A word can not contain special characters.", $response);
    }

    public function testCreateScoreReturnScore8IfTextWithUppercaseLetters(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'coMpuTer'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(8, $response);
    }

    public function testCreateScoreReturnScore8IfTextWithLowercaseLettersOnly(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'computer'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(8, $response);
    }

    public function testCreateScoreReturnScore5IfTextWithUppercaseLetter(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'Solo'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(5, $response);
    }

    public function testCreateScoreReturnScore5IfTextWithLowercaseLettersOnly(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'solo'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(5, $response);
    }

    public function testCreateScoreReturnScore6IfTextWithLowercaseLettersOnly(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'madam'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(6, $response);
    }

    public function testCreateScoreReturnScore6IfTextWithUppercaseLetters(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
            'word' => 'maDAm'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals(6, $response);
    }

    public function testAddNewWordReturn200IfWordIsInValidFormat(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
              'word' => 'glass'
            ])
        );
        $this->assertResponseStatusCodeSame(200);
    }

    public function testAddNewWordThrowsExceptionIfWordIsNotFromEnglishDictionary(): void
    {
        $client = AuthJWT::createAuthenticatedClient();
        $client->request('POST',
            '/api/entry/word',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
              'word' => 'glassd'
            ])
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertResponseStatusCodeSame(400);
        $this->assertEquals("A word is not from english dictionary.", $response);
    }
}
