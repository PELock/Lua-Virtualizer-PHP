<?php

/******************************************************************************
 * Lua Virtualizer WebApi interface usage example.
 *
 * In this example we will verify our activation key status.
 *
 * Version        : v1.0
 * Language       : PHP
 * Author         : Bartosz Wójcik
 * Web page       : https://www.pelock.com
 *
 *****************************************************************************/

//
// include Lua Virtualizer class
//
use PELock\LuaVirtualizer\LuaVirtualizer;

//
// if you don't want to use Composer use include_once
//
//include_once "LuaVirtualizer.php";

//
// create Lua Virtualizer class instance (we are using our activation key)
//
$myLuaVirtualizer = new LuaVirtualizer("ABCD-ABCD-ABCD-ABCD");

//
// login to the service
//
$result = $myLuaVirtualizer->Login();

//
// $result[] array holds the information about the license
//
// $result["demo"]          - demo mode (missing or invalid key); limited to 1000 bytes; the server applies only flat code virtualization (code_virtualization=flat), ignoring every other strategy field
// $result["license_expiration"] - license end date (Y-m-d), empty if none
// $result["usages_total"]  - total obfuscations for this activation code
// $result["string_limit"]  - Max. source code size allowed (it's 1000 bytes for demo mode)
//
if ($result !== false)
{
	echo "Demo version status - " . ($result["demo"] ? "true" : "false") . "<br>";
	echo "License expiration - " . $result["license_expiration"] . "<br>";
	echo "Total obfuscations - " . $result["usages_total"] . "<br>";
	echo "Max. source code size - " . $result["string_limit"] . "<br>";
}
else
{
	die("Something unexpected happen while trying to login to the service.");
}

?>
