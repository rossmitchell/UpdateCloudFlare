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
 * along with this program. If not, see <http:
 */

namespace RossMitchell\UpdateCloudFlare\Responses\Results;

use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\OwnerFactory;
use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\PlanFactory;
use RossMitchell\UpdateCloudFlare\Helpers\Hydrator;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class ListZones
 * @package RossMitchell\UpdateCloudFlare\Responses\Results
 */
class ListZonesResult
{
    const COMPLEX_PROPERTIES = ['owner', 'plan', 'plan_pending'];
    const SIMPLE_PROPERTIES  = [
        'id',
        'name',
        'development_mode',
        'original_name_servers',
        'original_registrar',
        'original_dnshost',
        'created_on',
        'modified_on',
        'permissions',
        'status',
        'paused',
        'type',
        'name_servers',
    ];
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
     * ListZonesResult constructor.
     *
     * @param Hydrator     $hydrator
     * @param OwnerFactory $ownerFactory
     * @param PlanFactory  $planFactory
     * @param \stdClass    $data
     *
     * @throws LogicException
     */
    public function __construct(
        Hydrator $hydrator,
        OwnerFactory $ownerFactory,
        PlanFactory $planFactory,
        \stdClass $data
    ) {
        foreach (self::SIMPLE_PROPERTIES as $property) {
            $hydrator->setProperty($this, $data, $property);
        }
        
        foreach (self::COMPLEX_PROPERTIES as $property) {
            if (!\property_exists($data, $property)) {
                throw new LogicException("No $property node in the response");
            }
        }

        $this->setOwner($ownerFactory->create($data->owner));
        $this->setPlan($planFactory->create($data->plan));
        $this->setPlanPending($planFactory->create($data->plan_pending));
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
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
    public function setDevelopmentMode(int $developmentMode)
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
    public function setOriginalNameServers(array $originalNameServers)
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
    public function setOriginalRegistrar(string $originalRegistrar)
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
    public function setOriginalDnsHost(string $originalDnsHost)
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
    public function setCreatedOn(string $createdOn)
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
    public function setModifiedOn(string $modifiedOn)
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
    public function setOwner(Owner $owner)
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
    public function setPermissions(array $permissions)
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
    public function setPlan(Plan $plan)
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
    public function setPlanPending(Plan $planPending)
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
    public function setStatus(string $status)
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
    public function setPaused(bool $paused)
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
    public function setType(string $type)
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
    public function setNameServers(array $nameServers)
    {
        $this->nameServers = $nameServers;
    }
}
