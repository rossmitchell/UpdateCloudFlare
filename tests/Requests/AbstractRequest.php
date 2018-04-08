<?php declare(strict_types = 1);
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

namespace RossMitchell\UpdateCloudFlare\Tests\Requests;

use RossMitchell\UpdateCloudFlare\Interfaces\RequestInterface;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;

/**
 * Class AbstractRequest - The tests for the request interfaces are going to be largely the same, so we'll abstract
 * them out
 * @package RossMitchell\UpdateCloudFlare\Tests\Requests
 */
abstract class AbstractRequest extends AbstractTestClass
{
    /**
     * @return mixed
     */
    abstract public function getRequest();

    /**
     * @return array
     */
    abstract public function getHeaders(): array;

    /**
     * @return string
     */
    abstract public function getRequestType(): string;

    /**
     * @return array
     */
    abstract public function getFields(): array;

    /**
     * @return string
     */
    abstract public function getUrl(): string;

    /**
     * @test
     */
    public function checkClassImplementsRequestInterface()
    {
        $this->assertInstanceOf(RequestInterface::class, $this->getRequest());
    }

    /**
     * @test
     */
    public function theClassReturnsTheCorrectHeadersArray()
    {
        $headers  = $this->getRequest()
                         ->getHeaders();
        $expected = $this->getHeaders();
        $this->assertInternalType('array', $headers);
        $this->assertEquals($expected, $headers);
    }

    /**
     * @test
     */
    public function theClassReturnsTheCorrectRequestType()
    {
        $this->assertEquals($this->getRequestType(),
                            $this->getRequest()
                                 ->getRequestType()
        );
    }

    /**
     * @test
     */
    public function theClassReturnsTheCorrectFields()
    {
        $fields   = $this->getRequest()
                         ->getFields();
        $expected = $this->getFields();
        $this->assertInternalType('array', $fields);
        $this->assertEquals($expected, $fields);
    }

    /**
     * @test
     */
    public function theClassReturnsTheCorrectUrl()
    {
        $expectedUrl = $this->getUrl();
        $this->assertEquals($expectedUrl,
                            $this->getRequest()
                                 ->getUrl()
        );
    }
}
