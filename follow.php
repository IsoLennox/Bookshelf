<?php include("inc/header.php"); ?>  
 <div id="page">
<?php

//FOLLOW OR UNFOLLOW BUTTON ACTION

$user_id =$_GET['user'];
$follow =$_GET['follow'];


 

if($follow==0){

    // User chose to unfollow, delete instance in following table
 
    $unfollow_q = "DELETE FROM following WHERE you = {$_SESSION['user_id']} AND following = {$user_id}";
    
    $unfollowed = mysqli_query($connection, $unfollow_q);

//    if ($unfollowed && mysqli_affected_rows($connection) == 1) {
    if ($unfollowed) {
      // Success
      $_SESSION["message"] = "Unfollowing!";
     header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      // Failure
      $_SESSION["message"] = "Could not unfollow this reader";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
}elseif($follow==1){
    
    // Create tabe instance of you following user_id
  

 
    $query  = "INSERT INTO following (";
    $query .= " you, following";
    $query .= ") VALUES (";
    $query .= " {$_SESSION['user_id']}, {$user_id}";
    $query .= ") ";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Following!";
     header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      // Failure
      $_SESSION["message"] = "Could not follow this reader";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        
    }
}else{ 
    $_SESSION["message"] = "I did not understand your request.";
     header('Location: ' . $_SERVER['HTTP_REFERER']);
}
  
            ?>
  </div> 
 
<?php include("inc/footer.php"); ?> 