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

use RossMitchell\UpdateCloudFlare\Factories\Responses\ErrorFactory;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;

/**
 * Class ErrorFactoryTest
 * @testdox RossMitchell\UpdateCloudFlare\Factories\Responses\ErrorFactory
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses
 */
class ErrorFactoryTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var ErrorFactory
     */
    private $factory;

    /**
     * @test
     */
    public function canCreateAnErrorArrayFromTheResponse()
    {
        $code        = 123;
        $message     = 'An Error Happened';
        $errorString = <<<JSON
[
    {"code": $code, "message": "$message"}
]
JSON;
        $errorArray  = \json_decode($errorString);

        $errors = $this->factory->create($errorArray);
        $this->assertInternalType('array', $errors);
        $this->assertCount(1, $errors);
        $error = $errors[0];
        $this->assertEquals($code, $error->getCode());
        $this->assertEquals($message, $error->getMessage());
    }

    /**
     * @test
     */
    public function canHandleMultipleErrors()
    {
        $firstCode     = 123;
        $firstMessage  = 'An Error Happened';
        $secondCode    = 345;
        $secondMessage = 'A different Error Happened';
        $errorString   = <<<JSON
[
    {"code": $firstCode, "message": "$firstMessage"},
    {"code": $secondCode, "message": "$secondMessage"}
]
JSON;
        $errorArray    = \json_decode($errorString);
        $errors        = $this->factory->create($errorArray);
        $this->assertInternalType('array', $errors);
        $this->assertCount(2, $errors);
        $error = $errors[1];
        $this->assertEquals($secondCode, $error->getCode());
        $this->assertEquals($secondMessage, $error->getMessage());
    }

    /**
     * @test
     */
    public function canHandleMalformedErrors()
    {
        $firstMessage  = 'An Error Happened';
        $secondCode    = 345;
        $secondMessage = 'A different Error Happened';
        $errorString   = <<<JSON
[
    {"message": "$firstMessage"},
    {"code": $secondCode, "message": "$secondMessage"}
]
JSON;
        $errorArray    = \json_decode($errorString);
        $errors        = $this->factory->create($errorArray);
        $this->assertInternalType('array', $errors);
        $this->assertCount(1, $errors);
        $error = $errors[0];
        $this->assertEquals($secondCode, $error->getCode());
        $this->assertEquals($secondMessage, $error->getMessage());
    }
}
