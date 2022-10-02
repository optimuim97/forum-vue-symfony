<?php

namespace App\Tests\Func;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Faker\Factory;

class UserTest extends AbstractEndPoint{
    
    private $userPayload = '{
        "email" : "%s",
        "password" : "password"
    }';
    
    public function testGetUser() 
    {
        $response = $this->getResponseFromRequest(Request::METHOD_GET, 'api/users');
        $responseContent = $response->getContent();
        $json_response = json_decode($responseContent, true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertNotEmpty($json_response);
        self::assertJson($responseContent);
    }

    public function testPostUser(){

        $response = $this->getResponseFromRequest(Request::METHOD_POST, 'api/users',  $this->getPayLoad());
        $responseContent = $response->getContent();
        $json_response = json_decode($responseContent, true);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertNotEmpty($json_response);
        self::assertJson($responseContent);
    }

    private function getPayLoad() : string {
        $faker = Factory::create();
        return sprintf($this->userPayload, $faker->email);
    }
}
