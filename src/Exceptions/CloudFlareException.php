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

namespace RossMitchell\UpdateCloudFlare\Exceptions;

use RossMitchell\UpdateCloudFlare\Abstracts\CloudFlareResponse;

/**
 * Class CloudFlareException
 * @package RossMitchell\UpdateCloudFlare\Exceptions
 */
class CloudFlareException extends \Exception
{
    /**
     * This will parse the result from Cloud Flare and try to produce a meaningful error message
     *
     * @param CloudFlareResponse $details
     */
    public function setDetails(CloudFlareResponse $details)
    {
        $errorDetail   = $this->collectionErrors($details);
        $call          = \get_class($details);
        $message       = "There was an error making the $call:".\PHP_EOL.$errorDetail;
        $this->message = $message;
    }

    /**
     * This actually loops over the response and fetches the errors
     *
     * @param CloudFlareResponse $details
     *
     * @return string
     */
    private function collectionErrors(CloudFlareResponse $details): string
    {
        $errorMessages = [];

        foreach ($details->getErrors() as $error) {
            $errorMessages[] = $error->getMessage();
        }

        if (empty($errorMessages)) {
            $errorMessages[] = 'No error details returned';
        }

        return \implode(PHP_EOL, $errorMessages);
    }
}
