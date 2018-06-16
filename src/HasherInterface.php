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

/**
 * The hasher interface.
 *
 * @link <https://secure.php.net/manual/en/function.hash-equals.php>.
 * @link <https://secure.php.net/manual/en/ref.password.php>.
 *
 * @interface HasherInterface.
 */
interface HasherInterface
{

    /**
     * Verify that the two hashes match.
     *
     * Timing attack safe string comparison.
     *
     * @param string $hashA The first hash.
     * @param string $hashB The second hash.
     *
     * @return bool Returns TRUE when the two strings are equal, FALSE otherwise.
     */
    public function verifyHash(string $hashA, string $hashB): bool;

    /**
     * Creates a password hash.
     *
     * Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to
     * change over time as new and stronger algorithms are added to PHP. For that reason, the length
     * of the result from using this identifier can change over time.
     *
     * Use the CRYPT_BLOWFISH algorithm to create the hash. This will produce a standard crypt() compatible
     * hash using the "$2y$" identifier. The result will always be a 60 character string, or FALSE on failure.
     *
     * Use the Argon2 hashing algorithm to create the hash.
     *
     * Using the PASSWORD_BCRYPT as the algorithm, will result in the password parameter being truncated to
     * a maximum length of 72 characters.
     *
     * @param string $password The user's password.
     * @param array  $options  Alternative options to use.
     *
     * @return mixed Returns the hashed password, or FALSE on failure.
     */
    public function hashPassword(string $password, array $options = array());

    /**
     * Verifies that a password matches a hash.
     *
     * Note that password_hash() returns the algorithm, cost and salt as part of the returned hash. Therefore, all
     * information that's needed to verify the hash is included in it. This allows the verify function to verify the
     * hash without needing separate storage for the salt or algorithm information.
     *
     * This function is safe against timing attacks.
     *
     * @param string $password The user's password.
     * @param string $hash     A hash created by $this->hashPassword().
     *
     * @return bool Returns TRUE if the password and hash match, or FALSE otherwise.
     */
    public function verifyPassword(string $password, string $hash): bool;

    /**
     * Checks if the given hash matches the given options.
     *
     * This function checks to see if the supplied hash implements the algorithm and options provided. If not,
     * it is assumed that the hash needs to be rehashed.
     *
     * @param string $hash    A hash created by $this->hashPassword().
     * @param array  $options Alternative options to use.
     *
     * @return bool Returns TRUE if the hash should be rehashed to match the given algo and options, or FALSE otherwise.
     */
    public function doesNeedRehash(string $hash, array $options = array()): bool;

    /**
     * Returns information about the given hash.
     *
     * When passed in a valid hash created by an algorithm supported by password_hash(), this function will return an array of information
     * about that hash.
     *
     * @param string $hash A hash created by $this->hashPassword().
     *
     * @return array Returns an associative array with three elements:
     *               - algo, which will match a password algorithm constant.
     *               - algoName, which has the human readable name of the algorithm.
     *               - options, which includes the options provided when calling $this->hashPassword().
     */
    public function getPasswordHashInfo(string $hash): array;
}
