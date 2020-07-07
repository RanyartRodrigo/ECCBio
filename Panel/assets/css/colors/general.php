<?php
header('content-type:text/css');
include "../../../base.php";
include "../../../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$result =$obj->consulta("SELECT color FROM colores");
$numfilas = $result->num_rows;
for ($x=0;$x<$numfilas;$x++) {
    $fila = $result->fetch_object();
    if($x==0)
        $primero=$fila->color;
    if($x==1)
        $segundo=$fila->color;
    if($x==2)
        $cajas=$fila->color;
    if($x==3)
        $texto=$fila->color;
}

if(isset($_GET['color'])){
    $primero="#".$_GET['color'];
}
$fondo=$segundo;
echo <<<FINCSS
.elementoSeleccionado{
background:$texto !important;
color:$segundo !important;
}
.container{
max-width:100%;
background:$primero;
color:$texto;
}
input[type='checkbox']{
background:$segundo !important;
color:$segundo !important;
}
#Lista button, #Contenidos input{
background:$primero !important;
color:$segundo !important;
border:solid 1px $texto;
margin:2px;
}
input[type='checkbox']{
background:$segundo !important;
color:$segundo !important;
}

#Lista button:hover{
background:$segundo !important;
color:$texto;
border:solid 1px $cajas;
margin:2px;
}
.row{
background:$cajas;
}
#Contenidos{
width:100%;
}
html{
//background:$cajas !important;
}
.btn{
color:$primero !important;
background:$segundo !important;
border-color:$segundo !important;
}
.btn-primary{
color:$segundo !important;
background:$primero !important;
border-color:$primero !important;
}
.btn-danger{
color:$cajas !important;
background:$texto !important;
border-color:$primero !important;
}
select {
    background: $primero!important;
    color: $segundo !important;
}
select:hover {
 background: $segundo !important;
    color: $primero !important;
    cursor: pointer;
}
select:hover {
    cursor: pointer;
}

.navbar-top  {
	background-color: $primero;
	border-solid:solid 2px $segundo;
}
.navbar-top .navbar-toggle {
	border-color: $cajas;
}
.navbar-top .navbar-toggle:hover,
.navbar-top .navbar-toggle:focus {
	background-color:$cajas;
}
.navbar-top .navbar-toggle .icon-bar {
	background-color: $segundo;
}

.navbar-top .navbar-brand,
.navbar-top .navbar-nav>li>a,
.navbar-top .dropdown-menu>li>a {
	color: $segundo;
}
.navbar-top .navbar-brand:hover {
	color: $texto;
}

.navbar-top .navbar-nav>.active>a, 
.navbar-top .navbar-nav>.active>a:hover, 
.navbar-top .navbar-nav>.active>a:focus {
	color: $segundo;
	background-color: $primero;
}

.navbar-top .nav>li>a:hover,
.navbar-top .nav>li>a:focus,
.navbar-top .nav .open>a, 
.navbar-top .nav .open>a:hover, 
.navbar-top .nav .open>a:focus,
.nav-pills>li>a:hover,
.nav-pills>li>a:focus {
	background-color: $segundo;
	color:$texto;
}
.navbar-top .navbar-nav>.open>a, 
.navbar-top .navbar-nav>.open>a:hover, 
.navbar-top .navbar-nav>.open>a:focus {
	color: $primero;
}

.navbar-top .navbar-nav>.active>a, 
.navbar-top .navbar-nav>.active>a:hover, 
.navbar-top .navbar-nav>.active>a:focus {
	color: $segundo;
	background-color: $texto;
}

.navbar-top .dropdown-menu {
	border: none;
	background-color: $primero;
}

.navbar-top .dropdown-menu>li>a:hover, 
.navbar-top .dropdown-menu>li>a:focus {
	color: $segundo;
        background-color: $texto;
}

.nav-pills a:hover {
	color: $segundo;
}

.masP, .menosP {
    float: right;
    width: 20px;
    height: 20px;
}
.elemento > h7 {
    width: 8%;
    float: left;    
    text-overflow: ellipsis; 
    height: 30px;
    padding: 5px;
      background: $primero;
    color: $segundo;
    border-bottom: solid 2px ;
    text-align: center;
}
.elemento >p {
    width: 90%;
    float: left;    
    padding: 5px;
        background: $segundo;
    color: $texto;
    border-bottom: solid 2px $texto;
}
.elemento {
    width: auto;
    min-width: 300px;
    background: $cajas;
    padding: 2px;
    overflow: hidden;
}

.elemento:hover >p {
  cursor: pointer;
  background: $texto;
    color: $segundo;
    border-bottom: solid 2px $cajas;

}
.elemento > span {
    height: 30px;
    font-size: 21px;
    margin: auto;
    background: $primero;
    float: left;
    width: 100%;
    text-align: center;
    color: $cajas;
}
.elemento:hover > span {
    background: $primero;
    cursor: pointer;
}
FINCSS;
?>
