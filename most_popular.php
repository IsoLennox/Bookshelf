<?php include("inc/header.php"); ?>
 
        <h4>Most Popular<span class="right"><a href="browse.php"><i class="fa fa-clock-o"></i></a> | <a href="top_viewed.php"><i class="fa fa-eye"></i></a> | <i class="fa fa-heart"></i></span> </h4>
        

    
    <!--  show most read-->
    <?php
    
    //get  each distinct book_id
//foreach book id count rows the books appears

$books_added=array();
function array_push_assoc($array, $key, $value){
$array[$key] = $value;
return $array;
}


            $find_views  = "SELECT DISTINCT book_id ";
            $find_views .= "FROM bookshelves ";
            $views_found = mysqli_query($connection, $find_views);
            if($views_found){
                 foreach($views_found as $this_book){
                    $book_id=$this_book['book_id'];
                     
                     //GET BOOK COUNT
    $view_count_query  = "SELECT * FROM bookshelves WHERE book_id = {$book_id}";  
    $view_count_result = mysqli_query($connection, $view_count_query);
    $times_added=mysqli_num_rows($view_count_result);
     //PUT IN ASSOC ARRAY, ORDER BY DESC
    $books_added = array_push_assoc($books_added, $book_id, $times_added);      
                     
                     
                 }
            }
//sort book array by value
 arsort($books_added);

foreach($books_added as $book_id => $times_added){

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
        echo "<h2 class=\"subtitle\">Added to ".$times_added." Bookshelves </h2>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
    
    
    }else{
        echo "nothing.";
    }
    
    
    
} 

include("inc/footer.php"); ?>