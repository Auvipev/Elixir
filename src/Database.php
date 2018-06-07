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

use PDO;
use PDOException;

/**
 * The database class.
 *
 * @link <https://secure.php.net/manual/en/language.types.resource.php>.
 * @link <https://secure.php.net/manual/en/book.pdo.php>.
 * @link <https://secure.php.net/manual/en/pdo.connections.php>.
 *
 * @class      Database.
 * @extends    Engine.
 * @implements DatabaseInterface.
 * @implements InjectableObject.
 */
class Database extends Engine implements DatabaseInterface, InjectableObject
{

    /**
     * @var resource $connection The database connection.
     */
    private $connection = null;

    /**
     * @var array $config The configuration.
     */
    private $config;

    /**
     * Inject any configuration or objct classes for this class.
     *
     * @param array $config The configuration.
     *
     * @return void Returns nothing.
     *
     * @codeCoverageIgnore.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Open a new database connection.
     *
     * Connections are established by creating instances of the PDO base class. It doesn't matter which driver you want to use; you
     * always use the PDO class name. The constructor accepts parameters for specifying the database source (known as the DSN)
     * and optionally for the username and password (if any).
     *
     * @param array $options Alternative options to use.
     *
     * @return object Returns itself.
     */
    public function open(array $options = array()): object
    {
        if (empty($options)) {
            $this->connection = new PDO(
                $config['database']['dns'],
                isset($config['database']['username']) && $config['database']['username'] !== ''
                    ? $config['database']['username']
                    : null,
                isset($config['database']['password']) && $config['database']['password'] !== ''
                    ? $config['database']['password']
                    : null,
                isset($config['database']['options'])
                    ? $config['database']['options']
                    : array();
            );
        }
        $this->connection = new PDO(
            $options['dns'],
            isset($options['username']) && $options['username'] !== ''
                ? $options['username']
                : null,
            isset($options['password']) && $options['password'] !== ''
                ? $options['password']
                : null,
            isset($options['options'])
                ? $options['options']
                : array();
        );
        return $this;
    }
}
