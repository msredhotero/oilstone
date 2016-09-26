<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;



/* PARA las llamadas */

case 'insertarClientes':
insertarClientes($serviciosReferencias);
break;
case 'modificarClientes':
modificarClientes($serviciosReferencias);
break;
case 'eliminarClientes':
eliminarClientes($serviciosReferencias);
break;
case 'insertarUsuarios':
insertarUsuarios($serviciosReferencias);
break;
case 'modificarUsuarios':
modificarUsuarios($serviciosReferencias);
break;
case 'eliminarUsuarios':
eliminarUsuarios($serviciosReferencias);
break;
case 'insertarVentas':
insertarVentas($serviciosReferencias);
break;
case 'insertarClienteVenta':
insertarClienteVenta($serviciosReferencias);
break;
case 'modificarVentas':
modificarVentas($serviciosReferencias);
break;
case 'eliminarVentas':
eliminarVentas($serviciosReferencias);
break;
case 'insertarPredio_menu':
insertarPredio_menu($serviciosReferencias);
break;
case 'modificarPredio_menu':
modificarPredio_menu($serviciosReferencias);
break;
case 'eliminarPredio_menu':
eliminarPredio_menu($serviciosReferencias);
break;
case 'insertarRoles':
insertarRoles($serviciosReferencias);
break;
case 'modificarRoles':
modificarRoles($serviciosReferencias);
break;
case 'eliminarRoles':
eliminarRoles($serviciosReferencias);
break;
case 'insertarTipoventa':
insertarTipoventa($serviciosReferencias);
break;
case 'modificarTipoventa':
modificarTipoventa($serviciosReferencias);
break;
case 'eliminarTipoventa':
eliminarTipoventa($serviciosReferencias);
break; 
}

/* Fin */
/*

/* PARA Tipoventa */

function insertarClientes($serviciosReferencias) {
$apellido = $_POST['apellido'];
$nombre = $_POST['nombre'];
$nrodocumento = $_POST['nrodocumento'];
$telefono = $_POST['telefono'];

$existe = $serviciosReferencias->existencia("idcliente","dbclientes","nrodocumento",$nrodocumento,1);

	if ($existe) {
		echo 'El agente ya existe, verifique el Nro de Documento';
	} else {
		$res = $serviciosReferencias->insertarClientes($apellido,$nombre,$nrodocumento,$telefono);
		if ((integer)$res > 0) {
			echo '';
		} else {
			echo 'Huvo un error al insertar datos';
		}
	}
}

function insertarClienteVenta($serviciosReferencias) {
$apellido = $_POST['apellido'];
$nombre = $_POST['nombre'];
$nrodocumento = $_POST['nrodocumento'];
$telefono = $_POST['telefono'];

$existe = $serviciosReferencias->existencia("idcliente","dbclientes","nrodocumento",$nrodocumento,1);

	if ($existe) {
		echo 'El agente ya existe, verifique el Nro de Documento';
	} else {
		$res = $serviciosReferencias->insertarClientes($apellido,$nombre,$nrodocumento,$telefono);
		if ((integer)$res > 0) {
			echo $res;
		} else {
			echo 'Huvo un error al insertar datos';
		}
	}
}


function modificarClientes($serviciosReferencias) {
$id = $_POST['id'];
$apellido = $_POST['apellido'];
$nombre = $_POST['nombre'];
$nrodocumento = $_POST['nrodocumento'];
$telefono = $_POST['telefono'];
$res = $serviciosReferencias->modificarClientes($id,$apellido,$nombre,$nrodocumento,$telefono);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarClientes($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarClientes($id);
echo $res;
}
function insertarUsuarios($serviciosReferencias) {
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$refroles = $_POST['refroles'];
$email = $_POST['email'];
$nombrecompleto = $_POST['nombrecompleto'];
$res = $serviciosReferencias->insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarUsuarios($serviciosReferencias) {
$id = $_POST['id'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$refroles = $_POST['refroles'];
$email = $_POST['email'];
$nombrecompleto = $_POST['nombrecompleto'];
$res = $serviciosReferencias->modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarUsuarios($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarUsuarios($id);
echo $res;
}
function insertarVentas($serviciosReferencias) {
$numero = $_POST['numero'];
$refclientes = $_POST['refclientes'];
$reftipoventa = $_POST['reftipoventa'];
$tarjeta = $_POST['tarjeta'];
$adicionales = $_POST['adicionales'];
$seguros = $_POST['seguros'];
$upgrate = $_POST['upgrate'];
$observaciones = $_POST['observaciones'];
$fechacreacion = $_POST['fechacreacion'];
$res = $serviciosReferencias->insertarVentas($numero,$refclientes,$reftipoventa,$tarjeta,$adicionales,$seguros,$upgrate,$observaciones,$fechacreacion);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarVentas($serviciosReferencias) {
$id = $_POST['id'];
$numero = $_POST['numero'];
$refclientes = $_POST['refclientes'];
$reftipoventa = $_POST['reftipoventa'];
$tarjeta = $_POST['tarjeta'];
$adicionales = $_POST['adicionales'];
$seguros = $_POST['seguros'];
$upgrate = $_POST['upgrate'];
$observaciones = $_POST['observaciones'];
$fechacreacion = $_POST['fechacreacion'];
$res = $serviciosReferencias->modificarVentas($id,$numero,$refclientes,$reftipoventa,$tarjeta,$adicionales,$seguros,$upgrate,$observaciones,$fechacreacion);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
} 
function eliminarVentas($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarVentas($id);
echo $res;
}
function insertarPredio_menu($serviciosReferencias) {
$url = $_POST['url'];
$icono = $_POST['icono'];
$nombre = $_POST['nombre'];
$Orden = $_POST['Orden'];
$hover = $_POST['hover'];
$permiso = $_POST['permiso'];
$res = $serviciosReferencias->insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarPredio_menu($serviciosReferencias) {
$id = $_POST['id'];
$url = $_POST['url'];
$icono = $_POST['icono'];
$nombre = $_POST['nombre'];
$Orden = $_POST['Orden'];
$hover = $_POST['hover'];
$permiso = $_POST['permiso'];
$res = $serviciosReferencias->modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarPredio_menu($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarPredio_menu($id);
echo $res;
}
function insertarRoles($serviciosReferencias) {
$descripcion = $_POST['descripcion'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->insertarRoles($descripcion,$activo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarRoles($serviciosReferencias) {
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->modificarRoles($id,$descripcion,$activo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarRoles($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarRoles($id);
echo $res;
}
function insertarTipoventa($serviciosReferencias) {
$tipoventa = $_POST['tipoventa'];
$res = $serviciosReferencias->insertarTipoventa($tipoventa);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarTipoventa($serviciosReferencias) {
$id = $_POST['id'];
$tipoventa = $_POST['tipoventa'];
$res = $serviciosReferencias->modificarTipoventa($id,$tipoventa);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarTipoventa($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarTipoventa($id);
echo $res;
}

/* Fin */

////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$refroll,$email,$nombre);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	//$idempresa  =	$_POST['idempresa'];
	
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>