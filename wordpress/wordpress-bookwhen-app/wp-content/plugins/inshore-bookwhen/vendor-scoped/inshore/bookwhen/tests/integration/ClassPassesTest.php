<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\tests\integration;

use _PhpScoper6af4d594edb1\GuzzleHttp\Client as GuzzleClient;
use _PhpScoper6af4d594edb1\GuzzleHttp\Handler\MockHandler;
use _PhpScoper6af4d594edb1\GuzzleHttp\Psr7\Response;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Bookwhen;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\BookwhenApi;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Client;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Domain\ClassPass;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Factory;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ConfigurationException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ValidationException;
use _PhpScoper6af4d594edb1\PHPUnit\Framework\TestCase;
use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientInterface;
use _PhpScoper6af4d594edb1\InShore;
/**
 * @uses InShore\Bookwhen\Validator
 */
class ClassPassesTest extends TestCase
{
    protected $apiKey;
    protected $mockHandler;
    protected $client;
    protected $guzzleClient;
    public function setUp() : void
    {
        $this->apiKey = 'dfsdsdsd';
        $this->mockHandler = new MockHandler();
        $this->guzzleClient = new GuzzleClient(['handler' => $this->mockHandler]);
    }
    /**
     * @covers InShore\Bookwhen\Bookwhen
     * @covers InShore\Bookwhen\BookwhenApi
     * @covers InShore\Bookwhen\Client
     * @covers InShore\Bookwhen\Domain\Event
     * @covers InShore\Bookwhen\Domain\ClassPass
     * @covers InShore\Bookwhen\Domain\ClassPass
     * @covers InShore\Bookwhen\Factory
     * @covers InShore\Bookwhen\Resources\Concerns\Transportable
     * @covers InShore\Bookwhen\Resources\ClassPasses
     * @covers InShore\Bookwhen\Responses\ClassPasses\ListResponse
     * @covers InShore\Bookwhen\Responses\ClassPasses\RetrieveResponse
     * @covers InShore\Bookwhen\Transporters\HttpTransporter
     * @covers InShore\Bookwhen\ValueObjects\ApiKey
     * @covers InShore\Bookwhen\ValueObjects\ResourceUri
     * @covers InShore\Bookwhen\ValueObjects\Transporter\BaseUri
     * @covers InShore\Bookwhen\ValueObjects\Transporter\Headers
     * @covers InShore\Bookwhen\ValueObjects\Transporter\Payload
     * @covers InShore\Bookwhen\ValueObjects\Transporter\QueryParams
     */
    public function testValidClassPassId() : void
    {
        $this->mockHandler->append(new Response(200, [], \file_get_contents(__DIR__ . '/../fixtures/classPasses_200.json')));
        $this->client = BookwhenApi::factory()->withApiKey($this->apiKey)->withHttpClient($this->guzzleClient)->make();
        $bookwhen = new Bookwhen(null, $this->client);
        $classPasses = $bookwhen->classPasses();
        $this->assertIsArray($classPasses);
        $this->assertInstanceOf(ClassPass::class, $classPasses[1]);
        $this->assertEquals('', $classPasses[1]->details);
        $this->assertEquals('cp-13nyd5p7lqx7', $classPasses[1]->id);
        $this->assertNull($classPasses[1]->numberAvailable);
        $this->assertEquals('16 x I000 inShore 4 Hour Product Engineer Consultation (15% discount save GBP 960)', $classPasses[1]->title);
        $this->assertEquals(16, $classPasses[1]->usageAllowance);
        $this->assertEquals('personal', $classPasses[1]->usageType);
        $this->assertNull($classPasses[1]->useRestrictedForDays);
    }
}
