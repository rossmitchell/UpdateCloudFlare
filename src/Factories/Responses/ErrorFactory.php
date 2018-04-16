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

namespace RossMitchell\UpdateCloudFlare\Factories\Responses;

use RossMitchell\UpdateCloudFlare\Helpers\Hydrator;
use RossMitchell\UpdateCloudFlare\Responses\Error;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class ErrorFactory
 * @package RossMitchell\UpdateCloudFlare\Factories\Responses
 */
class ErrorFactory
{
    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * ErrorFactory constructor.
     *
     * @param Hydrator $hydrator
     */
    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @param array $errors
     *
     * @return Error[]
     * @throws LogicException
     */
    public function create(array $errors): array
    {
        $actualErrors = [];
        foreach ($errors as $error) {
            if (!\property_exists($error, 'code')) {
                continue;
            }
            $actualErrors[] = $this->createError($error);
        }

        return $actualErrors;
    }

    /**
     * @param \stdClass $error
     *
     * @return Error
     * @throws LogicException
     */
    private function createError(\stdClass $error): Error
    {
        $errorObject = new Error();
        foreach (['code', 'message'] as $property) {
            $this->hydrator->setProperty($errorObject, $error, $property);
        }

        return $errorObject;
    }
}
