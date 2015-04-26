<?php require_once("functions/db_connection.php"); 

//THIS FILE GOES WITH FORM_SUGGEST.PHP

//GET LIST OF AUTHORS

    $find_author  = "SELECT * FROM authors ";
    $author_set = mysqli_query($connection, $find_author);
    if($author_set){
        //for each author in DB put in array
        foreach($author_set as $author){
            $a[] = $author['name'];
        }
    }


// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                //submit value to same page to autofill form
//                $hint = "<a href=\"?name=".$name."\">".$name."</a>";
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "" : "Suggestions: ".$hint;
?> 