<?php

/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 22/01/2016
 * Time: 00:38
 */

include_once 'adb.php';

/**
 * Class Wine
 *
 */
class Wine extends Adb
{

    /**
     * Function login
     *
     * Authenticates users to be able to access
     * the admin page in order to manipulate the
     * wine data
     *
     * @param $username
     * @param $password
     * @return bool|mysqli_result
     */
    public function login ($username, $password)
    {
        $loginQuery = "SELECT `users`.`user_name`, `users`.`password`
                       FROM `users`
                       WHERE `users`.`user_name` = '$username'
                       AND `users`.`password` = MD5('$password')
                       LIMIT 1";

        return $this->query($loginQuery);
    }

    /**
     * Function displayWine
     *
     * Display all the wines in the database
     * by displaying the wine type, cost of the wine,
     * wine name, the year of manufacture, the wine id
     * and winery name
     *
     * @return bool|mysqli_result
     */
    public function displayWine ()
    {
        $wineQuery = "SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`, `inventory`.`cost`, `wine`.`year`
                      FROM `wine`
                      JOIN `wine_type`
                      JOIN `winery`
                      JOIN `inventory`
                      ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
                      AND `wine`.`winery_id` = `winery`.`winery_id`
                      AND `wine`.`wine_id` = `inventory`.`wine_id`
                      ORDER BY `wine_id`
                      LIMIT 9";

        return $this->query($wineQuery);
    }

    /**
     * Function searchWine
     *
     * Search the wine by wine name from the wine database
     * and displays the name, type, cost, winery, year and
     * the id of the wine
     *
     * @param $searchWord
     * @return bool|mysqli_result
     */
    public function searchWine ($searchWord)
    {
        $searchWineQuery = "SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`, `inventory`.`cost`, `wine`.`year`
                            FROM `wine`
                            JOIN `wine_type`
                            JOIN `winery`
                            JOIN `inventory`
                            ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
                            AND `wine`.`winery_id` = `winery`.`winery_id`
                            AND `wine`.`wine_id` = `inventory`.`wine_id`
                            WHERE `wine`.`wine_name`
                            LIKE '$searchWord%'
                            LIMIT 9";

        return $this->query($searchWineQuery);
    }

    /**
     * Function wineType
     *
     * Load the types of wines from the
     * database. Also fetches the id of
     * the wine type
     *
     * @return bool|mysqli_result
     */
    public function wineType ()
    {
        $wineTypeQuery = "SELECT `wine_type`.`wine_type_id`, `wine_type`.`wine_type`
                          FROM `wine_type`";

        return $this->query($wineTypeQuery);
    }

    /**
     * Function displayWineByType
     *
     * Display all the wines in the database
     * by type. Shows the wine type, cost of the wine,
     * wine name, the year of manufacture, the wine id
     * and winery name
     *
     * @param $wineType
     * @return bool|mysqli_result
     */
    public function displayWineByType ($wineType)
    {
        $displayWineByTypeQuery = "SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`, `inventory`.`cost`, `wine`.`year`
                                   FROM `wine`
                                   JOIN `wine_type`
                                   JOIN `winery`
                                   JOIN `inventory`
                                   ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
                                   AND `wine`.`winery_id` = `winery`.`winery_id`
                                   AND `wine`.`wine_id` = `inventory`.`wine_id`
                                   WHERE `wine_type`.`wine_type` = '$wineType'
                                   ORDER BY `wine_id`
                                   LIMIT 9";

        return $this->query($displayWineByTypeQuery);
    }

    /**
     * Function sortWineDesc
     *
     * Sorting of the wines in descending order
     * in relation to the prices of the wine
     *
     * @return bool|mysqli_result
     */
    public function sortWinePriceDesc ()
    {
        $sortWineDescQuery = "SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`, `inventory`.`cost`, `wine`.`year`
                              FROM `wine`
                              JOIN `wine_type`
                              JOIN `winery`
                              JOIN `inventory`
                              ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
                              AND `wine`.`winery_id` = `winery`.`winery_id`
                              AND `wine`.`wine_id` = `inventory`.`wine_id`
                              ORDER BY `inventory`.`cost` DESC
                              LIMIT 9";

        return $this->query($sortWineDescQuery);
    }

    /**
     * Function sortWineAsc
     *
     * Sorting of the wines in ascending order
     * in relation to the prices of the wine
     *
     * @return bool|mysqli_result
     */
    public function sortWinePriceAsc ()
    {
        $sortWineAscQuery = "SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`, `inventory`.`cost`, `wine`.`year`
                              FROM `wine`
                              JOIN `wine_type`
                              JOIN `winery`
                              JOIN `inventory`
                              ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
                              AND `wine`.`winery_id` = `winery`.`winery_id`
                              AND `wine`.`wine_id` = `inventory`.`wine_id`
                              ORDER BY `inventory`.`cost` ASC
                              LIMIT 9";

        return $this->query($sortWineAscQuery);
    }

    /**
     * Function sortWineName
     *
     * Sorting of the wines by name
     *
     * @return bool|mysqli_result
     */
    public function sortWineName ()
    {
        $sortWineName = "SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`, `inventory`.`cost`, `wine`.`year`
                         FROM `wine`
                         JOIN `wine_type`
                         JOIN `winery`
                         JOIN `inventory`
                         ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
                         AND `wine`.`winery_id` = `winery`.`winery_id`
                         AND `wine`.`wine_id` = `inventory`.`wine_id`
                         ORDER BY `wine`.`wine_name`
                         LIMIT 9";

        return $this->query($sortWineName);
    }
}

//$Wine = new Wine();
//$word = "kin";
//$result = $Wine->searchWine($word);
//
//$row = $result->fetch_assoc();
////echo 'Success...' . $Wine->host_info . "\n";
//print_r ($row);