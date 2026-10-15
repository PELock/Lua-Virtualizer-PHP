<?php
/******************************************************************************
 * Lua Virtualizer WebApi interface
 *
 * Version        : v1.0
 * Language       : PHP
 * Author         : Bartosz Wójcik
 * Web page       : https://www.pelock.com
 *
 *****************************************************************************/

namespace PELock\LuaVirtualizer;

class LuaVirtualizer
{
	/**
	 * @var string default Lua Virtualizer WebApi endpoint
	 */
	const API_URL = "https://www.pelock.com/api/lua-virtualizer/v1";

	/**
	 * @var string WebApi key for the service
	 */
	protected $_ApiKey = null;

	/**
	 * @var bool should the source code be compressed
	 */
	public $enableCompression = false;

	/**
	 * @var int|null fixed random seed for reproducible obfuscation output (optional)
	 */
	public $seed = null;

	/**
	 * @var int|null randomization density / intensity (0-100)
	 */
	public $randomizationDensity = null;

	/**
	 * @var RenameStyle|string|null identifier renaming style (il, o0, hex, mangled)
	 */
	public $renameStyle = null;

	/**
	 * @var Target|string Lua dialect (5.1, 5.2, 5.3, 5.4, 5.5, luajit, luau). auto or empty omits the POST field.
	 */
	public $target = Target::Auto;

	/**
	 * @var CodeVirtualization|string|null public virtualization mode (vm, fsa, or flat). Set to null to skip virtualization.
	 */
	public $codeVirtualization = CodeVirtualization::VM;

	/**
	 * @var bool protection against tampering with protected code (integrity verification)
	 */
	public $selfDefending = false;

	/**
	 * @var bool protection linker (decoy call graph)
	 */
	public $protectionLinker = false;

	/**
	 * @var bool rename variable names to random string values
	 */
	public $renameVariables = true;

	/**
	 * @var bool rename parameter names to random string values
	 */
	public $renameParameters = true;

	/**
	 * @var bool rename function names to random string values
	 */
	public $renameFunctions = true;

	/**
	 * @var bool rename function call references consistently with renamed functions
	 */
	public $renameFunctionCalls = true;

	/**
	 * @var bool shuffle function order in the output source
	 */
	public $shuffleFunctions = true;

	/**
	 * @var bool fold/resolve constant expressions at obfuscation time
	 */
	public $resolveConstants = true;

	/**
	 * @var bool split strings into concatenated chunks
	 */
	public $splitStrings = true;

	/**
	 * @var bool apply light transformations/mutations to string literals
	 */
	public $modifyStrings = true;

	/**
	 * @var bool encrypt strings using randomly generated polymorphic encryption algorithms
	 */
	public $encryptStrings = true;

	/**
	 * @var bool store string fragments in char-code array vaults
	 */
	public $stringCharArrayVault = true;

	/**
	 * @var bool encrypt integers
	 */
	public $encryptIntegers = true;

	/**
	 * @var bool encrypt floating point numbers
	 */
	public $encryptFloating = true;

	/**
	 * @var bool replace binary operators with mixed boolean-arithmetic (MBA) equivalents
	 */
	public $mbaBinops = true;

	/**
	 * @var bool represent integers via floating-point math
	 */
	public $integersToFloating = true;

	/**
	 * @var bool move integers to arrays
	 */
	public $integersToArrays = true;

	/**
	 * @var bool move floats to arrays
	 */
	public $floatsToArrays = true;

	/**
	 * @var bool apply redundant xor / affine integer masks
	 */
	public $affineIntegerMask = true;

	/**
	 * @var bool encrypt integer array literals
	 */
	public $arrayIntCrypt = true;

	/**
	 * @var bool encrypt character array literals
	 */
	public $arrayCharCrypt = true;

	/**
	 * @var bool encrypt floating-point array literals
	 */
	public $arrayDoubleCrypt = true;

	/**
	 * @var bool encrypt string array literals
	 */
	public $arrayStringCrypt = true;

	/**
	 * @var bool insert a shared bucket of random noise values used by other strategies
	 */
	public $insertRandomValueBucket = true;

	/**
	 * @var bool populate the random value bucket with decoy integers
	 */
	public $randomBucketIntegers = true;

	/**
	 * @var bool populate the random value bucket with decoy arrays
	 */
	public $randomBucketArrays = true;

	/**
	 * @var bool populate the random value bucket with decoy functions
	 */
	public $randomBucketFunctions = true;

	/**
	 * @var bool populate the random value bucket with decoy characters
	 */
	public $randomBucketCharacters = true;

	/**
	 * @var bool populate the random value bucket with anti-regex decoy noise
	 */
	public $randomBucketAntiRegex = true;

	/**
	 * @var bool populate the random value bucket with autostart decoy stubs
	 */
	public $randomBucketAutostart = true;

	/**
	 * @var bool rewrite selected statements using ternary operators
	 */
	public $insertTernaryOperators = true;

	/**
	 * @var bool replace boolean conditions with equivalent complex expressions
	 */
	public $complexifyBooleans = true;

	/**
	 * @var bool insert opaque predicate branches
	 */
	public $opaqueBranches = true;

	/**
	 * @var bool insert opaque mixer chains into control flow
	 */
	public $opaqueMixerChain = true;

	/**
	 * @var bool insert dead code
	 */
	public $insertDeadCode = true;

	/**
	 * @var bool wrap code in try/finally blocks with dead noise
	 */
	public $tryFinallyNoise = true;

	/**
	 * @var bool insert decoy functions
	 */
	public $decoyFunctions = true;

	/**
	 * @var bool insert decoy lambda expressions
	 */
	public $lambdaDecoys = true;

	/**
	 * @var bool insert literal padding noise
	 */
	public $literalPadding = true;

	/**
	 * @var bool insert fake import statement markers
	 */
	public $fakeImportMarkers = true;

	/**
	 * @var bool use dynamic getattr()-based indirect calls
	 */
	public $dynamicGetattrCalls = true;

	/**
	 * @var bool rewrite absolute imports into __import__ and getattr
	 */
	public $obfuscateImports = true;

	/**
	 * @var bool insert dead callback/event registration stubs
	 */
	public $callbackRegistrationStubs = true;

	/**
	 * @var bool insert anti-debugging detections
	 */
	public $detectDebugger = false;

	/**
	 * @var bool insert virtual machine (anti-VM) detections
	 */
	public $antiVm = false;

	/**
	 * @var bool insert anti-sandbox detections
	 */
	public $antiSandbox = false;

	/**
	 * @var bool insert anti-emulators (CPU) detections
	 */
	public $antiEmulator = false;

	/**
	 * @var bool strip comments from the output source
	 */
	public $removeComments = true;

	/**
	 * @var integer success
	 */
	const ERROR_SUCCESS = 0;

	/**
	 * @var integer invalid size for source code (it's 1000 bytes max. for demo version)
	 */
	const ERROR_INPUT_SIZE = 1;

	/**
	 * @var integer input source is empty
	 */
	const ERROR_INPUT = 2;

	/**
	 * @var integer Lua source code parsing error
	 */
	const ERROR_PARSING = 3;

	/**
	 * @var integer Python parsed code obfuscation error
	 */
	const ERROR_OBFUSCATION = 4;

	/**
	 * @var integer An error occurred while generating output code
	 */
	const ERROR_OUTPUT = 5;

	/**
	 * Initialize Lua Virtualizer class
	 *
	 * @param string|null $ApiKey Activation key. Empty or invalid keys run demo mode, A missing or invalid key is limited to 1000 bytes and the server applies only flat code virtualization (code_virtualization=flat), ignoring every other strategy field.
	 */
	function __construct($ApiKey = null)
	{
		$this->_ApiKey = $ApiKey;
	}

	/**
	 * Login to the service and get the information about the current license limits
	 *
	 * @param bool $ReturnAsArray  Return result as an associative array or JSON encoded string
	 * @return mixed               An array with the results or false on error
	 */
	public function Login($ReturnAsArray = true)
	{
		// parameters
		$Params["command"] = "login";

		return $this->PostRequest($Params, $ReturnAsArray);
	}

	/**
	 * Obfuscate Lua script source code file using provided parameters
	 *
	 * @param string $ScriptFilePath Lua compatible script *.lua file path
	 * @param bool $ReturnAsArray    Return result as an associative array or JSON encoded string
	 * @return mixed                 An array with the results or false on error
	 */
	public function ObfuscateScriptFile($ScriptFilePath, $ReturnAsArray = true)
	{
		$Source = @file_get_contents($ScriptFilePath);

		if (!$Source) return null;

		return $this->ObfuscateScriptSource($Source, $ReturnAsArray);
	}

	/**
	 * Obfuscate Lua script source code using provided parameters
	 *
	 * @param string $ScriptSource Lua compatible script *.lua source code
	 * @param bool $ReturnAsArray  Return result as an associative array or JSON encoded string
	 * @return mixed               An array with the results or false on error
	 */
	public function ObfuscateScriptSource($ScriptSource, $ReturnAsArray = true)
	{
		// additional parameters
		$ParamsArray["command"] = "obfuscate";
		$ParamsArray["source"] = $ScriptSource;

		return $this->PostRequest($ParamsArray, $ReturnAsArray);
	}

	/**
	 * Send a POST request to the server
	 *
	 * @param array $ParamsArray  An array with the parameters
	 * @param bool $ReturnAsArray Return result as an associative array or JSON encoded string
	 * @return mixed              An array with the results or false on error
	 */
	protected function PostRequest($ParamsArray, $ReturnAsArray)
	{
		// add activation key to the parameters array
		if (!empty($this->_ApiKey))
		{
			$ParamsArray["key"] = $this->_ApiKey;
		}

		//
		// global tuning options
		//
		if ($this->seed !== null) $ParamsArray["seed"] = (string) $this->seed;
		if ($this->randomizationDensity !== null) $ParamsArray["randomization_density"] = (string) $this->randomizationDensity;
		if ($this->renameStyle instanceof RenameStyle) $ParamsArray["rename_style"] = $this->renameStyle->value;
		elseif (!empty($this->renameStyle)) $ParamsArray["rename_style"] = (string) $this->renameStyle;
		if ($this->codeVirtualization instanceof CodeVirtualization) $ParamsArray["code_virtualization"] = $this->codeVirtualization->value;
		elseif (!empty($this->codeVirtualization)) $ParamsArray["code_virtualization"] = (string) $this->codeVirtualization;
		$targetValue = $this->target instanceof Target ? $this->target->value : (string) $this->target;
		if ($targetValue !== '' && strcasecmp($targetValue, 'auto') !== 0)
		{
			$ParamsArray["target"] = $targetValue;
		}

		//
		// obfuscation strategies
		//
		if ($this->selfDefending) $ParamsArray["self_defending"] = "1";
		if ($this->protectionLinker) $ParamsArray["protection_linker"] = "1";
		if ($this->renameVariables) $ParamsArray["rename_variables"] = "1";
		if ($this->renameParameters) $ParamsArray["rename_parameters"] = "1";
		if ($this->renameFunctions) $ParamsArray["rename_functions"] = "1";
		if ($this->renameFunctionCalls) $ParamsArray["rename_function_calls"] = "1";
		if ($this->shuffleFunctions) $ParamsArray["shuffle_functions"] = "1";
		if ($this->resolveConstants) $ParamsArray["resolve_constants"] = "1";
		if ($this->splitStrings) $ParamsArray["split_strings"] = "1";
		if ($this->modifyStrings) $ParamsArray["modify_strings"] = "1";
		if ($this->encryptStrings) $ParamsArray["encrypt_strings"] = "1";
		if ($this->stringCharArrayVault) $ParamsArray["string_char_array_vault"] = "1";
		if ($this->encryptIntegers) $ParamsArray["encrypt_integers"] = "1";
		if ($this->encryptFloating) $ParamsArray["encrypt_floating"] = "1";
		if ($this->mbaBinops) $ParamsArray["mba_binops"] = "1";
		if ($this->integersToFloating) $ParamsArray["integers_to_floating"] = "1";
		if ($this->integersToArrays) $ParamsArray["integers_to_arrays"] = "1";
		if ($this->floatsToArrays) $ParamsArray["floats_to_arrays"] = "1";
		if ($this->affineIntegerMask) $ParamsArray["affine_integer_mask"] = "1";
		if ($this->arrayIntCrypt) $ParamsArray["array_int_crypt"] = "1";
		if ($this->arrayCharCrypt) $ParamsArray["array_char_crypt"] = "1";
		if ($this->arrayDoubleCrypt) $ParamsArray["array_double_crypt"] = "1";
		if ($this->arrayStringCrypt) $ParamsArray["array_string_crypt"] = "1";
		if ($this->insertRandomValueBucket) $ParamsArray["insert_random_value_bucket"] = "1";
		if ($this->randomBucketIntegers) $ParamsArray["random_bucket_integers"] = "1";
		if ($this->randomBucketArrays) $ParamsArray["random_bucket_arrays"] = "1";
		if ($this->randomBucketFunctions) $ParamsArray["random_bucket_functions"] = "1";
		if ($this->randomBucketCharacters) $ParamsArray["random_bucket_characters"] = "1";
		if ($this->randomBucketAntiRegex) $ParamsArray["random_bucket_anti_regex"] = "1";
		if ($this->randomBucketAutostart) $ParamsArray["random_bucket_autostart"] = "1";
		if ($this->insertTernaryOperators) $ParamsArray["insert_ternary_operators"] = "1";
		if ($this->complexifyBooleans) $ParamsArray["complexify_booleans"] = "1";
		if ($this->opaqueBranches) $ParamsArray["opaque_branches"] = "1";
		if ($this->opaqueMixerChain) $ParamsArray["opaque_mixer_chain"] = "1";
		if ($this->insertDeadCode) $ParamsArray["insert_dead_code"] = "1";
		if ($this->tryFinallyNoise) $ParamsArray["try_finally_noise"] = "1";
		if ($this->decoyFunctions) $ParamsArray["decoy_functions"] = "1";
		if ($this->lambdaDecoys) $ParamsArray["lambda_decoys"] = "1";
		if ($this->literalPadding) $ParamsArray["literal_padding"] = "1";
		if ($this->fakeImportMarkers) $ParamsArray["fake_import_markers"] = "1";
		if ($this->dynamicGetattrCalls) $ParamsArray["dynamic_getattr_calls"] = "1";
		if ($this->obfuscateImports) $ParamsArray["obfuscate_imports"] = "1";
		if ($this->callbackRegistrationStubs) $ParamsArray["callback_registration_stubs"] = "1";
		if ($this->detectDebugger) $ParamsArray["detect_debugger"] = "1";
		if ($this->antiVm) $ParamsArray["anti_vm"] = "1";
		if ($this->antiSandbox) $ParamsArray["anti_sandbox"] = "1";
		if ($this->antiEmulator) $ParamsArray["anti_emulator"] = "1";
		if ($this->removeComments) $ParamsArray["remove_comments"] = "1";

		//
		// check if compression is enabled
		//
		if ($this->enableCompression && !empty($ParamsArray["source"]))
		{
			$ParamsArray["source"] = @base64_encode(@gzcompress($ParamsArray["source"], 9));
			$ParamsArray["compression"] = "1";
		}

		if (!function_exists('curl_version'))
		{
			return false;
		}

		$ch = curl_init();

		// URL
		curl_setopt($ch, CURLOPT_URL, self::API_URL);

		// send POST request
		curl_setopt($ch, CURLOPT_POST, true);

		// POST parameters
		curl_setopt($ch, CURLOPT_POSTFIELDS, $ParamsArray);

		// user agent
		curl_setopt($ch, CURLOPT_USERAGENT, "PELock Lua Virtualizer");

		// return only result
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// execute query
		$response = curl_exec($ch);

		// close the session
		curl_close($ch);

		// check the result
		if (empty($response)) return false;

		// decode to array
		$result = json_decode($response, true);

		if (empty($result)) return false;

		// depack output code back into the string
		$depacked = false;

		if ($this->enableCompression && isset($result["error"]) && $result["error"] === self::ERROR_SUCCESS && !empty($result["output"]))
		{
			$result["output"] = @gzuncompress(@base64_decode($result["output"]));
			$depacked = true;
		}

		if ($ReturnAsArray)
		{
			return $result;
		}

		// if output was depacked - pack it again to JSON format
		if ($depacked)
		{
			return json_encode($result);
		}

		// return original JSON response code
		return $response;
	}
}
?>
