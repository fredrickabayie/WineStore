<?php
/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 24/01/2016
 * Time: 22:51
 */


if ( isset ( $_REQUEST [ 'cmd' ] ) )
{
    $cmd = $_REQUEST[ 'cmd' ];

    switch ( $cmd )
    {
        case 1:
            displayWines();
            break;

        case 2:
            displayWineTypes();
            break;

        case 3:
            displayWinery();
            break;

        case 4:
            insertWine();
            break;

        default:
            echo '{"result":0,status:"unknown command"}';
            break;
    }//end of switch

}//end of if



/**
 * Function to display all wines
 */
function displayWines ( )
{
    include_once '../models/admin.php';
    $wine = new Admin ( );

    if ( $result = $wine->displayWine() )
    {
        $row = $result->fetch_assoc();
        echo '{"result":1, "wines": [';
        while ( $row )
        {
            echo '{"wine_id": "'.$row ["wine_id"].'", "wine_name": "'.$row ["wine_name"].'",
            "winery_name": "'.$row ["winery_name"].'",
            "wine_type": "'.$row["wine_type"].'", "year": "'.$row["year"].'"}';

            if ($row = $result->fetch_assoc() )   {
                echo ',';
            }
        }
        echo ']}';
    }   else
    {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}//end of display_all_tasks()


/**
 * Function to display wine types
 */
function displayWineTypes ( )
{
    include_once '../models/admin.php';
    $wine = new Admin ( );

    if ( $result = $wine->wineType() )
    {
        $row = $result->fetch_assoc();
        echo '{"result":1, "wineType": [';
        while ( $row )
        {
            echo '{"wine_type_id": "'.$row ["wine_type_id"].'", "wine_type": "'.$row ["wine_type"].'"}';

            if ($row = $result->fetch_assoc() ) {
                echo ',';
            }
        }
        echo ']}';
    }   else
    {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}


/**
 * Function to display winery
 */
function displayWinery ( )
{
    include_once '../models/admin.php';
    $wine = new Admin ( );

    if ( $result = $wine->winery() )
    {
        $row = $result->fetch_assoc();
        echo '{"result":1, "winery": [';
        while ( $row )
        {
            echo '{"winery_id": "'.$row ["winery_id"].'", "winery_name": "'.$row ["winery_name"].'"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    }   else
    {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}


/**
* Function to add a new wine
*/
function insertWine ( )
{
    if ( isset ( $_REQUEST [ 'addWineName' ] ) && isset ( $_REQUEST [ 'addWineType' ] )
        && isset ( $_REQUEST [ 'addYear' ] ) && isset ( $_REQUEST ['addWinery'] )
        && isset ( $_REQUEST ['addDescription'] ) && isset ( $_REQUEST ['addImage'] ) )
    {
        include '../models/admin.php';

        $addWineName = $_REQUEST [ 'addWineName' ];
        $addWineType = $_REQUEST [ 'addWineType' ];
        $addYear = $_REQUEST [ 'addYear' ];
        $addWinery = $_REQUEST ['addWinery'];
        $addDescription = $_REQUEST ['addDescription'];
        $addImage = $_REQUEST ['addImage'];

        $addWineId = "1049";

        $wine = new Admin ();

        if ($wine->insertWine($addWineId, $addWineName, $addWineType, $addYear, $addWinery, $addDescription, $addImage))
        {
            echo ' { "result":1, "status": "Successfully added a new Wine to the database" } ';
        }
        else
        {
            echo ' { "result":0, "status": "Failed to add a new Wine to the database" }';
        }
    }
}//end of add_task ( )