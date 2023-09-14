<?php
require_once '../common/includes/dbconnect.php';
require_once '../common/includes/admin/check.php';
define('URLBASE','http://test.local/final_project/backend');

$page = basename($_SERVER['PHP_SELF']); 
switch ($page){
case 'Index.php':
    $title= 'Начална';
    break;

case 'add_book.php':
    $title= 'Добавяне на книга';
    break;

case 'add_author.php':
    $title= 'Добавяне на автор';
    break;

case 'add_category.php':
    $title= 'Добавяне на категория';
    break;

case 'add_publisher.php':
    $title= 'Добавяне на издател';
    break;

case 'all_books.php':
    $title= 'Всички книги';
    break;

case 'all_authors.php':
    $title= 'Всички автори';
    break;

case 'all_categories.php':
    $title= 'Всички категории';
    break;

case 'all_publishers.php':
    $title= 'Всички издатели';
    break;

case 'all_users.php':
    $title= 'Всички потребители';
    break;

case 'all_orders.php':
    $title= 'Всички поръчки';
    break;

default: 
$title="bookstore";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/main.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/header.js"></script>
    <script src="js/dropdown.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="img/Tab.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title><?php echo $title; ?></title>
</head>
<body>
    <div class="sidebar">
        <a href="<?php echo URLBASE; ?>/Index.php" class="sidebar-logo"><img src="img/logo_01.png" alt=""></a>
        <div class="sidebar-categories">
            <div class="sidebar-categories-name">
                <p>База данни</p>
                <a href="<?php echo URLBASE; ?>/all_books.php">Всички книги</a>
                <a href="<?php echo URLBASE; ?>/all_authors.php">Всички автори</a>
                <a href="<?php echo URLBASE; ?>/all_categories.php">Всички категории</a>
                <a href="<?php echo URLBASE; ?>/all_publishers.php">Всички издатели</a>
                <a href="<?php echo URLBASE; ?>/all_users.php">Всички потребители</a>
                <a href="<?php echo URLBASE; ?>/all_orders.php">Всички поръчки</a>
            </div>
            <div class="sidebar-categories-name">
                <p>Добавяне</p>
                <a href="<?php echo URLBASE; ?>/add_book.php">Добавяне на книга</a>
                <a href="<?php echo URLBASE; ?>/add_author.php">Добавяне на автор</a>
                <a href="<?php echo URLBASE; ?>/add_category.php">Добавяне на категория</a>
                <a href="<?php echo URLBASE; ?>/add_publisher.php">Добавяне на издател</a>
            </div>
        </div> 
    </div>