<?php include("inc/header.php"); ?>
 
    <h4>All Uploads <span class="right">
    <i class="fa fa-clock-o"></i>
 | <a title="Most Viewed" href="top_viewed.php"><i class="fa fa-eye"></i>
</a> | <a title="Most Popular" href="most_popular.php"><i class="fa fa-heart"></i>
</a> | 
  
    <?php 
    $query  = "SELECT * FROM genres ORDER BY name";  
    $result = mysqli_query($connection, $query);
    $num_rows=mysqli_num_rows($result);
    if($num_rows >= 1){
         echo "<form id=\"inline\" action=\"browse.php\" method=\"POST\">";           
 echo "<select id=\"genre\" name=\"genre\" onchange=\"this.form.submit()\" >";
//       echo " <select name=\"genre\" id=\"genre\">";
        echo "<option name=\"\" value=\"\">By Genre</option>";
        echo "<option name=\"\" value=\"\">All Genres</option>";
        foreach($result as $genre){
            echo "<option name=\"genre\" value=".$genre['id'].">".$genre['name']."</option>";
        }
         echo "</select></form>";
    } ?> 
    
    
    </span> </h4>



    
<!--    ADD DROPDOWN TO BROWSE BY GENRE -->
 
    
           <?php

if(isset($_POST['genre'])){
    if(empty($_POST['genre'])){
        $query  = "SELECT * FROM books ORDER BY id DESC"; 
        $genre_name="";
        
    }else{
    $genre_id=$_POST['genre'];
    $query  = "SELECT * FROM books WHERE genre={$genre_id} ORDER BY id DESC";
         
    $namequery  = "SELECT * FROM genres WHERE id={$genre_id}";  
    $nameresult = mysqli_query($connection, $namequery);
//    $num_rows=mysqli_num_rows($result);
//    if($num_rows >= 1){}
    if($nameresult){ 
        $genre_found=mysqli_fetch_assoc($nameresult);
        $genre_name=$genre_found['name'];}
    }
}else{
    $query  = "SELECT * FROM books ORDER BY id DESC"; 
    $genre_name="";
}

echo "<h3>".$genre_name."</h3>";

    $result = mysqli_query($connection, $query);
    if($result){
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

include("inc/footer.php"); ?>