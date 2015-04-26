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

echo "<h3><a href=\"profile.php?user=".$user_id."\">".$username."</a></h3>";

 echo "<h4>".$num_following." Following | <a href=\"followers.php?user=".$user_id."\">".$num_followers." Followers</a><span class=\"right\"><a href=\"all_users.php\" title=\"Explore Users\"><i class=\"fa fa-globe\"></i></a></span> </h4> ";




    $query  = "SELECT * FROM following WHERE you={$user_id}";  
    $result = mysqli_query($connection, $query);
    if($result){
        
     $you_following=mysqli_fetch_assoc($result);
        if(empty($you_following)){
            echo "Not Following Any Readers Yet!";
        }
        
    foreach($result as $user){
         
        
        $get_user  = "SELECT * FROM users WHERE id={$user['following']}";  
    $user_result = mysqli_query($connection, $get_user);
    if($user_result){
        $user_found=mysqli_fetch_assoc($user_result);
        
        //GET # UPLOADS
            $find_uploads  = "SELECT * ";
            $find_uploads .= "FROM books ";
            $find_uploads .= "WHERE uploaded_by = {$user_found['id']} ";
            $uploads_set = mysqli_query($connection, $find_uploads);
            if($uploads_set){
                $num_uploads=mysqli_num_rows($uploads_set);
            }else{ $num_uploads=0; }
        
        //GET # IN BOOKSHELF 
            $find_bookshelf  = "SELECT * ";
            $find_bookshelf .= "FROM bookshelves ";
            $find_bookshelf .= "WHERE user_id = {$user_found['id']} ";
            $bookshelf_found = mysqli_query($connection, $find_bookshelf);
            if($bookshelf_found){
                $num_bookshelf=mysqli_num_rows($bookshelf_found);
            }else{
                $num_bookshelf=0;
            }
        
        
                //GET # Following
            $find_following  = "SELECT * ";
            $find_following .= "FROM following ";
            $find_following .= "WHERE you = {$user_found['id']} ";
            $following_found = mysqli_query($connection, $find_following);
            if($following_found){
                $num_following=mysqli_num_rows($following_found);
            }else{
                $num_following=0;
            }
        
        
        
      //GET # Followers
            $find_followers  = "SELECT * ";
            $find_followers .= "FROM following ";
            $find_followers .= "WHERE following = {$user_found['id']} ";
            $followers_found = mysqli_query($connection, $find_followers);
            if($followers_found){
                $num_followers=mysqli_num_rows($followers_found);
            }else{
                $num_followers=0;
            }
        
        
        
     
        echo "<a href=\"profile.php?user_id={$user_found['id']}\"><div class=\"hover-row book-list\">";
       echo "<span class=\"title\">".$user_found['username']."</span><br/>";
        

        echo $num_uploads." Uploads<br/>";
        echo $num_bookshelf." books in bookshelf<br/>";
        echo $num_following." Following<br/>";
        echo $num_followers." Followers<br/>";
        echo "</div></a>";
 
        }//end get data of each user following
    }//end find ID of each user following
}else{
    echo "You are not following any readers!";
    }//end see if following

include("inc/footer.php"); ?>