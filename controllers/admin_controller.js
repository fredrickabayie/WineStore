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
//$(document).ready(function () {
function displayWines(page) {
    "use strict";
    var obj, pageNum = 1, index, pagination = "", div = "", url = "../controllers/admin_controller.php?cmd=1&page=" + page;

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
            div += "<a class='btn btn-danger' data-toggle='tooltip' onclick='deleteWine(this)' href='#' id='deleteBtn' title='Delete'>";
            div += "<i class='icon-trash'></i></a></td></tr>";
        }
        $("#viewWines").html(div);

        if (parseInt(page) === 1) {
            pagination += "<li><a href='#' onclick='displayWines(1)'>First</a></li>";
        } else {
            pagination += "<li><a href='#' onclick='displayWines(" + (parseInt(page) - 1) + ")'>Previous</a></li>";
        }

        for (var i = parseInt(page) - 6; i <= parseInt(page) + 6; i++) {
            if (i >= 1 && i <= obj.wines[index].total_pages) {
                if (i === parseInt(page)) {
                    pagination += "<li class='active'><a href='#' onclick='displayWines(" + i + ")'><b>" + i + "</b></a></li>";
                } else {
                    pagination += "<li><a href='#' onclick='displayWines(" + i + ")'>" + i + "</a></li>";
                }
            }
        }

        if (parseInt(page) === obj.wines[index].total_pages) {
            pagination += "<li><a href='#'>Last</a></li>";
        } else {
            pagination += "<li><a href='#' onclick='displayWines(" + (parseInt(page) + 1) + ")'>Next</a></li>";
        }

        $("#recordsNumber").html(obj.wines[index].total_records);
        $("#pagination").html(pagination);
        $("#paginationResult").find("a").html(page + " <a style='color: black'>of</a> " + obj.wines[index].total_pages);
    }
}


$(function () {
    "use strict";
    displayWines("1");
});


function deleteWine(id) {
//$(document).ready(function () {
    'use strict';
    //$('#deleteBtn').click(function() {
    console.log(id);
    $(id).closest('tr')
        .children('td')
        .animate({padding: 0})
        .wrapInner('<div />')
        .children()
        .slideUp(function () {
            $(this).closest('tr').remove();
        });
    return false;
    //});
//});
}


//Function that populates the wine type button dropdown
$(document).ready(function () {
    'use strict';
    var obj, url = "../controllers/admin_controller.php?cmd=2", index = "", option = "";
    obj = sendRequest(url);
    if (obj.result === 1) {
        for (index in obj.wineType) {
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
        for (index in obj.winery) {
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
        //addImage = encodeURI(document.getElementById("fileToUpload").value);

        addImage = 'img';
        url = "../controllers/admin_controller.php?cmd=4&addWineName=" + addWineName + "&addWineType=" + addWineType +
            "&addYear=" + addYear + "&addWinery=" + addWinery + "&addDescription=" + addDescription + "&addImage=" + addImage;

        //console.log(url+"");

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
            window.location.replace("adminwines.php");
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
    var obj, wineType, url = "../controllers/admin_controller.php?cmd=8&wine_id=" + id;

    obj = sendRequest(url);
    if (obj.wine_name !== null) {
        $("#addWineName").val(obj.wine_name);
        $("#addYear").val(obj.year);
        $("#addDescription").val(obj.description);
        $("#addWineId").val(obj.wine_id);
        $("#addWineType").find("option").filter(function () {
            return ($(this).text() === obj.wine_type); //To select Blue
        }).prop('selected', true);
        $("#addWinery").find("option").filter(function () {
            return ($(this).text() === obj.winery_name); //To select Blue
        }).prop('selected', true);
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

//
//function uploadFile(){
//    var input = document.getElementById("file");
//    file = input.files[0];
//    if(file != undefined){
//        formData= new FormData();
//        if(!!file.type.match(/image.*/)){
//            formData.append("image", file);
//            $.ajax({
//                url: "../views/upload.php",
//                type: "POST",
//                data: formData,
//                processData: false,
//                contentType: false,
//                success: function(data){
//                    alert('success');
//                }
//            });
//        }else{
//            alert('Not a valid image!');
//        }
//    }else{
//        alert('Input something!');
//    }
//}

