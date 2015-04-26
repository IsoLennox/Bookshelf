<?php include("inc/header.php"); 

//determine whose profile we are looking at
if(isset($_GET['user'])){
    $user_id=$_GET['user'];
    
    //GET USERNAME
    $find_user = find_user_by_id($user_id);
    $username= $find_user['username'];
    
    
}else{
    $user_id=$_SESSION['user_id'];
    $username = $_SESSION['username'];
   
}

?>
 
 
     <h4><a href="profile.php?user=<?php echo $user_id; ?>"><?php echo $username; ?></a> 's Viewing History</h4>
   
    <?php
//            $find_views  = "SELECT * ";
            $find_views  = "SELECT DISTINCT book_id ";
            $find_views .= "FROM books_viewed ";
            $find_views .= "WHERE user_id = {$user_id} ORDER BY id DESC";
            $views_found = mysqli_query($connection, $find_views);
            if($views_found){
                 foreach($views_found as $this_book){
                    $book_id=$this_book['book_id'];
                     
                     //GET BOOK DETAILS
        $bookquery  = "SELECT * FROM books WHERE id={$book_id}";  
        $bookresult = mysqli_query($connection, $bookquery);
            if($bookresult){
                $book=mysqli_fetch_assoc($bookresult);
                $author_id=$book['author_id'];
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];
           
            
        echo "<a href=\"view.php?book_id={$book['id']}\">";
        echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
        echo "<h1 class=\"title\">".$book['title']."</h1>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
    
            } //END GET BOOK DETAILS
                 }
            }
    ?>
     
<?php include("inc/footer.php"); ?>