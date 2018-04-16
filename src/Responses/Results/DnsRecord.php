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

namespace RossMitchell\UpdateCloudFlare\Responses\Results;

/**
 * Class DnsRecord
 * @package RossMitchell\UpdateCloudFlare\Responses\Results
 */
class DnsRecord
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $content;
    /**
     * @var bool
     */
    private $proxiable;
    /**
     * @var bool
     */
    private $proxied;
    /**
     * @var int
     */
    private $ttl;
    /**
     * @var bool
     */
    private $locked;
    /**
     * @var string
     */
    private $zoneId;
    /**
     * @var string
     */
    private $zoneName;
    /**
     * @var string
     */
    private $createdOn;
    /**
     * @var string
     */
    private $modifiedOn;
    private $data;

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
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function isProxiable(): bool
    {
        return $this->proxiable;
    }

    /**
     * @param bool $proxiable
     */
    public function setProxiable(bool $proxiable): void
    {
        $this->proxiable = $proxiable;
    }

    /**
     * @return bool
     */
    public function isProxied(): bool
    {
        return $this->proxied;
    }

    /**
     * @param bool $proxied
     */
    public function setProxied(bool $proxied): void
    {
        $this->proxied = $proxied;
    }

    /**
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     */
    public function setTtl(int $ttl): void
    {
        $this->ttl = $ttl;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     */
    public function setLocked(bool $locked): void
    {
        $this->locked = $locked;
    }

    /**
     * @return string
     */
    public function getZoneId(): string
    {
        return $this->zoneId;
    }

    /**
     * @param string $zoneId
     */
    public function setZoneId(string $zoneId): void
    {
        $this->zoneId = $zoneId;
    }

    /**
     * @return string
     */
    public function getZoneName(): string
    {
        return $this->zoneName;
    }

    /**
     * @param string $zoneName
     */
    public function setZoneName(string $zoneName): void
    {
        $this->zoneName = $zoneName;
    }

    /**
     * @return string
     */
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    /**
     * @param string $createdOn
     */
    public function setCreatedOn(string $createdOn): void
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return string
     */
    public function getModifiedOn(): string
    {
        return $this->modifiedOn;
    }

    /**
     * @param string $modifiedOn
     */
    public function setModifiedOn(string $modifiedOn): void
    {
        $this->modifiedOn = $modifiedOn;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        if (\json_encode($data) === '{}') {
            $data = null;
        }
        $this->data = $data;
    }
}
