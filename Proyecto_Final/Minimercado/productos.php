<?php
	require 'conexion.php';

	$where = " ";

	// if (!empty($_POST))
	// {
	// 	$valor = $_POST['campo'];
	// 	if (!empty($valor)) {
	// 		$where = "WHERE Nombre LIKE '%$valor' ";
	// 	}
	// }
	$sql = "SELECT * FROM  producto $where";
	$resultado = $conexion -> query($sql);
?>

<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<link href="css/jquery.dataTables.min.css" rel="stylesheet">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<!--Configuracion de la tabla con jquery PAGINACION U ORDENAMIENTO-->
		<script>
			$(document).ready(function(){		//Cuando lea una funcion...va a estar leyenbdo jquery, va a leer cuando detecte la tabal
				$('#tabla') .DataTable({		// lee el id de la tabla, para que reconozca  la tabla
					"order":  [[0,  "asc"]],
					"language" : {
						"lengthMenu" : "Visualizar  _MENU_  registros por pagina",
						"info": "Mostrando pagina _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(Filtrada de _MAX_ registros)",
						"loadingRecords": "Cargando...",
						"processing":     "Procesando...",
						"search": "Buscar:",
						"zeroRecords":    "No se encontraron registros coincidentes",
						"paginate": {
							"next":       "Siguiente",
							"previous":   "Anterior"
						},
					}
				});
			});
		</script>

	</head>

	<body>
		<div class="container">
			<div class="row">
				<h2 style="text-align:center">Minimercado S.A.</h2>
				<br>
			</div>

			<div class="row">
				<a href="Nuevo_Producto.php" class="btn btn-success">Nuevo Producto</a>
				<a href="index.php" class="btn btn-success">Volver al Menu</a>
				<br>
				<br>
				<!-- <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
				<b>Nombre: </b><input type="text" id="campo" name="campo" />
				<input type="submit" id="enviar" name="enviar" value="Buscar"  class="btn btn-info" />
				</form> -->
			</div>

			<br>

			<div class="row table-responsive">
				<table class="display" id="tabla">
					<thead>
						<tr>
							<th>Codigo</th>
							<th>Nombre</th>
							<th>Marca</th>
							<th>Fecha_Elaboracion</th>
							<th>Fecha_Vencimiento</th>
							<th>Lugar_Origen</th>							
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Categoria</th>
							<th>Codigo_Proveedor</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = $resultado ->fetch_array(MYSQLI_ASSOC))	{ ?>
							<tr>
								<td><?php echo $row["Codigo"]; ?></td>
								<td><?php echo $row["Nombre"]; ?></td>
								<td><?php echo $row["Marca"]; ?></td>
								<td><?php echo $row["Fecha_Elaboracion"]; ?></td>
								<td><?php echo $row["Fecha_Vencimiento"]; ?></td>
								<td><?php echo $row["Lugar_Origen"]; ?></td>								
								<td><?php echo $row["Precio"]; ?></td>
								<td><?php echo $row["Cantidad"]; ?></td>
								<td><?php echo $row["Categoria"]; ?></td>
								<td><?php echo $row["Codigo_Proveedor"]; ?></td>
								<td><a href="Modificar_Producto.php?Codigo=<?php echo $row["Codigo"]; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
								<td><a href="#" data-href="Eliminar_Producto.php?Codigo=<?php echo $row["Codigo"]; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
					</div>

					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<a class="btn btn-danger btn-ok">Eliminar</a>
					</div>
				</div>
			</div>
		</div>

		<script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>
	</body>
</html>