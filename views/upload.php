<?php
/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 27/01/2016
 * Time: 23:18
 */
$dir = "image/";
move_uploaded_file($_FILES["image"]["tmp_name"], $dir. $_FILES["image"]["name"]);