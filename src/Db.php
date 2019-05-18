<?php
include_once 'config.php';

/**
 * Class Db
 */
class Db
{
    private static $instance = null;
    private        $pdo      = null;

    /**
     * @return PDO|null
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance->getPDO();
    }

    /**
     * Db constructor.
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * @return PDO|null
     */
    private function getPDO()
    {
        return $this->pdo;
    }

    /**
     * Db _clone
     */
    private function __clone() { }

    /**
     * Db _wakeup
     */
    private function __wakeup() { }
}
