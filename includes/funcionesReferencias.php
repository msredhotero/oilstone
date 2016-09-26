<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function existencia($id,$tabla,$campo,$busquedas,$esCadena) {
	if ($esCadena == 1) {
		$sql = "select ".$id." from ".$tabla." where ".$campo." = '".str_replace(' ','',trim($busquedas))."'";	
	} else {
		$sql = "select ".$id." from ".$tabla." where ".$campo." = ".$busquedas;	
	}
	
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		return true;	
	}
	return false;
}



/* PARA Clientes */

function insertarClientes($apellido,$nombre,$nrodocumento,$telefono) {
$sql = "insert into dbclientes(idcliente,apellido,nombre,nrodocumento,telefono)
values ('','".utf8_decode($apellido)."','".utf8_decode($nombre)."','".utf8_decode($nrodocumento)."','".utf8_decode($telefono)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarClientes($id,$apellido,$nombre,$nrodocumento,$telefono) {
$sql = "update dbclientes
set
apellido = '".utf8_decode($apellido)."',nombre = '".utf8_decode($nombre)."',nrodocumento = '".utf8_decode($nrodocumento)."',telefono = '".utf8_decode($telefono)."'
where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClientes($id) {
$sql = "delete from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerClientes() {
$sql = "select
c.idcliente,
c.apellido,
c.nombre,
c.nrodocumento,
c.telefono
from dbclientes c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientesPorId($id) {
$sql = "select idcliente,apellido,nombre,nrodocumento,telefono from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbclientes*/


/* PARA Usuarios */

function insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "insert into dbusuarios(idusuario,usuario,password,refroles,email,nombrecompleto)
values ('','".utf8_decode($usuario)."','".utf8_decode($password)."',".$refroles.",'".utf8_decode($email)."','".utf8_decode($nombrecompleto)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "update dbusuarios
set
usuario = '".utf8_decode($usuario)."',password = '".utf8_decode($password)."',refroles = ".$refroles.",email = '".utf8_decode($email)."',nombrecompleto = '".utf8_decode($nombrecompleto)."'
where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUsuarios($id) {
$sql = "delete from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerUsuarios() {
$sql = "select
u.idusuario,
u.usuario,
u.password,
u.refroles,
u.email,
u.nombrecompleto
from dbusuarios u
inner join tbroles rol ON rol.idrol = u.refroles
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerUsuariosPorId($id) {
$sql = "select idusuario,usuario,password,refroles,email,nombrecompleto from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbusuarios*/


/* PARA Ventas */

function zerofill($valor, $longitud){
 $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
 return $res;
}

function generarNroVenta() {
	$sql = "select idventa from dbventas order by idventa desc limit 1";
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		$c = $this->zerofill(mysql_result($res,0,0)+1,6);
		return "ORD".$c;
	}
	return "VEN000001";
}

function insertarVentas($numero,$refclientes,$reftipoventa,$tarjeta,$adicionales,$seguros,$upgrate,$observaciones,$fechacreacion) {
$sql = "insert into dbventas(idventa,numero,refclientes,reftipoventa,tarjeta,adicionales,seguros,upgrate,observaciones,fechacreacion)
values ('','".utf8_decode($numero)."',".$refclientes.",".$reftipoventa.",".($tarjeta == '' ? 'null' : $tarjeta).",".($adicionales == '' ? 'null' : $adicionales).",".($seguros == '' ? 'null' : $seguros).",".($upgrate == '' ? 'null' : $upgrate).",'".utf8_decode($observaciones)."','".(date('Y-m-d H:i:s'))."')";
$res = $this->query($sql,1);
return $res;
}


function modificarVentas($id,$numero,$refclientes,$reftipoventa,$tarjeta,$adicionales,$seguros,$upgrate,$observaciones,$fechacreacion) {
$sql = "update dbventas
set
numero = '".utf8_decode($numero)."',refclientes = ".$refclientes.",reftipoventa = ".$reftipoventa.",tarjeta = ".($tarjeta == '' ? 'null' : $tarjeta).",adicionales = ".($adicionales == '' ? 'null' : $adicionales).",seguros = ".($seguros == '' ? 'null' : $seguros).",upgrate = ".($upgrate == '' ? 'null' : $upgrate).",observaciones = '".utf8_decode($observaciones)."',fechacreacion = '".utf8_decode($fechacreacion)."'
where idventa =".$id;
$res = $this->query($sql,0);
return $res;
} 


function eliminarVentas($id) {
$sql = "delete from dbventas where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerVentas() {
$sql = "select
v.idventa,
concat(cli.apellido,' ',cli.nombre) as apyn,
cli.nrodocumento,
cli.telefono,
tip.tipoventa,
v.tarjeta,
v.adicionales,
v.seguros,
v.upgrate,
v.fechacreacion,
v.observaciones,
v.numero
from dbventas v
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join tbtipoventa tip ON tip.idtipoventa = v.reftipoventa
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorTipo($tipo) {
$sql = "select
v.idventa,
concat(cli.apellido,' ',cli.nombre) as apyn,
cli.nrodocumento,
cli.telefono,
v.tarjeta,
v.adicionales,
v.seguros,
v.upgrate,
v.fechacreacion,
v.observaciones,
v.numero
from dbventas v
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join tbtipoventa tip ON tip.idtipoventa = v.reftipoventa
where tip.tipoventa = '".$tipo."'
order by v.fechacreacion desc";
$res = $this->query($sql,0);
return $res;
}




function traerVentasPorTipos() {
$sql = "select
sum(coalesce(v.tarjeta,0)) as tarjetas,
sum(coalesce(v.adicionales,0)) as adicionales,
sum(coalesce(v.seguros,0)) as seguros,
sum(coalesce(v.upgrate,0)) as upgrades
from dbventas v
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join tbtipoventa tip ON tip.idtipoventa = v.reftipoventa
where tip.tipoventa = 'Venta'";
$res = $this->query($sql,0);
return $res;
}

function traerTotalVentas() {
$sql = "select
count(v.idventa)
from dbventas v
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join tbtipoventa tip ON tip.idtipoventa = v.reftipoventa
where tip.tipoventa = 'Venta'	";
$res = $this->query($sql,0);
return $res;
}

function traerVentasPorCliente($idCliente)  {
	$sql = "select
				v.idventa,
				concat(cli.apellido,' ',cli.nombre) as apyn,
				cli.nrodocumento,
				cli.telefono,
				tip.tipoventa,
				v.tarjeta,
				v.adicionales,
				v.seguros,
				v.upgrate,
				v.fechacreacion,
				v.observaciones,
				v.numero
			from dbventas v
			inner join dbclientes cli ON cli.idcliente = v.refclientes
			inner join tbtipoventa tip ON tip.idtipoventa = v.reftipoventa
			where cli.idcliente = ".$idCliente."
			order by 1";
	$res = $this->query($sql,0);
	return $res;
}


function traerVentasPorId($id) {
$sql = "select idventa,numero,refclientes,reftipoventa,tarjeta,adicionales,seguros,upgrate,fechacreacion,observaciones from dbventas where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbventas*/


/* PARA Predio_menu */

function insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "insert into predio_menu(idmenu,url,icono,nombre,Orden,hover,permiso)
values ('','".utf8_decode($url)."','".utf8_decode($icono)."','".utf8_decode($nombre)."',".$Orden.",'".utf8_decode($hover)."','".utf8_decode($permiso)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "update predio_menu
set
url = '".utf8_decode($url)."',icono = '".utf8_decode($icono)."',nombre = '".utf8_decode($nombre)."',Orden = ".$Orden.",hover = '".utf8_decode($hover)."',permiso = '".utf8_decode($permiso)."'
where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPredio_menu($id) {
$sql = "delete from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menu() {
$sql = "select
p.idmenu,
p.url,
p.icono,
p.nombre,
p.Orden,
p.hover,
p.permiso
from predio_menu p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menuPorId($id) {
$sql = "select idmenu,url,icono,nombre,Orden,hover,permiso from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: predio_menu*/


/* PARA Roles */

function insertarRoles($descripcion,$activo) {
$sql = "insert into tbroles(idrol,descripcion,activo)
values ('','".utf8_decode($descripcion)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarRoles($id,$descripcion,$activo) {
$sql = "update tbroles
set
descripcion = '".utf8_decode($descripcion)."',activo = ".$activo."
where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarRoles($id) {
$sql = "delete from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerRoles() {
$sql = "select
r.idrol,
r.descripcion,
r.activo
from tbroles r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerRolesPorId($id) {
$sql = "select idrol,descripcion,activo from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbroles*/


/* PARA Tipoventa */

function insertarTipoventa($tipoventa) {
$sql = "insert into tbtipoventa(idtipoventa,tipoventa)
values ('','".utf8_decode($tipoventa)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipoventa($id,$tipoventa) {
$sql = "update tbtipoventa
set
tipoventa = '".utf8_decode($tipoventa)."'
where idtipoventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipoventa($id) {
$sql = "delete from tbtipoventa where idtipoventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipoventa() {
$sql = "select
t.idtipoventa,
t.tipoventa
from tbtipoventa t
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTipoventaPorId($id) {
$sql = "select idtipoventa,tipoventa from tbtipoventa where idtipoventa =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipoventa*/

function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>