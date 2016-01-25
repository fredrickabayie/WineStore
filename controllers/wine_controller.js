/**
 * Created by fredrickabayie on 22/01/2016.
 */

/*global $, document, console, alert, window*/

//function to send an ajax request
function sendRequest(u) {
    'use strict';
    var obj, result;
    obj = $.ajax({url: u, async: false});
    result = $.parseJSON(obj.responseText);
    return result;
}//end of sendRequest(u)


//Function to display the wines
$(document).ready(function () {
    "use strict";
    var obj, index, div = "", url = "../controllers/wine_controller.php?cmd=1";

    obj = sendRequest(url);
    if (obj.result === 1) {

        for (index in obj.wines) {
            div += '<div class="col-md-4 col-sm-4 col-xs-12 anima scale-in ">';
            div += '<article class="text-center">';
            div +=  '<img src="../img/wine1.png" style="height: 200px; width: 200px" alt="#" class="zoom-img img-responsive center-block">';
            div +=  '<h3>​' + obj.wines[index].wine_name + '</h3>';
            div += '<p>WINERY: ' + obj.wines[index].winery_name + '</p>';
            div += '<p>TYPE: ' + obj.wines[index].wine_type + '</p>';
            div += '<p>YEAR: ' + obj.wines[index].year + '</p>';
            div += '<a class="btn" href="#" data-toggle="modal" data-target="#product-modal"><b>$' + obj.wines[index].cost + '</b> Buy now</a>';
            div += '</article></div>';
        }
        $("#displayWines").html(div);
    }
});

//Function that handles searching of wine
$(function () {
    'use strict';
    $("#searchField").keyup(function () {
        document.getElementById("displayWines").innerHTML = "";
        var obj, div = "", index, url = "../controllers/wine_controller.php?cmd=2&searchWord=" + $("#searchField").val();

        obj = sendRequest(url);

        if (obj.result === 1) {
            for (index in obj.wines) {
                div += '<div class="col-md-4 col-sm-4 col-xs-12 anima scale-in ">';
                div += '<article class="text-center">';
                div +=  '<img src="img/demo1.jpg" alt="#" class="zoom-img img-responsive center-block">';
                div +=  '<h3>​' + obj.wines[index].wine_name + '</h3>';
                div += '<p>WINERY: ' + obj.wines[index].winery_name + '</p>';
                div += '<p>TYPE: ' + obj.wines[index].wine_type + '</p>';
                div += '<p>YEAR: ' + obj.wines[index].year + '</p>';
                div += '<a class="btn" href="#" data-toggle="modal" data-target="#product-modal"><b>$' + obj.wines[index].cost + '</b> Buy now</a>';
                div += '</article></div>';
            }
            $("#displayWines").html(div);
        }
    });
});

//Function that populates the wine type button dropdown
$(document).ready(function () {
    'use strict';
    var obj, url = "../controllers/wine_controller.php?cmd=3", index = "", li = "";
    obj = sendRequest(url);
    if (obj.result === 1) {
        for (index in obj.wineType ) {
            li += '<li><a>' + obj.wineType[index].wine_type + '</a></li>';
        }
        $("#wineTypes").html(li);
    }
});


//Function to display the wines
$(function () {
    "use strict";
    $("#wineTypes li > a").click(function () {

        var obj, index, div = "", url = "../controllers/wine_controller.php?cmd=4&wineType=" + this.innerHTML;

        obj = sendRequest(url);
        if (obj.result === 1) {

            for (index in obj.wines) {
                div += '<div class="col-md-4 col-sm-4 col-xs-12 anima scale-in ">';
                div += '<article class="text-center">';
                div +=  '<img src="img/demo1.jpg" alt="#" class="zoom-img img-responsive center-block">';
                div +=  '<h3>​' + obj.wines[index].wine_name + '</h3>';
                div += '<p>WINERY: ' + obj.wines[index].winery_name + '</p>';
                div += '<p>TYPE: ' + obj.wines[index].wine_type + '</p>';
                div += '<p>YEAR: ' + obj.wines[index].year + '</p>';
                div += '<a class="btn" href="#" data-toggle="modal" data-target="#product-modal"><b>$' + obj.wines[index].cost + '</b> Buy now</a>';
                div += '</article></div>';
            }
            $("#displayWines").html(div);
        }
    });
});


//Function to display the wines
$(function () {
    "use strict";
    $("#sortWines li > a").click(function () {

        var obj, index, div = "", url = "../controllers/wine_controller.php?cmd=" + this.id;

        obj = sendRequest(url);
        if (obj.result === 1) {

            for (index in obj.sortWines) {
                div += '<div class="col-md-4 col-sm-4 col-xs-12 anima scale-in ">';
                div += '<article class="text-center">';
                div +=  '<img src="img/demo1.jpg" alt="#" class="zoom-img img-responsive center-block">';
                div +=  '<h3>​' + obj.sortWines[index].wine_name + '</h3>';
                div += '<p>WINERY: ' + obj.sortWines[index].winery_name + '</p>';
                div += '<p>TYPE: ' + obj.sortWines[index].wine_type + '</p>';
                div += '<p>YEAR: ' + obj.sortWines[index].year + '</p>';
                div += '<a class="btn" href="#" data-toggle="modal" data-target="#product-modal"><b>$' + obj.sortWines[index].cost + '</b> Buy now</a>';
                div += '</article></div>';
            }
            $("#displayWines").html(div);
        }
    });
});


//Function to hanlde the login of a user
$(function () {
    "use strict";
    $("#loginBtn").click(function () {
        var url = "../controllers/wine_controller.php?cmd=8&username=" + $("#username").val() +
            "&password=" + $("#password").val(), obj;

        obj = sendRequest(url);
        if (obj.result === 1) {
            window.location.replace("dashboard.php");
        }
    });
});


