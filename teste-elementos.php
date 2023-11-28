<?php 
  session_start();

  include_once('banco.php');

  if(isset($_POST['salvar'])){
    $ctnome = $_POST['CTnome'];
    $item = $_POST['CTcontato'];
    $quantidade = $_POST['previsto'];
    $itens = [];

    
    for ($nt = 1; $nt <= 10; $nt++){
        if(isset($_POST[$nt.'°item'])){
          $x = $_POST[$nt.'°item'];
          $y = $_POST[$nt.'°item-Qt'];
          if($x == ""){
            $itens[] = ['item' => "'-'", 'qt' => "''",];
          }else{
            $itens[] = ['item' => "'".$x."'", 'qt' => "'".$y."'",];
          }
        }else{
          $itens[] = ['item' => "'-'", 'qt' => "''",];
        }
    }
    $spd = "INSERT INTO tb_pedido_cp(Nome_cliente, Contato,	Data_Emissao, Data_Prevista, Itens_01, Quantidade_01, Itens_02, Quantidade_02, Itens_03, Quantidade_03, Itens_04, Quantidade_04, Itens_05, Quantidade_05, Itens_06, Quantidade_06, Itens_07, Quantidade_07, Itens_08, Quantidade_08, Itens_09, Quantidade_09, Itens_10, Quantidade_10) VALUES ('$ctnome', '$CTcontato', NOW(), '$previsto'";
    foreach ($itens as $it){
      if(isset($it)){
        $spd .= ', '.$it['item'].', '.$it['qt'].' ,';
        $spd = substr($spd, 0, -2);
      }
    }
    $spd .= ')';
    $newpdd = mysqli_query($instability, $spd);
  }


  $sqlCT = "SELECT * FROM tb_pedido_cp ORDER BY Id_pedido DESC";

  if(!empty($_GET['search'])){ 
      $busca = $_GET['search'];
      //echo "Foi! tudo ok meu fela! ".$busca;
      
      $buscapdd = "SELECT * FROM tb_pedido_cp WHERE Id_pedido LIKE '$busca' ORDER BY Id_pedido DESC";
      $resultPDD = $instability->query($buscapdd);
      $resultInfo = $instability->query($buscapdd);
  }

  $resultCT = $instability->query($sqlCT);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="storage.css">
    <title>Quick Stock</title>
  </head>

  <body>
    <header>
      <!--Navegação-->
      <div class="navegate">
        <form action="" method="">
          <button onclick="" type="button" class="navegaH">H</button>
        </form>
        <form action="" method="">
          <button type="button" class="navega">P</button>
        </form>
      </div>
    
      <!--Titulo da pagina-->
      <div class="cranio">
        <h1 class="titulo">PRODUTOS</h1>
      </div>
      <div></div>

    </header>
    <div class="interno">

      <!--Outros-->
      <div class="left">
      <h1>teste</h1>
    <select name='' id=''>
      <?php 
        while($user_dt = mysqli_fetch_assoc($resultCT)){
          echo '<option value='.$user_dt['Id_pedido'].'>'.$user_dt['Id_pedido'].'</option>';
        }
      ?>
    </select>
      </div>
      <div class="left">
          <button onclick="" class="add">
              <h2>NOVO ITEM</h2>
          </button>
      </div>

  </div>

  </body>
</html>