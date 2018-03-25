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

namespace RossMitchell\UpdateCloudFlare\Abstracts;

abstract class Curl
{
    public function makeRequest()
    {
        $fields    = $this->getFields();
        $hasFields = \count($fields);
        $ch        = \curl_init();
        \curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        \curl_setopt($ch, CURLOPT_POST, $hasFields);
        if ($hasFields === true) {
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getFieldsString($fields));
        }
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = \curl_exec($ch);

        if (\curl_error($ch)) {
            echo 'error:'.\curl_error($ch);
            die();
        }
        \curl_close($ch);

        return $result;
    }

    abstract public function getFields();

    abstract public function getUrl() : string;

    private function getFieldsString(array $fields): string
    {
        $fieldsString = "";
        foreach ($fields as $key => $value) {
            $fieldsString .= $key.'='.$value.'&';
        }
        rtrim($fieldsString, '&');

        return $fieldsString;
    }
}
