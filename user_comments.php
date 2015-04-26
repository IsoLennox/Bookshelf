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
 
 
     <h4><a href="profile.php?user=<?php echo $user_id; ?>"><?php echo $username; ?></a> 's Comment History</h4>
 
    <?php 
            $find_comments  = "SELECT * ";
            $find_comments .= "FROM comments ";
            $find_comments .= "WHERE user_id = {$user_id} ORDER BY id DESC";
            $comments_found = mysqli_query($connection, $find_comments);
            if($comments_found){
                 foreach($comments_found as $this_comment){
                    $book_id=$this_comment['book_id'];
                    $datetime=$this_comment['datetime'];
                    $comment=$this_comment['comment'];
                     
                     //GET BOOK DETAILS
        $bookquery  = "SELECT * FROM books WHERE id={$book_id}";  
        $bookresult = mysqli_query($connection, $bookquery);
            if($bookresult){
                $book=mysqli_fetch_assoc($bookresult);
                $title=$book['title'];
 
 echo $datetime."<br/>";
 echo "<a href=\"view.php?book_id=".$book_id."\">".$title."</a><br/>";
echo "\"".$comment."\"<br/>";
 echo "<hr/>";
    
            } //END GET BOOK DETAILS
                 }
            }else{
                echo "This user has not commented on any books yet!";
            }
   ?>
<?php include("inc/footer.php"); ?>