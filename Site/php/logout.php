<?php
session_start();
session_destroy();
echo "<script>alert('Sessão finalizada');window.location.href='login.php';</script>";

?>