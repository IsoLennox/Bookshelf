<?php include("inc/header.php"); 


//IF COMMENT WAS SUBMITTED
if(isset($_POST['submit'])){
    $book_id=$_POST['book_id'];
      // validations
  $required_fields = array("comment");
  validate_presences($required_fields);
 
  if (empty($errors) ) {
    // Perform Create
 
    $content_raw = mysql_prep($_POST["comment"]);
       $content= strip_tags($content_raw, '<p><a><img><br/><br><br />');
 
     $dateTimeVariable = date("F j, Y \a\t g:ia");
      //create user
    $query  = "INSERT INTO comments (";
    $query .= "  book_id, user_id, datetime, comment";
    $query .= ") VALUES (";
    $query .= "  {$book_id},'{$_SESSION['user_id']}', '{$dateTimeVariable}', '{$content}'";
    $query .= ") ";
    $new_comment_created = mysqli_query($connection, $query);
 
    if ($new_comment_created) {
        
        
         
        
        
                //get book title 
        $book_query  = "SELECT * FROM books WHERE id={$book_id}"; 
        $book_retrieved = mysqli_query($connection, $book_query);
        if($book_retrieved){
        $book_array= mysqli_fetch_assoc($book_retrieved);
        $book_title=$book_array['title']; 
        $uploaded_by=$book_array['uploaded_by']; 
        
        }else{
            $uploaded_by=2;
        }
        
        
          //Success, send notification to members: IF not you making a comment on your own book. 
        
//        $notification_content = mysql_prep("<i class=\"fa fa-comments\"></i>  New comment on your book: '<a href=\"book_single.php?book_id=".$book_id."\">$book_title</a>'!");
//        
//     //create notification
//    $notifyquery  = "INSERT INTO notifications (";
//    $notifyquery .= "  user_id, datetime, content";
//    $notifyquery .= ") VALUES (";
//    $notifyquery .= " {$book_author},'{$dateTimeVariable}', '{$notification_content}'";
//    $notifyquery .= ") ";
//    $new_notification_created = mysqli_query($connection, $notifyquery);  
        
        
                 
        
        
                        
 //SEND EMAIL 
                
        $email_query  = "SELECT * FROM users WHERE id={$uploaded_by}"; 
        $email_found = mysqli_query($connection, $email_query);  

        if($email_found){
            
    $author= mysqli_fetch_assoc($email_found);
    $name = $author['username'];
    $recipient = $author['email'];

$formcontent=" \r\n Go to Bookshelf to view this comment.\r\n http://bookshelf.isobellennox.com/view.php?book_id=$book_id";
$subject = "Bookshelf: New Comment on your upload";
$mailheader = "New Comment on a book you uploaded: $title ! \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
        
     
        }//end send email
    
        //end create notification
        
        
        
 
        
    // Success
      $_SESSION["message"] = "comment created!";
      redirect_to("view.php?book_id=$book_id"); 
    } else {
      // Failure
     $_SESSION["message"] = "comment Failed!";
        redirect_to("view.php?book_id=$book_id"); 
    }
 
    }else{
  $_SESSION["message"] = "Comment cannot be empty!";
        redirect_to("view.php?book_id=$book_id"); 
      
  }//end confirm no errors in form 
    
    
}
 //determine whose uploads we are looking at
if(isset($_GET['book_id'])){
    $book_id=$_GET['book_id'];
    ?>
 <script type="text/javascript">
     
     
function markViewed() {
  
    //ONCLICK FUNCTION
// AJAX to open up query that inserts view of this book into viewed table
    $.get("add_view.php?book_id=<?php echo $book_id; ?>");
    return false; 
    
         }//end markViewed()
    
     
 </script> 
  <?php
    
     
    //Get # of Views this book has
    $view_count_query  = "SELECT * FROM books_viewed WHERE book_id = {$book_id}";  
    $view_count_result = mysqli_query($connection, $view_count_query);
    $times_read=mysqli_num_rows($view_count_result);
        
    
    
    
    //See if in your bookshelf
      
    $query  = "SELECT * FROM bookshelves WHERE book_id = {$book_id} AND user_id={$_SESSION['user_id']}";  
    $result = mysqli_query($connection, $query);
    $num_rows=mysqli_num_rows($result);
    if($num_rows >= 1){        
        $bookshelf=" <a href=\"add_to_bookshelf.php?remove=".$book_id."\"><i class=\"fa fa-bookmark\"></i>
 Remove From Bookshelf</a>";
    }else{
        $bookshelf=" <a href=\"add_to_bookshelf.php?add=".$book_id."\"><i class=\"fa fa-bookmark-o\"></i>
 Add To Bookshelf</a>";
    }//end see if in bookshelf
    
    //GET BOOK INFO
    
    $query  = "SELECT * FROM books WHERE id = {$book_id}";  
    $result = mysqli_query($connection, $query);
    if($result){
        echo "<h4>Book Details<span class=\"right\">".$bookshelf."</span></h4>";
    foreach($result as $book){
          
        echo "<h2>".$book['title']."<span class=\"right\">";
        
                //GET USER RATINGS                
        $this_rating  = "SELECT * ";
        $this_rating .= "FROM ratings ";
        $this_rating .= "WHERE book_id={$book['id']} ";
        $rating = mysqli_query($connection, $this_rating);
        if($rating){
            $book_rating=array();
            foreach($rating as $rated){
 
                array_push($book_rating, $rated['rating']);
//                 
            }
            //GET AVERAGE RATING
            if(!empty($book_rating)){
                $average_of_book_rating = array_sum($book_rating) / count($book_rating); 
                $average_of_book_rating=ceil($average_of_book_rating);
                //            echo $average_of_book_rating; //echo star rating rounded up
                $average_of_book_rating=$average_of_book_rating;
                //ECHO OUT AVERAGE RATING AS STAR VALUE
                $star_rating=0;
                while($star_rating < $average_of_book_rating){
                    echo "<i class=\"fa fa-star\"></i> ";
                    $star_rating++;
                }
                //ECHO "OUT OF 5" AS STAR VALUE
                $stars_empty=(5-$average_of_book_rating);

                $stars_left=0;
                while($stars_left < $stars_empty){
                    echo "<i class=\"fa fa-star-o\"></i> ";
                    $stars_left++;
                }
                
            }else{
                //rating ==0
                echo "<i class=\"fa fa-star-o\"></i> ";
                echo "<i class=\"fa fa-star-o\"></i> ";
                echo "<i class=\"fa fa-star-o\"></i> ";
                echo "<i class=\"fa fa-star-o\"></i> ";
                echo "<i class=\"fa fa-star-o\"></i> ";
            }
            

        }
        echo "</span></h2>";
        
        
                //GET AUTHOR NAME
            $author_id=$book['author_id'];
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];
        
                        //GET GENRE NAME
                $genre_id=$book['genre'];
//                $find_genre = find_genre_by_id($genre_id);
//                $genre_name= $find_genre['name'];
                $genre_query  = "SELECT * ";
                $genre_query .= "FROM genres ";
                $genre_query .= "WHERE id = {$genre_id} ";
                $genre_set = mysqli_query($connection, $genre_query);
        if($genre_set){
            $genre_array=mysqli_fetch_assoc($genre_set);
            $genre_name=$genre_array['name'];
        }else{
            $genre_name="No Genre Given";
        }
        
        
        
        echo "<h3>Genre: ".$genre_name."</h3>";
        echo "<i class=\"fa fa-eye\"> </i> " . $times_read."<br/>";
        
        echo "<a onclick='markViewed();' href=\"".$book['file']."\">View This Book</a><br/>";
        
        
                //STAR RATINGS
//        echo "Average Rating: #";
        echo "<span class=\"rate right\">
        <a title=\"Rate 1 Star\" href=\"rate.php?book_id=$book_id&rating=1\"><i class=\"fa fa-star-o\"></i></a>
        <a title=\"Rate 2 Stars\"  href=\"rate.php?book_id=$book_id&rating=2\"><i class=\"fa fa-star-o\"></i></a>
        <a title=\"Rate 3 Stars\" href=\"rate.php?book_id=$book_id&rating=3\"><i class=\"fa fa-star-o\"></i></a>
        <a title=\"Rate 4 Stars\" href=\"rate.php?book_id=$book_id&rating=4\"><i class=\"fa fa-star-o\"></i></a>
        <a title=\"Rate 5 Stars\" href=\"rate.php?book_id=$book_id&rating=5\"><i class=\"fa fa-star-o\"></i></a>
        <br/>
        
        </span>
        <br/>
        ";
        
        //GET USER RATINGS                
        $rating_query  = "SELECT * ";
        $rating_query .= "FROM ratings ";
        $rating_query .= "WHERE user_id = {$_SESSION['user_id']} AND book_id={$book['id']} ";
        $rating_set = mysqli_query($connection, $rating_query);
        if($rating_set){
            $rating_array=mysqli_fetch_assoc($rating_set);
            $rating_given=$rating_array['rating'];
             
        }else{
            $rating_given="You have not rated this book!";
        }
       echo "<span class=\"right\">Your rating: ".$rating_given."</span><br/><br/>";
        
        
        echo "<p id=\"description\">".$book['description']."</p>";
        

        
        echo "<div class=\"details left\">Author:</div> <a href=\"view_author.php?author=".$author_id."\">".$name."</a></br>";
        
        //IF BOOK HAS ISBN, SHOW IT
        if($book['ISBN']!=0){
        echo "<div class=\"details left\">ISBN:</div> ".$book['ISBN']."<br/>";
        }
        
        echo "<div class=\"details left\">Published:</div> ".$book['published']."<br/>";
        
        $uploaded_by=find_user_by_id($book['uploaded_by']);
        $username = $uploaded_by['username'];
        
        echo "<div class=\"details left\">Uploaded By:</div> <a href=\"profile.php?user=".$book['uploaded_by']."\">".$username." </a></small><br/>";
        
       
        //EDIT/DELETE OPTIONS IF UPLOADER OF BOOK
        if($book['uploaded_by']==$_SESSION['user_id']){ 
            echo "<div class=\"right\"><a href=\"edit.php?book_id={$book['id']}\"><i title=\"Edit\" class=\"fa fa-pencil\"></i></a> | <a onclick='return confirm(\"DELETE this book?\");' href=\"delete.php?book_id={$book['id']}\"><i title=\"Delete\" class=\"fa fa-trash-o\"></i></a></div>"; 
        }//end manage options
        echo "<br/>";
        
/********************************/
        /* USER COMMENTS*/
/********************************/    
          //FIND USER COMMENTS
        
        //FOREACH COMMENT ECHO COMMENTS

        ?>
        <script>
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
</script>
        
        <h4>Comments On This Book 
        <span class="right"> 
        <span id="new_title" onclick="toggle_visibility('new_comment');" title="Write Comment">
        <i class="fa fa-pencil"></i> 
        <span class="small"> Write Comment</span>
        </span>  
        </span>
       </h4>
       
       
       <span id="new_comment"><br/>
       <form action="#" method="POST">
           <p>Your comment:</p>
           <textarea maxlength="500" name="comment" id="comment" cols="50" rows="5"></textarea><br/>
           <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
           <input type="submit" name="submit" value="Submit">
       </form>
</span>
       <hr/>
        
      
        

         
        
     <?php 
            $find_comments  = "SELECT * ";
            $find_comments .= "FROM comments WHERE book_id={$book['id']} ";
            $find_comments .= "ORDER BY id DESC";
            $comments_found = mysqli_query($connection, $find_comments);
            if($comments_found){
                 foreach($comments_found as $this_comment){
                    $user_id=$this_comment['user_id'];
                    $book_id=$this_comment['book_id'];
                    $datetime=$this_comment['datetime'];
                    $comment=$this_comment['comment'];
                     
                     //GET BOOK DETAILS
        $bookquery  = "SELECT * FROM books WHERE id={$book_id}";  
        $bookresult = mysqli_query($connection, $bookquery);
            if($bookresult){
                $book=mysqli_fetch_assoc($bookresult);
                $title=$book['title'];
                
     $user_query  = "SELECT * FROM users WHERE id={$user_id}";  
        $user_result = mysqli_query($connection, $user_query);
            if($user_result){
                $user=mysqli_fetch_assoc($user_result);
                $username=$user['username'];
                $avatar=$user['avatar'];
                if(empty($avatar)){
            $avatar="http://lorempixel.com/150/150/cats";
        }
                
 ?>
        <div class="comments">
                       <?php
                if($_SESSION['user_id']==$user_id){
//                echo "<a href=\"edit_comment.php\"><i class=\"fa fa-pencil\"></i>";
                echo "<a href=\"delete.php?comment_id=".$this_comment['id']."\"><i class=\"right fa fa-trash-o\"></i></a>";
                }
                ?>
            <section class="avatar left"><img src="<?php echo $avatar; ?>" alt="">
            <br/>
            <strong> <a href="profile.php?user_id=<?php echo $user_id; ?>"> <?php echo $username; ?></a></strong>
            </section>
            <section>
               <p><?php echo $datetime; ?></p>
                <p><?php echo $comment; ?></p>
            </section>

        </div>
   <?php 
                }//end get username 
            } //END GET BOOK DETAILS
                 }
            }else{
                echo "No comments on this book yet!";
            }
   ?>
        
        <?php       
        
        
        
    }//END FOREACH BOOK
}else{
    echo "This book was not found: ".$book_id."";
    }//END GET BOOK DETAILS
    
    
    
}else{
    echo "No Book Was Selected!";
   
}

?>
 
      
        
<?php include("inc/footer.php"); ?>