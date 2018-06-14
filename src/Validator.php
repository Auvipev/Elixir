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
class Validator implements ValidatorInterface, InjectableObject
{

    /**
     * @var array $defaultValidationObjects The default validation objects avaliable.
     */
    private static $defaultValidationObjects = array(
        'Empty',
        'NotEmpty',
        'Username',
        'Email',
        'Pin',
        'Phone',
        'Name',
        'Domain',
        'Regex',
        'Country',
        'Count',
        'Date',
        'Ip',
        'IsNull',
        'IsFalse',
        'Ssn',
        'IsTrue',
        'Length',
        'Range',
        'LessThan',
        'GreaterThan',
        'Identical',
        'NotNull',
        'Uuid',
        'TimeZone',
        'Language',
        'IsFile',
        'EqualTo',
        'NotEqualTo',
        'IsImage',
        'Currency'
    );

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
     *
     * @codeCoverageIgnore.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     *
     *
     *
     */
    public function isValid(string $validationObject, $testCase = null, array $options = array()): bool
    {
        if (in_array($validationObject, $this->defaultValidationObjects)) {
            $validator = new Validation\$validationObject($options);
            if ($validator->valid($testCase)) {
                return true;
            }
            return false;
        }
        throw new UnexpectedValueException('The validation object requested does not exist or is no longer supported.');
    }
}
