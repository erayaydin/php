<?php
/**
 * Created by PhpStorm.
 * User: AliFii
 * Date: 6/22/17
 * Time: 11:06 AM
 */

include "system/application.php";
include "system/config.php";
include "system/validation.php";
include "system/helpers.php";

Config::import();
Application::run();