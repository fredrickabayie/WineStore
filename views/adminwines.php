<?php
session_start();
if ( isset ( $_SESSION [ 'LOGIN' ] )  )
{
}
else{
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html class='no-js' lang='en'>
<head>
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title>Tables</title>
    <meta content='lab2023' name='author'>
    <meta content='' name='description'>
    <meta content='' name='keywords'>
    <link href="../css/admin.dashboard.css" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">-->
<!--    <link href="assets/images/favicon.ico" rel="icon" type="image/ico" />-->

</head>
<body class='main page'>
<!-- Navbar -->
<div class='navbar navbar-default' id='navbar'>
    <a class='navbar-brand' href='#'>
        <img src="../img/winestoreshop-logo.png" alt="#" class="img-responsive center-block" width="150" height="150" style="margin-top: -15px">
    </a>
    <ul class='nav navbar-nav pull-right'>
        <li>
            <a href='#'>
                <i class='icon-cog'></i>
                Settings
            </a>
        </li>
        <li class='dropdown user'>
            <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                <i class='icon-user'></i>
                <strong><?php echo $_SESSION['username'];?></strong>
                <img class="img-rounded" src="http://placehold.it/20x20/ccc/777" />
                <b class='caret'></b>
            </a>
            <ul class='dropdown-menu'>
                <li>
                    <a href='#'>Edit Profile</a>
                </li>
                <li class='divider'></li>
                <li>
                    <a href="" id="logout" onclick="logout()">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<div id='wrapper'>
    <!-- Sidebar -->
    <section id='sidebar'>
        <i class='icon-align-justify icon-large' id='toggle'></i>
        <ul id='dock'>
            <li class='launcher'>
                <i class='icon-dashboard'></i>
                <a href="dashboard.php">Dashboard</a>
            </li>
            <li class='active launcher'>
                <i class='icon-file-text-alt'></i>
                <a href="adminwines.php">Wines</a>
            </li>
        </ul>
        <div data-toggle='tooltip' id='beaker' title='Made by Wine Store'></div>
    </section>


    <!-- Tools -->
    <section id='tools'>
        <ul class='breadcrumb' id='breadcrumb'>
            <li class='title'>Notifications</li>
            <li><a href="#" id="notification"></a></li>
        </ul>
        <div id='toolbar'>
            <div class='btn-group'>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Building'>
                    <i class='icon-building'></i>
                </a>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Laptop'>
                    <i class='icon-laptop'></i>
                </a>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Calendar'>
                    <i class='icon-calendar'></i>
                    <span class='badge'>3</span>
                </a>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Lemon'>
                    <i class='icon-lemon'></i>
                </a>
            </div>
        </div>
    </section>


    <!-- Content -->
    <div id='content'>


        <div class="panel panel-default grid col-lg-6">
            <div class="panel-heading">
                <i class="icon-edit icon-large"></i>
                Add Wines
            </div>
            <div class="panel-body">
                <form>
                    <fieldset>

                        <div class="form-group row">
                            <div class="col-lg-3 col-sm-6">
                                <input id="addWineName" class="form-control" placeholder="Wine Name" type="text" data-toggle="tooltip" data-original-title="Wine Name">
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <select id="addWineType" class="form-control" data-toggle="tooltip" data-original-title="Wine Type">
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <input id="addYear" class="form-control" placeholder="Year" type="number" data-toggle="tooltip" data-original-title="Year">
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <select id="addWinery" class="form-control" data-toggle="tooltip" data-original-title="Winery">
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label">Description</label>
                                <textarea id="addDescription" class="form-control" rows="4" placeholder="Description"></textarea>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <label class="control-label">Upload Picture</label>
                                <input type="file" name="uploadImage" id="file" onchange="uploadFile()">
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <img id="blah" src="#" alt="your image" />
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button id="addWineBtn" class="btn btn-success" type="button">Insert</button>
                        <button id="updateWineBtn" class="btn btn-primary" type="button">Update</button>
                        <a id="clearBtn" class="btn btn-default" href="#" onclick="clearAddWineForm()">Clear</a>
                        <input id="addWineId" style="display: none">
                    </div>
                </form>
            </div>

        </div>


        <div class='panel panel-default grid col-lg-6'>
            <div class='panel-heading'>
                <i class='icon-table icon-large'></i>
                Wine Database
                <div class='panel-tools'>
                    <div class='btn-group'>
                        <a class='btn' href='#'>
                            <i class='icon-wrench'></i>
                            Settings
                        </a>
                        <a class='btn' href='#'>
                            <i class='icon-filter'></i>
                            Filters
                        </a>
                        <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Reload'>
                            <i class='icon-refresh'></i>
                        </a>
                    </div>
                    <div class='badge'>3 record</div>
                </div>
            </div>
            <div class='panel-body filters'>
                <div class='row'>
                    <div class='col-md-9'>
                        Add your custom filters here...
                    </div>
                    <div class='col-md-3'>
                        <div class='input-group'>
                            <input class='form-control' placeholder='Quick search...' type='text'>
                  <span class='input-group-btn'>
                    <button class='btn' type='button'>
                        <i class='icon-search'></i>
                    </button>
                  </span>
                        </div>
                    </div>
                </div>
            </div>

            <table class='table' id="table_id">
                <thead>
                <tr>
<!--                    <th>#</th>-->
                    <th>Wine Name</th>
                    <th>Wine Type</th>
                    <th>Year</th>
                    <th class='actions'>
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody id="viewWines">

                </tbody>
            </table>

            <div class='panel-footer'>
                <ul class='pagination pagination-sm'>
                    <li>
                        <a href='#'>«</a>
                    </li>
                    <li class='active'>
                        <a href='#'>1</a>
                    </li>
                    <li>
                        <a href='#'>2</a>
                    </li>
                    <li>
                        <a href='#'>3</a>
                    </li>
                    <li>
                        <a href='#'>4</a>
                    </li>
                    <li>
                        <a href='#'>5</a>
                    </li>
                    <li>
                        <a href='#'>6</a>
                    </li>
                    <li>
                        <a href='#'>7</a>
                    </li>
                    <li>
                        <a href='#'>8</a>
                    </li>
                    <li>
                        <a href='#'>»</a>
                    </li>
                </ul>
                <div class='pull-right'>
                    Showing 1 to 10 of 32 entries
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Footer -->
<!-- Javascripts -->
<!--<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
<!--<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js" type="text/javascript"></script>
<script src="../js/admin.dashboard.js" type="text/javascript"></script>
<script src="../controllers/admin_controller.js" type="text/javascript"></script>
<!--<script src="../controllers/wine_controller.js" type="text/javascript"></script>-->

<!-- Google Analytics -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>
