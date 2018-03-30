<?php
declare(strict_types=1);
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

namespace RossMitchell\UpdateCloudFlare\Responses\Results;

use RossMitchell\UpdateCloudFlare\Helpers\Hydrator;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class Owner
 * @package RossMitchell\UpdateCloudFlare\Responses\Results
 */
class Owner
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $ownerType;

    /**
     * Owner constructor.
     *
     * @param Hydrator  $hydrator
     * @param \stdClass $data
     *
     * @throws LogicException
     */
    public function __construct(Hydrator $hydrator, \stdClass $data)
    {
        $hydrator->setProperty($this, $data, 'id');
        $hydrator->setProperty($this, $data, 'email');
        $hydrator->setProperty($this, $data, 'owner_type');
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getOwnerType(): string
    {
        return $this->ownerType;
    }

    /**
     * @param string $ownerType
     */
    public function setOwnerType(string $ownerType)
    {
        $this->ownerType = $ownerType;
    }
}
