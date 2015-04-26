<?php include("inc/header.php");  


//determine whose uploads we are looking at
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
 
 <h4> <a href="profile.php?user=<?php echo $user_id ?>"><?php echo $username; ?></a>'s Uploads 
   </h4>
   
    <form class="center search h4_search"  action="search.php?books_by_uploaded_by=<?php echo $user_id; ?>" method="post">
        <input class="" type="text" name="query" value="" placeholder="Search for titles or authors uploaded by this Reader..." />    
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
 <br/>
    
    <?php

    $query  = "SELECT * FROM books WHERE uploaded_by = {$user_id} ORDER BY id DESC";  
    $result = mysqli_query($connection, $query);
if($result){
    foreach($result as $book){
            $author_id=$book['author_id'];
            //GET name
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];

 
        
        echo "<a href=\"view.php?book_id={$book['id']}\">";
        echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
        echo "<h1 class=\"title\">".$book['title']."</h1>";
         
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
        
    }
}

?>
    
     </div>
        
      
        
<?php include("inc/footer.php"); ?>