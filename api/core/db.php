<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db
 *
 * @author hll
 */
class Db {

    //put your code here
    static $db_stmt;

    public static function init() {
        if (self::$db_stmt) {
            return self::$db_stmt;
        }
        try {
            $pdo_instance = new PDO(Config::getPdoMysqlDsn(), Config::getPdoMysqlUser(), Config::getPdoMysqlPassword());
            Log::info("pdo connect");
        } catch (PDOException $e) {
            Log::error("Pdo Error! " . $e->getMessage());
            throw new Exception("Pdo Error! " . $e->getMessage());
        }
        self::$db_stmt = new Dbstmt();
        self::$db_stmt->pdo_instance = $pdo_instance;
        return self::$db_stmt;
    }

    public static function table($table_name) {
        self::init();
        self::$db_stmt->table_name = $table_name;
        self::$db_stmt->bind_fields = [];
        self::$db_stmt->bind_where = "";
        return self::$db_stmt;
    }

}
