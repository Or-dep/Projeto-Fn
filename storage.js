var ctNI = 0
var ctNL = 0
var ct = 0

function buscaAv(botao) {
    window.location = 'storage.php?pedido='+botao;
}

function buscaitem(botao) {
    window.location = 'storage.php?item='+botao;
}

function delet(aa){
    window.location = 'storage.php'+aa;
}


function NewItem(){
    const modal = document.getElementById('rt')
    const md = document.getElementById('edit')
    const mdl = document.getElementById('cadastrolocal')
    ctNI += 1
    ct = 0
    ctNL = 0
    md.classList.remove('ativo')
    mdl.classList.remove('ativo')
    modal.classList.add('ativo')

    if(ctNI == 1){
        modal.addEventListener('click', (e) =>{
            if(e.target.id == 'x' || e.target.id == 'eliminar' || e.target.id == 'salvar'){
                ctNI = 0
                modal.classList.remove('ativo')
            }
        })
    }if(ctNI == 2){
        ctNI = 0
        modal.classList.remove('ativo')
    }
}


function NewLocal(){
    const modal = document.getElementById('cadastrolocal')
    const mdl = document.getElementById('rt')
    const md = document.getElementById('edit')
    ctNI = 0
    ct = 0
    ctNL += 1
    md.classList.remove('ativo')
    mdl.classList.remove('ativo')
    modal.classList.add('ativo')
    
    if(ctNL == 1){
        modal.addEventListener('click', (e) =>{
            if(e.target.id == 'cancelar' || e.target.id == 'salvar'){
                ctNL = 0
                modal.classList.remove('ativo')
            }
        })
    }if(ctNL == 2){
        ctNL = 0
        modal.classList.remove('ativo')
    }
}

function SalvarLocal(){

}



function editItem(){
    const modal = document.getElementById('edit')
    const md = document.getElementById('rt')
    const mdl = document.getElementById('cadastrolocal')
    ct += 1
    ctNI = 0
    ctNL = 0
    md.classList.remove('ativo')
    mdl.classList.remove('ativo')
    //buscaitem(modal.value)
    modal.classList.add('ativo')
    
    if(ct == 1){
        modal.addEventListener('click', (e) =>{
            if(e.target.id == 'X-edit' || e.target.id == 'editEliminar' || e.target.id == 'editSalvar'){
                ct = 0
                modal.classList.remove('ativo')
            }
        })
    }if(ct == 2){
        ct = 0
        modal.classList.remove('ativo')
    }
}

function delet(aa){
    window.location = 'index.php'+aa;
}
function delet2(aa){
    window.location = 'storage.php'+aa;
}