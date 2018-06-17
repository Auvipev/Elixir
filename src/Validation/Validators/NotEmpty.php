<?php
declare(strict_types=1);
/**
 * Viper Engine Management System.
 *
 * @author Nicholas English   <https://github.com/Auvipev>.
 * @author Viper Contributors <https://github.com/Auvipev/Viper/graphs/contributors>.
 *
 * @package Viper.
 */

namespace Auvipev\Viper\Validation\Validators;

use Auvipev\Viper\Validation\ValidatorObjectInterface;

use function is_null;
use function trim;

/**
 * The not empty validation object class.
 *
 * @class      NotEmpty.
 * @implements ValidatorObjectInterface.
 */
class NotEmpty implements ValidatorObjectInterface
{

    /**
     * @var bool $checkAgainstDiffDataTypes Should we check different data types.
     */
    private $checkAgainstDiffDataTypes;

    /**
     * Consturct the validation object.
     *
     * @param array $options The options array.
     *
     * @return void Returns nothing.
     */
    public function __construct(array $options = array())
    {
        $this->checkAgainstDiffDataTypes = isset($options['mixed_data_types'])
            ? $options['mixed_data_types']
            : true;
    }

    /**
     * Check to see if the test case is valid against the validation object.
     *
     * @param mixed $testCase The test case to validate.
     *
     * @return bool Returns TRUE if the test case is valid and FALSE if it does not.
     */
    public function valid($testCase): bool
    {
        if ($this->checkAgainstDiffDataTypes) {
            if (is_null($testCase)) {
                return false;
            } elseif ($testCase === 0) {
                return false;
            } else {
                /** Mixed Data Type Validation Complete. */
            }
        }
        if ((string) trim($testCase) === '' || empty((string) trim($testCase))) {
            return false;
        }
        return true;
    }
}
