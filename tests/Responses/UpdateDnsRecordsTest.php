<?php
/**
 *
 * Copyright (C) 2018  Ross Mitchell
 *
 * This file is part of RossMitchell/UpdateCloudFlare.
 *
 * RossMitchell/UpdateCloudFlare is free software: you can redistribute
 * it and/or modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace RossMitchell\UpdateCloudFlare\Tests\Responses;

use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Factories\Responses\UpdateDnsRecordsFactory;
use RossMitchell\UpdateCloudFlare\Responses\Results\DnsRecord;
use RossMitchell\UpdateCloudFlare\Responses\UpdateDnsRecords;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Helpers\UpdateDnsRecordsResponse;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class UpdateDnsRecordsTest
 * @testdox RossMitchell\UpdateCloudFlare\Responses\UpdateDnsRecords
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses
 */
class UpdateDnsRecordsTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var UpdateDnsRecordsFactory
     */
    private $factory;
    /**
     * @Inject
     * @var UpdateDnsRecordsResponse
     */
    private $responseHelper;

    /**
     * @test
     */
    public function canCreateTheClassUsingTheFactory()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(UpdateDnsRecords::class, $class);
    }

    /**
     * @test
     */
    public function itReturnsASingleResult()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(DnsRecord::class, $class->getResult());

    }

    /**
     * @test
     */
    public function theResultContainsTheNewIpAddress()
    {
        $class = $this->createClass();
        $this->assertEquals('9.8.7.6', $class->getResult()
                                             ->getContent());
    }

    /**
     * @test
     */
    public function canReturnTheSuccess()
    {
        $class = $this->createClass();
        $this->assertTrue($class->isSuccess());
    }

    /**
     * @test
     */
    public function canReturnTheErrors()
    {
        $class  = $this->createClass();
        $errors = $class->getErrors();
        $this->assertInternalType('array', $errors);
        $this->assertEmpty($errors);
    }

    /**
     * @test
     */
    public function canReturnTheMessages()
    {
        $class    = $this->createClass();
        $messages = $class->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertEmpty($messages);
    }

    /**
     * @test
     */
    public function canReturnTheResultInfo()
    {
        $class      = $this->createClass();
        $resultInfo = $class->getResultInfo();
        $this->assertInstanceOf(\stdClass::class, $resultInfo);
        $this->assertEquals(1, $resultInfo->page);
        $this->assertEquals(20, $resultInfo->per_page);
        $this->assertEquals(1, $resultInfo->count);
        $this->assertEquals(2000, $resultInfo->total_count);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheSuccessIsMissing()
    {
        $json = $this->getJson();
        unset($json->success);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheErrorsAreMissing()
    {
        $json = $this->getJson();
        unset($json->errors);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheMessagesAreMissing()
    {
        $json = $this->getJson();
        unset($json->messages);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheResultIsMissing()
    {
        $json = $this->getJson();
        unset($json->result);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willNotThrowAnExceptionIfTheResultInfoIsMissing()
    {
        $json = $this->getJson();
        unset($json->result_info);
        $class = $this->createClass($json);
        $this->assertNull($class->getResultInfo());
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfCloudFlareReportsAnError()
    {
        $error = '{"code":1003,"message":"Invalid or missing zone id."}';
        $json  = $this->getJson('false', $error);
        $this->expectException(CloudFlareException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willReturnAMeaningfulExceptionIfCloudFlareReportsAnError()
    {
        $code    = 1003;
        $message = 'Invalid or missing zone id.';
        $error   = "{\"code\":$code,\"message\":\"$message\"}";
        $json    = $this->getJson('false', $error);
        try {
            $this->createClass($json);
            $this->fail('Exception was not thrown');
        } catch (CloudFlareException $exception) {
            $expectedError = 'There was an error making the '.UpdateDnsRecords::class.':'.PHP_EOL.$message;

            $this->assertEquals($expectedError, $exception->getMessage());
        }
    }

    /**
     * @test
     */
    public function willReturnMultipleMessage()
    {
        $json           = $this->getJson();
        $messages       = '[{}, {"message": "A Different Message"}]';
        $json->messages = \json_decode($messages);
        $class          = $this->createClass($json);
        $actualMessages = $class->getMessages();
        $this->assertInternalType('array', $actualMessages);
        $this->assertCount(1, $actualMessages);
        $this->assertEquals("A Different Message", $actualMessages[0]->message);
    }

    /**
     * @param \stdClass|null $json
     *
     * @return UpdateDnsRecords
     * @throws CloudFlareException
     */
    private function createClass(\stdClass $json = null): UpdateDnsRecords
    {
        if ($json === null) {
            $json = $this->getJson();
        }

        return $this->factory->create($json);
    }

    /**
     * @param string $success
     * @param string $errors
     *
     * @return mixed
     */
    private function getJson(string $success = 'true', string $errors = '{}'): \stdClass
    {
        $json = $this->responseHelper->getFullJson($success, $errors);

        return \json_decode($json);
    }
}
