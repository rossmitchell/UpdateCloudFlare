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

namespace RossMitchell\UpdateCloudFlare\Exceptions;

/**
 * Class CloudFlareException
 * @package RossMitchell\UpdateCloudFlare\Exceptions
 */
class CloudFlareException extends \Exception
{
    /**
     * This will parse the result from Cloud Flare and try to produce a meaningful error message
     *
     * @param \stdClass $details
     * @param string    $call
     */
    public function setDetails(\stdClass $details, string $call)
    {
        $errorDetail = $this->collectionErrors($details);
        $message = "There was an error making the $call:" . \PHP_EOL . $errorDetail;
        $this->message = $message;
    }

    /**
     * This actually loops over the response and fetches the errors
     *
     * @param \stdClass $details
     *
     * @return string
     */
    private function collectionErrors(\stdClass $details): string
    {
        $errorMessages = [];
        if (!\property_exists($details, 'errors')) {
            return 'No error node returned';
        }
        $errors = $details->errors;
        if (!\is_array($errors)) {
            return 'Error node is not an array';
        }

        foreach ($errors as $error) {
            $errorMessages[] = $error->message;
        }

        return \implode(PHP_EOL, $errorMessages);
    }
}
