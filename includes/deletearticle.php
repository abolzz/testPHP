<?php

// Include config file
require_once 'connection.php';

$this_article_id = '';

$sql = "DELETE FROM articles WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_this_article_id);
            
            // Set parameters
            $param_this_article_id = trim($_POST["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                $this_article_id = trim($_POST["id"]);
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Prepare an insert statement
        $sql = "DELETE FROM articles WHERE id = ?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_this_article_id);
            
            // Set parameters
            $param_this_article_id = $this_article_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
        	mysqli_stmt_close($stmt);
    	}
 
// Close the prepared statement
mysqli_close($stmt);
 
// Close connection
mysqli_close($link);

header("location: ../index.php");

?>
