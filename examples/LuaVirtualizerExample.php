<?php

/******************************************************************************
 * Lua Virtualizer WebApi interface usage example.
 *
 * In this example we will obfuscate sample source with every public option
 * set, so you can see the full client surface and turn flags on or off.
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
use PELock\LuaVirtualizer\CodeVirtualization;
use PELock\LuaVirtualizer\RenameStyle;
use PELock\LuaVirtualizer\Target;

//
// if you don't want to use Composer use include_once
//
//include_once "LuaVirtualizer.php";

//
// create Lua Virtualizer class instance (we are using our activation key)
//
$myLuaVirtualizer = new LuaVirtualizer("ABCD-ABCD-ABCD-ABCD");

//
// should the source code be compressed (both input & compressed)
//
$myLuaVirtualizer->enableCompression = false;

//
// globals
//
// fixed random seed for reproducible obfuscation output (optional)
//
$myLuaVirtualizer->seed = null;

//
// randomization density / intensity (0-100)
//
$myLuaVirtualizer->randomizationDensity = null;

//
// identifier renaming style: RenameStyle::Il, O0, Hex, or Mangled
//
$myLuaVirtualizer->renameStyle = RenameStyle::Il;

//
// Lua dialect. "auto" (default) omits the POST field.
// Explicit values: 5.1, 5.2, 5.3, 5.4, 5.5, luajit, luau.
//
$myLuaVirtualizer->target = Target::Auto;

//
// code virtualization (exactly one): VM, FSA, or FLAT
// set to null to skip virtualization
//
$myLuaVirtualizer->codeVirtualization = CodeVirtualization::VM;

//
// protection (opt-in on the service for --all; shown enabled here so every flag is visible)
//
// protection against tampering with protected code (integrity verification)
//
$myLuaVirtualizer->selfDefending = true;

//
// protection linker (decoy call graph; requires selfDefending)
//
$myLuaVirtualizer->protectionLinker = true;

//
// insert anti-debugging detections
//
$myLuaVirtualizer->detectDebugger = true;

//
// insert virtual machine (anti-VM) detections
//
$myLuaVirtualizer->antiVm = true;

//
// insert anti-sandbox detections
//
$myLuaVirtualizer->antiSandbox = true;

//
// insert anti-emulators (CPU) detections
//
$myLuaVirtualizer->antiEmulator = true;

//
// renaming
//
// rename variable names to random string values
//
$myLuaVirtualizer->renameVariables = true;

//
// rename parameter names to random string values
//
$myLuaVirtualizer->renameParameters = true;

//
// rename function names to random string values
//
$myLuaVirtualizer->renameFunctions = true;

//
// rename function call references consistently with renamed functions
//
$myLuaVirtualizer->renameFunctionCalls = true;

//
// shuffle function order in the output source
//
$myLuaVirtualizer->shuffleFunctions = true;

//
// fold/resolve constant expressions at obfuscation time
//
$myLuaVirtualizer->resolveConstants = true;

//
// strings
//
// split strings into concatenated chunks
//
$myLuaVirtualizer->splitStrings = true;

//
// apply light transformations/mutations to string literals
//
$myLuaVirtualizer->modifyStrings = true;

//
// encrypt strings using randomly generated polymorphic encryption algorithms
//
$myLuaVirtualizer->encryptStrings = true;

//
// store string fragments in char-code array vaults
//
$myLuaVirtualizer->stringCharArrayVault = true;

//
// numeric
//
// encrypt integers
//
$myLuaVirtualizer->encryptIntegers = true;

//
// encrypt floating point numbers
//
$myLuaVirtualizer->encryptFloating = true;

//
// replace binary operators with mixed boolean-arithmetic (MBA) equivalents
//
$myLuaVirtualizer->mbaBinops = true;

//
// represent integers via floating-point math
//
$myLuaVirtualizer->integersToFloating = true;

//
// move integers to arrays
//
$myLuaVirtualizer->integersToArrays = true;

//
// move floats to arrays
//
$myLuaVirtualizer->floatsToArrays = true;

//
// apply redundant xor / affine integer masks
//
$myLuaVirtualizer->affineIntegerMask = true;

//
// encrypted array literals
//
// encrypt integer array literals
//
$myLuaVirtualizer->arrayIntCrypt = true;

//
// encrypt character array literals
//
$myLuaVirtualizer->arrayCharCrypt = true;

//
// encrypt floating-point array literals
//
$myLuaVirtualizer->arrayDoubleCrypt = true;

//
// encrypt string array literals
//
$myLuaVirtualizer->arrayStringCrypt = true;

//
// decoy value pools
//
// insert a shared bucket of random noise values used by other strategies
//
$myLuaVirtualizer->insertRandomValueBucket = true;

//
// populate the random value bucket with decoy integers
//
$myLuaVirtualizer->randomBucketIntegers = true;

//
// populate the random value bucket with decoy arrays
//
$myLuaVirtualizer->randomBucketArrays = true;

//
// populate the random value bucket with decoy functions
//
$myLuaVirtualizer->randomBucketFunctions = true;

//
// populate the random value bucket with decoy characters
//
$myLuaVirtualizer->randomBucketCharacters = true;

//
// populate the random value bucket with anti-regex decoy noise
//
$myLuaVirtualizer->randomBucketAntiRegex = true;

//
// populate the random value bucket with autostart decoy stubs
//
$myLuaVirtualizer->randomBucketAutostart = true;

//
// opaque predicates & noise
//
// rewrite selected statements using ternary operators
//
$myLuaVirtualizer->insertTernaryOperators = true;

//
// replace boolean conditions with equivalent complex expressions
//
$myLuaVirtualizer->complexifyBooleans = true;

//
// insert opaque predicate branches
//
$myLuaVirtualizer->opaqueBranches = true;

//
// insert opaque mixer chains into control flow
//
$myLuaVirtualizer->opaqueMixerChain = true;

//
// insert dead code
//
$myLuaVirtualizer->insertDeadCode = true;

//
// wrap code in try/finally blocks with dead noise
//
$myLuaVirtualizer->tryFinallyNoise = true;

//
// decoys
//
// insert decoy functions
//
$myLuaVirtualizer->decoyFunctions = true;

//
// insert decoy lambda expressions
//
$myLuaVirtualizer->lambdaDecoys = true;

//
// insert literal padding noise
//
$myLuaVirtualizer->literalPadding = true;

//
// insert fake import statement markers
//
$myLuaVirtualizer->fakeImportMarkers = true;

//
// use dynamic getattr()-based indirect calls
//
$myLuaVirtualizer->dynamicGetattrCalls = true;

//
// rewrite absolute imports into __import__ / getattr
//
$myLuaVirtualizer->obfuscateImports = true;

//
// insert dead callback/event registration stubs
//
$myLuaVirtualizer->callbackRegistrationStubs = true;

//
// other
//
// strip comments from the output source
//
$myLuaVirtualizer->removeComments = true;

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

//
// Per-function marker (source syntax, not a library import). The marker is the
// first statement of a function. The engine reads it and strips it.
//
// local function f()
//   LUAVIRTUALIZER(VM(FSA), OBFUSCATION(encrypt_strings, NUMBERS))
//   return 1
// end
//
// VM(VM|FSA|FLAT|NONE) selects the dispatcher; NONE stays native Lua.
// OBFUSCATION(...) is a blacklist: NONE, ALL, group names NAMES, STRINGS,
// NUMBERS, BOOLEANS, SHAPE, BUCKET, CALLS, COMMENTS, PROTECT, or a specific
// snake_case strategy flag.
