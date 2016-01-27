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
            div += "<a class='btn btn-info' onclick='getWineToUpdate(" + obj.wines[index].wine_id + ")' data-toggle='tooltip' href='#' title='Edit'>";
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

//Function to add a new wine
$(function () {
    "use strict";
    $("#addWineBtn").click(function () {
        var addWineName, wineType, addWineType, addYear, winery, addWinery, addDescription, obj,
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
            $("#notification").html("New Wine Added");
        } else {
            $("#notification").html("Failed to add wine");
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


//Function to handle logout
function logout() {
    "use strict";
    var url = "../controllers/admin_controller.php?cmd=7", obj;

    obj = sendRequest(url);
    if (obj.result === 1) {
        window.location.replace("login.php");
    }
}

//Function to send a request for a single wine by id
function getWineToUpdate(id) {
    "use strict";
    var obj, url = "../controllers/admin_controller.php?cmd=8&wine_id=" + id;

    obj = sendRequest(url);
    if (obj.wine_name !== null) {
        $("#addWineName").val(obj.wine_name);
        $("#addYear").val(obj.year);
        $("#addDescription").val(obj.description);
        $("#addWineId").val(obj.wine_id);
        //$("#addWineType option:contains(" + obj.wine_type + ")");
        //$("#addWineType").val(obj.wine_type);
        $("#addWineType").find('option[value="' + obj.wine_type + '"]').prop("selected", true);
    }
}


//Function to update a wine
$(function () {
    "use strict";
    $("#updateWineBtn").click(function () {
        var updateWineName, wineType, updateWineType, updateYear, winery, updateWinery, updateDescription, obj,
            url, updateImage, updateWineId;
        updateWineId = encodeURI(document.getElementById("addWineId").value);
        updateWineName = encodeURI(document.getElementById("addWineName").value);
        wineType = document.getElementById("addWineType");
        updateWineType = wineType.options[wineType.selectedIndex].value;
        updateYear = encodeURI(document.getElementById("addYear").value);
        winery = document.getElementById("addWinery");
        updateWinery = winery.options[winery.selectedIndex].value;
        updateDescription = encodeURI(document.getElementById("addDescription").value);
        updateImage = "../img";

        url = "../controllers/admin_controller.php?cmd=5&updateWineName=" + updateWineName + "&updateWineType=" + updateWineType +
            "&updateYear=" + updateYear + "&updateWinery=" + updateWinery + "&updateDescription=" + updateDescription + "&updateImage=" + updateImage +
            "&updateWineId=" + updateWineId;

        obj = sendRequest(url);
        if (obj.result === 1) {
            $("#notification").html("Wine Updated");
        } else {
            $("#notification").html("Failed to update wine");
        }
    });
});

