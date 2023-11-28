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
        
        <!--bt add-->
        <div>
            <button onclick="NewItem()" class="add">
                <h2>NOVO ITEM</h2>
            </button>
        </div>
        <script src="storage.js"></script>
    </header>
    <div class="interno">

        <!--Outros-->
        <div class="lt">
            <div class="superiorLT">
                <h2>Exemplo</h2>
            </div>
            
            <div class="listagem">
                <table class="tb">
                    <tr>
                        <th>Item: </th>
                        <td>nome_teste01</td>
                        <th>Qtd:</th>
                        <td>qtd_teste01</td>
                        <td><button onclick='buscaAv()'>Editar</button></td>
                    </tr>
                    <?php /*
                        while($user_dt = mysqli_fetch_assoc($resultCT)){
                        echo "<tr>";
                        echo "<th scope='col'>Item:</th>";
                        echo "<td class='pdd'>".$user_dt['Id_pedido']."</td>";
                        echo "<th scope='col'>Qtd:</th>";
                        echo "<td class='pdd'>".$user_dt['Nome_cliente']."</td>";
                        echo "<td><button onclick='buscaAv(".$user_dt['Id_pedido'].")'>+Info</button></td>";
                        echo "</tr>";
                        }*/
                    ?>
                </table>
            </div>
        </div>


        <!--Janela de adição de itens-->
        <div class="rt">
            <div class="infos">
                <h2>Informações do Item</h2>
                <button id='x' class="btt">X</button>
                <div class="inputzone">
                    <label class="ft" for="item-name">NOME:</label>
                    <input class="nm_it" type="text" name="item-name" id="item-name">
                    <label class="ft" for="item-qt">QUATIDADE:</label>
                    <input class="qt_it" type="number" name="item-qt" id="item-qt">
                </div>
                <div class="local">
                    <label class="ft">LOCAL:</label>
                    <select name='id-tem' id='id-tem'>
                        <option value="1">1</option>
                        <option value="outro">outro</option>
                    </select>
                    <!--
                    <input class="lc_it" type="text" name="item-local" id="item-local">-->
                </div>
            </div>

            <div class="interagir">
                <button id="eliminar" onclick="" class="btt">
                    Eliminar
                </button>
                <button id="salvar" onclick="" class="btt">
                    Salvar
                </button>
            </div>
            <script src="storage.js"></script>
        </div>

        <!--Janela de edição de itens-->
        <div class="edit">
            <div class="infos">
                <h2>Informações do Item</h2>
                <div class="inputzone">
                    <label class="ft" for="item-name">NOME:</label>
                    <?php 
                        //echo '<label class="ft" for="item-name">"Nome do item"</label>'
                    ?>                 
                    <label class="ft" for="item-qt">QUATIDADE:</label>
                    <input class="qt_it" type="number" name="item-qt" id="item-qt">
                </div>
                <div class="local">
                    <label class="ft">LOCAL:</label>
                    <select name='id-tem' id='id-tem'>
                        <option value="1">1</option>
                        <option value="outro">outro</option>
                    </select>
                </div>
            </div>

            <div class="interagir">
                <button onclick="" class="btt">
                    Eliminar
                </button>
                <button onclick="" class="btt">
                    Salvar
                </button>
            </div>
            <script src="storage.js"></script>
        </div>

    </div>
    

</body>
</html>

