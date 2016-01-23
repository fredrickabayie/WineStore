<?php

/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 17/12/2015
 * Time: 17:13
 */

include_once 'config.php';

/**
 * Class Adb
 *
 * This is a class to model the mysqli instances,
 * thus to handle connections, querying, fetching
 * and closing of the connection to the database
 * server. It also extends 'mysqli' to be able to
 * access it methods and objects
 *
 */
class Adb extends mysqli
{

    /**
     * Adb constructor.
     *
     * Function to establish a connection each time
     * the adb class is instantiated. The constructor
     * takes in the host, username, password, the name
     * of the database and the port as its parameters
     *
     * @param string $host
     * @param string $username
     * @param string $passwd
     * @param string $dbname
     * @param int $port
     */
    public function __construct()
    {
        parent::__construct(DB_HOST, DB_USER, DB_PWORD, DB_NAME, DB_PORT);

        if (mysqli_connect_error())
        {
            die('Connection Error (' . mysqli_connect_errno() . ') ' .mysqli_connect_error() );
        }
    }

}

//$sql = <<<SQL
//SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`
//FROM `wine`
//JOIN `wine_type`
//JOIN `winery`
//ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
//AND `wine`.`winery_id` = `winery`.`winery_id`
//ORDER BY `wine_id`
//SQL;
//
//$adb = new Adb();
////$result = $adb->query($sql);
////$row = $result->fetch_assoc();
//echo 'Success...' . $adb->host_info . "\n";
////print_r ($row);
//
////print_r($row);
//
//$adb->close();