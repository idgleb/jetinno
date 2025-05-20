<?php

header("Content-type: text/css; charset: UTF-8");

include_once "../funciones.php";

?>

.form-check-input:checked {
background-color: red;
border-color: red;
}

.no-bootstrap * {
all: unset; /* Resetea estilos heredados */
}


* {
margin: 0px;
padding: 0px;
font-family: Verdana, Geneva, Tahoma, sans-serif;
font-size: 10pt;
}

.misombra {
box-shadow: 0px 0px 20px rgb(74, 74, 74);
}

.oculto{
display: none;
}

.imagen_prod{
width: 160px;
padding: 10px;
}

@keyframes animacionHover {
0% {
box-shadow: 0px 0px 0px rgb(0, 0, 0);
}
100% {
box-shadow: 0px 0px 20px rgb(0, 0, 0);
}
}

.hover {
border-radius: 16px;
transition: all 1s ease;
}

.hover:hover {

animation: animacionHover 1s forwards;
}



header {
padding-top: 50px;
height: 700px;
background-size: cover;
background-position: center;
background-image: url(../img/fondo_header.png);
}

.admin_header {
padding-top: 50px;
height: 150px;
background-size: cover;
background-position: center;
background-image: url(../img/fondo_header.png);
}


.width90centr {
width: 80%;
margin: auto;
}

.pt-5 {
padding-top: 50px;
}

.logo {
width: 150px;
height: 39px;
margin-right: 40px;
background-repeat: no-repeat;
background-size: contain;
background-image: url(../img/logo.png);
}

.navarriba {

font-weight: bold;
display: flex;
flex-direction: row;
justify-content: flex-start;
align-items: end;
position: relative;
z-index: 1;
}

.menu {
width: 80%;
display: flex;
flex-direction: row;
justify-content: space-between;
margin-left: 30px;
}

.menu_text {
width: 100%;
display: flex;
flex-direction: row;
justify-content: space-between;
}

.menu a {
margin-left: 10px;
}

.textBaner {
width: 50%;
height: 300px;
margin-top: 50px;
line-height: 1.3;
color: white;
position: relative;
z-index: 2;
}

h1 {
font-size: 40pt;
font-weight: normal;
}

main {
display: flex;
flex-direction: column;
align-items: center;

}

h2 {
font-size: 30pt;
text-align: center;
padding-top: 30px;
padding-bottom: 70px;
}

h3,
ul {
padding: 20px;
}

.col_row {
display: flex;
flex-direction: row;
justify-content: center;
padding: 10px;
align-items: center; /* Alinea los elementos al fondo */
}

.col_row_top {
display: flex;
flex-direction: row;
justify-content: center;
padding: 10px;
}

.caja_producto {
display: flex;
flex-direction: row;
justify-content: center;
align-items: center;
background-color: #d4e9ff;
height: fit-content;
border-radius: 8px;
border-color: black;
border-style: solid;
border-width: 2px;
padding: 5px;
margin: 10px;
box-shadow: 0px 0px 20px rgb(74, 74, 74);
}

.caja_prod_baton {
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
padding: 20px;
}

.baton {
align-content: center;
text-align: center;
padding: 10px;
margin: 10px;
border-radius: 8px;
border-color: black;
border-style: solid;
border-width: 2px;
background-color: rgb(255, 255, 255);
}



.caja_form_mapa {
background-image: url(../img/grano_gota.png);
background-size: cover;
background-position: center;
background-repeat: no-repeat;

width: 90%;
height: 1145px;

display: flex;
flex-direction: row;
align-items: center;

}

.caja_formulario {
box-shadow: 0px 0px 20px rgb(74, 74, 74);
background-color: #83e2ff;
padding: 20px;
border-radius: 10px;
border-style: solid;
width: 50%;
margin: 10px;
}

iframe {
border-style: solid;
width: 760px;
height: 415px;
margin: 70px;
border-radius: 30px;
}

#mapa {

border-radius: 10px;
border-style: solid;
border-color: black;
margin: 40px;
width: 50%;
height: 415px;

}




p {
font-size: 15pt;
margin: 6px;
}

.interval_2punto5 {
line-height: 2.5;
}

.contenedor_maquina_luz {
position: absolute;
top: 0%;
left: 40%;

}

.contenedor_maquina {
position: absolute;
top: 49%;
left: 0%;

}




#luz {
animation-duration: 1s;
animation-iteration-count: initial;
animation-name: rebote;

}

#imgmaquina {
animation-duration: 1.5s;
animation-iteration-count: initial;
animation-name: rebote;
width: 150%;
}

.contenedorgrano1 {
position: absolute;
top: 200px;
left: 80%;
}

#grano1 {
width: 60%;
}

.contenedorgrano2 {
position: absolute;
top: 330px;
left: 45%;
}

#grano2 {
width: 60%;
}

.conteinedor_garantia {
position: absolute;
top: 570px;
left: 20%;
}

#garantia {
width: 60%;
}

a {
text-decoration: none;
color: black;
}

@keyframes rebote {
0% {
margin-left: 900px;
}

100% {
margin-left: 0px;
}
}

.conteinedor_garantia {
animation-duration: 2s;
animation-name: garant;
}

@keyframes garant {
0% {
margin-left: -900px;
}

100% {
margin-left: 0px;
}
}

footer {
height: 400px;
background-image: url(../img/fondo_footer.png);

}

.navabajo {
padding-top: 210px;
font-weight: bold;
display: flex;
flex-direction: row;
justify-content: space-between;
align-items: end;
}

form {
display: inline-block;
align-items: flex-end;
}

label {
display: block;
margin-bottom: 1%;
}

textarea {
width: 100%;
margin-bottom: 4%;
}

input[type=submit],
input {
width: 100%;
margin-bottom: 4%;
}






.modal_cont {
margin: auto;
position: relative;
text-align: justify;
width: 50%;
height: fit-content;

background-color: rgb(255, 255, 255);
border-style: solid;
border-width: 3px;
border-radius: 20px;
box-shadow: 0px 0px 20px rgb(255, 255, 255);

}

.modal_prod {
display: flex;
flex-direction: row;
justify-content: center;
margin: auto;
position: relative;
width: 40%;
height: fit-content;

background-color: rgb(255, 255, 255);
border-style: solid;
border-width: 3px;
border-radius: 20px;
box-shadow: 0px 0px 20px rgb(255, 255, 255);

}

.caja_img_producto_mod {
display: flex;
flex-direction: row;
justify-content: center;
align-items: end;
width: fit-content;
height: 240px;
margin: 10px;
}

.modal_cont a,
.modal_cont batton,
.modal_prod a {
float: inline-end;
padding: 10px;
text-decoration: none;
color: black;
font-size: 20pt;
font-weight: bold;
border-radius: 15px;
}

.modal_cont a:hover,
.modal_cont batton,
.modal_prod a:hover {
color: rgb(0, 110, 255);
}

.modal_cont h2 {
padding: 25px;
}





.parallax {
background-image: url("../img/tecno1.png");
height: fit-content;
background-repeat: no-repeat;
background-attachment: fixed;
background-position: inherit;
min-height: 400px;
background-position: 17%;
display: flex;
flex-direction: row;
justify-content: end;
width: 90%;
margin: auto;

}

.parallax2 {
background-image: url("../img/tecno2.png");
height: fit-content;
background-repeat: no-repeat;
background-position: 17%;
background-attachment: fixed;
min-height: 400px;
display: flex;
flex-direction: row;
justify-content: end;
width: 90%;
margin: auto;
}

.fon_paralax {
height: 30px;
}

.width50right {
width: 65%;
padding: 60px;
}

.window {
width: 65%;
border-style: solid;
border-radius: 30px;
border-color: black;
box-shadow: 0px 0px 20px rgb(74, 74, 74);
}

.menu figure {
display: none;
}


.menu_text a,
.menu a {
padding: 8px;
border-radius: 8px;
}

.menu_text a:hover,
.menu a:hover {
color: rgb(255, 255, 255);
box-shadow: 0px 0px 20px rgb(255, 255, 255);
padding: 8px;
border-radius: 8px;
fill: white;
}


.caja_vertud {
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
text-align: center;
height: fit-content;
padding: 15px;
margin: 10px;
}

.caja_row {
display: flex;
flex-direction: row;
height: fit-content;
padding: 20px;
margin: 10px;
}

.caja_row p {

padding: 10px;
margin: 10px;
}




.baner {
background-image: url("../img/baner.png");
background-size: cover;
/* Ajusta el tamaño del contenedor al tamaño de la imagen */
background-position: center;
background-repeat: no-repeat;
width: 100%;
/* Ajusta el ancho al 100% del contenedor padre */
height: auto;
/* Ajusta la altura automáticamente */
aspect-ratio: 16 / 7.3;
/* Ajusta la relación de aspecto, opcional */
box-shadow: 0px 0px 20px rgb(41, 39, 39);
margin-top: 50px;
margin-bottom: 50px;
display: flex;
flex-direction: column;
align-items: start;
justify-content: left;

text-shadow: 3px 2px 5px rgba(255, 255, 255, 1);
/* Agrega sombra al texto */
}

.baner_text {
text-align: left;
margin-left: 20px;
margin-right: 30%;
line-height: 2.5;
background-color: rgba(255, 255, 255, 0.514);
padding: 10px;
text-shadow: 3px 2px 5px rgba(255, 255, 255, 1);
/* Agrega sombra al texto */
border-radius: 8px;
margin-bottom: 10px;
}

.baner_title {
margin-left: 20px;
}



/* WHATS APP/////////////////////////// */

.conteyner-whatsapp {
display: flex;
flex-direction: row;
align-items: center;
position: fixed;
right: 5%;
bottom: 8%;
padding: 0px !important;
}

.msg-left {
background: #ffffff;
border: 2px solid #5e71ff;
border-radius: 20px;
box-shadow: 4px 5px 5px rgba(0, 0, 0, 0.6);
padding: 10px;
cursor: pointer;
}

.wb-circulo {
background: #25D366;
border: 3px solid #5e71ff;
border-radius: 50%;
box-shadow: 0 8px 10px rgba(7, 206, 112, 0.6);
height: 68px;
width: 68px;
transition: .3s;
-webkit-animation: hoverWave linear 1s infinite;
animation: hoverWave linear 1s infinite;
cursor: pointer;
text-align: center;
}

.text-circulo i {
color: #ffffff;
font-size: 42px;
line-height: 62px;
transition: .3s;
transition: .5s ease-in-out;
animation: 1200ms ease 0s normal none 1 running shake;
animation-iteration-count: infinite;
-webkit-animation: 1200ms ease 0s normal none 1 running shake;
-webkit-animation-iteration-count: infinite;
}

.text-circulo span {
text-align: center;
color: #23a455;
opacity: 0;
font-size: 0;
position: absolute;
right: 10px;
line-height: 68px;
font-weight: 600;
font-family: 'montserrat', Arial, Helvetica, sans-serif;
}

.conteyner-whatsapp:hover i {
display: none;
transition: .3s;
}

.conteyner-whatsapp:hover .wb-circulo {
background: #fff;
transition: .3s;
}

.conteyner-whatsapp:hover .text-circulo span {
transition: .3s;
opacity: 1;
font-size: 11px;
}


@-webkit-keyframes hoverWave {
0% {
box-shadow: 0 8px 10px rgba(7, 33, 180, 0.3), 0 0 0 0 rgba(7, 33, 180, 0.2), 0 0 0 0 rgba(7, 33, 180, 0.2)
}

40% {
box-shadow: 0 8px 10px rgba(7, 33, 180, 0.3), 0 0 0 15px rgba(7, 33, 180, 0.2), 0 0 0 0 rgba(7, 33, 180, 0.2)
}

80% {
box-shadow: 0 8px 10px rgba(7, 33, 180, 0.3), 0 0 0 30px rgba(7, 33, 180, 0), 0 0 0 26.7px rgba(7, 33, 180, 0.067)
}

100% {
box-shadow: 0 8px 10px rgba(7, 33, 180, 0.3), 0 0 0 30px rgba(7, 33, 180, 0), 0 0 0 40px rgba(7, 33, 180, 0.0)
}

}

@keyframes hoverWave {
0% {
box-shadow: 0 8px 10px rgba(7, 33, 180, 0.3), 0 0 0 0 rgba(7, 33, 180, 0.2), 0 0 0 0 rgba(7, 33, 180, 0.2)
}

40% {
box-shadow: 0 8px 10px rgba(7, 33, 180, 0.3), 0 0 0 15px rgba(7, 33, 180, 0.2), 0 0 0 0 rgba(7, 33, 180, 0.2)
}

80% {
box-shadow: 0 8px 10px rgba(7, 33, 180, 0.3), 0 0 0 30px rgba(7, 33, 180, 0), 0 0 0 26.7px rgba(7, 33, 180, 0.067)
}

100% {
box-shadow: 0 8px 10px rgba(7, 33, 180, 0.3), 0 0 0 30px rgba(7, 33, 180, 0), 0 0 0 40px rgba(7, 33, 180, 0.0)
}
}

@keyframes shake {
0% {
transform: rotateZ(0deg);
-ms-transform: rotateZ(0deg);
-webkit-transform: rotateZ(0deg);
}

10% {
transform: rotateZ(-30deg);
-ms-transform: rotateZ(-30deg);
-webkit-transform: rotateZ(-30deg);
}

20% {
transform: rotateZ(15deg);
-ms-transform: rotateZ(15deg);
-webkit-transform: rotateZ(15deg);
}

30% {
transform: rotateZ(-10deg);
-ms-transform: rotateZ(-10deg);
-webkit-transform: rotateZ(-10deg);
}

40% {
transform: rotateZ(7.5deg);
-ms-transform: rotateZ(7.5deg);
-webkit-transform: rotateZ(7.5deg);
}

50% {
transform: rotateZ(-6deg);
-ms-transform: rotateZ(-6deg);
-webkit-transform: rotateZ(-6deg);
}

60% {
transform: rotateZ(5deg);
-ms-transform: rotateZ(5deg);
-webkit-transform: rotateZ(5deg);
}

70% {
transform: rotateZ(-4.28571deg);
-ms-transform: rotateZ(-4.28571deg);
-webkit-transform: rotateZ(-4.28571deg);
}

80% {
transform: rotateZ(3.75deg);
-ms-transform: rotateZ(3.75deg);
-webkit-transform: rotateZ(3.75deg);
}

90% {
transform: rotateZ(-3.33333deg);
-ms-transform: rotateZ(-3.33333deg);
-webkit-transform: rotateZ(-3.33333deg);
}

100% {
transform: rotateZ(0deg);
-ms-transform: rotateZ(0deg);
-webkit-transform: rotateZ(0deg);
}
}

@-webkit-keyframes shake {
0% {
transform: rotateZ(0deg);
-ms-transform: rotateZ(0deg);
-webkit-transform: rotateZ(0deg);
}

10% {
transform: rotateZ(-30deg);
-ms-transform: rotateZ(-30deg);
-webkit-transform: rotateZ(-30deg);
}

20% {
transform: rotateZ(15deg);
-ms-transform: rotateZ(15deg);
-webkit-transform: rotateZ(15deg);
}

30% {
transform: rotateZ(-10deg);
-ms-transform: rotateZ(-10deg);
-webkit-transform: rotateZ(-10deg);
}

40% {
transform: rotateZ(7.5deg);
-ms-transform: rotateZ(7.5deg);
-webkit-transform: rotateZ(7.5deg);
}

50% {
transform: rotateZ(-6deg);
-ms-transform: rotateZ(-6deg);
-webkit-transform: rotateZ(-6deg);
}

60% {
transform: rotateZ(5deg);
-ms-transform: rotateZ(5deg);
-webkit-transform: rotateZ(5deg);
}

70% {
transform: rotateZ(-4.28571deg);
-ms-transform: rotateZ(-4.28571deg);
-webkit-transform: rotateZ(-4.28571deg);
}

80% {
transform: rotateZ(3.75deg);
-ms-transform: rotateZ(3.75deg);
-webkit-transform: rotateZ(3.75deg);
}

90% {
transform: rotateZ(-3.33333deg);
-ms-transform: rotateZ(-3.33333deg);
-webkit-transform: rotateZ(-3.33333deg);
}

100% {
transform: rotateZ(0deg);
-ms-transform: rotateZ(0deg);
-webkit-transform: rotateZ(0deg);
}
}

/* WHATS APP/////////////////////////// */

#ventajamodal
{
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
overflow: auto;
background-color: rgba(0, 0, 0, 0.6);
display: none;
}



#ventajamodal:target
{
display: flex;
flex-direction: row;
justify-content: center;
align-items: center;
position: fixed;
z-index: 3;
}



<?php
listaModal();
?>
{
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
overflow: auto;
background-color: rgba(0, 0, 0, 0.6);
display: none;
}



<?php
listaModalTarget();
?>
{
display: flex;
flex-direction: row;
justify-content: center;
align-items: center;
position: fixed;
z-index: 3;
}