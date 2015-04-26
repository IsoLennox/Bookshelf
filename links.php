<?php

$books_query="SELECT * FROM books";
$result = mysqli_query($connection, $books_query);
    if($result){
    foreach($result as $book){
        

?>


<pages>
 
 
<title><?php echo $book['title']; ?></title><a href="view.php?book_id=<?php echo $book['id']; ?>"></a>

<!--
 <span id="link">
<a href="view.php?book_id=<?php echo $book['id']; ?>">
    <h3><?php echo $book['title']; ?></h3> 
</a>
</span>
-->
    
    

<!--
<link><title>HTML a tag</title><url>#?author=This</url></link>

<link><title>CSS background Property</title><url>http://www.w3schools.com/cssref/css3_pr_background.asp</url></link>

<link><title>CSS border Property</title><url>http://www.w3schools.com/cssref/pr_border.asp</url></link>

<link><title>JavaScript Date Object</title><url>http://www.w3schools.com/jsref/jsref_obj_date.asp</url></link>

<link><title>JavaScript Array Object</title><url>http://www.w3schools.com/jsref/jsref_obj_array.asp</url></link>
-->

</pages>


<?php }//end foreach
    } ?>