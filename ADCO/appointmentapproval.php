<?php
include("adheader.php");
include("dbconnection.php");
if (isset($_POST['submit'])) {
	if (isset($_GET['editid'])) {
		$sql = "UPDATE patient SET status='Activo' WHERE patientid='$_GET[patientid]'";
		$qsql = mysqli_query($con, $sql);
		$roomid = 0;
		$sql = "UPDATE appointment SET appointmenttype='$_POST[apptype]',specialtyid='$_POST[select5]',doctorid='$_POST[select6]',status='Aprobado',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]' WHERE appointmentid='$_GET[editid]'";
		if ($qsql = mysqli_query($con, $sql)) {
			$roomid = $_POST['select3'];
			$billtype = "Room Rent";
			include("insertbillingrecord.php");
			echo "<script>
    setTimeout(function() {
        var alert = Swal.fire({
            title: '¡Exito!',
			text: '¡Cita registrada exitosamente!',
            icon: 'success',
            showConfirmButton: false,
        });

        // Cerrar la alerta después de 3000 milisegundos (3 segundos)
        setTimeout(function() {
            alert.close();
            window.location='patientreport.php?patientid=$_POST[select4]';
        }, 3000);
    }, 10);
</script>";

		} else {
			echo mysqli_error($con);
		}
	} else {
		$sql = "UPDATE patient SET status='Activo' WHERE patientid='$_POST[select4]'";
		$qsql = mysqli_query($con, $sql);

		$sql = "INSERT INTO appointment(appointmenttype,patientid,roomid,specialtyid,appointmentdate,appointmenttime,doctorid,status) values('$_POST[select2]','$_POST[select4]','$_POST[select3]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]')";
		if ($qsql = mysqli_query($con, $sql)) {
			echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Cita de cita insertado exitosamente',
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
	$sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con, $sql);
	$rsedit = mysqli_fetch_array($qsql);

}
?>


<div class="card ">

	<div class="block-header">
		<h2 class="text-center">Proceso de aprobación de citas</h2>
	</div>
	<form method="post" action="" name="frmappnt" onSubmit="return validateform()">

		<table class="table table-striped">
			<tr>
				<td>Paciente</td>
				<td>
					<?php
					if (isset($_GET['patientid'])) {
						$sqlpatient = "SELECT * FROM patient WHERE patientid='$_GET[patientid]'";
						$qsqlpatient = mysqli_query($con, $sqlpatient);
						$rspatient = mysqli_fetch_array($qsqlpatient);
						echo $rspatient['patientname'] . " (Patient ID - $rspatient[patientid])";
					} else {
						$sqlpatient = "SELECT * FROM patient WHERE status='Activo'";
						$qsqlpatient = mysqli_query($con, $sqlpatient);
						while ($rspatient = mysqli_fetch_array($qsqlpatient)) {
							if ($rspatient['patientid'] == $rsedit['patientid']) {
								echo "<option value='$rspatient[patientid]' selected> $rspatient[patientname](Patient ID - $rspatient[patientid])</option>";
							}
						}
					}
					?>
				</td>
			</tr>

			<tr>
				<td>Especialidad</td>
				<td><select name="select5" id="select5" class="form-control show-tick">
						<option value="">Seleccionar</option>
						<?php
						$sqlspecialty = "SELECT * FROM specialty WHERE status='Activo'";
						$qsqlspecialty = mysqli_query($con, $sqlspecialty);
						while ($rsspecialty = mysqli_fetch_array($qsqlspecialty)) {
							if ($rsspecialty['specialtyid'] == $rsedit['specialtyid']) {
								echo "<option value='$rsspecialty[specialtyid]' selected>$rsspecialty[specialtyname]</option>";
							} else {
								echo "<option value='$rsspecialty[specialtyid]'>$rsspecialty[specialtyname]</option>";
							}

						}
						?>
					</select></td>
			</tr>

			<tr>
				<td>Odontologo</td>
				<td><select name="select6" id="select6" class="form-control show-tick">
						<option value="">Seleccionar</option>
						<?php
						$sqldoctor = "SELECT * FROM doctor INNER JOIN specialty ON specialty.specialtyid=doctor.specialtyid WHERE doctor.status='Activo'";
						$qsqldoctor = mysqli_query($con, $sqldoctor);
						while ($rsdoctor = mysqli_fetch_array($qsqldoctor)) {
							if ($rsdoctor['doctorid'] == $rsedit['doctorid']) {
								echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[specialtyname] ) </option>";
							} else {
								echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[specialtyname] )</option>";
							}
						}
						?>
					</select></td>
			</tr>

			<tr>
				<td>Día de la cita</td>
				<td><input class="form-control" type="date" name="appointmentdate" id="appointmentdate"
						value="<?php echo $rsedit['appointmentdate']; ?>" /></td>
			</tr>
			<tr>
				<td>Hora de la cita</td>
				<td><input class="form-control" type="time" name="time" id="time"
						value="<?php echo $rsedit['appointmenttime']; ?>" /></td>
			</tr>
			<tr>
				<td>Motivo de la cita</td>
				<td><input class="form-control" name="appreason" id="appreason"
						value="<?php echo $rsedit['app_reason']; ?>" /></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input class="btn btn-default" type="submit" name="submit" id="submit"
						value="Entregar" /></td>
			</tr>
			</tbody>
		</table>
	</form>
	<p>&nbsp;</p>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
	function validateform() {
		if (document.frmappnt.select4.value == "") {
			// alert("Patient name should not be empty..");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'Nombre de Paciente no debe ir vacio.',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmappnt.select4.focus();
			return false;
		}
		else if (document.frmappnt.select3.value == "") {
			// alert("Room type should not be empty..");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'El tipo de habitación no debe estar vacía..',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmappnt.select3.focus();
			return false;
		}
		else if (document.frmappnt.select5.value == "") {
			// alert("specialty name should not be empty..");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'Especialidad no debe ir vacio.',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmappnt.select5.focus();
			return false;
		}
		else if (document.frmappnt.appointmentdate.value == "") {
			// alert("Appointment date should not be empty..");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'Fecha no debe ir vacio',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmappnt.appointmentdate.focus();
			return false;
		}
		else if (document.frmappnt.time.value == "") {
			// alert("Appointment time should not be empty..");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'Hora no debe ir vacio.',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmappnt.time.focus();
			return false;
		}
		else if (document.frmappnt.select6.value == "") {
			// alert("Odontologo name should not be empty..");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'Nombre de Odontologo no debe ir vacio',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmappnt.select6.focus();
			return false;
		}
		else if (document.frmappnt.select.value == "") {
			// alert("Kindly select the status..");
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'Estado no debe ir vacio.',
				showConfirmButton: false,
				timer: 2000,
			});
			document.frmappnt.select.focus();
			return false;
		}
		else {
			return true;
		}
	}
	$('.out_patient').hide();
	$('#apptype').change(function () {
		apptype = $('#apptype').val();
		if (apptype == 'InPatient') {
			$('.out_patient').show();
		}
		else {
			$('.out_patient').hide();
		}
	});
</script>