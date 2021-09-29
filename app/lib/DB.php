<?php

namespace app\lib;

use PDO;
use PDOException;

class DB
{
    protected $db;

    public function __construct()
    {
        $config = require_once('app/config/db.php');
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'], $config['login'], $config['password']);
    }

    public function query($sql, $params = [])
    {
        try {
            $statement = $this->db->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    if (is_int($value)) {
                        $type = PDO::PARAM_INT;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    $statement->bindValue(':'.$key, $value, $type);
                }
            }
            $statement->execute();
            return [
                'status' => true,
                'statement' => $statement
            ];
        } catch (PDOException $exception) {
            return [
                'status' => false,
                'message' => $exception->getMessage()
            ];
        }
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        if ($result['status']) {
            return $result['statement']->fetchAll(PDO::FETCH_ASSOC);
        } else {
            debug($result);
            return false;
        }
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        if ($result['status']) {
            return $result['statement']->fetchColumn();
        } else {
            debug($result);
            return false;
        }
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
