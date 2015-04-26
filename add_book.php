<?php include("inc/header.php"); ?>
           <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
 //check isbn availability/if empty
       $(document).ready(function () {
           
    $("#isbn").blur(function () {
      var isbn = $(this).val();
      if (isbn == '') {
        $("#availability").html("");
           $("#i-error input").css({"border": "5px solid #E43633"});
      }else{
          $("#i-error input").css({"border": "1px solid grey"});
        $.ajax({
          url: "validation.php?isbn="+isbn
        }).done(function( data ) {
          $("#availability").html(data);
        });   
      } 
    });
           
           
    $("#title").blur(function () {
      var title = $(this).val();
      if (title == '') {
        $("#availability").html("");
           $("#t-error input").css({"border": "5px solid #E43633"});
      }else{
          $("#t-error input").css({"border": "1px solid grey"});
         
      } 
    });
           
     $("#author").blur(function () {
      var author = $(this).val();
      if (author == '') {
        $("#availability").html("");
           $("#a-error input").css({"border": "5px solid #E43633"});
      }else{
          $("#a-error input").css({"border": "1px solid grey"});
         
      } 
    });
           
    $("#published").blur(function () {
      var published = $(this).val();
      if (published == '') {
        $("#availability").html("");
           $("#p-error input").css({"border": "5px solid #E43633"});
      }else{
          $("#p-error input").css({"border": "1px solid grey"});
         
      } 
    });
           
    $("#description").blur(function () {
      var description = $(this).val();
      if (description == '') {
        $("#availability").html("");
           $("#d-error textarea").css({"border": "5px solid #E43633"});
      }else{
          $("#d-error textarea").css({"border": "1px solid grey"});
         
      } 
    });
           
           $("#year").blur(function () {
      var year = $(this).val();
      if (year == '') {
        $("#availability").html("");
           $("#y-error input").css({"border": "5px solid #E43633"});
      }else{
          $("#y-error input").css({"border": "1px solid grey"});
         
      } 
    });
           
           
  });


// TOGGLE NO ISBN/QUESTION MARK ICON
 
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
        
//SHOW COLOR PREVIEW
    function myfunction(val) {
         var $color=(val);
         var element = document.getElementById('viewColor');
//        element.innerHTML = $color; 
        element.setAttribute("class", $color);

    }
 
</script>
     <?php

if(isset($_GET['add'])){
    
      // validations
  $required_fields = array("title","author", "published");
  validate_presences($required_fields);
  
 
  if (empty($errors) ) {

    $title_raw = $_POST["title"]; 
    $title= strip_tags($title_raw, '<p><a><img><br/><br><br />'); 
    
    $author_raw = $_POST["author"]; 
    $author= strip_tags($author_raw, '<p><a><img><br/><br><br />'); 
    
    
//    $description_raw = $_POST["description"]; 
////    $description= strip_tags($description_raw, '<p><a><img><br/><br><br />');
//        $description= strip_tags($description_raw);
//        $description = str_replace(array(':', '_', '\\', '*', '%', '//', '^'), '', $description);
//        $description=mysqli_real_escape_string($description);
      
    $published= $_POST["published"]; 
    $isbn= $_POST["isbn"]; 
      $isbn = str_replace(array('-'), '', $isbn);
    $color= $_POST["color"]; 
      
//    $genre= $_POST["genre"]; 

 

      // Process the form
        //CHECK FOR DIR

        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {      
            //CREATE DIR and FILE 
        mkdir($target_dir, 0777, true);      
        require_once("inc/upload_file.php");     

    }else{
            //DIRECTORY EXISTS. UPLOAD IMAGE
            require_once("inc/upload_file.php"); 

    
  }
  
  }else{
      
            if(isset($_POST["title"])){
        $title=$_POST["title"];
      }
      
//            if(isset($_POST["description"])){
//        $title=$_POST["description"];
//      }
      
            if(isset($_POST["author"])){
        $title=$_POST["author"];
      }
      
            if(isset($_POST["published"])){
        $title=$_POST["published"];
      }
      
            if(isset($_POST["isbn"])){
        $title=$_POST["isbn"];
      }
      
     ?>
       
     <h4>Upload New Book</h4>
     <h6>Book must be in PDF or ePub format</h6>
     <h6 style="color:red">All fields are required</h6>
     

 
 <form action="add_book.php?add" method="POST" enctype="multipart/form-data">
 
 
      <p id="t-error">Title<span style="color:red">*</span>:
        <input type="text" name="title" id="title" value="" /> </p>
          
          
    <p id="a-error">Author<span style="color:red">*</span>: 
        <?php include("form_suggest.php"); ?>
        <input autocomplete="off" name="author" id="author" value="<?php echo $name; ?>" type="text" onkeyup="showHint(this.value)">
        <p><span id="txtHint"></span></p>
    
    
<!--     <p>Genre:-->
          <?php 
//                $query  = "SELECT * FROM genres ORDER BY name";  
//    $result = mysqli_query($connection, $query);
//    $num_rows=mysqli_num_rows($result);
//    if($num_rows >= 1){
//       echo " <select name=\"color\" id=\"color\" onchange=\"myfunction(this.value);\">";
//        foreach($result as $genre){
//            echo "<option name=\"genre\" value=".$genre['id'].">".$genre['name']."</option>";
//        }
//        
//         echo "</select>";
//    }  
         ?>
<!--    </p>-->
 

  
   <p id="i-error">Enter ISBN<span style="color:red">*</span>:
        <input type="text" name="isbn" id="isbn" value="<?php echo $isbn; ?>" /><i title="This book has no ISBN" onclick="toggle_visibility('no-isbn');" class="fa fa-question-circle"></i>
          <span id="no-isbn"><br/>If you are uploading a personal or unpublished work work with no ISBN, you may enter '0' for the ISBN here.</span>
      </p>
 
          
<!--
          <p id="d-error">Description<span style="color:red">*</span>:
         <textarea maxlength="600" cols="100" rows="5" id="description" name="description" value="<?php echo $description; ?>" ><?php echo $description; ?></textarea>
-->
        
        
        <p id="y-error">Year Of Publication (i.e. 1973)<span style="color:red">*</span>:
        <input maxlength="4" id="year" type="text" name="published" value="<?php echo $published; ?>" /> </p>
        
        
        Upload PDF or ePub<span style="color:red">*</span>: 
        <input type="file" name="image" id="fileToUpload"><br/> <br/> 
        
            Cover Color: <select onchange="myfunction(this.value);" name="color" id="color">
            
            <option name="color" value="beige">Beige</option>
            <option name="color" value="red">Red</option>
            <option name="color" value="purple">Purple</option>
            <option name="color" value="seagreen">SeaGreen</option>
            <option name="color" value="gold">Gold</option>
        </select>
        <div id="viewColor"></div>
        
        <br/>
   
   <div id="availability"></div>
     </form> 
     <div class="padding"></div>
 
 <?php   }
    
}else{
?>
 

     
     <h4>Upload New Book</h4>
     <h6>Book must be in PDF or ePub format</h6>
     <h6 style="color:red">All fields are required</h6>
     

 
 <form action="add_book.php?add" method="POST" enctype="multipart/form-data">
 
      <p id="t-error">Title<span style="color:red">*</span>:
        <input type="text" name="title" id="title" value="" /> </p>
          
          
    <p id="a-error">Author<span style="color:red">*</span>: 
        <?php include("form_suggest.php"); ?> 
        <input autocomplete="off" name="author" id="author" value="<?php echo $name; ?>" type="text" onkeyup="showHint(this.value)">
        <p><span id="txtHint"></span></p>
    
    
<!--     <p>Genre:-->
          <?php 
//                $query  = "SELECT * FROM genres ORDER BY name";  
//    $result = mysqli_query($connection, $query);
//    $num_rows=mysqli_num_rows($result);
//    if($num_rows >= 1){
//       echo " <select name=\"color\" id=\"color\" onchange=\"myfunction(this.value);\">";
//        foreach($result as $genre){
//            echo "<option name=\"genre\" value=".$genre['id'].">".$genre['name']."</option>";
//        }
//        
//         echo "</select>";
//    }  
     ?>
<!--    </p>-->
 

  
   <p id="i-error">Enter ISBN<span style="color:red">*</span>:
        <input type="text" name="isbn" id="isbn" value="" />  <i title="This book has no ISBN" onclick="toggle_visibility('no-isbn');" class="fa fa-question-circle"></i>
          <span id="no-isbn"><br/>Numbers only, no dashes. If you are uploading a personal or unpublished work with no ISBN, you may enter '0' for the ISBN here.</span>
      </p>
      
      
    
    

          
<!--
          <p id="d-error">Description<span style="color:red">*</span>:</p> 
              <textarea maxlength="600" cols="100" rows="5" id="description" name="description" value="" ></textarea>
-->
        
        
        
        <p id="y-error">Year Of Publication (i.e. 1973)<span style="color:red">*</span>:
        <input maxlength="4" id="year" type="text" name="published" value="" /> </p>
        
        
        Upload PDF or ePub<span style="color:red">*</span>: 
        <input type="file" name="image" id="fileToUpload"><br/> <br/> 
        
 
        
        Cover Color: <select name="color" id="color" onchange="myfunction(this.value);">
            
            <option name="color" value="beige">Beige</option>
            <option name="color" value="red">Red</option>
            <option name="color" value="purple">Purple</option>
            <option name="color" value="seagreen">SeaGreen</option>
            <option name="color" value="gold">Gold</option>
        </select>
        <div id="viewColor"></div>
        
        <br/>
   
   <div id="availability"></div>
     </form> 
  <div class="padding"></div>
<?php }//end if submit ?>
    
      
        
<?php include("inc/footer.php"); ?>