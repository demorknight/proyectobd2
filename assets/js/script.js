document.getElementById("boton_sesion").addEventListener("click", login);
document.getElementById("boton_registro").addEventListener("click", register);
window.addEventListener("resize", anchopag);


//declarar variables//
var contenedor_login_register = document.querySelector (".contenedor_login_registro")
var formulario_login = document.querySelector (".container_login")
var formulario_register = document.querySelector (".container_registro")
var caja_trasera_login = document.querySelector (".caja_atras_login")
var caja_trasera_register = document.querySelector (".caja_atras_registro")


function anchopag(){
    if(window.innerWidth > 850){
        caja_trasera_login.style.display = "block";
        caja_trasera_register.style.display= "block";

    }else{
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
    }
}
/*este comando es para que a pesar de que tenga resize, se jauste desde el principio*/
anchopag();


function login(){
    if(window.innerWidth > 850){
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "10px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else{
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
    
}


function register(){
    if(window.innerWidth > 850){
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "435px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";

    } else{

        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";

    }
    

}