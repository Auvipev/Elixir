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
 * @class      Validator.
 * @extends    ValidationObjects.
 * @implements ValidatorInterface.
 * @implements InjectableObject.
 */
class Validator extends ValidationObjects implements ValidatorInterface, InjectableObject
{

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
        if (in_array($validationObject, static::$defaultValidationObjects)) {
            $validator = new Validation\Validators\$validationObject($options);
            if ($validator->valid($testCase)) {
                return true;
            }
            return false;
        }
        user_error(
            'The validation object requested does not exist or is no longer supported.',
            E_USER_ERROR
        );
    }
}
