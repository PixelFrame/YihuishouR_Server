<?php
    require "db_config.php";
    require "XML_parser.php";
    $xmlStr = $_POST["xmlStr"];
    $id = $_POST["id"];

    $sql_select = "select * from user where id ='$id'";
    $result = mysqli_query($con, $sql_select);
    if ($result == false) {
        echo "FATAL ERROR: No such user";
        exit();
    } else {
        $order = getArray($xmlStr);
        $row = mysqli_fetch_row($result);
    }

    function updateOrder($oid, $alias, $attrib, $date, $status) {

    }

    function createItems($iid, $item_name, $price, $catagory, $num) {

    }
?>