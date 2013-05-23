<?php
	include_once '../classes/Constants.php';
	include_once("../classes/PageAccess.php");
	include_once '../classes/BitacoraDAO.php';
	include_once '../classes/UsuarioDTO.php';
	include_once '../classes/DBUtil.php';
	include_once '../includes/session.php';
	
	//falta el criterio de filtro para esta pagina
	PageAccess::validateAccess(Constants::$OPCION_PERFIL);
	
	BitacoraDAO::registrarComentario("Acceso autorizado a la funcionalidad de cambio de perfil");
	$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
		
	$query = "UPDATE usuarios SET "
			." nombre='".$_POST["nombre"]."',"
			." apellido='".$_POST["apellido"]."',"
			." correo='".$_POST["correo"]."',"
			.($_POST["clave"] != "" ? " clave=MD5('".$_POST["clave"]."'), " : "")
			." tiempo_sesion=".$_POST["tiempoSesion"].", "
			." registros_por_pagina=".$_POST["registrosPorPagina"]
			." WHERE id=".$userDTO->getId();
		
	DBUtil::executeQuery($query);
		
	BitacoraDAO::registrarComentario("Informacion de perfil actualizada");
		
	//actualizamos en session los valores
	$newUserDTO = new UsuarioDTO($userDTO->getId(),
			$_POST["nombre"],
			$_POST["apellido"],
			$userDTO->getLogin(),
			'',
			$_POST["correo"],
			$_POST["tiempoSesion"],
			$userDTO->getActive(),
			$_POST["registrosPorPagina"]);
	$newUserDTO->setModulesAllowed($userDTO->getModulesAllowed());
				
	$_SESSION[Constants::$KEY_USUARIO_DTO] = $newUserDTO;
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Su operaci&oacute;n fue realizada";
	
	header("Location: ../perfil.php")
?>
