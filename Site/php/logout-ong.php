<?php
session_start();
unset($_SESSION['id_ong']);

echo "<script>alert('Sessão finalizada');window.location.href='minhas-ongs2.php';</script>";

?>