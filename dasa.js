document.querySelector("#botao").addEventListener("click", function() {
    var valorBotao = document.querySelector("#botao").value;
    document.querySelector("#valor").value = valorBotao;
});

document.querySelector("#botao").addEventListener("click", function() {
    var valorBotaoTranscrito = document.querySelector("#botao").value;
    var elemento = document.createElement("p");
    elemento.innerHTML = "Valor do botão transcrito: " + valorBotaoTranscrito;
    document.body.appendChild(elemento);
});