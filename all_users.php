<?php include("inc/header.php"); 

?>
<h4>All Users</h4>
<?php

//GET ALL USERS

    $get_users  = "SELECT * FROM users ORDER BY id DESC";  
    $users_found = mysqli_query($connection, $get_users);
  if($users_found){
foreach($users_found as $reader){
//FOREACH, GET FOLLOWING, UPLOADS, ETC
    $user_id=$reader['id'];
    $username=$reader['username'];


//echo "<h3><a href=\"profile.php?user=".$user_id."\">".$username."</a></h3>";
//     
// 


 

 

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
    
    
            //GET # UPLOADS
            $find_uploads  = "SELECT * ";
            $find_uploads .= "FROM books ";
            $find_uploads .= "WHERE uploaded_by = {$user_id} ";
            $uploads_set = mysqli_query($connection, $find_uploads);
            if($uploads_set){
                $num_uploads=mysqli_num_rows($uploads_set);
            }else{ $num_uploads=0; }
        
        //GET # IN BOOKSHELF 
            $find_bookshelf  = "SELECT * ";
            $find_bookshelf .= "FROM bookshelves ";
            $find_bookshelf .= "WHERE user_id = {$user_id} ";
            $bookshelf_found = mysqli_query($connection, $find_bookshelf);
            if($bookshelf_found){
                $num_bookshelf=mysqli_num_rows($bookshelf_found);
            }else{
                $num_bookshelf=0;
            }
    
           echo "<a href=\"profile.php?user_id={$user_id}\"><div class=\"hover-row book-list\">";
       echo "<span class=\"title\">".$username."</span><br/>";
        
            echo $num_uploads." Uploads<br/>";
        echo $num_bookshelf." books in bookshelf<br/>";
        echo $num_following." Following<br/>";
        echo $num_followers." Followers<br/>";
        echo "</div></a>";
 
 
    
    
    }//foreach READER FOUND
}else{
  echo "This site has no readers yet!"; }

include("inc/footer.php"); ?>