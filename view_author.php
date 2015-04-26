<?php include("inc/header.php");  
$error="";
 
//determine whose uploads we are looking at
if(isset($_GET['author'])){
    
    $author_id=$_GET['author'];
    //GET AUTHOR name
    $find_author = find_author_by_id($author_id);
    $name= $find_author['name'];

    
 ?>
     
 <h4>Books By <?php echo $name; ?> </h4>   
<form class="center search h4_search"  action="search.php?books_by_author=<?php echo $author_id; ?>" method="post">
    <input class="" type="text" name="query" value="" placeholder="Search for titles by this author..." />    
    <input type="submit" name="submit" value="&#xf002;" />
</form> 
 <br/>
<?php
      
    $book_data = "SELECT * FROM books WHERE author_id = {$author_id}";  
    $book_result = mysqli_query($connection, $book_data);
    if($book_result){
        foreach($book_result as $this_book){
            

            
  
        
        echo "<a href=\"view.php?book_id={$this_book['id']}\">";
        echo "<div class=\"book {$this_book['color']}\"><div class=\"book-cover\">";
        echo "<h1 class=\"title\">".$this_book['title']."</h1>";
//        echo "<h2 class=\"subtitle\"> ".$genre_name."</h2>";
        echo "<h5 class=\"author\"><span>written by</span> ".$name."</h5></div>";
        echo "<div class=\"book-top\"></div><div class=\"book-right\"></div></div></a>";
            
            
            
            
            
        }
    }else{ $error= "This author has no books!"; }


}else{ $error= "This author has no books!"; }
     
echo $error; 

?>    

      
        
<?php include("inc/footer.php"); ?>