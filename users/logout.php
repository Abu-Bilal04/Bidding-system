<?php  
session_start(); 
$f=0;
if (isset($_SESSION["username"]) || isset($_SESSION["email"])) {
    $f = 1;
} else {
    $f = 0;
}
session_destroy(); 

 if($f==0)
 {
?>
<script>
window.location="../login.php";
</script>
<?php
}
if($f==1)
 {
?>
<script>
window.location="dashboard.php";
</script>
<?php
}
  exit;
?>