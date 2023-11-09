<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM doctor WHERE doctorid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Registro médico eliminado exitosamente..');</script>";
	}
}
?>
<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center">View Available Doctor</h2>

	</div>

<div class="card">

	<section class="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
			<thead>
				<tr>
					<td>Nombre</td>
					<td>Contacto</td>
					<td>Departamento</td>
					<td>Ingresar identificación</td>
					<td>Cargo por consultoría</td>
					<td>Educación</td>
					<td>Experiencia</td>
					<td>Estatado</td>
					<td>Acción</td>
				</tr>
			</thead>
			<tbody>
				
				<?php
				$sql ="SELECT * FROM doctor";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{

					$sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
					$qsqldept = mysqli_query($con,$sqldept);
					$rsdept = mysqli_fetch_array($qsqldept);
					echo "<tr>
					<td>&nbsp;$rs[doctorname]</td>
					<td>&nbsp;$rs[mobileno]</td>
					<td>&nbsp;$rsdept[departmentname]</td>
					<td>&nbsp;$rs[loginid]</td>
					<td>&nbsp;$rs[consultancy_charge]</td>
					<td>&nbsp;$rs[education]</td>
					<td>&nbsp;$rs[experience] year</td>
					<td>$rs[status]</td>
					<td>&nbsp;
					<a href='doctor.php?editid=$rs[doctorid]' class='btn btn-sm btn-raised g-bg-cyan'>Editar</a> <a href='viewdoctor.php?delid=$rs[doctorid]' class='btn btn-sm btn-raised g-bg-blush2'>Borrar</a> </td>
					</tr>";
				}
				?>      </tbody>
			</table>
		</section>
	</div>
</div>
	<?php
	include("adformfooter.php");
	?>