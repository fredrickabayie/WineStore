<?php

if ( isset ( $_REQUEST [ 'cmd' ] ) )
{
    $cmd = $_REQUEST[ 'cmd' ];
    
    switch ( $cmd )
    {
        case 1:
            displayWines();
            break;

        case 2:
            searchWine();
            break;

        case 3:
            displayWineTypes();
            break;

        case 4:
            displayWineByType();
            break;

        case 5:
            sortWineName();
            break;

        case 6:
            sortWineDesc();
            break;

        case 7:
            sortWineAsc();
            break;

        case 8:
            login();
            break;

        default:
            echo '{"result":0,status:"unknown command"}';
            break;
    }//end of switch
    
}//end of if


/**
 * Function to display all tasks
 */
function displayWines ( )
{
    include_once '../models/wine.php';
    $wine = new Wine ( );

    if ( $result = $wine->displayWine() )
    {
        $row = $result->fetch_assoc();
        echo '{"result":1, "wines": [';
        while ( $row )
        {
            echo '{"wine_id": "'.$row ["wine_id"].'", "wine_name": "'.$row ["wine_name"].'",
            "winery_name": "'.$row ["winery_name"].'", "cost": "'.$row ["cost"].'",
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
 * Function to search for a task
 */
function searchWine ( )
{
    if ( isset ( $_REQUEST [ 'searchWord' ] ) )
    {
        include_once '../models/wine.php';
        $wine = new Wine ( );

        $searchWord = $_REQUEST [ 'searchWord' ];

        if ( $result = $wine->searchWine ( $searchWord ) )
        {
            $row = $result->fetch_assoc ( );
            echo '{"result":1, "wines": [';
            while ( $row )
            {
                echo '{"wine_id": "'.$row ["wine_id"].'", "wine_name": "'.$row ["wine_name"].'",
            "winery_name": "'.$row ["winery_name"].'", "cost": "'.$row ["cost"].'",
            "wine_type": "'.$row["wine_type"].'", "year": "'.$row["year"].'"}';

                if ( $row = $result->fetch_assoc() ) {
                    echo ',';
                }
            }
            echo ']}';
        }   else
        {
            echo '{"result":0,"status": "An error occurred for select product."}';
        }
    }
}//end of search_task()


/**
 * Function to display all tasks
 */
function displayWineTypes ( )
{
    include_once '../models/wine.php';
    $wine = new Wine ( );

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
 * Function to display all tasks
 */
function displayWineByType ( )
{
    if ( isset ( $_REQUEST [ 'wineType' ] ) ) {
        include_once '../models/wine.php';
        $wine = new Wine ();

        $wineType = $_REQUEST [ 'wineType' ];

        if ($result = $wine->displayWineByType($wineType)) {
            $row = $result->fetch_assoc();
            echo '{"result":1, "wines": [';
            while ($row) {
                echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

                if ($row = $result->fetch_assoc()) {
                    echo ',';
                }
            }
            echo ']}';
        } else {
            echo '{"result":0,"status": "An error occurred for display wines."}';
        }
    }
}//end of display_all_tasks()


/**
 * Function to display all sorted wines by cost in
 * descending order
 */
function sortWineDesc ( )
{
        include_once '../models/wine.php';
        $wine = new Wine ();

        if ($result = $wine->sortWinePriceDesc()) {
            $row = $result->fetch_assoc();
            echo '{"result":1, "sortWines": [';

            while ($row) {
                echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

                if ($row = $result->fetch_assoc()) {
                    echo ',';
                }
            }
            echo ']}';
        } else {
            echo '{"result":0,"status": "An error occurred for display wines."}';
        }
}


/**
 * Function to display all sorted wines by cost in
 * ascending order
 */
function sortWineAsc ( )
{
    include_once '../models/wine.php';
    $wine = new Wine ();

    if ($result = $wine->sortWinePriceAsc()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "sortWines": [';

        while ($row) {
            echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}


/**
 * Function to display all sorted wines by name
 */
function sortWineName ( )
{
    include_once '../models/wine.php';
    $wine = new Wine ();

    if ($result = $wine->sortWineName()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "sortWines": [';

        while ($row) {
            echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}

function login ()
{
    if ( isset ( $_REQUEST['username'] ) & isset ( $_REQUEST['password'] ) )
    {
        include_once '../models/wine.php';
        $obj = new Wine ( );
        $username = $_REQUEST ['username'];
        $password = $_REQUEST ['password'];

        $result = $obj->login($username, $password);
        $row = $result->fetch_assoc();

        if ( !$row )
        {
            echo '{"result":0, "message":"Failed to login"}';
        }
        else
        {
//            echo json_encode ( $row );
//            session_start ( );
//            $user_type = $row['user_type'];
//            if ( $user_type == 'admin' )
//            {
                echo '{"result":1, "user_name":"'.$row['user_name'].'"}';
//                $_SESSION ['user_type'] = $user_type;
//                $_SESSION ['user_id'] = $row['user_id'];
//                header("Location: home.php");
//                exit ( );
//            }
        }
    }

}



function sendMail ( )
{
    $admin = "chok.real@gmail.com";
    $mail = "fredrick.abayie@ashesi.edu.gh";
    $subject = "Mail sending first test";
    $comment = "good or bad";
    
    if ( mail($admin, $subject,  $comment, 'From'.$mail) )
    {
      echo '{"success"}';
    }
}