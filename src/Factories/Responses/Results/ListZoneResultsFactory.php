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

namespace RossMitchell\UpdateCloudFlare\Factories\Responses\Results;

use RossMitchell\UpdateCloudFlare\Helpers\Hydrator;
use RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class ListZoneResultsFactory
 * @package RossMitchell\UpdateCloudFlare\Factories\Responses\Results
 */
class ListZoneResultsFactory
{
    public const COMPLEX_PROPERTIES = ['owner', 'plan', 'plan_pending'];
    public const SIMPLE_PROPERTIES  = [
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
     * @var Hydrator
     */
    private $hydrator;
    /**
     * @var OwnerFactory
     */
    private $ownerFactory;
    /**
     * @var PlanFactory
     */
    private $planFactory;

    /**
     * ListZoneResultsFactory constructor.
     *
     * @param Hydrator     $hydrator
     * @param OwnerFactory $ownerFactory
     * @param PlanFactory  $planFactory
     */
    public function __construct(Hydrator $hydrator, OwnerFactory $ownerFactory, PlanFactory $planFactory)
    {
        $this->hydrator     = $hydrator;
        $this->ownerFactory = $ownerFactory;
        $this->planFactory  = $planFactory;
    }

    /**
     * @param \stdClass $data
     *
     * @return ListZonesResult
     * @throws LogicException
     */
    public function create(\stdClass $data): ListZonesResult
    {
        $listZone = new ListZonesResult();
        foreach (self::SIMPLE_PROPERTIES as $property) {
            $this->hydrator->setProperty($listZone, $data, $property);
        }

        foreach (self::COMPLEX_PROPERTIES as $property) {
            if (!\property_exists($data, $property)) {
                throw new LogicException("No $property node in the response");
            }
        }

        $listZone->setOwner($this->ownerFactory->create($data->owner));
        $listZone->setPlan($this->planFactory->create($data->plan));
        $listZone->setPlanPending($this->planFactory->create($data->plan_pending));

        return $listZone;
    }
}
