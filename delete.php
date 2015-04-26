<?php require_once("functions/session.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/db_connection.php"); ?>
<?php confirm_logged_in(); ?>
<?php


if(isset($_GET["book_id"])){

//DELETE BOOK
    
  $current_book=$_GET["book_id"];
    
    //REMOVE FROM DIR
    $get_book  = "SELECT * FROM books WHERE id = {$current_book}";  
    $book_result = mysqli_query($connection, $get_book);
    if($book_result){
      
      
      $array=mysqli_fetch_assoc($book_result);
      $filepath=$array['file'];
        unlink($filepath);
      
                  //MAKE SURE FILE WAS REMOVED FROM DIR
        if (file_exists($filepath)) {
             $_SESSION["message"] = "Problem deleting " .$filepath;
            redirect_to("user_uploads.php");
        } else {
            $_SESSION["message"] = "Successfully deleted " .$filepath;
            
               
    //REMOVE FROM DB
  $query = "DELETE FROM books WHERE id = {$current_book} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "book deleted.";
    redirect_to("user_uploads.php");
  } else{
    // Failure
    $_SESSION["message"] = "book deletion failed.";
    redirect_to("user_uploads.php");
  }
    
            
            
        }
      
    
  } else{
    
    $_SESSION["message"] = "Book Not Found"; 
        redirect_to("user_uploads.php");
  }
   

}//END DELETE BOOK




if(isset($_GET["comment_id"])){

//DELETE comment
    
  $current_comment=$_GET["comment_id"];
    
    //REMOVE FROM DIR
    $get_comment  = "SELECT * FROM comments WHERE id = {$current_comment}";  
    $comment_result = mysqli_query($connection, $get_comment);
    if($comment_result){
      
      
      $array=mysqli_fetch_assoc($comment_result);
      $book_id=$array['book_id'];
        
   
               
    //REMOVE FROM DB
  $query = "DELETE FROM comments WHERE id = {$current_comment} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "comment deleted.";
    redirect_to("view.php?book_id=$book_id");
  } else{
    // Failure
    $_SESSION["message"] = "comment deletion failed.";
    redirect_to("view.php?book_id=$book_id");
  }
    
            
      
    
  } else{
    
    $_SESSION["message"] = "comment Not Found"; 
        redirect_to("view.php?book_id=$book_id");
  }
   

}//END DELETE comment




if(isset($_GET["avatar"])){

//DELETE avatar
    
  $user_id=$_GET["avatar"];
    
    //REMOVE FROM DIR
    $get_avatar  = "SELECT * FROM users WHERE id = {$user_id}";  
    $avatar_result = mysqli_query($connection, $get_avatar);
    if($avatar_result){
      
      
      $array=mysqli_fetch_assoc($avatar_result);
      $book_id=$array['book_id'];
        
   
               
    //REMOVE FROM DB
    $reset  = "UPDATE users SET ";
    $reset .= "avatar = '' ";
    $reset .= "WHERE id = {$user_id} ";
    $result = mysqli_query($connection, $reset);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success 
    $_SESSION["message"] = "avatar deleted.";
    redirect_to("edit_profile.php");
     
  } else{
    // Failure
    $_SESSION["message"] = "avatar deletion failed.";
    redirect_to("edit_profile.php");
  }
    
            
      
    
  } else{
    
    $_SESSION["message"] = "avatar Not Found"; 
        redirect_to("view.php?book_id=$book_id");
  }
   

}//END DELETE avatar

 

?>