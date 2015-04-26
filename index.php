<?php include("inc/header.php"); ?>

     
    
    
<!--    LAST 4 UPLOADS   -->
<!--    LAST 4 UPLOADS   -->
<!--    LAST 4 UPLOADS   -->
<!--    LAST 4 UPLOADS   -->
      

    <h4>Recent Uploads <span class="right"> <a title="Browse All Books" href="browse.php"><i class="fa fa-globe"></i> <span class="small">Browse All</span>  
</a> </span></h4>
    <!--show last 4 uploaded to website show who uploaded it -->
    
           <?php
    $query  = "SELECT * FROM books ORDER BY id DESC LIMIT 4";  
    $result = mysqli_query($connection, $query);
    if($result){
        //show latest 4 books if there are any
        foreach($result as $book){
            
            //ORIGINAL BOOK DESIGN
            
            $author_id=$book['author_id'];
            //GET name
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];
            
            	  echo "<a href=\"view.php?book_id={$book['id']}\">";	 
			echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
					echo "<h1 class=\"title\">".$book['title']."</h1>";
//					echo "<h2 class=\"subtitle\">this is the Book Subitle</h2>";
					echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5>
				</div>";
				echo "<div class=\"book-top\"></div>				<div class=\"book-right\"></div></div></a>";
			 
                            
                            
        }
}
 ?>
  
  
  
  
  
<!--  =======================================================-->
 
<!--  TOP VIEWED    -->
<!--  TOP VIEWED    -->
<!--  TOP VIEWED    -->
<!--  TOP VIEWED    -->
   
   
<!--
    <h4>Top 4 Viewed <span class="right"><a href="top_viewed.php"><i class="fa fa-eye"></i>   
<span class="small"> Viewed Books</span> 
</a>
</span> </h4>
-->
    <!--  show most read-->
    <?php
    
//    //get  each distinct book_id
////foreach book id count rows the books appears
//
//$books_views=array();
//function array_push_assoc($array, $key, $value){
//$array[$key] = $value;
//return $array;
//}
//
//
//            $find_views  = "SELECT DISTINCT book_id ";
//            $find_views .= "FROM books_viewed ORDER BY id DESC LIMIT 4";
//            $views_found = mysqli_query($connection, $find_views);
//            if($views_found){
//                 foreach($views_found as $this_book){
//                    $book_id=$this_book['book_id'];
//                     
//                     //GET BOOK COUNT
//    $view_count_query  = "SELECT * FROM books_viewed WHERE book_id = {$book_id}";  
//    $view_count_result = mysqli_query($connection, $view_count_query);
//    $times_read=mysqli_num_rows($view_count_result);
////push book ID and times the appear in viewed table into assoc array, as to sort later and call DB by key
//    $books_views = array_push_assoc($books_views, $book_id, $times_read);          
//                 }
//            }
////Sort books by highest value
// arsort($books_views); 
//
//foreach($books_views as $book_id => $times_read){
// 
//    //GET BOOK DETAILS
//    
//    $get_book  = "SELECT * FROM books WHERE id = {$book_id}";  
//    $book_result = mysqli_query($connection, $get_book);
//    if($book_result){
//        
//        $book=mysqli_fetch_assoc($book_result);
//        
//       
//            $author_id=$book['author_id'];
//            //GET name
//            $find_author = find_author_by_id($author_id);
//            $name= $find_author['name'];
//
// 
//        
//        echo "<a href=\"view.php?book_id={$book['id']}\">";
//        echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
//        echo "<h1 class=\"title\">".$book['title']."</h1>";
//        echo "<h2 class=\"subtitle\">Viewed ".$times_read." times</h2>";
//        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
//        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
//        
//        
//        
//    
//    
//    }else{
//        echo "No Books Have been uploaded.";
//    }
//    
//    
//    
//}
?>
    
 
     
     
 <!--  =======================================================-->    
     
<!--     BOKSHELF    -->
<!--     BOKSHELF    -->
<!--     BOKSHELF    -->
<!--     BOKSHELF    -->

    <h4>Your Bookshelf <span class="right"> <a href="bookshelf.php" title="View More"><i class="fa fa-bookmark"></i> <span class="small"> Your Bookshelf</span> </a> </span> </h4>
    <!--show last 4 added-->
    <?php
        //See what's in your bookshelf
      
    $query  = "SELECT * FROM bookshelves WHERE user_id={$_SESSION['user_id']} ORDER BY id DESC LIMIT 4";  
    $result = mysqli_query($connection, $query);
    $num_rows=mysqli_num_rows($result);
    if($num_rows >= 1){
        //show books
        foreach($result as $get_book){
            //for each book found, find details
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
         echo "You have not added any books to your bookshelf!";
    }
    ?>

   
<!-- =======================================================-->
    
<!--    FROM FOLLOWING -->
<!--    FROM FOLLOWING -->
<!--    FROM FOLLOWING -->
<!--    FROM FOLLOWING -->
    
    
     <h4>From Readers You Follow <span class="right"> <a href="following.php" title="See Who You're Following"><i class="fa fa-users"></i> <span class="small"> Following</span> </a> </span> </h4>
     <!-- show top 4 (read/added to bookshelf/uploaded)? -->
     <!-- in this link: show link to following list -->
 <?php   
     //SEE WHO YOURE FOLLOWING
    $follow_query  = "SELECT * FROM following WHERE you={$_SESSION['user_id']}";  
    $follow_result = mysqli_query($connection, $follow_query);
    $is_following=mysqli_num_rows($follow_result);
    if($is_following >= 1){
//         $following_array=mysqli_fetch_assoc($follow_result);
        foreach($follow_result as $following){

            
            
            //SHOW ONE RANDOM BOOK UPLOADED BY EACH OF WHO YOU"RE FOLLOWING
            
                $query  = "SELECT * FROM books WHERE uploaded_by={$following['following']} ORDER BY RAND() LIMIT 1";  
    $result = mysqli_query($connection, $query);
    if($result){
        //show latest 4 books if there are any
        foreach($result as $book){
            
            
            $author_id=$book['author_id'];
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];
           
            
        echo "<a href=\"view.php?book_id={$book['id']}\">";
        echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
        echo "<h1 class=\"title\">".$book['title']."</h1>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
             
        }
}
            
            
        
        }
    }else{
        echo "You are not following any readers!";
    }
     
     ?>

    
     </div>
        
      
        
<?php include("inc/footer.php"); ?>