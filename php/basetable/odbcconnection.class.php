<?php

class ODBCConnection {

    static protected $connections = array();

    public static function getConnection($dsn) {
        // Normalize the dsn
        $dsn = trim(strtolower($dsn));
        // Do I already have this one?
        if (!key_exists($dsn, self::$connections)) {
            // create it
            self::$connections[$dsn] = new PDO("odbc:$dsn");
            self::$connections[$dsn]->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            self::$connections[$dsn]->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$connections[$dsn]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connections[$dsn];
    }

    public static function closeConnection($dsn) {
        self::$connections[$dsn] = null;
    }

    public function __construct() {
        throw new Exception("YOU MAY NOT INSTANTIATE THIS OBJECT!! USE IT STATICALLY!");
    }
}
