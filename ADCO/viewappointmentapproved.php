

<?php

include("adformheader.php");
include("dbconnection.php");

if (isset($_GET['delid'])) {
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $sql = "DELETE FROM appointment WHERE appointmentid='$_GET[delid]'";
        $qsql = mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) == 1) {
            echo "<script>
            Swal.fire({
              title: 'Eliminado!',
              text: 'Se ha eliminado con éxito',
              icon: 'success',
			  showConfirmButton: false,
			  timer:920
            }).then(function() {
                window.location.href = 'viewappointmentapproved.php'; // Redirect to desired page after deletion
            });
            </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
          title: '¿Estás seguro?',
          text: 'No podrás revertirlo.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'No, cancelar',
          confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'viewappointmentapproved.php?delid=" . $_GET['delid'] . "&confirm=true';
            } else {
                window.location.href = 'viewappointmentapproved.php'; 
            }
        });
        </script>";
    }
}

if (isset($_GET['approveid'])) {
    $sql = "UPDATE appointment SET status='Approved' WHERE appointmentid='$_GET[approveid]'";
    $qsql = mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) == 1) {
        echo "<script>
        Swal.fire({
          title: 'Aprobado!',
          text: 'El registro de la cita ha sido aprobado con éxito',
          icon: 'success'
        }).then(function() {
            window.location.href = 'viewappointmentapproved.php'; // Redirect to desired page after approval
        });
        </script>";
    }
}
?>

<div class="container-fluid">
<div class="block-header">
        <h2 class="text-center">Ver citas: aprobadas</h2>
    </div>

<div class="card">
	<section class="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">

			<thead>
				<tr>
					<td>Detalles del paciente</td>
					<td>Fecha y hora</td>
					<td>Especialidad</td>
					<td>Odontologo</td>
					<td>Motivo de la cita</td>
					<td>Estado</td>
					<td><div align="center">Accion</div></td>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql ="SELECT * FROM appointment WHERE (status='Aprobado' OR status='Activo')";
				if(isset($_SESSION['patientid']))
				{
					$sql  = $sql . " AND patientid='$_SESSION[patientid]'";
				}
				if(isset($_SESSION['doctorid']))
				{
					$sql  = $sql . " AND doctorid='$_SESSION[doctorid]'";			
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
					$qsqlpat = mysqli_query($con,$sqlpat);
					$rspat = mysqli_fetch_array($qsqlpat);


					$sqldept = "SELECT * FROM specialty WHERE specialtyid='$rs[specialtyid]'";
					$qsqldept = mysqli_query($con,$sqldept);
					$rsdept = mysqli_fetch_array($qsqldept);

					$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
					$qsqldoc = mysqli_query($con,$sqldoc);
					$rsdoc = mysqli_fetch_array($qsqldoc);
					echo "<tr>

					<td>&nbsp;$rspat[patientname]<br>&nbsp;$rspat[mobileno]</td>		 
					<td>&nbsp;$rs[appointmentdate]&nbsp;$rs[appointmenttime]</td> 
					<td>&nbsp;$rsdept[specialtyname]</td>
					<td>&nbsp;$rsdoc[doctorname]</td>
					<td>&nbsp;$rs[app_reason]</td>
					<td>&nbsp;$rs[status]</td>
					<td><div align='center'>";
					if($rs['status'] != "Aprobado")
					{
						if(!(isset($_SESSION['patientid'])))
						{
							echo "<a href='appointmentapproval.php?editid=$rs[appointmentid]' class='btn btn-raised g-bg-cyan>Aprobar</a><hr>";
						}
						echo "  <a href='viewappointment.php?delid=$rs[appointmentid]' class='btn btn-raised g-bg-blush2'>Eliminar</a>";
					}
					else
					{
						echo "<a href='patientreport.php?patientid=$rs[patientid]&appointmentid=$rs[appointmentid]' class='btn btn-raised bg-cyan'>Ver  Reporte</a>";
					}
					echo "</center></td></tr>";
				}
				?>
			</tbody>
		</table>
	</section>

</div>
</div> 
<?php
include("adformfooter.php");
?>