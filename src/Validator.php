<?php
declare(strict_types=1);
/**
 * Viper Content Management System.
 *
 * @author Nicholas English   <https://github.com/Auvipev>.
 * @author Viper Contributors <https://github.com/Auvipev/Viper/graphs/contributors>.
 *
 * @package Viper.
 */

namespace Auvipev\Viper;

use UnexpectedValueException;

use function is_null;
use function in_array;

/**
 * The validator class.
 *
 * @link <https://secure.php.net/manual/en/class.unexpectedvalueexception.php>.
 *
 * @class      Validator.
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
     * @return bool Returns TRUE if th test case passes and FALSE if it does not.
     */
    public function isValid(string $validationObject, $testCase = null, array $options = array()): bool
    {
        if (in_array($validationObject, ValidationObjects::$defaultValidationObjects)) {
            $validator = new Validation\$validationObject($options);
            if ($validator->valid($testCase)) {
                return true;
            }
            return false;
        }
        throw new UnexpectedValueException('The validation object requested does not exist or is no longer supported.');
    }
}
