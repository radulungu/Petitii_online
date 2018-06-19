<?php

class OracleConnection
{

    private  const USERNAME = 'PETITII';
    private  const PASSWORD = 'PETITII';
    private  const CONNECTION_STRING = 'localhost/xe';
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection) {
            self::$connection = oci_connect(self::USERNAME, self::PASSWORD, self::CONNECTION_STRING);
            if (!self::$connection)
            {
                echo "Connection error!";
                return null;
            }
        }

        return self::$connection;
    }

    public static function closeConnection()
    {

        oci_close(self::$connection);
    }
}

?>
