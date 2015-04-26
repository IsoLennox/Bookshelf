<?php include("inc/header.php"); ?>
 
        <h4>Top Viewed <span class="right"><a href="browse.php"><i class="fa fa-clock-o"></i></a> | <i class="fa fa-eye"></i> | <a href="most_popular.php"><i class="fa fa-heart"></i></a></span> </h4>
        
         

    <!--  show most read-->
    <?php
    
    //get  each distinct book_id
//foreach book id count rows the books appears

$books_views=array();
function array_push_assoc($array, $key, $value){
$array[$key] = $value;
return $array;
}


            $find_views  = "SELECT DISTINCT book_id ";
            $find_views .= "FROM books_viewed ";
            $views_found = mysqli_query($connection, $find_views);
            if($views_found){
                 foreach($views_found as $this_book){
                    $book_id=$this_book['book_id'];
                     
                     //GET BOOK COUNT
    $view_count_query  = "SELECT * FROM books_viewed WHERE book_id = {$book_id}";  
    $view_count_result = mysqli_query($connection, $view_count_query);
    $times_read=mysqli_num_rows($view_count_result);
                    // echo "Book ID#:".$book_id." read ".$times_read." times<br/>";
                     
                     //PUT IN ASSOC ARRAY, ORDER BY DESC
                     
//                $books_views=array_push($books_views, $book_id, $times_read);
 
            $books_views = array_push_assoc($books_views, $book_id, $times_read);      
                     
                     
                 }
            }

 arsort($books_views);
//print_r($books_views);

foreach($books_views as $book_id => $times_read){
//    echo "Book ID#".$book_id." Viewed: ".$times_read." times.<br/>";
    //GET BOOK DETAILS
    
    $get_book  = "SELECT * FROM books WHERE id = {$book_id}";  
    $book_result = mysqli_query($connection, $get_book);
    if($book_result){
        
        $book=mysqli_fetch_assoc($book_result);
                

            $author_id=$book['author_id'];
            //GET name
            $find_author = find_author_by_id($author_id);
            $name= $find_author['name'];

 
        
        echo "<a href=\"view.php?book_id={$book['id']}\">";
        echo "<div class=\"book {$book['color']}\"><div class=\"book-cover\">";
        echo "<h1 class=\"title\">".$book['title']."</h1>";
        echo "<h2 class=\"subtitle\">Viewed ".$times_read." times </h2>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
    
    
    }else{
        echo "nothing.";
    }
    
    
    
} 

include("inc/footer.php"); ?>