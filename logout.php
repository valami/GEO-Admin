<?php
setcookie('user', '0', time() -10);
setcookie('rememberme', '0', time() -10);
ob_start();
session_start();
session_unset();
session_regenerate_id(true);
session_unset();
session_destroy();
session_write_close();
header("Location: ../index.php"); 
?>