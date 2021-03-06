<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Dashboard",$_SESSION['refroll_predio'],'');

/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Venta";

$plural = "Ventas";

$eliminar = "eliminarVentas";

$insertar = "insertarVentas";

$tituloWeb = "Gestión: Ventas";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////

/////////////////////// Opciones para la creacion del view  patente,refmodelo,reftipovehiculo,anio/////////////////////
$cabeceras 		= "	<th>Apellido y Nombre</th>
					<th>Nro Documento</th>
					<th>Teléfono</th>
					<th>Tarjeta</th>
					<th>Adicionales</th>
					<th>Seguros</th>
					<th>Upgrate</th>
					<th>Fecha</th>
					<th>Observaciones</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////

//$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerOrdenesActivos(),95);
//$lstCargadosMora 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerOrdenesMora(),94);


$resClientes		=	$serviciosReferencias->traerClientes();
$cantClienetes		=	mysql_num_rows($resClientes);

$resVentas			=	$serviciosReferencias->traerTotalVentas();
if (mysql_num_rows($resVentas)>0) {
	$cantVentas			=	mysql_result($resVentas,0,0);
} else {
	$cantVentas			=	0;
}

$resTarjetas		=	$serviciosReferencias->traerVentasPorTipos();

if (mysql_num_rows($resTarjetas)>0) {
	$cantTarjetas		=	mysql_result($resTarjetas,0,0);
	$cantAdicionales	=	mysql_result($resTarjetas,0,1);
	$cantSeguros		=	mysql_result($resTarjetas,0,2);
	$cantUpgrade		=	mysql_result($resTarjetas,0,3);
} else {
	$cantTarjetas		=	0;
	$cantAdicionales	=	0;
	$cantSeguros		=	0;
	$cantUpgrade		=	0;
}


$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerVentasPorTipo("Venta"),9);
$lstCargados2 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerVentasPorTipo("Pre-Aprobado"),9);
$lstCargados3 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerVentasPorTipo("No Aplica"),9);

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Ventas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>




    
   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
    <script src="../js/jquery.color.min.js"></script>
	<script src="../js/jquery.animateNumber.min.js"></script>
    
    

</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">

<h3>Bienvenido</h3>
	
    <div class="row">
    	<div class="col-md-1">
        </div>
        <div class="col-md-10">
        	<div class="col-md-6">
            	<div class="col-md-4">
                    <div align="center">
                        <img src="../imagenes/lblClientes.png" width="80%"/>
                        <p><span id="lblCliente" style="color: red;">0</span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div align="center">
                        <img src="../imagenes/lblVentas.png" width="80%">
                        <p><span id="lblVentas" style="color: red;">0</span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div align="center">
                        <img src="../imagenes/lblTarjeta.png" width="80%">
                        <p><span id="lblTarjetas" style="color: red;">0</span></p>
                    </div>
                </div>
                
                
            </div>

            <div class="col-md-6">
            	<div class="col-md-4">
                    <div align="center">
                        <img src="../imagenes/lblAdicional.png" width="80%"/>
                        <p><span id="lblAdicionales" style="color: red;">0</span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div align="center">
                        <img src="../imagenes/lblUpgrade.png" width="80%">
                        <p><span id="lblUpgrade" style="color: red;">0</span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div align="center">
                        <img src="../imagenes/lblSeguros.png" width="80%">
                        <p><span id="lblSeguros" style="color: red;">0</span></p>
                    </div>
                </div>            
            </div>
        </div>
        
        
        
        <div class="col-md-1">
        </div>
    </div>

    <div class="boxInfoLargo tile-stats tile-white stat-tile">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ventas Cargadas</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<?php echo $lstCargados; ?>
    	</div>
    </div>
    
    <div class="boxInfoLargo tile-stats tile-white stat-tile">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ventas Pre-Aprobadas</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<?php echo $lstCargados2; ?>
    	</div>
    </div>
    
    <div class="boxInfoLargo tile-stats tile-white stat-tile">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ventas que No Aplica</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<?php echo $lstCargados3; ?>
    	</div>
    </div>
    
    
    
    
    
   
</div>


</div>


<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pagos</h4>
      </div>
      <div class="modal-body userasignates">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el <?php echo $singular; ?> se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	
	
	$('table.table').dataTable({
		"order": [[ 0, "asc" ]],
		"language": {
			"emptyTable":     "No hay datos cargados",
			"info":           "Mostrar _START_ hasta _END_ del total de _TOTAL_ filas",
			"infoEmpty":      "Mostrar 0 hasta 0 del total de 0 filas",
			"infoFiltered":   "(filtrados del total de _MAX_ filas)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrar _MENU_ filas",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No se encontraron resultados",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		  }
	} );
	

	$('table.table').on("click",'.varborrar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$('table.table').on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "ordenes/modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	
	$('table.table').on("click",'.varpagar', function(){
		
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "pagos/pagar.php?id="+usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton pagos
	
	
	$('table.table').on("click",'.varpagos', function(){
			
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {

			$.ajax({
					data:  {id: usersid, accion: 'traerPagosPorOrden'},
					url:   '../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							
					},
					success:  function (response) {
							$('.userasignates').html(response);
							
					}
			});
			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error redo action.");	
		  }
	});//fin del boton eliminar
	
	
	$('table.table').on("click",'.varfinalizar', function(){

		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {

			$.ajax({
					data:  {id: usersid, usuario: '<?php echo $_SESSION['nombre_predio']; ?>', accion: 'finalizarOrden'},
					url:   '../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							
					},
					success:  function (response) {
							if (response == '') {
								$(".alert").removeClass("alert-danger");
								$(".alert").removeClass("alert-info");
								$(".alert").addClass("alert-success");
								$(".alert").html('<strong>Ok!</strong> Se finalizo exitosamente la <strong>Orden</strong>. ');
								$(".alert").delay(3000).queue(function(){
									/*aca lo que quiero hacer 
									  después de los 2 segundos de retraso*/
									$(this).dequeue(); //continúo con el siguiente ítem en la cola
									
								});
								$("#load").html('');
								url = "index.php";
								$(location).attr('href',url);
								
								
							} else {
								$(".alert").removeClass("alert-danger");
								$(".alert").addClass("alert-danger");
								$(".alert").html('<strong>Error!</strong> '+response);
								$("#load").html('');
							}
							
					}
			});
			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error redo action.");	
		  }
	});//fin del boton eliminar
	
	 $( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: '<?php echo $eliminar; ?>'},
									url:   '../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "index.php";
											$(location).attr('href',url);
											
									}
							});
						$( this ).dialog( "close" );
						$( this ).dialog( "close" );
							$('html, body').animate({
	           					scrollTop: '1000px'
	       					},
	       					1500);
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para eliminar

	


});
</script>


    <script>
	  	var percent_number_step = $.animateNumber.numberStepFactories.append('')
		$('#lblCliente').animateNumber(
		  {
			number: <?php echo $cantClienetes; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		
		$('#lblVentas').animateNumber(
		  {
			number: <?php echo $cantVentas; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		
		$('#lblTarjetas').animateNumber(
		  {
			number: <?php echo $cantTarjetas; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		
		$('#lblAdicionales').animateNumber(
		  {
			number: <?php echo $cantAdicionales; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		$('#lblUpgrade').animateNumber(
		  {
			number: <?php echo $cantUpgrade; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		$('#lblSeguros').animateNumber(
		  {
			number: <?php echo $cantSeguros; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
	</script>
<?php } ?>
</body>
</html>
