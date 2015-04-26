<?php require_once("functions/db_connection.php"); 

//THIS FILE GOES WITH FORM_SUGGEST2.PHP

//FOR HEADER

//GET LIST OF AUTHORS

    $find_author  = "SELECT * FROM authors ";
    $author_set = mysqli_query($connection, $find_author);
    if($author_set){
        //for each author in DB put in array
        foreach($author_set as $author){
            $a[] = $author['name'];
        }
    }


//GET BOOK TITLES
    $find_book  = "SELECT * FROM books ";
    $book_set = mysqli_query($connection, $find_book);
    if($book_set){
        //for each book in DB put in array
        foreach($book_set as $book){
            $t[] = $book['title'];
        }
    }


//GET USERNAMES
    $find_user  = "SELECT * FROM users ";
    $user_set = mysqli_query($connection, $find_user);
    if($user_set){
        //for each user in DB put in array
        foreach($user_set as $user){
            $u[] = $user['username'];
        }
    }


// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    
    //loop through authors
    foreach($a as $name) {
        
//    $find_author_id  = "SELECT * FROM authors WHERE name = '{$name}'";
    $find_author_id  = "SELECT * FROM authors WHERE name LIKE '%{$name}%'";
    $author_set_id = mysqli_query($connection, $find_author_id);
    if($author_set_id){
        $author_id=mysqli_fetch_assoc($author_set_id);        
    }
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                //submit value to same page to autofill form
                $hint = "<a href=\"view_author.php?author=".$author_id['id']."\">".$name."</a>";
            } else {
                $hint .= ", <a href=\"view_author.php?author=".$author_id['id']."\">".$name."</a>";
            }
        }
    }//end authors loop
    
    
    
        //loop through bookss
    foreach($t as $title) {
        
    $find_title_id  = "SELECT * FROM books WHERE title = '{$title}'";
    $title_set_id = mysqli_query($connection, $find_title_id);
    if($title_set_id){
        $title_id=mysqli_fetch_assoc($title_set_id);        
    }
        if (stristr($q, substr($title, 0, $len))) {
            if ($hint === "") {
                //submit value to same page to autofill form
                $hint = "<a href=\"view.php?book_id=".$title_id['id']."\">".$title."</a>";
            } else {
                $hint .= ", <a href=\"view.php?book_id=".$title_id['id']."\">".$title."</a>";
            }
        }
    }//end BOOKs loop
    
    
    
        //loop through USERNAMES
    foreach($u as $username) {
        
//    $find_user_id  = "SELECT * FROM users WHERE username = '{$username}'";
    $find_user_id  = "SELECT * FROM users WHERE username LIKE '%{$username}%'";
    $user_set_id = mysqli_query($connection, $find_user_id);
    if($user_set_id){
        $user_id=mysqli_fetch_assoc($user_set_id);        
    }
        if (stristr($q, substr($username, 0, $len))) {
            if ($hint === "") {
                //submit value to same page to autofill form
                $hint = "<a href=\"profile.php?user=".$user_id['id']."\">".$username."</a>";
            } else {
                $hint .= ", <a href=\"profile.php?user=".$user_id['id']."\">".$username."</a>";
            }
        }
    }//end USERNAME loop
    
    
    
}

// Output "" if no hint was found or output correct values
echo $hint === "" ? "" : "<span id=\"get_hint\">".$hint."</div>";
?> 