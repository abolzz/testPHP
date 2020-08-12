<?php

// Include config file
require_once 'connection.php';

$this_article_id = $_POST['id'];

// sql to delete a record
$link->query("DELETE FROM articles WHERE id='".$this_article_id."'");

header("location: ../index.php");

?>
