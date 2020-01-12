<?php
    session_start();
    require_once __DIR__.'/../libraries/Database.php';
    require_once __DIR__.'/../libraries/Function.php';
    $db = new Database;

    define("ROOT", $_SERVER['DOCUMENT_ROOT'] ."/tutphp/public/uploads/");

    $category = $db->fetchAll("category");

    // Lấy danh sách sản phẩm mới
    $sqlNew = "SELECT * FROM `product` WHERE 1 ORDER BY `ID` DESC LIMIT 3";
    $productNew = $db->fetchsql($sqlNew); 
?>