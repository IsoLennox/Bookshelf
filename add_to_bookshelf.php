<?php include("inc/header.php"); ?>
           
    
     <?php

if(isset($_GET['add'])){
    $book_id=$_GET['add'];
    
    
    $query  = "INSERT INTO bookshelves ("; 
    $query .= " user_id, book_id ";
    $query .= ") VALUES ("; 
    $query .= " {$_SESSION['user_id']}, {$book_id} ";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
        $_SESSION["message"] = "Added to bookshelf!";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $_SESSION["message"] = "Could Not Add This Book To Your Bookshelf";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    
}else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if(isset($_GET['remove'])){
    $book_id=$_GET['remove'];
    
    
    //DELETE BOOK
     

  $query = "DELETE FROM bookshelves WHERE book_id = {$book_id} AND user_id= {$_SESSION['user_id']} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "This book was removed from your bookshelf!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else{
    // Failure
    $_SESSION["message"] = "Could not remove this book from your bookshelf!";
   header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
    
    
    
}else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
 
      
        
 include("inc/footer.php"); ?>