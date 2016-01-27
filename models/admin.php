<?php

/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 24/01/2016
 * Time: 23:15
 */

include_once 'adb.php';

/**
 * Class admin
 */
class Admin extends Adb
{
    public function __destruct()
    {
        parent::__destruct();
    }

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
    public function login($username, $password)
    {
        $loginQuery = "SELECT `users`.`user_name`, `users`.`password`
                       FROM `users`
                       WHERE `users`.`user_name` = ?
                       AND `users`.`password` = MD5(?)
                       LIMIT 1";

        if ($statement = $this->prepare($loginQuery)) {
            $statement->bind_param("ss", $username, $password);
            $statement->execute();
            return $statement->get_result();
        }
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
    public function displayWine()
    {
        $wineQuery = "SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`, `wine`.`year`
                      FROM `wine`
                      JOIN `wine_type`
                      JOIN `winery`
                      ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
                      AND `wine`.`winery_id` = `winery`.`winery_id`
                      ORDER BY `wine`.`wine_id` DESC
                      LIMIT 20";

        return $this->query($wineQuery);
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
    public function wineType()
    {
        $wineTypeQuery = "SELECT `wine_type`.`wine_type_id`, `wine_type`.`wine_type`
                          FROM `wine_type`";

        return $this->query($wineTypeQuery);
    }

    /**
     * Function Winery
     *
     * Load the winert from the database.
     * Also fetches the region id and
     * winery id
     *
     * @return bool|mysqli_result
     */
    public function winery()
    {
        $wineryQuery = "SELECT `winery`.`region_id`, `winery`.`winery_id`, `winery`.`winery_name`
                        FROM `winery`";

        return $this->query($wineryQuery);
    }

    /**
     * Function InsertWine
     *
     * Adding new wine to the database.
     * The id, name, type, year, image, winery id,
     * and description of the wine is added.
     *
     * @param $wine_id
     * @param $wine_name
     * @param $wine_type
     * @param $year
     * @param $winery_id
     * @param $description
     * @param $image
     * @return bool|mysqli_result
     */
    public function insertWine($wine_id, $wine_name, $wine_type, $year, $winery_id, $description, $image)
    {
        $insertWineQuery = "INSERT
                            INTO `wine`(`wine_id`, `wine_name`, `wine_type`, `year`, `winery_id`, `description`, `image`)
                            VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($statement = $this->prepare($insertWineQuery)) {
            $statement->bind_param("sssssss", $wine_id, $wine_name, $wine_type, $year, $winery_id, $description, $image);
            return $statement->execute();
        }
    }

    /**
     * Function UpdateWine
     *
     * Updating a wine in the database by editing
     * the name, type, year, winery id, description
     * and image of the wine by its id
     *
     * @param $wine_id
     * @param $wine_name
     * @param $wine_type
     * @param $year
     * @param $winery_id
     * @param $description
     * @param $image
     * @return bool
     */
    public function updateWine($wine_id, $wine_name, $wine_type, $year, $winery_id, $description, $image)
    {
        $updateWineQuery = "UPDATE `wine`
                            SET `wine_name`=?,`wine_type`=?,`year`=?,`winery_id`=?,`description`=?,`image`=?
                            WHERE `wine_id`= ?";

        if ($statement = $this->prepare($updateWineQuery)) {
            $statement->bind_param("sssssss", $wine_name, $wine_type, $year, $winery_id, $description, $image, $wine_id);
            return $statement->execute();
        }
    }

    /**
     * Function SelectWine
     *
     * Selecting a single wine from the database
     *
     * @param $wine_id
     * @return bool|mysqli_result
     */
    public function selectWine($wine_id)
    {
        $selectWineQuery = "SELECT `wine`.`wine_id`, `wine_type`.`wine_type`, `wine`.`wine_name`, `winery`.`winery_name`, `wine`.`year`
                            FROM `wine`
                            JOIN `wine_type`
                            JOIN `winery`
                            ON `wine`.`wine_type` = `wine_type`.`wine_type_id`
                            AND `wine`.`winery_id` = `winery`.`winery_id`
                            WHERE `wine`.`wine_id` = ?
                            LIMIT 1";

        if ($statement = $this->prepare($selectWineQuery)) {
            $statement->bind_param("s", $wine_id);
            $statement->execute();
            return $statement->get_result();
        }
    }


}
















