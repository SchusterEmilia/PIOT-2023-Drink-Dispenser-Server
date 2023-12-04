<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\PingHandler;

use function json_decode;

use const JSON_THROW_ON_ERROR;

use Laminas\Diactoros\Response\JsonResponse;
use PHPUnit\Framework\TestCase;

use function property_exists;

use Psr\Http\Message\ServerRequestInterface;

class PingHandlerTest extends TestCase
{
    public function testResponse(): void
    {
        $pingHandler = new PingHandler();
        $response    = $pingHandler->handle(
            $this->createMock(ServerRequestInterface::class)
        );

        $json = json_decode((string) $response->getBody(), null, 512, JSON_THROW_ON_ERROR);

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertTrue(property_exists($json, 'ack') && $json->ack !== null);
    }
}
