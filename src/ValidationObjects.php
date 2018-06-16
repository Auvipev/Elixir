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
 * The validation object class.
 *
 * @class ValidationObjects.
 */
class ValidationObjects
{

    /**
     * @var array $defaultValidationObjects The validation object definitions.
     */
    protected static $defaultValidationObjects = array(
        'NotEmpty',
        'Empty'
    );
}
