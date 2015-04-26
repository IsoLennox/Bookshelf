<?php 

//THIS FILE GOES WITH GET_HINT2.PHP

//include("inc/header.php"); 

if(isset($_GET['name'])){
    $name=$_GET['name'];
}else{ $name=""; }
?>

<!--     <div id="page">-->
    
 <script>
function showHinthead(str) {
    if (str.length == 0) {
        document.getElementById("txtHinthead").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHinthead").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "get_hint2.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
<!-- PUT IN ADD BOOK "AUTHOR" FORM
 <input autocomplete="off" id="author" value="<?php echo $name; ?>" type="text" onkeyup="showHint(this.value)">
<p><span id="txtHint"></span></p>
-->
<!--
 
 
        
      
        
<?php 
//include("inc/footer.php"); 
?>-->
