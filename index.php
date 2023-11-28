<?php 
  session_start();

  include_once('banco.php');

  if(isset($_POST['salvar'])){
    $ctnome = $_POST['CTnome'];
    $CTcontato = $_POST['CTcontato'];
    $previsto = $_POST['previsto'];
    //$salvarDD = $_POST['salvarDD'];
    $itens = [];

    /*
    if($salvarDD==1){
        $salvardados = mysqli_query($instability, "INSERT INTO tb_cliente(Nome_cliente, Contato,	Data_de_emissao) VALUES ('$ctnome', '$CTcontato', NOW())");
    }*/
    
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
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pedidos-H.css">
    <link rel="stylesheet" href="janela-Flut.css">
    <title>Quick Stock</title>
  </head>

  <body>
    <script src="index.js"></script>
    <header>

      <!--Navegação-->
      <div class="navegate">
            <form action="index.php">
                <button onclick="delet('')">Pedidos</button>
            </form>
            <form action="storage.php">
                <button onclick="delet2('')">Produtos</button>
            </form>
        </div>

      <!--Titulo da pagina-->
      <div class="cranio">
        <h1 class="titulo">PEDIDOS</h1>
      </div>

      <!--Outros-->
      <div class="cranio">
        <button onclick="NewPedido()" class="add">
          <h2>NOVO PEDIDO</h2>
        </button>
      </div>
    </header>

    <!--Conteudo do pagina-->
    <div class="interno">

      <!--lado esquerdo-->
      <div class="left">
        <div class="atta">
          <label>Pedidos:</label>
        </div>
        <div class="listagem">
          <table class="tb">
            <?php
            while($user_dt = mysqli_fetch_assoc($resultCT)){
              echo "<tr>";
              echo "<th scope='col'>Id:</th>";
              echo "<td class='pdd'>".$user_dt['Id_pedido']."</td>";
              echo "<th scope='col'>Nome:</th>";
              echo "<td class='pdd'>".$user_dt['Nome_cliente']."</td>";
              echo "<td><button onclick='buscaAv(".$user_dt['Id_pedido'].")'>+Info</button></td>";
              echo "</tr>";
            }
            ?>
          </table>
        </div>
      </div>

      <!--lado direito-->
      <div class="right">
        <div class="topPdd">
          <tbody>
            <table class="tb">
              <?php
                if(!empty($_GET['search'])){ 
                  $busca = $_GET['search'];
                  $buscapdd = "SELECT * FROM tb_pedido_cp WHERE Id_pedido LIKE '$busca' ORDER BY Id_pedido DESC";
                  $resultPDD = $instability->query($buscapdd);
                  while($cabe_pdd = mysqli_fetch_assoc($resultPDD)){
                    echo "<tr>";
                    echo "<th class='pdinfos'>Id:</th>";
                    echo "<td class='trinfo'>".$cabe_pdd['Id_pedido']."</td>";
                    echo "<th class='pdinfos'>Nome:</th>";
                    echo "<td class='trinfo' >".$cabe_pdd['Nome_cliente']."</td>";
                    echo "<th class='pdinfos'>Contato:</th>";
                    echo "<td class='trinfo' >".$cabe_pdd['Contato']."</td>";
                    echo "<th class='pdinfos'>Emissão:</th>";
                    echo "<td class='trinfo' >".$cabe_pdd['Data_Emissao']."</td>";
                    echo "<th class='pdinfos'>Previsão:</th>";
                    echo "<td class='trinfo' >".$cabe_pdd['Data_Prevista']."</td>";
                    echo "<td><a class='bct' href='delete.php?id=$cabe_pdd[Id_pedido]'>Deletar</a></td>";
                    echo "</tr>";
                  }
                }
              ?>
            </table>
          </tbody>
        </div>
        
        <div class="infoPdd">
          <div class="descriPdd">
            <div class="alinhando">
              <?php
                if(!empty($_GET['search'])){ 
                  $busca = $_GET['search'];
                  $buscapdd = "SELECT * FROM tb_pedido_cp WHERE Id_pedido LIKE '$busca' ORDER BY Id_pedido DESC";
                  $resultInfo = $instability->query($buscapdd);
                  while($info_pdd = mysqli_fetch_assoc($resultInfo)){
                    for ($nt = 1; $nt <= 10; $nt++){
                      if($nt == 10){
                        $contador = $nt;
                      }else{
                        $contador = "0".$nt;
                      }
                      if($info_pdd['Itens_'.$contador] !== '-' || $info_pdd['Quantidade_'.$contador] > 0){
                        echo "<table class='itemPdd'>";
                        echo "<tr>";
                        echo "<th class='ite'>item:</th>";
                        echo "<td class='ite'>".$info_pdd['Itens_'.$contador]."</td>";
                        echo "<th class='ite'>Quantidade:</th>";
                        echo "<td class='ite'>".$info_pdd['Quantidade_'.$contador]."</td>";
                        echo "</tr>";
                        echo "</table>";
                      }if($info_pdd['Quantidade_'.$contador] == '-'){

                      }if($info_pdd['Itens_'.$contador] == ''){

                      }
                    }
                  }
                }
              ?>
            </div>
          </div>
        </div> 
      </div>
    </div>

    

    <!--Configuração para janela flutuante-->
    <div class="Bkflutuante" id="Bkflutuante">
      <div class="Jnflutuante">
        <div class="ttpedido">
          <h1>Novo Pedido</h1>
        </div>

          <form action="index.php" method="POST">
            <div class="infos">
              <label class="dados" for="cliente">Cliente:</label>
              <input type="text" name="CTnome" id="cliente" placeholder="Digite o Nome do cliente">
              <label class="dados" for="Contato">Contato:</label>
              <input type="text" name="CTcontato" id="Contato" placeholder="Digite algum contato">
            </div>
          
            <div class="infos">
              <label class="dados" for="previsao">Previsão:</label>
              <input type="date" name="previsto" id="previsao">
            </div>

            <!--
            <div class="infos">
              <label class="ttpedido" for="salvarCt">Salvar dados de cliente:</label>
              <input type="radio" name="salvarDD" id="salvarCt" value="1">
              <label class="ttpedido" for="salvarDD">Sim</label>
              <input type="radio" name="salvarDD" id="salvarCt" value="0">
              <label class="ttpedido" for="salvarDD">Não</label>
            </div>
            
            <div class="infos">
              <button type="button" onclick="createInputs()" id="bt-add" class="btAdd">+</button>
            </div>
            -->

            <div class="box">
              <div class="caixa" id="caixa1">
                <div class="alin">
                  <label class="legenda">Item:</label>
                    <select name='1°item' id='id-tem'>
                      <option value="-">-</option>
                      <?php
                        $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                        $resultlocal = $instability->query($sqlIts);
                        while($its = mysqli_fetch_assoc($resultlocal)){
                            echo "<option value='".$its['Item']."' name='1°item'>".$its['Item']."</option>";
                        }
                      ?>
                    </select>
                    <label class="legenda" for="1°item-Qt">Quantidade:</label>
                    <input class='quantidade' type='number' autocomplete='off' name='1°item-Qt' id='1°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                    <label class="nada">' ' '</label>
                
                </div>
              </div>
              <div id="box" class="inputzone">

                <!--2-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='2°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='2°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="2°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='2°item-Qt' id='2°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>

                <!--3-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='3°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='3°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="3°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='3°item-Qt' id='1°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>

                <!--4-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='4°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='4°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="4°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='4°item-Qt' id='4°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>

                <!--5-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='5°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='5°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="5°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='5°item-Qt' id='5°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>

                <!--6-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='6°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='6°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="6°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='6°item-Qt' id='6°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>

                <!--7-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='7°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='7°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="7°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='7°item-Qt' id='7°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>

                <!--8-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='8°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='8°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="8°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='8°item-Qt' id='8°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>

                <!--9-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='9°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='9°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="9°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='9°item-Qt' id='9°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>

                <!--10-->
                <div class="alin">
                    <label class="legenda">Item:</label>
                      <select name='10°item' id='id-tem'>
                        <option value="-">-</option>
                        <?php
                          $sqlIts = "SELECT * FROM tb_itens ORDER BY Id DESC";
                          $resultlocal = $instability->query($sqlIts);
                          while($its = mysqli_fetch_assoc($resultlocal)){
                              echo "<option value='".$its['Item']."' name='10°item'>".$its['Item']."</option>";
                          }
                        ?>
                      </select>
                      <label class="legenda" for="10°item-Qt">Quantidade:</label>
                      <input class='quantidade' type='number' autocomplete='off' name='10°item-Qt' id='10°item-Qt' placeholder='Somente numeros' max='20' min='1'>
                      <label class="nada">' ' '</label>
                  
                </div>
              </div>

              <div class="btzone">
                <input type="button" type="button" id="cancelar" class="cancelar" value="Cancelar">
                <input type="button" onclick="NewPedido()" type="button" id="cancelar" class="cancelar" value="Cancelar">
                <input type="submit" name="salvar" id="salvar" class="salvar" value="Salvar">
              </div>
          </form>
      </div>
    </div>

    <script src="index.js"></script>

  </body>
</html>