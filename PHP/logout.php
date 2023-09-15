<?php
session_start();
session_destroy();
header("Location: Paginaprincipal.php"); 
exit;
?>