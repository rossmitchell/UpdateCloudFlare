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

namespace RossMitchell\UpdateCloudFlare\Tests\Model;

use RossMitchell\UpdateCloudFlare\Model\Curl;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\CurlResource;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Request;

class CurlTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var CurlResource
     */
    private $resource;

    /**
     * @test
     */
    public function itCanSetTheRequiredOptions()
    {
        $request = $this->getRequest();
        $curl    = $this->getClass();
        $curl->makeRequest($request);
        $requiredOptions = [
            \CURLOPT_URL            => 'http://www.example.com',
            \CURLOPT_USERAGENT      => 'curl',
            \CURLOPT_CUSTOMREQUEST  => 'GET',
            \CURLOPT_RETURNTRANSFER => true,
        ];
        foreach ($requiredOptions as $option => $value) {
            $this->assertEquals($value, $this->resource->getOption($option));
        }
    }

    /**
     * @test
     */
    public function itWillSetTheHeadersWhenPresent()
    {
        $request         = $this->getRequest();
        $expectedHeaders = ['testHeader: test'];
        $request->setHeaders($expectedHeaders);
        $curl = $this->getClass();
        $curl->makeRequest($request);
        $headers = $this->resource->getOption(\CURLOPT_HTTPHEADER);
        $this->assertInternalType('array', $headers);
        $this->assertCount(1, $headers);
        $this->assertEquals($expectedHeaders, $headers);
    }

    /**
     * @test
     */
    public function itWillNotSetTheHeadersWhenTheyAreNotPresent()
    {
        $request = $this->getRequest();
        $curl    = $this->getClass();
        $curl->makeRequest($request);
        $this->expectException(\LogicException::class);
        $this->resource->getOption(\CURLOPT_HTTPHEADER);
    }

    /**
     * @test
     */
    public function itWillSetTheFieldsWhenPresent()
    {
        $request        = $this->getRequest();
        $expectedFields = ['testHeader: test'];
        $request->setFields($expectedFields);
        $curl = $this->getClass();
        $curl->makeRequest($request);
        $headers = $this->resource->getOption(\CURLOPT_POSTFIELDS);
        $this->assertInternalType('string', $headers);
        $this->assertEquals(\json_encode($expectedFields), $headers);
    }

    /**
     * @test
     */
    public function itWillNotSetTheFieldsWhenTheyAreNotPresent()
    {
        $request = $this->getRequest();
        $curl    = $this->getClass();
        $curl->makeRequest($request);
        $this->expectException(\LogicException::class);
        $this->resource->getOption(\CURLOPT_POSTFIELDS);
    }

    /**
     * @test
     */
    public function itWillThrowAnExceptionWhenThereIsACurlError()
    {
        $request = $this->getRequest();
        $curl = $this->getClass();
        $this->resource->setError('An error has occurred');
        $this->expectException(\RuntimeException::class);
        $curl->makeRequest($request);
    }


    /**
     * @return Curl
     */
    private function getClass(): Curl
    {
        return new Curl($this->resource);
    }

    /**
     * @param string $url
     * @param string $requestType
     *
     * @return Request
     */
    private function getRequest(string $url = 'http://www.example.com', string $requestType = 'GET'): Request
    {
        $request = new Request();
        $request->setUrl($url);
        $request->setRequestType($requestType);

        return $request;
    }
}
