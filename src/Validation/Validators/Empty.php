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

/**
 * The empty validation object class.
 *
 * @class      Empty.
 * @implements ValidatorObjectInterface.
 */
class Empty implements ValidatorObjectInterface
{

    /**
     * @var bool $checkAgainstDiffDataTypes Should we check different data types.
     */
    private $checkAgainstDiffDataTypes;

    /**
     * @var bool $checkAgainstIntDataTypes Should we check int data types.
     */
    private $checkAgainstIntDataTypes;

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
        $this->checkAgainstIntDataTypes  = isset($options['int_data_types'])
            ? $options['int_data_types']
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
        return ! (new NotEmpty(array(
            'mixed_data_types' => $this->checkAgainstDiffDataTypes,
            'int_data_types'   => $this->checkAgainstIntDataTypes
        )))->valid($testCase);
    }
}
