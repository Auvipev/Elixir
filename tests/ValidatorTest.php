<?php
declare(strict_types=1);
/**
 * Viper Content Management System.
 *
 * @author Nicholas English   <https://github.com/Auvipev>.
 * @author Viper Contributors <https://github.com/Auvipev/Viper-Engine/graphs/contributors>.
 *
 * @package Viper.
 */

namespace Auvipev\Viper;

use PHPUnit\Framework\TestCase;

/**
 * The hasher test class.
 *
 * @class HasherTest.
 */
class ValidatorTest extends TestCase
{

    public function testValidator()
    {
        $validator = new Validator();
        $testCaseA = '';
        $testCaseB = ' ';
        $testCaseC = 0;
        $testCaseD = null;
        $testCaseE = 'Hello World!';
        $testCaseF = 27;
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseA));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseB));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseC));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseD));
        $this->assertTrue($validator->isValid('NotEmpty', $testCaseE));
        $this->assertTrue($validator->isValid('NotEmpty', $testCaseF));
        $this->assertTrue($validator->isValid('Empty', $testCaseA));
        $this->assertTrue($validator->isValid('Empty', $testCaseB));
        $this->assertTrue($validator->isValid('Empty', $testCaseC));
        $this->assertTrue($validator->isValid('Empty', $testCaseD));
        $this->assertTrue(!$validator->isValid('Empty', $testCaseE));
        $this->assertTrue(!$validator->isValid('Empty', $testCaseF));
    }
}
