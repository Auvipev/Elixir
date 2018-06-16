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

use PHPUnit\Framework\TestCase;

use function md5;

/**
 * The hasher test class.
 *
 * @class HasherTest.
 */
class HasherTest extends TestCase
{

    public function testHashVerify()
    {
        $hasher = new Hasher();
        $testHashA = md5('Hello World!');
        $testHashB = md5('Hello World!');
        $testHashC = md5('Hello Tom!');
        $this->assertTrue($hasher->verify($testHashA, $testHashB));
        $this->assertTrue(!$hasher->verify($testHashB, $testHashC));
    }
}
