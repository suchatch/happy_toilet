<?php

/* 
 * Copyright (C) 2013 peredur.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


include_once './config.php';   // Needed because functions.php is not included

$mysqli_asset = new mysqli(DBHost, DBUser, DBPasswd, DBName);
if ($mysqli_asset->connect_error) {
//    header("Location: error.php?err=Unable to connect to MySQL");
//    exit();
}

mysqli_set_charset($mysqli_asset, "utf8");