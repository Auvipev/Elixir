<?php
declare(strict_types=1);
/**
 * Viper Engine Management System.
 *
 * @author Nicholas English   <https://github.com/Auvipev>.
 * @author Viper Contributors <https://github.com/Auvipev/Viper-Engine/graphs/contributors>.
 *
 * @package Viper.
 */

namespace Auvipev\Viper;

use function is_null;
use function in_array;
use function user_error;

use const E_USER_ERROR;

/**
 * The validator class.
 *
 * @link <https://secure.php.net/manual/en/function.trigger-error.php>.
 *
 * @class      Validator.
 * @extends    ValidationObjects.
 * @implements ValidatorInterface.
 * @implements InjectableObject.
 */
class Validator extends ValidationObjects implements ValidatorInterface, InjectableObject
{

    /**
     * @var array $config The configuration.
     */
    private $config;

    /**
     * Inject any configuration or objct classes for this class.
     *
     * @param array $config The configuration.
     *
     * @return void Returns nothing.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Check to see if the test case is valid against the requested validation object based on
     * any options passed.
     *
     * @param string $validationObject The validation object.
     * @param mixed  $testCase         The test case (Can be anything).
     * @param array  $options          Any options to pass.
     *
     * @return bool Returns TRUE if the test case passes and FALSE if it does not.
     */
    public function isValid(string $validationObject, $testCase = null, array $options = array()): bool
    {
        if (!is_null($this->config['validation']['exclude_validation_objects']) && isset($this->config['validation']['exclude_validation_objects']) && in_array($validationObject, $this->config['validator']['exclude_validation_objects'])) {
            goto skip;
        }
        $validationObject = strtolower($validationObject);
        if (in_array($validationObject, static::$defaultValidationObjects)) {
            if (strcmp($validationObject, 'notempty') === 0) {
                $validator = new Validation\Validators\NotEmpty($options); 
            }
            if (strcmp($validationObject, 'isempty') === 0) {
                $validator = new Validation\Validators\IsEmpty($options);
            }
            return $validator->valid($testCase);
        }
        skip:
        user_error(
            'The validation object requested does not exist or is no longer supported.',
            E_USER_ERROR
        );
    }
}
