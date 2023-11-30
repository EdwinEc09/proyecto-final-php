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
                text: 'Cita eliminada .',
                icon: 'success'
            }).then(function() {
                window.location.href = 'viewappointment.php'; // Redirect to desired page after deletion
            });
            </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            title: 'estas seguro?',
            text: 'No podras revertir!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'viewappointmentpending.php?delid=" . $_GET['delid'] . "&confirm=true';
            }else{
				window.location.href = 'viewappointmentpending.php';
			}
        });
        </script>";
    }
}

if(isset($_GET['approveid'])) {
    $sql ="UPDATE patient SET status='Activo' WHERE patientid='$_GET[patientid]'";
    $qsql=mysqli_query($con,$sql);
    
    $sql ="UPDATE appointment SET status='Approved' WHERE appointmentid='$_GET[approveid]'";
    $qsql=mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) == 1) {
        echo "<script>
        Swal.fire({
            title: 'Approved!',
            text: 'Appointment record approved successfully.',
            icon: 'success'
        }).then(function() {
            window.location.href = 'viewappointmentpending.php';
        });
        </script>";
    } else {
        echo "<script>alert('Error approving appointment');</script>";
    }
}
?>
<div class="container-fluid">
<div class="block-header">
        <h2 class="text-center">Ver citas pendientes</h2>
    </div>


<div class="card">
	<section class="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
			<thead>

				<tr>

					<th>Detalles del paciente</th>
					<th>Fecha y hora</th>
					<th>especialidad</th>
					<th>Odontologo</th>
					<th>Motivo de la cita</th>
					<th>Estado</th>
					<th width="15%">Accion</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql ="SELECT * FROM appointment WHERE (status='Pendiente' OR status='Inactivo')";
				if(isset($_SESSION['patientid']))
				{
					$sql  = $sql . " AND patientid='$_SESSION[patientid]'";
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
					<td>&nbsp;" . date("d-M-Y",strtotime($rs['appointmentdate'])) . " &nbsp; " . date("H:i A",strtotime($rs['appointmenttime'])) . "</td> 
					<td>&nbsp;$rsdept[specialtyname]</td>
					<td>&nbsp;$rsdoc[doctorname]</td>
					<td>&nbsp;$rs[app_reason]</td>
					<td>&nbsp;$rs[status]</td>
					<td>";
					if($rs['status'] != "Aprobado")
					{
						if(!(isset($_SESSION['patientid'])))
						{
							echo "<a href='appointmentapproval.php?editid=$rs[appointmentid]&patientid=$rs[patientid]' class='btn btn-sm btn-raised g-bg-cyan'>Aprobar</a>";
						}
						echo "  <a href='viewappointmentpending.php?delid=$rs[appointmentid]' class='btn btn-sm btn-raised g-bg-blush2'>Eliminar</a>";
					}
					else
					{
						echo "<a href='patientreport.php?patientid=$rs[patientid]&appointmentid=$rs[appointmentid]' class='btn btn-raised'>Ver reporte</a>";
					}
					echo "</td></tr>";
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