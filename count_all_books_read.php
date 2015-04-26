<?php include("inc/header.php"); 





///get  each distinct book_id
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
                echo "<a href=\"view.php?book_id={$book['id']}\"><div class=\"hover-row book-list\">";
               echo "<span class=\"title\">".$book['title']."</span><br/>";

                    $author_id=$book['author_id'];

                    $find_author  = "SELECT * ";
                    $find_author .= "FROM authors ";
                    $find_author .= "WHERE id = {$author_id} ";
                    $author_set = mysqli_query($connection, $find_author);
                    if($author_set){
                        $author_array=mysqli_fetch_assoc($author_set);
                        $name=$author_array['name'];
                    }


                echo $name."</br><hr/>";
                echo "Viewed ".$times_read." times</br><hr/>";
                echo $book['description']."<br/>";
                echo "</div></a>";
    
    
    }else{
        echo "nothing.";
    }
    
    
    
}



 


include("inc/footer.php"); ?>