<?php
function create_user_table($pdo)
{
$sql = "CREATE TABLE IF NOT EXISTS `user` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
	`droit` INT,
	`login` VARCHAR(255) UNIQUE,
	`mail` VARCHAR(255) UNIQUE,
	`mdp` VARCHAR(255))";
 $pdo->exec($sql);
}

function create_pictures_table($pdo)
{
$sql ="CREATE TABLE IF NOT EXISTS `pictures` (
	`id_photo` INT PRIMARY KEY AUTO_INCREMENT,
	`link` VARCHAR(255),
	`titre` VARCHAR(255) CHARACTER SET UTF8,
	`legende` VARCHAR(255) CHARACTER SET UTF8,
        `id_article` INT,
	`id_group` INT)";
$pdo->exec($sql);
}



function create_groups_table($pdo)
{
$sql ="CREATE TABLE IF NOT EXISTS `groups` (
	`id_group` INT PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(255))";
$pdo->exec($sql);
}

function create_selection_table($pdo)
{
$sql ="CREATE TABLE IF NOT EXISTS `selection` (
	`id_photo` INT PRIMARY KEY AUTO_INCREMENT)";
$pdo->exec($sql);
}

function create_article_table($pdo)
{
$sql ="CREATE TABLE IF NOT EXISTS `article` (
	`id_article` INT PRIMARY KEY AUTO_INCREMENT,
        `id_group` INT,
        `titre` VARCHAR(255),
        `text1` VARCHAR(1000) CHARACTER SET UTF8,
        `text2` VARCHAR(1000) CHARACTER SET UTF8)";
$pdo->exec($sql);
}

