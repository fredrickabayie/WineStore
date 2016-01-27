/**
 * Created by fredrickabayie on 24/01/2016.
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
    var obj, index, div = "", url = "../controllers/admin_controller.php?cmd=1";

    obj = sendRequest(url);
    if (obj.result === 1) {

        for (index in obj.wines) {
            div += "<tr>";
            div += "<td>" + obj.wines[index].wine_name + "</td><td>" + obj.wines[index].wine_type + "</td><td>" + obj.wines[index].year + "</td>";
            div += "<td class='action'>";
            div += "<a class='btn btn-success' data-toggle='tooltip' href='#' title='View'>";
            div += "<i class='icon-zoom-in'></i>";
            div += "</a>";
            div += "<a class='btn btn-info' data-toggle='tooltip' href='#' title='Edit'>";
            div += "<i class='icon-edit'></i>";
            div += "</a>";
            div += "<a class='btn btn-danger' data-toggle='tooltip' href='#' title='Delete'>";
            div += "<i class='icon-trash'></i></a></td></tr>";
        }
        $("#viewWines").html(div);
    }
});


//Function that populates the wine type button dropdown
$(document).ready(function () {
    'use strict';
    var obj, url = "../controllers/admin_controller.php?cmd=2", index = "", option = "";
    obj = sendRequest(url);
    if (obj.result === 1) {
        for (index in obj.wineType ) {
            option += "<option value=" + obj.wineType[index].wine_type_id + ">" + obj.wineType[index].wine_type + "</option>";
            console.log(obj.wineType[index].wine_type);
        }
        $("#addWineType").html(option);
    }
});


//Function that populates the winery button dropdown
$(document).ready(function () {
    'use strict';
    var obj, url = "../controllers/admin_controller.php?cmd=3", index = "", option = "";
    obj = sendRequest(url);
    if (obj.result === 1) {
        for (index in obj.winery ) {
            option += "<option value=" + obj.winery[index].winery_id + ">" + obj.winery[index].winery_name + "</option>";
        }
        $("#addWinery").html(option);
    }
});

$(function () {
    "use strict";
    $("#addWineBtn").click(function () {
        var addWineName, wineType, addWineType, addYear, winery, addWinery, addDescription, obj = "",
            url, addImage;
        addWineName = encodeURI(document.getElementById("addWineName").value);
        wineType = document.getElementById("addWineType");
        addWineType = wineType.options[wineType.selectedIndex].value;
        addYear = encodeURI(document.getElementById("addYear").value);
        winery = document.getElementById("addWinery");
        addWinery = winery.options[winery.selectedIndex].value;
        addDescription = encodeURI(document.getElementById("addDescription").value);
        addImage = "../img";

        url = "../controllers/admin_controller.php?cmd=4&addWineName=" + addWineName + "&addWineType=" + addWineType +
            "&addYear=" + addYear + "&addWinery=" + addWinery + "&addDescription=" + addDescription + "&addImage=" + addImage;

        obj = sendRequest(url);
        if (obj.result === 1) {
            //for (index in obj.winery ) {
            //    option += "<option value=" + obj.winery[index].winery_id + ">" + obj.winery[index].winery_name + "</option>";
            //}
            //$("#addWinery").html(option);
            alert("added");
        }
    });
});


//Function to hanlde the login of a user
$(function () {
    "use strict";
    $("#loginBtn").click(function () {
        var url = "../controllers/admin_controller.php?cmd=6&username=" + $("#username").val() +
            "&password=" + $("#password").val(), obj;

        obj = sendRequest(url);
        if (obj.result === 1) {
            window.location.replace("dashboard.php");
        }
    });
});

function logout() {
    "use strict";
    var url = "../controllers/admin_controller.php?cmd=7", obj;

    obj = sendRequest(url);
    if (obj.result === 1) {
        window.location.replace("login.php");
    }
}


