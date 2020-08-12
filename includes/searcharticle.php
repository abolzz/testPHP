<?php

// Include config file
require_once 'connection.php';

$search_value = $_GET["q"];

$sql = "SELECT * FROM articles WHERE title LIKE '%$search_value%'";

$res = $link->query($sql);

while($row = $res->fetch_assoc()){
	$title = $row["title"];
	$content = $row["content"];
	$id = $row["id"];
    echo "<li class='list-group-item mx-auto w-100'>
	    	<h2 class='article-title'>$title</h2>
			  <p>$content</p>
			  <form action='includes/deletearticle.php' method='POST'>
				<input type='hidden' name='id' value='$id'>
				<button class='btn btn-danger'>Delete</button>
			  </form>
			  <form action='includes/editarticle.php' method='POST'>
				  	<div class='d-none'>
				      	<label for='title'>Title</label>
				      	<input type='text' name='title'>
				      	<label for='content'>Content</label>
				      	<input type='textarea' name='content'>
				  	</div>
				  	<input type='hidden' name='id' value='$id'>
				      <button type='submit' class='btn btn-secondary'>Edit</button>
			  </form>
			</li>";
}       

?>