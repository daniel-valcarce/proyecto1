<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
require_once 'sistema.php';
error_reporting(0);
session_start();
class Oper_Phone extends sistema{
   function __construct() {
       parent::__construct();
   }
   public function __destruct() {
       parent::__destruct();
   }

   public function verificar($sql){
   	 $conexion=$this->pdo->prepare($sql);
        if($conexion->execute()){
         if($conexion->rowCount()===0){
         		return false;
         }else{
         	while($datoss = $conexion->fetch()){
         		$infor[]=$datoss;
         	}
         	return $infor;
         }
   }
	}
}
	$objeto_operacion= new Oper_Phone();
	
	if(isset($_POST["usuario"])){
		$cedula =htmlspecialchars(trim($_POST["usuario"]));
		$clave =htmlspecialchars(trim($_POST["password"]));
	 $sql="select personas.id_persona, acceso.id_perfil, perfil.nomb_perfil, personas.nombres, personas.apellidos, personas.cedula from personas join acceso join perfil where personas.cedula='$cedula' AND acceso.clave='$clave' and personas.id_persona=acceso.id_persona and acceso.id_perfil=perfil.id_perfil";
	 
	 if($informacion=$this->verificar($sql)){
	 	echo json_encode($informacion);

	 }else{
	 	echo json_encode(array("value"=>"Usuario No Registrado"));
	 }

	}