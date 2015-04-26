<?php include("inc/header.php"); 

//determine whose profile we are looking at
if(isset($_GET['user'])){
    $user_id=$_GET['user'];
    
    //GET USERNAME
    $find_user = find_user_by_id($user_id);
    $username= $find_user['username'];
    
    
}elseif(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
    
    //GET USERNAME
    $find_user = find_user_by_id($user_id);
    $username= $find_user['username'];
    
    
}else{
    $user_id=$_SESSION['user_id'];
    $username = $_SESSION['username'];
   
}


//SEE IF FOLLOWING THIS "READER"
    $follow_query  = "SELECT * FROM following WHERE you={$_SESSION['user_id']} AND following={$user_id}";  
    $follow_result = mysqli_query($connection, $follow_query);
    $is_following=mysqli_num_rows($follow_result);
    if($is_following >= 1){
        
         $follow= "<a title=\"Unfollow Reader\" href=\"follow.php?follow=0&user=".$user_id."\"> - <i class=\"fa fa-user\"></i></a> ";
    
    }else{
        $follow= "<a title=\"Follow Reader\" href=\"follow.php?follow=1&user=".$user_id."\"> + <i class=\"fa fa-user\"></i></a> ";
    }


//GET FOLLOWING COUNT

    $following_query  = "SELECT count(*) as total FROM following WHERE you={$user_id}";  
    $following_result = mysqli_query($connection, $following_query);
  if($following_result){
$following_count=mysqli_fetch_assoc($following_result);
$num_following= $following_count['total'];
}else{
  $num_following= 0;  }

//GET FOLLOWERS COUNT

    $get_followers  = "SELECT count(*) as total FROM following WHERE following={$user_id}";  
    $followers_found = mysqli_query($connection, $get_followers);
  if($followers_found){
$followers_array=mysqli_fetch_assoc($followers_found);
$num_followers= $followers_array['total'];  
  }else{
  $num_followers= 0;  }


//GET PROFILE IMAGE AND CONTENT
     $query  = "SELECT * FROM users WHERE id={$user_id}";  
    $result = mysqli_query($connection, $query);
     
    if($result){
        $profile_array=mysqli_fetch_assoc($result);
        $content=$profile_array['profile_content'];
        $avatar=$profile_array['avatar'];
        if(empty($avatar)){
            $avatar="http://lorempixel.com/150/150/cats";
        }
    }else{
        $content="Error retrieving Profile";
        $avatar="http://lorempixel.com/150/150/cats";
    }

?>
 
 <h2> <?php echo $username; ?>'s Profile <span class="right"><?php echo $follow; ?> </span> </h2>
 
<p><a href="following.php?user=<?php echo $user_id; ?>"> <?php echo $num_following; ?> following</a> | <a href="followers.php?user=<?php echo $user_id; ?>"><?php echo $num_followers; ?> followers</a></p>


<div id="profile">
    <section id="avatar" class="left"> <img src="<?php echo $avatar; ?>" alt="profile image">
     </section>
    <section id="profile-content"> <?php echo $content; ?> </section>
</div>

<?php

if($user_id==$_SESSION['user_id']){
    echo "<br/><span class=\"right\"><a href=\"edit_profile.php\"><i class=\"fa fa-pencil\"></i> Edit Profile</a></span><br/>";
}
?>
 
  <?php
        //See if this user has a bookshelf 
      
    $query  = "SELECT * FROM bookshelves WHERE user_id={$user_id} ORDER BY id DESC LIMIT 4";  
    $result = mysqli_query($connection, $query);
    $num_rows=mysqli_num_rows($result);
    if($num_rows >= 1){
        //this user has a bookshelf, show books and header
        ?>
         <h4>Bookshelf<?php  echo '<span class="right"><a href="bookshelf.php?user='.$user_id.'" title="View Bookshelf"><i class="fa fa-book"></i> <span class="small"> Browse All</span> 
</a></span>'; ?> </h4>
        <?php
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
//        echo "<h2 class=\"subtitle\">Added to ".$times_added." Bookshelves </h2>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
    
            } //END GET BOOK DETAILS
        }//END FOREACH BOOK IN BOOKSHELF    
    }//end get bookshelf results
    ?>
 
  
         
       <?php //SEE IF USER HAS UPLOADED ANY BOOKS
    $query  = "SELECT * FROM books WHERE uploaded_by = {$user_id} ORDER BY id LIMIT 4";  
    $result = mysqli_query($connection, $query);
    if($result){
        ?>
<h4>Recently Uploaded By This User <a href="user_uploads.php?user=<?php echo $user_id; ?>" class="right" title="View Uploads"><i class="fa fa-archive"></i><span class="small"> Browse All</span> 

</a></h4>
        
        <?php
    foreach($result as $book){
       $author_id=$book['author_id'];
            //GET name
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];

 
        
        echo "<a href=\"view.php?book_id={$book['id']}\">";
        echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
        echo "<h1 class=\"title\">".$book['title']."</h1>";
//        echo "<h2 class=\"subtitle\">Added to ".$times_added." Bookshelves </h2>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
    }
}//END SEE IF USER UPLOADED BOOKS
 ?>
 
 
 
     <h4>Recently Viewed <span title="view history" class="right"><a href="history.php?user=<?php echo $user_id; ?>"><i class="fa fa-clock-o"></i><span class="small"> History</span> 
</a></span> </h4>
    <!--    show last 5 viewed-->
    <?php
            $find_views  = "SELECT DISTINCT book_id ";
            $find_views .= "FROM books_viewed ";
            $find_views .= "WHERE user_id = {$user_id} ORDER BY id DESC LIMIT 4";
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
            //GET name
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];

 
        
        echo "<a href=\"view.php?book_id={$book['id']}\">";
        echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
        echo "<h1 class=\"title\">".$book['title']."</h1>";
//        echo "<h2 class=\"subtitle\">Added to ".$times_added." Bookshelves </h2>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
    
            } //END GET BOOK DETAILS
                 }
            }











 ?>    <br/><h4>Recent Comments <span title="view history" class="right"><a href="user_comments.php?user=<?php echo $user_id; ?>"><i class="fa fa-comment"></i><span class="small"> All Comments</span> 
</a></span> </h4>
    <!--    show last 5 viewed-->
    <?php 
            $find_comments  = "SELECT * ";
            $find_comments .= "FROM comments ";
            $find_comments .= "WHERE user_id = {$user_id} ORDER BY id DESC LIMIT 4";
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