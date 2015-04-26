<?php include("inc/header.php"); 

 
    $book_id=$_GET['book_id'];
    $rating=$_GET['rating'];

 
//SEE IF THIS USER HAS RATED THIS BOOK
    $find_rating  = "SELECT * FROM ratings ";
    $find_rating  .= "WHERE book_id = {$book_id} ";
    $find_rating  .= "AND user_id={$_SESSION['user_id']}";
    $rating_found = mysqli_query($connection, $find_rating);

    $num_rows=mysqli_num_rows($rating_found);
    if($num_rows >= 1){
// if($rating_found){
        //USER HAS RATED THIS BEFORE, UPDATE RATING
        
          //create rating
        $query  = "UPDATE ratings SET ";
        $query .= "rating = {$rating} ";
        $query .= "WHERE user_id={$_SESSION['user_id']} ";
        $query .= "AND book_id={$book_id}";
  
        $new_comment_created = mysqli_query($connection, $query);

        if ($new_comment_created) {

        // Success
          $_SESSION["message"] = "You've updated your rating!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
          // Failure
       $_SESSION["message"] = "Rating Failed";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        
                      
    }else{
        //CREATE NEW RATING FOR THIS USER/BOOK

                  //create rating
        $query  = "INSERT INTO ratings (";
        $query .= "  book_id, user_id, rating";
        $query .= ") VALUES (";
        $query .= "  {$book_id},'{$_SESSION['user_id']}', {$rating}";
        $query .= ") ";
        $new_rating_created = mysqli_query($connection, $query);

        if ($new_rating_created) {

        // Success
          $_SESSION["message"] = "You've rated this book!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
          // Failure
         $_SESSION["message"] = "Rating Failed!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
     
    }
 

?>
 
      
        
<?php include("inc/footer.php"); ?>