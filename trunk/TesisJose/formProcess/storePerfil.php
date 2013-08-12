<?php
	include_once '../classes/Constants.php';
	include_once '../classes/UsuarioDTO.php';
	include_once '../classes/DBUtil.php';
	include_once '../classes/SessionUtil.php';
	
	session_start();
	
	//falta el criterio de filtro para esta pagina
	$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
		
	$query = "UPDATE usuario SET "
			." nombre='".$_POST["nombre"]."',"
			." apellido='".$_POST["apellido"]."',"
			.($_POST["clave"] != "" ? " clave=MD5('".$_POST["clave"]."'), " : "")
			." timeout=".$_POST["tiempoSesion"].", "
			." registros_por_pagina=".$_POST["registrosPorPagina"]
			." WHERE id=".$userDTO->getId();
		
	DBUtil::executeQuery($query);
		
	//actualizamos en session los valores
	$newUserDTO = new UsuarioDTO($userDTO->getId(),
			$_POST["nombre"],
			$_POST["apellido"],
			$userDTO->getLogin(),
			'',
			'',
			$_POST["tiempoSesion"],
			$userDTO->getActive(),
			$_POST["registrosPorPagina"]);
				
	$_SESSION[Constants::$KEY_USUARIO_DTO] = $newUserDTO;
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Su operaci&oacute;n fue realizada";
	
	header("Location: ../perfil.php")
?>
