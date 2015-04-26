<?php require_once("functions/session.php"); 
require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php"); 
confirm_logged_in(); ?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Bookshelf</title>
        <meta name="description" content="An interactive PDF library">
<!--        Main stylesheet-->
        <link rel="stylesheet" href="css/style.css">
<!--        link to font awesome-->
         <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!--         GOOGLE FONTS-->
          <link href='http://fonts.googleapis.com/css?family=Merriweather:400,400italic,900italic,900' rel='stylesheet' type='text/css'>
 <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
<!--   JS VERSIONS-->
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.js"></script>
   
    </head>
    
    
    
    
    
    
<body>
     
    <script>
        //FADE OUT MESSAGES
      setTimeout(function() {
          $(".message").fadeOut(800);
      }, 5000);
     </script>
    
    <header id="full">
        <span class="left min-five"><a href="index.php">Bookshelf</a></span>
        
        
<!--        USER ICONS -->
    <span class="right username"><i class="fa fa-user"> </i> <a title="Your Profile" href="profile.php?user=<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['username']; ?></a> | <a title="Upload Book" href="add_book.php"> + <i class="fa fa-book"></i>
</a> | <a title="Your Uplaods" href="user_uploads.php"><i class="fa fa-archive"></i>
</a> | <a title="Your Bookshelf" href="bookshelf.php"> <i class="fa fa-bookmark"></i>
</a> | <a title="Readers You're Following" href="following.php"><i class="fa fa-users"></i>
</a> | <a title="Manage Account Settings" href="settings.php?user=<?php echo $_SESSION['user_id'] ?>"><i class="fa fa-cog"></i></a> | <a title="Log Out" href="logout.php"><i class="fa fa-sign-out"></i></a> </span>
        
<!--   HEADER SEARCH BAR       -->
            
 <form class="center search" id="search_all" action="search.php?all" method="post">
  <?php 
      include("form_suggest2.php");
 ?>
    <input name="query" value="" placeholder="Search Titles, Authors, Usernames..." autocomplete="off" name="author" id="author" value="<?php echo $name; ?>" type="text" onkeyup="showHinthead(this.value)">
    <input type="submit" name="submit" value="&#xf002;" />
<p id="txtHinthead"></p>
 </form> 
          </header>
          
          
          
              <header id="mobile">
        <span class="left"><a href="index.php">Bookshelf</a></span>
        <!--   HEADER SEARCH BAR       -->
            
 <form class="right search" id="search_all" action="search.php?all" method="post">
  <?php 
      include("form_suggest2.php");
 ?>
    <input name="query" value="" placeholder="Search Titles, Authors, Usernames..." autocomplete="off" name="author" id="author" value="<?php echo $name; ?>" type="text" onkeyup="showHinthead(this.value)">
    <input type="submit" name="submit" value="&#xf002;" />
<p id="txtHinthead"></p>
 </form> 
        
<!--        USER ICONS -->
    <div class="center username"><a title="Your Profile" href="profile.php?user=<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['username']; ?></a> | <a title="Upload Book" href="add_book.php"> + <i class="fa fa-book"></i>
</a> | <a title="Your Uplaods" href="user_uploads.php"><i class="fa fa-archive"></i>
</a> |  <a title="Your Bookshelf" href="bookshelf.php"> <i class="fa fa-bookmark"></i>
</a> | <a title="Readers You're Following" href="following.php"><i class="fa fa-users"></i>
</a> | <a title="Manage Account Settings" href="settings.php?user=<?php echo $_SESSION['user_id'] ?>"><i class="fa fa-cog"></i></a> | <a title="Log Out" href="logout.php"><i class="fa fa-sign-out"></i></a> </div>
        

          </header>
        
        
        
        <div class="clearfix" id="page"> 
              <?php echo message(); ?>
              <?php echo form_errors($errors); ?>
         

