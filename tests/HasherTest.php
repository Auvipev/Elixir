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

use function md5;

use const PASSWORD_BCRYPT;

/**
 * The hasher test class.
 *
 * @class HasherTest.
 */
class HasherTest extends TestCase
{

    public function testHasher()
    {
        $hasher = new Hasher(array(
            'password_hash' => array(
                'algo' => PASSWORD_BCRYPT,
                'options' => array(
                    'cost' => 11
                )
            )
        ));
        $generatedHashA = $hasher->hashPassword('Hello World!');
        $generatedHashB = $hasher->hashPassword('Hello World!');
        $generatedHashC = $hasher->hashPassword('Hello Tom!');
        $testHashA = md5('Hello World!');
        $testHashB = md5('Hello World!');
        $testHashC = md5('Hello Tom!');
        $this->assertTrue($hasher->verify($testHashA, $testHashB));
        $this->assertTrue(!$hasher->verify($testHashB, $testHashC));
        $this->assertTrue($hasher->verifyPassword($generatedHashA, $generatedHashB));
        $this->assertTrue(!$hasher->verifyPassword($generatedHashB, $generatedHashC));
        $this->assertEquals($hasher->getPasswordHashInfo($generatedHashA), array(
            'algo' => PASSWORD_BCRYPT,
            'algoName' => 'bcrypt',
            'options' => array(
                'cost' => 11
            )
        ));
    }
}
