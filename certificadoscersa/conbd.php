<?php 
function Conectarse() 
{ 
   if (!($link=mysql_connect("localhost","root",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("aulacers_clientespotenciales",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
} 


$mysqli = new mysqli("localhost","aulacers_joserq","4v^]o~)t$;;e","aulacers_clientespotenciales"); 
   
   if(mysqli_connect_errno()){
      echo 'Conexion Fallida : ', mysqli_connect_error();
      exit();
   }
?>