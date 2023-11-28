<?php 
if(!empty($_GET['id']))
{
    include_once('banco.php');

    $id = $_GET['id'];

    $sqlremove = "SELECT * FROM tb_itens WHERE Id=$id";

    $result = $instability->query($sqlremove);

    if($result->num_rows > 0){
        
        $deleteIt = "DELETE FROM tb_itens WHERE Id=$id";

        $delIt = $instability->query($deleteIt);
    }
}
header('Location: storage.php');

?>