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

/**
 * The validator interface.
 *
 * @interface ValidatorInterface.
 */
interface ValidatorInterface
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
    public function isValid(string $validationObject, $testCase = null, array $options = array()): bool;
}
