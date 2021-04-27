<?php

declare(strict_types=1);

namespace App;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

final class DB
{
    const DB_HOST = '127.0.0.1'; // localhost
    const DB_USER = 'root';
    const DB_PASSWORD = 'root';
    const DB_NAME = 'davinci';
    const CHARSET = 'utf8';

    /**
     * @var PDO
     */
    private PDO $db;

    /**
     * @var null
     */
    private $instance = null;

    /**
     * DB constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if ($this->getInstance() === null){
            try {
                $this->setDb(new PDO(
                    'mysql:host='.self::DB_HOST.';dbname=' . self::DB_NAME,
                    self::DB_USER,
                    self::DB_PASSWORD,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . self::CHARSET
                    ]
                ));
            } catch (PDOException $e) {
                throw new Exception ($e->getMessage());
            }
        }
        return $this->getInstance();
    }

    /**
     * @param $query
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getRows($query, $params = []): array
    {
        return $this->run($query, $params)->fetchAll();
    }

    /**
     * @param $stmt
     * @return PDOStatement
     */
    private function query($stmt): PDOStatement
    {
        return $this->getDb()->query($stmt);
    }

    /**
     * @param $stmt
     * @return false|PDOStatement
     */
    private function prepare($stmt)
    {
        return $this->getDb()->prepare($stmt);
    }

    /**
     * @param $query
     * @param array $params
     * @return PDOStatement
     * @throws Exception
     */
    private function run($query, $params = []): PDOStatement
    {
        try{
            if (!$params) {
                return $this->query($query);
            }
            $stmt = $this->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param PDO $db
     */
    private function setDb(PDO $db): void
    {
        $this->db = $db;
    }

    /**
     * @return null
     */
    private function getInstance()
    {
        return $this->instance;
    }

    /**
     * @return PDO
     */
    private function getDb(): PDO
    {
        return $this->db;
    }

    /**
     * @param null $instance
     */
    private function setInstance($instance): void
    {
        $this->instance = $instance;
    }
}
