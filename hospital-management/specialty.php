<?php
include("adheader.php");
include("dbconnection.php");
if (isset($_POST['submit'])) {
	if (isset($_GET['editid'])) {
		$sql = "UPDATE specialty SET specialtyname='$_POST[specialtyname]',description='$_POST[textarea]',status='$_POST[select]' WHERE specialtyid='$_GET[editid]'";
		if ($qsql = mysqli_query($con, $sql)) {
			echo "<script>
			setTimeout(function() {
				Swal.fire({
					title: 'Especialidad actualizada exitosamente!',
					icon: 'success'
				}); 
			}, 100);
		  </script>";
		} else {
			echo mysqli_error($con);
		}
	} else {
		$sql = "INSERT INTO specialty(specialtyname,description,status) values('$_POST[specialtyname]','$_POST[textarea]','$_POST[select]')";
		if ($qsql = mysqli_query($con, $sql)) {
			echo "<script>
			setTimeout(function() {
				Swal.fire({
					title: 'Especialidad insertada exitosamente!',
					icon: 'success'
				});
			}, 100);
		  </script>";
		} else {
			echo mysqli_error($con);
		}
	}
}
if (isset($_GET['editid'])) {
	$sql = "SELECT * FROM specialty WHERE specialtyid='$_GET[editid]' ";
	$qsql = mysqli_query($con, $sql);
	$rsedit = mysqli_fetch_array($qsql);
}
?>


<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center">Agregar nueva especialidad</h2>

	</div>
	<div class="card">

		<form method="post" action="" name="frmdept" onSubmit="return validateform()">
			<table class="table table-hover">
				<tbody>
					<tr>
						<td width="34%">Nombre de especialidad</td>
						<td width="66%"><input placeholder=" Entre aquí " class="form-control" type="text" name="specialtyname" id="specialtyname" value="<?php echo $rsedit['specialtyname']; ?>" /></td>
					</tr>
					<tr>
						<td>Descripción</td>
						<td><textarea placeholder=" Entre aquí " class="form-control no-resize" name="textarea" id="textarea" cols="45" rows="5"><?php echo $rsedit['description']; ?></textarea></td>
					</tr>
					<tr>
						<td>Estado</td>
						<td> <select name="select" id="select" class="form-control show-tick">
								<option value="">Seleccionar</option>
								<?php
								$arr = array("Activo", "Inactivo");
								foreach ($arr as $val) {
									if ($val == $rsedit['status']) {
										echo "<option value='$val' selected>$val</option>";
									} else {
										echo "<option value='$val'>$val</option>";
									}
								}
								?>
							</select></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input class="btn btn-raised g-bg-cyan" type="submit" name="submit" id="submit" value="Enviar" /></td>
					</tr>
				</tbody>
			</table>
		</form>
		<p>&nbsp;</p>
	</div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
	var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

	function validateform() {
		if (document.frmdept.specialtyname.value == "") {
			// alert("El nombre del especialidad no debe estar vacío.");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'Nombre de especialidad no debe ir vacio.',
				showConfirmButton: false,
				timer: 2000,
			});

			document.frmdept.specialtyname.focus();
			return false;
		} else if (!document.frmdept.specialtyname.value.match(alphaspaceExp)) {
			// alert("Nombre del especialidad no válido.");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'Nombre de especialidad no valido.',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmdept.specialtyname.focus();
			return false;
		} else if (document.frmdept.select.value == "") {
			// alert("Por favor seleccione el estado.");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'estado no debe ir vacio.',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmdept.select.focus();
			return false;
		} else {
			return true;
		}
	}
</script>