<?php include("inc/header.php"); 

$book_id=$_GET['book_id'];
    $viewed_query  = "INSERT INTO books_viewed (";
    $viewed_query .= "  user_id, book_id";
    $viewed_query .= ") VALUES (";
    $viewed_query .= "  {$_SESSION['user_id']}, {$book_id} ";
    $viewed_query .= ")";
    $viewed_result = mysqli_query($connection, $viewed_query);
?>