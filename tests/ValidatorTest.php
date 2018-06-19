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
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseA));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseB));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseC));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseD));
        $this->assertTrue(!$validator->isValid('IsEmpty', $testCaseE));
        $this->assertTrue(!$validator->isValid('IsEmpty', $testCaseF));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseA, array()));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseB, array()));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseC, array()));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseD, array()));
        $this->assertTrue($validator->isValid('NotEmpty', $testCaseE, array()));
        $this->assertTrue($validator->isValid('NotEmpty', $testCaseF, array()));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseA, array()));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseB, array()));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseC, array()));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseD, array()));
        $this->assertTrue(!$validator->isValid('IsEmpty', $testCaseE, array()));
        $this->assertTrue(!$validator->isValid('IsEmpty', $testCaseF, array()));
    }
}
