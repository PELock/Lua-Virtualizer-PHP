<?php

/******************************************************************************
 * Lua Virtualizer WebApi interface usage example.
 *
 * In this example we will obfuscate sample source with default options.
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
// source code in Lua format
//
$scriptSourceCode = "local function greet(name)
  print("Hello, " .. name)
end
greet("Lua")
";

//
// by default all obfuscation options are enabled, so we can just simply call:
//
$result = $myLuaVirtualizer->ObfuscateScriptSource($scriptSourceCode);

//
// it's also possible to pass a Lua script file path instead of a string e.g.
//
// $result = $myLuaVirtualizer->ObfuscateScriptFile("/path/to/project/script.lua");

//
// $result[] array holds the obfuscation results as well as other information
//
// $result["error"]         - error code
// $result["output"]        - obfuscated code
// $result["demo"]          - demo mode (missing or invalid key); limited to 1000 bytes; the server applies only flat code virtualization (code_virtualization=flat), ignoring every other strategy field
// $result["license_expiration"] - license end date (Y-m-d), empty if none
// $result["usages_total"]  - total obfuscations for this activation code
//
if ($result !== false)
{
	// display obfuscated code
	if ($result["error"] === \PELock\LuaVirtualizer::ERROR_SUCCESS)
	{
		// format output code for HTML display
		echo "<pre>" . htmlentities($result["output"]) . "</pre>";
	}
	else
	{
		die("An error occurred, error code: " . $result["error"]);
	}
}
else
{
	die("Something unexpected happen while trying to obfuscate the code.");
}

?>
