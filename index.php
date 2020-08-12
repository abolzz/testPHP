<!DOCTYPE html>
<html>
<head>
	<title>testPHP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

	<nav class="navbar navbar-dark bg-dark">
		 <a class="navbar-brand">Articles</a>
		 <form class="form-inline">
		   <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" onkeyup="showResult(this.value)">
		 </form>
	</nav>

	<main class="container">

		<div class="row my-5">

			<form class="col-md-5 col-sm-12 mx-auto form" action="includes/addarticle.php" method="POST">
				<h2>Add article</h2>
				<input class="form-control my-1" type="text" name="title" placeholder="Title" required>
				<textarea class="form-control my-1" rows="10" name="content" placeholder="Content" required></textarea>
				<button class="btn btn-primary mt-2" type="submit">Add article</button>
			</form>

			<ul id="livesearch" class="list-group my-3 col-md-7 col-sm-12 mx-auto p-3">
			<?php

			require_once 'includes/connection.php';
			$article = $link->query("SELECT * FROM articles");
			foreach ($article as $this_article) {
				?>
				<li class="list-group-item mx-auto w-100 my-2">
					<h2 class="article-title"><?php echo $this_article['title'] ?></h2>
					<p><?php echo $this_article['content'] ?></p>
					<div class="d-flex justify-content-end">
				    	<button class="btn btn-secondary mr-2" onclick="document.getElementById('editform<?php echo $this_article['id'] ?>').classList.remove('d-none');this.classList.add('d-none')">Edit</button>
				    	<form action="includes/deletearticle.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $this_article['id'] ?>">
							<button class="btn btn-danger">Delete</button>
						</form>
				    </div>
				    <form action="includes/editarticle.php" method="POST" id="editform<?php echo $this_article['id'] ?>" class="d-none">
					    <input value="<?php echo $this_article['title'] ?>" class="form-control my-2" type="text" name="title" placeholder="Title" required>
					    <textarea class="form-control my-2" rows="10" name="content" placeholder="Content" required><?php echo $this_article['content'] ?></textarea>
					    <input type="hidden" name="id" value="<?php echo $this_article['id'] ?>">
					    <button type="submit" class="btn btn-secondary">Edit</button>
					</form>
				</li>
				<?php
			}

			$link->close();
			?>
			</ul>
		</div>
	</main>

	<script>
		function showEditForm() {
			document.getElementById('editform<?php echo $this_article['id'] ?>').classList.remove('d-none');
			this.classList.add('d-none');
		}
		
		var search_result = '';
		function showResult(str) {
		  if (str.length == 0) {
		    return;
		  }
		  var xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("livesearch").innerHTML=this.responseText;
		    }
		  }
		  xmlhttp.open("GET","includes/searcharticle.php?q="+str,true);
		  xmlhttp.send();
		}
	</script>
</body>
</html>