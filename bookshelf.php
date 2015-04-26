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
 
 
 <h4> <a href="profile.php?user=<?php echo $user_id; ?>"><?php echo $username; ?></a>'s Bookshelf </h4>
 <form class="center search h4_search"  action="search.php?bookshelf=<?php echo $user_id; ?>" method="post">
        <input class="" type="text" name="query" value="" placeholder="Search for titles or authors in this bookshelf..." />    
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
 
  <?php
        //See if this user has a bookshelf 
      
    $query  = "SELECT * FROM bookshelves WHERE user_id={$user_id} ORDER BY id DESC";  
    $result = mysqli_query($connection, $query);
    $num_rows=mysqli_num_rows($result);
    if($num_rows >= 1){
 
        //show books
        foreach($result as $get_book){
            
    $query  = "SELECT * FROM books WHERE id={$get_book['book_id']}";  
    $result = mysqli_query($connection, $query);
    if($result){
        $book=mysqli_fetch_assoc($result);
 
            $author_id=$book['author_id'];
            //GET name
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];
 
        
        echo "<a href=\"view.php?book_id={$book['id']}\">";
        echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
        echo "<h1 class=\"title\">".$book['title']."</h1>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
             
            } //END GET BOOK DETAILS
        }//END FOREACH BOOK IN BOOKSHELF    
    }else{
        echo "No Books Have Been Added To This Bookshelf!";
    }//end get bookshelf results
    ?>
     
<?php include("inc/footer.php"); ?>