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
 * along with this program. If not, see <http:
 */

namespace RossMitchell\UpdateCloudFlare\Responses\Results;

/**
 * Class ListZones
 * @package RossMitchell\UpdateCloudFlare\Responses\Results
 */
class ListZonesResult
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $developmentMode;
    /**
     * @var array
     */
    private $originalNameServers;
    /**
     * @var string
     */
    private $originalRegistrar;
    /**
     * @var string
     */
    private $originalDnsHost;
    /**
     * @var string
     */
    private $createdOn;
    /**
     * @var string
     */
    private $modifiedOn;
    /**
     * @var Owner
     */
    private $owner;
    /**
     * @var array
     */
    private $permissions;
    /**
     * @var Plan
     */
    private $plan;
    /**
     * @var Plan
     */
    private $planPending;
    /**
     * @var string
     */
    private $status;
    /**
     * @var bool
     */
    private $paused;
    /**
     * @var string
     */
    private $type;
    /**
     * @var array
     */
    private $nameServers;

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
     * @return int
     */
    public function getDevelopmentMode(): int
    {
        return $this->developmentMode;
    }

    /**
     * @param int $developmentMode
     */
    public function setDevelopmentMode(int $developmentMode): void
    {
        $this->developmentMode = $developmentMode;
    }

    /**
     * @return array
     */
    public function getOriginalNameServers(): array
    {
        return $this->originalNameServers;
    }

    /**
     * @param array $originalNameServers
     */
    public function setOriginalNameServers(array $originalNameServers): void
    {
        $this->originalNameServers = $originalNameServers;
    }

    /**
     * @return string
     */
    public function getOriginalRegistrar(): string
    {
        return $this->originalRegistrar;
    }

    /**
     * @param string $originalRegistrar
     */
    public function setOriginalRegistrar(string $originalRegistrar): void
    {
        $this->originalRegistrar = $originalRegistrar;
    }

    /**
     * @return string
     */
    public function getOriginalDnsHost(): string
    {
        return $this->originalDnsHost;
    }

    /**
     * @param string $originalDnsHost
     */
    public function setOriginalDnsHost(string $originalDnsHost): void
    {
        $this->originalDnsHost = $originalDnsHost;
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
     * @return Owner
     */
    public function getOwner(): Owner
    {
        return $this->owner;
    }

    /**
     * @param Owner $owner
     */
    public function setOwner(Owner $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     */
    public function setPermissions(array $permissions): void
    {
        $this->permissions = $permissions;
    }

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }

    /**
     * @param Plan $plan
     */
    public function setPlan(Plan $plan): void
    {
        $this->plan = $plan;
    }

    /**
     * @return Plan
     */
    public function getPlanPending(): Plan
    {
        return $this->planPending;
    }

    /**
     * @param Plan $planPending
     */
    public function setPlanPending(Plan $planPending): void
    {
        $this->planPending = $planPending;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isPaused(): bool
    {
        return $this->paused;
    }

    /**
     * @param bool $paused
     */
    public function setPaused(bool $paused): void
    {
        $this->paused = $paused;
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
     * @return array
     */
    public function getNameServers(): array
    {
        return $this->nameServers;
    }

    /**
     * @param array $nameServers
     */
    public function setNameServers(array $nameServers): void
    {
        $this->nameServers = $nameServers;
    }
}
