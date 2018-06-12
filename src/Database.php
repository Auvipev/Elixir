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
use PDOStatement;
use PDOException;

use function die;

/**
 * The database class.
 *
 * @link <https://secure.php.net/manual/en/language.types.resource.php>.
 * @link <https://secure.php.net/manual/en/book.pdo.php>.
 * @link <https://secure.php.net/manual/en/pdo.connections.php>.
 * @link <https://secure.php.net/manual/en/pdo.prepared-statements.php>.
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
     * @catches PDOException Prevents a backtrace from being displayed.
     *
     * @return object Returns itself.
     */
    public function open(array $options = array()): object
    {
        if (empty($options)) {
            try {
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
                        : array()
                );
            } catch (PDOException $e) {
                print "VIPERError: " . $e->getMessage() . "<br/>";
                die();
            }
            return $this;
        }
        try {
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
                    : array()
            );
        } catch (PDOException $e) {
            print "VIPERError: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this;
    }

    /**
     * Process a new statement.
     *
     * Many of the more mature databases support the concept of prepared statements. What are they? They can be thought of as a kind of compiled
     * template for the SQL that an application wants to run, that can be customized using variable parameters. Prepared statements offer
     * two major benefits:
     *
     * - The query only needs to be parsed (or prepared) once, but can be executed multiple times with the same or different parameters. When the query
     *   is prepared, the database will analyze, compile and optimize its plan for executing the query. For complex queries this process can take up 
     *   enough time that it will noticeably slow down an application if there is a need to repeat the same query many times with different parameters.
     *   By using a prepared statement the application avoids repeating the analyze/compile/optimize cycle. This means that prepared statements use
     *   fewer resources and thus run faster.
     *
     * - The parameters to prepared statements don't need to be quoted; the driver automatically handles this. If an application exclusively uses
     *   prepared statements, the developer can be sure that no SQL injection will occur (however, if other portions of the query are being built up
     *   with unescaped input, SQL injection is still possible).
     *
     * @param string $sql      The sql statement to prepare.
     * @param array  $bindings Any bindings to bind to the sql statement.
     * @param array  $optins   Any additional options to use based on the statement passed.
     *
     * @return mixed Returns TRUE if the statement was processed and FALSE if it was not or it will return fetch data if your are selecting
     *               any data.
     */
    public function processStatement(string $sql, array $bindings = array(), array $options = array())
    {
        $stmt = $this->connection->prepare($sql);
        foreach ($bindings as $key => $value) {
            $stmt->bindParam($key, $value);
        }
        if ($stmt->execute()) {
            if ($options['alias'] === 'select') {
                return $stmt->fetchAll($options['fetch_mode'])
            }
            return true;
        }
        return false;
    }

    /**
     * Start a new transaction.
     *
     * Transactions are typically implemented by "saving-up" your batch of changes to be applied all at once; this has the nice side effect of drastically improving
     * the efficiency of those updates. In other words, transactions can make your scripts faster and potentially more robust (you still need to use them correctly
     * to reap that benefit).
     *
     * @return void Returns nothing.
     *
     * @codeCoverageIgnore.
     */
    public function startTransaction(): void
    {
        $this->connection->beginTransaction();
    }

    /**
     * Runs a transaction statement.
     *
     * @param string $statement The transaction statement.
     *
     * @return void Returns nothing.
     *
     * @codeCoverageIgnore.
     */
    public function script(string $statement): void
    {
        $this->connection->exec($statement);
    }

    /**
     * Commits a transaction.
     *
     * @return void Returns nothing.
     *
     * @codeCoverageIgnore.
     */
    public function commit(): void
    {
        $this->connection->commit();
    }

    /**
     * Rollback a transaction.
     *
     * @return void Returns nothing.
     *
     * @codeCoverageIgnore.
     */
    public function rollBack(): void
    {
        $this->connection->rollBack();
    }

    /**
     * Is the statement a PDO statement?
     *
     * @return Returns TRUE if the statement is a PDO statement and FALSE if it is not.
     *
     * @param mixed $statement The passed statement.
     *
     * @codeCoverageIgnore.
     */
    public function isPDOStatement($statement): bool
    {
        return $statement instanceof PDOStatement; 
    }
}
