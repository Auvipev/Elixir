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

    /**
     * @expectedException PHPUnit\Framework\Error\Error
     */
    public function testUserError()
    {
        $validator = new Validator([]);
        $this->assertTrue($validator->isValid('ValidationObjectThatDoesNotExist', null));
    }

    /**
     * @expectedException PHPUnit\Framework\Error\Error
     */
    public function testSkipVerification()
    {
        $validator = new Validator([
            'validation' => [
                'exclude_validation_objects' => [
                    'NotEmpty',
                    'IsEmpty'
                ]
            ]
        ]);
        $this->assertTrue($validator->isValid('IsEmpty', null));
    }

    public function testValidator()
    {
        $validator = new Validator([]);
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
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseA, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseB, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseC, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue(!$validator->isValid('NotEmpty', $testCaseD, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue($validator->isValid('NotEmpty', $testCaseE, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue($validator->isValid('NotEmpty', $testCaseF, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseA, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseB, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseC, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue($validator->isValid('IsEmpty', $testCaseD, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue(!$validator->isValid('IsEmpty', $testCaseE, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
        $this->assertTrue(!$validator->isValid('IsEmpty', $testCaseF, array(
            'mixed_data_types' => true,
            'int_data_types' => true
        )));
    }
}
