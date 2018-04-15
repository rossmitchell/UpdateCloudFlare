<?php
declare(strict_types = 1);
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

namespace RossMitchell\UpdateCloudFlare\Helpers;

use Symfony\Component\Console\Exception\LogicException;

/**
 * Class Hydrator
 * @package RossMitchell\UpdateCloudFlare\Helpers
 */
class Hydrator
{
    /**
     * @param object    $class
     * @param \stdClass $data
     * @param string    $node
     * @param bool      $required
     *
     * @throws LogicException
     */
    public function setProperty($class, \stdClass $data, string $node, $required = true)
    {
        if (!\property_exists($data, $node)) {
            if ($required === true) {
                throw new LogicException("$node does not exist in the result");
            }
            $data->$node = null;
        }

        $settor = 'set' . str_replace('_', '', ucwords($node, '_'));

        if (!\method_exists($class, $settor)) {
            throw new LogicException("method $settor does not exist in class " . \get_class($class));
        }

        $class->$settor($data->$node);
    }
}
