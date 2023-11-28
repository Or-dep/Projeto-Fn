<?php
  if (isset($_POST['submit'])) {
    $valorBotao = $_POST['valorBotao'];
    echo $valorBotao;
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Passar valores de value de um botão para um label</title>
</head>
<body>
    <form action="dasa.php" method="post">
        <label for="botao">Valor do botão:</label>
        <button type="submit" value="testesPPP" id="botao">
            dasa
        </button>
    </form>
    <?php
        if (isset($_POST['submit'])) {
            $valorBotaoTranscrito = $_POST['button'];
            echo "<p>Valor do botão transcrito: $valorBotaoTranscrito</p>";
        }
    ?>
    <script>
        document.querySelector("#botao").addEventListener("click", function() {
            var valorBotao = document.querySelector("#botao").value;
            document.querySelector("#valor").value = valorBotao;
        });
    </script>
</body>
</html>
