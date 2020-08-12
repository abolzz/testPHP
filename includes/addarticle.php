<?php
// Include config file
require_once 'connection.php';
 
// Define variables and initialize with empty values
$title = $content = "";
$title_err = $content_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate title
    if(empty(trim($_POST["title"]))){
        $title_err = "Please enter title.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM articles WHERE title = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_title);
            
            // Set parameters
            $param_title = trim($_POST["title"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                $title = trim($_POST["title"]);
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate content
    if(empty(trim($_POST['content']))){
        $content_err = "Please enter content.";     
    } else {
        $content = trim($_POST['content']);
    }
    
    // Check input errors before inserting in database
    if(empty($title_err) && empty($content_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO articles (title, content) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_title, $param_content);
            
            // Set parameters
            $param_title = $title;
            $param_content = $content;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ../index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        if(!empty($title_err)) {
            echo $title_err;
        } elseif (!empty($content_err)) {
            echo $content_err;
        } else {
            echo $title_err;
            echo $content_err;
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>