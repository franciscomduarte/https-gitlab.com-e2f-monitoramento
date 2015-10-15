<?php
session_start();
session_destroy();
session_commit();

echo "<script>location.href='login.php';</script>";
 
?>