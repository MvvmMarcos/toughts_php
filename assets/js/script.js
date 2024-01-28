const password = document.getElementById("password");
const message = document.getElementById("message");
const forca = document.getElementById("forca");
const confirmarSenha = document.getElementById('confirmarSenha"');
password.addEventListener("input", function(){
    if(password.value.length > 0){
        message.style.display = "block";
    }else{
        message.style.display = "none"
    }
    if(password.value.length < 4){
        forca.innerHTML = 'fraca.';
        password.style.borderColor = 'red';
        message.style.color = 'red';
    }else if(password.value.length < 6){
        forca.innerHTML = 'média.';
        password.style.borderColor = 'yellow';
        message.style.color = 'yellow'
    }else if(password.value.length > 6){
        forca.innerHTML = 'forte.';
        password.style.borderColor = 'green';
        message.style.color = 'green'
    }
})
//deletar
// function delToughts(){
//     alert("tem certeza que deseja deletar o pensamento?");
//     return;
// }