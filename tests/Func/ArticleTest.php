<?php 

namespace App\Tests\Func;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleTest extends AbstractEndPoint{

    public function testArticle() : void {
        $response = $this->getResponseFromRequest(Request::METHOD_GET, 'api/articles');
        $json_response = json_decode($response->getContent());
        self::assertNotEmpty($json_response);
        self::assertJson($response->getContent());
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

}