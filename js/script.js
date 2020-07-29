
/*---------------------- INICIO ----------------------------*/

let  n = 99;
let ng = 99;

function inicio(){

    main = document.getElementById("main");

    buscando = document.getElementById("coleccion");

    creasion = document.getElementById("creacion");

    main.style.display = "none";

    buscando.style.display = "block";

    creasion.style.display = "none";

}

function thisLink(n) {

    let boton = document.getElementsByClassName("boton");
    let label = document.getElementsByClassName("label");

    for (let i=0; i<boton.length; i++){

        boton[i].style.background = "#0D46AD";

        if (n != ng && i != n){

            boton[i].style.width = "60px";
            label[i].style.display = "none";
        }

    }

    boton[n].style.background = "#4776CD";
    boton[n].style.width = "210px";
    label[n].style.display = "block";

    ng = n;

    if(n==0){

        coleccion();

    }

    if(n==1){

        insertar();

    }

}

function insertar(){

    main.style.display = "none";

    creasion.style.display = "block";

    buscando.style.display = "none";

}

function coleccion(){

    main.style.display = "none";

    creasion.style.display = "none";

    buscando.style.display = "block";

}

function on(n) {

    let boton = document.getElementsByClassName("boton");
    let label = document.getElementsByClassName("label");

    boton[n].style.width = "210px";
    label[n].style.display = "block";

}

function off(n) {

    let boton = document.getElementsByClassName("boton");
    let label = document.getElementsByClassName("label");

    if (n != ng){

        boton[n].style.width = "60px";
        label[n].style.display = "none";

    }

}

function uploadFile(target) {
    document.getElementById("file-name").innerHTML = target.files[0].name;
}

function uploadEditar(target) {
    document.getElementById("file-Editar").innerHTML = target.files[0].name;
}

function uploadPlataforma(target) {
    document.getElementById("file-Plat").innerHTML = target.files[0].name;
}

//Expresiones regulares
let letrasYNumeros = new RegExp(/^[A-Za-z0-9\s.\&.]{1,50}$/);
let imagenValida = new RegExp(/\.(jpg|png|gif|jpeg)$/i);
let regExpEmail = new RegExp(/^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/);


function validacionSelect(campo){

    if (campo.value == 0){

        campo.style.background = "#FDD4D4";

    }else{

        campo.style.background = "#D6FDDF";

    }

}

function validacionTextInput(campo){

    if (campo.value.length == 0 || campo.value.length > 50 || !(letrasYNumeros.test(campo.value))){

        campo.style.background = "#FDD4D4";

    }else{

        campo.style.background = "#D6FDDF";

    }

}

function validacionFile(campo,n) {

    var filebox = document.getElementsByClassName("file-box");

    if (!(imagenValida.test(campo.value))){

        filebox[n].style.background = "#FDD4D4";

    }else{

        filebox[n].style.background = "#D6FDDF";

    }

}

function validacionMail(campo){

    if (campo.value.length  == 0 || campo.value.length > 50 || !(regExpEmail.test(campo.value))){

        campo.style.background = "#FDD4D4";

    }else{

        campo.style.background = "#D6FDDF";

    }

}

function validacion(){

    var todoOk = true;

    var formulario = document.getElementById("formulario");
    var datos = document.getElementsByTagName("input");
    var selects = document.getElementsByTagName("select");
    var filebox = document.getElementsByClassName("file-box");

    /*let numeros = /^[0-9]^/;
    let imagenValida = /^(.*.(?!(jpg|jpeg|png|gif)$))?[^.]*$/i;*/

    //defaultB(datos, selects);

    //plataforma
    if (selects[0].value == 0){

        todoOk = false;
        selects[0].style.background = "#FDD4D4";

    }else{

        selects[0].style.background = "#D6FDDF";

    }

    //njugadores
    if (selects[1].value == 0){

        todoOk = false;
        selects[1].style.background = "#FDD4D4";

    }else{

        selects[1].style.background = "#D6FDDF";

    }

    //nombre
    if (datos[2].value.length < 2 || datos[2].value.length > 50 || !(letrasYNumeros.test(datos[2].value))){

        todoOk = false;
        datos[2].style.background = "#FDD4D4";

    }else{

        datos[2].style.background = "#D6FDDF";

    }

    //genero
    if (datos[3].value.length < 2 || datos[3].value.length > 50 || !(letrasYNumeros.test(datos[3].value))){

        todoOk = false;
        datos[3].style.background = "#FDD4D4";

    }else{

        datos[3].style.background = "#D6FDDF";

    }

    //desarrollador
    if (datos[4].value.length < 2 || datos[4].value.length > 50 || !(letrasYNumeros.test(datos[4].value))){

        todoOk = false;
        datos[4].style.background = "#FDD4D4";

    }else{

        datos[4].style.background = "#D6FDDF";

    }

    //distribuidor
    if (datos[5].value.length < 2 || datos[5].value.length > 50 || !(letrasYNumeros.test(datos[5].value))){

        todoOk = false;
        datos[5].style.background = "#FDD4D4";

    }else{

        datos[5].style.background = "#D6FDDF";

    }

    //caratula
    if(datos[7].value != ""){

        if (!(imagenValida.test(datos[7].value))){

            todoOk = false;
            filebox[0].style.background = "#FDD4D4";

        }

    }else{

        filebox[0].style.background = "#D6FDDF";

    }


    if (todoOk) {

        document.getElementById('formulario').submit();

    }else{

        document.getElementById("error").innerHTML = "<div class='mensajeError'> <img src='img/completeNO.png'> <label>Existen campos con datos inválidos</label> </div>";

    }

}

function validacionEd(){

    var todoOk = true;

    var formulario = document.getElementById("formulario");
    var datos = document.getElementsByTagName("input");
    var selects = document.getElementsByTagName("select");
    var filebox = document.getElementsByClassName("file-box");

    /*let numeros = /^[0-9]^/;
    let imagenValida = /^(.*.(?!(jpg|jpeg|png|gif)$))?[^.]*$/i;*/

    //defaultB(datos, selects);

    //plataforma
    if (selects[2].value == 0){

        todoOk = false;
        selects[2].style.background = "#FDD4D4";

    }else{

        selects[2].style.background = "#D6FDDF";

    }

    //njugadores
    if (selects[3].value == 0){

        todoOk = false;
        selects[3].style.background = "#FDD4D4";

    }else{

        selects[3].style.background = "#D6FDDF";

    }

    //nombre
    if (datos[10].value.length < 2 || datos[10].value.length > 50 || !(letrasYNumeros.test(datos[10].value))){

        todoOk = false;
        datos[10].style.background = "#FDD4D4";

    }else{

        datos[10].style.background = "#D6FDDF";

    }

    //genero
    if (datos[11].value.length < 2 || datos[11].value.length > 50 || !(letrasYNumeros.test(datos[11].value))){

        todoOk = false;
        datos[11].style.background = "#FDD4D4";

    }else{

        datos[11].style.background = "#D6FDDF";

    }

    //desarrollador
    if (datos[12].value.length < 2 || datos[12].value.length > 50 || !(letrasYNumeros.test(datos[12].value))){

        todoOk = false;
        datos[12].style.background = "#FDD4D4";

    }else{

        datos[12].style.background = "#D6FDDF";

    }

    //distribuidor
    if (datos[13].value.length < 2 || datos[13].value.length > 50 || !(letrasYNumeros.test(datos[13].value))){

        todoOk = false;
        datos[13].style.background = "#FDD4D4";

    }else{

        datos[13].style.background = "#D6FDDF";

    }

    //caratula
    if(datos[14].value != ""){

        if (!(imagenValida.test(datos[14].value))){

            todoOk = false;
            filebox[1].style.background = "#FDD4D4";

        }

    }else{

        filebox[1].style.background = "#D6FDDF";

    }

    if (todoOk) {

        document.getElementById('formularioEditar').submit();

    }else{

        document.getElementById("errorEd").innerHTML = "<div class='mensajeError'> <img src='img/completeNO.png'> <label>Existen campos con datos inválidos</label> </div>";

    }

}

function validacionPlat(){

    var todoOk = true;

    var formulario = document.getElementById("formulario");
    var datos = document.getElementsByTagName("input");
    var selects = document.getElementsByTagName("select");
    var filebox = document.getElementsByClassName("file-box");

    //tipo plataforma
    if (selects[4].value == 0){

        todoOk = false;
        selects[4].style.background = "#FDD4D4";

    }else{

        selects[4].style.background = "#D6FDDF";

    }

    //nombre
    if (datos[16].value.length < 2 || datos[16].value.length > 50 || !(letrasYNumeros.test(datos[16].value))){

        todoOk = false;
        datos[16].style.background = "#FDD4D4";

    }else{

        datos[16].style.background = "#D6FDDF";

    }

    //compañia
    if (datos[17].value.length < 2 || datos[17].value.length > 50 || !(letrasYNumeros.test(datos[17].value))){

        todoOk = false;
        datos[17].style.background = "#FDD4D4";

    }else{

        datos[17].style.background = "#D6FDDF";

    }

    //icono
    if(datos[18].value != ""){

        if (!(imagenValida.test(datos[18].value))){

            todoOk = false;
            filebox[2].style.background = "#FDD4D4";

        }

    }else{

        filebox[2].style.background = "#D6FDDF";

    }

    if (todoOk) {

        document.getElementById('formularioPlataforma').submit();

    }else{

        document.getElementById("errorPlat").innerHTML = "<div class='mensajeError'> <img src='img/completeNO.png'> <label>Existen campos con datos inválidos</label> </div>";

    }

}

function submitBusqueda() {

    document.getElementById('formBuscar').submit();

}

/*---------------------------LOGIN--------------------------------*/

function cerrarRegistro() {
    var registro=document.getElementById("registro");
    registro.style.display = "none";
}

function abrirRegistro() {
    var registro=document.getElementById("registro");
    registro.style.display = "block";
}

function cerrarRegistroCorrecto() {
    var registro=document.getElementById("registroCorrecto");
    registro.style.display = "none";
}

function abrirRegistroCorrecto() {
    var registro=document.getElementById("registroCorrecto");
    registro.style.display = "block";
}

function cerrarErrorRegistro() {
    var registro=document.getElementById("errorRegistro");
    registro.style.display = "none";
}

function abrirErrorRegistro() {
    var registro=document.getElementById("errorRegistro");
    registro.style.display = "block";
}

function cerrarErrorLogin() {
    var login=document.getElementById("errorLogin");
    login.style.display = "none";
}

function abrirErrorLogin() {
    var login=document.getElementById("errorLogin");
    login.style.display = "block";
}

function validarRegistro() {

    todoOk = true;

    var datos = document.getElementsByTagName("input");

    if (datos[0].value.length  == 0 || datos[0].value.length > 50 || !(letrasYNumeros.test(datos[0].value))){

        todoOk = false;
        datos[0].style.background = "#FDD4D4";

    }else{

        datos[0].style.background = "#D6FDDF";

    }

    if (datos[1].value.length  == 0 || datos[1].value.length > 50 || !(letrasYNumeros.test(datos[1].value))){

        todoOk = false;
        datos[1].style.background = "#FDD4D4";

    }else{

        datos[1].style.background = "#D6FDDF";

    }

    if (datos[2].value.length  == 0 || datos[2].value.length > 50 || !(regExpEmail.test(datos[2].value))){

        todoOk = false;
        datos[2].style.background = "#FDD4D4";

    }else{

        datos[2].style.background = "#D6FDDF";

    }

    if(todoOk){
        document.getElementById('formularioRegistro').submit();
    }

}

function validarLogin(){
    document.getElementById('formularioLogin').submit();
}

/*------------------EDITAR-----------------*/

function cerrarEditar() {
    var edicion = document.getElementById("backEd");
    edicion.style.display = "none";
}

function abrirEditar() {
    var edicion = document.getElementById("backEd");
    edicion.style.display = "block";
}

/*----------------AJAX-----------------*/

function ajax() {
    try {
        req = new XMLHttpRequest();
    } catch(err1) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                req = false;
            }
        }
    }
    return req;
}


//Borrar Videojuego
var borrar = new ajax();
function borrarVideojuego(id) {

    if(confirm("¿Desea eliminar el videojuego de la Base de Datos?")) {
        var myurl = 'gestor/llamadas/borrarVideojuego.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open("GET", modurl, true);
        borrar.onreadystatechange = borrarVideojuegoResponse;
        borrar.send(null);
    }

}

function borrarVideojuegoResponse() {

    if (borrar.readyState == 4) {
        if(borrar.status == 200) {

            var listaVideojuegos = borrar.responseText;

            document.getElementById('listaTotal').innerHTML =  listaVideojuegos;
        }
    }
}

//Borrar Caratula
var borrarCaratulaV= new ajax();
function borrarCaratula(id) {

    if(confirm("¿Desea eliminar la carátula del videojuego actual?")) {
        var myurl = 'gestor/llamadas/borrarCaratula.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrarCaratulaV.open("GET", modurl, true);
        borrarCaratulaV.onreadystatechange = borrarCaratulaResponse;
        borrarCaratulaV.send(null);
    }

}

function borrarCaratulaResponse() {

    if (borrarCaratulaV.readyState == 4) {
        if(borrarCaratulaV.status == 200) {

            var noCaratula = borrarCaratulaV.responseText;

            document.getElementById('caratulaEditar').innerHTML =  noCaratula;

        }
    }
}

/*------------PLATAFORMAS----------------*/

function cerrarPlataforma() {
    var plataforma = document.getElementById("backPlat");
    plataforma.style.display = "none";
}

function abrirPlataforma() {
    var plataforma = document.getElementById("backPlat");
    plataforma.style.display = "block";
}
