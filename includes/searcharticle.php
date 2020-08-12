<?php

// Include config file
require_once 'connection.php';

$search_value = "%".$_GET["q"]."%";

		$stmt = $link->prepare("SELECT * FROM articles WHERE title LIKE ?");
		$stmt->bind_param("s", $search_value);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $res = $stmt->get_result();

				while($row = $res->fetch_assoc()){
					?><li class='list-group-item mx-auto w-100 my-2'>
					    	<h2 class='article-title'><?php echo $row['title'] ?></h2>
							  <p><?php echo $row['content'] ?></p>
							  <div class='d-flex justify-content-end'>
							  	 <button class='btn btn-secondary mr-2' onclick="document.getElementById('editform<?php echo $row['id'] ?>').classList.remove('d-none');this.classList.add('d-none')">Edit</button>
							  	 <form action='includes/deletearticle.php' method='POST'>
									<input type='hidden' name='id' value="<?php echo $row['id'] ?>">
									<button class='btn btn-danger'>Delete</button>
								  </form>
							  </div>
								  <form id="editform<?php echo $row['id'] ?>" class='d-none' action='includes/editarticle.php' method='POST'>
									    <input class="form-control my-2" type='text' name='title' value="<?php echo $row['title'] ?>">
									    <textarea class="form-control my-2" rows="10" type='textarea' name='content'><?php echo $row['content'] ?></textarea>
									  	<input type='hidden' name='id' value="<?php echo $row['id'] ?>">
									    <button type='submit' class='btn btn-secondary'>Edit</button>
								  </form>
							</li>
				<?php
					}
            } else{
                echo "Something went wrong. Please try again later.";
            }      

?>