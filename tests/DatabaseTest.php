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
use PHPUnit\DbUnit\TestCaseTrait;

/**
 * The database test class.
 *
 * @class DatabaseTest.
 */
class DatabaseTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @return PHPUnit\DbUnit\Database\Connection
     */
    public function getConnection()
    {
        $link = new Database([
            'database' => [
                'dns'      => 'mysql:host=localhost;dbname=testdb',
                'username' => 'root',
                'password' => ''
            ]
        ]);
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    public function getDataSet()
    {
        return $this->createFlatXmlDataSet('bin/dataset.xml');
    }
}
