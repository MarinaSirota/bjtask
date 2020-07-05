<?php
require_once 'app/core/view.php';
require_once 'app/core/BaseActiveRecord.php';

/**
 * Class Controller
 */
class Controller
{
    /**
     * @var
     */
    public $model;
    /**
     * @var View
     */
    public $view;

    function __construct()
    {
        $this->view = new View();
        BaseActiveRecord::$pdo = $this->dbConnect();
    }

    /**
     * @return PDO
     */
    function dbConnect()
    {
        $dsn = 'mysql:dbname=task_db;host=127.0.0.1';
        $username = 'root';
        $password  = 'root';
        try {
            $pdo = new PDO(
                $dsn, $username, $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            return $pdo;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}