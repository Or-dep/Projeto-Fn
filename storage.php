<?php 
    session_start();

    include_once('banco.php');

    //Local ok!
    if(isset($_POST['salvarLC'])){
        //print_r($_POST['localname']);
        
        $newlocal = $_POST['localname'];

        $salvarlocal = mysqli_query($instability, "INSERT INTO aux_item_local(NLocal, Movimentacao) VALUES ('$newlocal', NOW())");
    }
    $sqllocal = "SELECT * FROM aux_item_local ORDER BY Id_local DESC";

    //Item ok!
    if(isset($_POST['salvarIt'])){
        /*print_r($_POST['item-name']);
        print_r('<br>');
        print_r($_POST['qtd']);
        print_r('<br>');
        print_r($_POST['local']);*/

        $Itnome = $_POST['item-name'];
        $Quant = $_POST['qtd'];
        $local = $_POST['local'];
        
        $newitem = "INSERT INTO tb_itens(Item, Quantidade, NLocal, Data_edicao, Criacao) VALUES ('$Itnome', '$Quant', '$local', NOW(), NOW())";

        $salvarlocal = mysqli_query($instability, $newitem);
    }
    $sqlitens = "SELECT * FROM tb_itens ORDER BY Id DESC";

    //edição 
    if(isset($_POST['salvarEdit'])){
        print_r($_POST['itemName']);
        print_r('<br>');
        print_r($_POST['qtd']);
        print_r('<br>');
        print_r($_POST['local']);

        /*
        $ctnome = $_POST['Itnome'];
        $CTcontato = $_POST['CTcontato'];
        $previsto = $_POST['previsto'];
        $salvarDD = $_POST['salvarDD'];
        $itens = [];*/
    }

    $resultitens = $instability->query($sqlitens);
    $resultlocal = $instability->query($sqllocal);
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
            <form action="index.php">
                <button onclick="delet('')" type="button" class="navega1"><img src="imagens\testeF1.png" title="Pedidos"></button>
            </form>
            <form action="storage.php">
                <button onclick="delet2('')" type="button" class="navega2"><img src="imagens\bt_item1.png" title="Produtos"></button>
            </form>
        </div>

        <!--Titulo da pagina-->
        <div class="cranio">
            <h1 class="titulo">PRODUTOS</h1>
        </div>
        
        <!--bt add-->
        <div class="btts">
            <button onclick="NewItem()" id="novoitem" class="add1" title="Adicionar Item"><img src="imagens\box2.png">
            </button>
            <button onclick="NewLocal()" class="add2"  title="Adicionar Local">
                <img src="imagens\box4.png">
            </button>
        </div>
    </header>

    <script src="storage.js"></script>

    <div class="interno">

        <!--Outros-->
        <div class="lt">
            <div class="superiorLT">
                <h2>Lista de Itens</h2>
            </div>
            
            <div class="listagem">
                <table class="tb">
                    <?php 
                        while($itenstt = mysqli_fetch_assoc($resultitens)){
                            echo "<tr>";
                            echo "<th>Item: </th>";
                            echo "<td class='infolist1'>".$itenstt['Item']."</td>";
                            echo "<th>Qtd: </th>";
                            echo "<td class='infolist2'>".$itenstt['Quantidade']."</td>";
                            echo "<form action='storage.php' method='post'>";
                            echo "<td><a type='button' class='editarIt' title='Eliminar item' href='deleteIt.php?id=$itenstt[Id]'><img src='imagens\box3.png'></a></td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </div>


        <div class="zonaRt">

            <!--Janela de adição de Local-->
            <div class="cadastrolocal" id="cadastrolocal">
                <h2>CADASTRAR NOVO LOCAL DE ESTOQUE</h2>
                <form action="storage.php" method="post">
                    <div class="inputlocal">
                        <label class="lc" for="item-name">NOME:</label>
                        <input class="nm_it" type="text" name="localname" id="item-name">
                        <button id="cancelar" class="butao" type="button">
                            Cancelar
                        </button>
                        <input type="submit" name="salvarLC" id="salvar" class="butao" value="Salvar">
                    </div>
                </form>
            </div>

   

            <!--Janela de adição de Itens-->
            <div class="rt" id="rt">
                <form class="infos" action="storage.php" method="post">
                    <div class="infos">
                        <div class="linha">
                            <h2>INFORMAÇÕES DO NOVO ITEM</h2>
                            <button id='x' class="btt" type="button">X</button>
                        </div>

                        <div class="inputzone">
                            <label class="ft" for="item-name">Nome:</label>
                            <input class="nm_it" type="text" name="item-name" id="item-name">
                        </div>

                        <div class="inputzone">
                            <label class="ft" for="item-qt">Quantidade:</label>
                            <input class="qt_it" type="number" name="qtd" id="item-qt">
                        </div>

                        
                        <div class="local">
                            <label class="ft">Local:</label>
                            <select name='local' id='id-tem'>
                                <option value="-">-</option>
                                <?php
                                    $resultlocal = $instability->query($sqllocal);
                                    while($locais = mysqli_fetch_assoc($resultlocal)){
                                        echo "<option value='".$locais['NLocal']."'>".$locais['NLocal']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="interagir">
                        <button id="eliminar" onclick="" class="bttC" type="button">
                            <img src="imagens\cancel.png" id="salvar" class="imgaction">Cancelar
                        </button>
                        <button id="salvar" onclick="" class="bttS" type="submit" name="salvarIt">
                            <img src="imagens\salavar.png" id="salvar" class="imgaction">Salvar
                        </button>
                    </div>
                </form>           
            </div>


            <!--Janela de edição de Itens-->
            <div class="edit" id="edit">
                <div class="linha">
                    <h2>INFORMAÇÕES DO ITEM</h2>
                    <button id='X-edit' class="btt" type="button">X</button>
                </div>
                <form class="forms" action="storage.php" method="post">
                    <div class="editzone" id="001">
                        <label class="editft" for="item-name">Nome:</label>
                        <?php 
                            //echo '<label class="editft" for="item-name">'.$itenstt['Item'].'</label>'
                        ?>
                    </div>
                    <div class="editzone">         
                        <label class="editft" for="item-qt">Quantidade:</label>
                        <input class="qt_it" type="number" name="item-qt" id="item-qt">
                    </div>
                    <div class="editzone">
                        <label class="editft">Local:</label>
                        <select name='id-tem' id='id-tem'>
                            <option value="-">-</option>
                            <?php 
                                $resultlocal = $instability->query($sqllocal);
                                while($locais = mysqli_fetch_assoc($resultlocal)){
                                    echo "<option value='".$locais['NLocal']."'>".$locais['NLocal']."</option>";
                                }
                                ?>
                        </select>
                    </div>

                    <div class="interagir">
                        <button onclick="" id="editEliminar" class="bttactionE" type="button">
                            <img id="editEliminar" class="imgaction" src="imagens\box3.png">
                            Eliminar
                        </button>
                        <button onclick="" id="editSalvar" class="bttactionS" title="Salvar">
                            <img id="editSalvar" class="imgaction" src="imagens\box2.png">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>



        </div>
        <script src="storage.js"></script>

    </div>
    <script src="storage.js"></script>
</body>
</html>

