<?php
include "conecta_banco.php";

if(isset($_GET["causa"])){

$causa = $_GET["causa"];

$select = $con->query("SELECT nm_causa from tb_causa where nm_causa = '$causa'");
if(mysqli_num_rows($select)== 0)
    $insert = $con->query("INSERT INTO tb_causa (nm_causa) VALUES ('$causa')");
else
    echo "<script> alert('Ja existe')</script>";
}


?>
<form action="#" method="get">

<h2>Causa da ONG*</h2><br>
                        <select name="causa" id="causas" class="input" required>
                        <option selected disabled> Causas</option>
                        <?php 
                        $select = $con->query("SELECT nm_causa from tb_causa");
                        foreach($select as $causa)
                        echo "<option value='$causa'>$causa</option>";
                        ?>
                        </select>
                        <button type="submit">apache_request_headers</button>
</form>