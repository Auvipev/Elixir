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

namespace Auvipev\Viper;

use function trim;
use function session_start;
use function session_status;

use const PHP_SESSION_ACTIVE;

/**
 * The session class.
 *
 * @link <https://secure.php.net/manual/en/session.security.php>.
 * @link <https://secure.php.net/manual/en/ref.session.php>.
 * @link <>.
 *
 * @class      Session. 
 * @implements SessionInterface.
 * @implements InjectableObject.
 */
class Session implements SessionInterface, InjectableObject
{

    /**
     * @var bool $encrypt Should we encrypt the sessions.
     */
    private static $encrypt;

    /**
     * Does a session already exist.
     *
     * @return bool Returns TRUE if a session exists and FALSE if does not.
     */
    public function exists(): bool
    {
        if (session_status() != PHP_SESSION_ACTIVE)
    }

    /**
     * Start a new secure session.
     *
     * @param string $name    The name of the session.
     * @param mixed  $handler The session handler to use.
     * @param bool   $encrypt Should we encrypt the sessions.
     * @param array  $options An array of options.
     *
     * @throws Exception\SessionStartException If a session is already running
     *
     * @return bool Returns TRUE if the session successfully started and FALSE if it was not.
     */
    public function start(string $name, $handler, bool $encrypt = true, array $options = array()): bool
    {
        if (self::exists) {
            return true;
        }
        session_start();
        self::$encrypt = $encrypt;
    }
}
