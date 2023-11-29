<?php
session_start();
include("dbconnection.php");
if(isset($_POST['submitapp']))
{
	$sql ="INSERT INTO appointment(appointmenttype,roomid,specialtyid,appointmentdate,appointmenttime,doctorid) values('$_POST[select]','$_POST[select2]','$_POST[select3]','$_POST[date]','$_POST[time]','$_POST[select5]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('appointment record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if (isset($_GET['editid'])) {
	$sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con, $sql);
	$rsedit = mysqli_fetch_array($qsql);

}

$sqlappointment1 = "SELECT max(appointmentid) FROM appointment where patientid='$_GET[patientid]' AND (status='Activo' OR status='Aprobado')";
$qsqlappointment1 = mysqli_query($con, $sqlappointment1);
$rsappointment1 = mysqli_fetch_array($qsqlappointment1);

$sqlappointment = "SELECT * FROM appointment where appointmentid='$rsappointment1[0]'";
$qsqlappointment = mysqli_query($con, $sqlappointment);
$rsappointment = mysqli_fetch_array($qsqlappointment);

if (mysqli_num_rows($qsqlappointment) == 0) {
	echo "<center><h2>Cita no encontrada..</h2></center>";
} else {
	$sqlappointment = "SELECT * FROM appointment where appointmentid='$rsappointment1[0]'";
	$qsqlappointment = mysqli_query($con, $sqlappointment);
	$rsappointment = mysqli_fetch_array($qsqlappointment);

	$sqlroom = "SELECT * FROM room where roomid='$rsappointment[roomid]' ";
	$qsqlroom = mysqli_query($con,$sqlroom);
	$rsroom =mysqli_fetch_array($qsqlroom);
	
	$sqlspecialty = "SELECT * FROM specialty where specialtyid='$rsappointment[specialtyid]'";
	$qsqlspecialty = mysqli_query($con,$sqlspecialty);
	$rsspecialty =mysqli_fetch_array($qsqlspecialty);
	
	$sqldoctor = "SELECT * FROM doctor where doctorid='$rsappointment[doctorid]'";
	$qsqldoctor = mysqli_query($con,$sqldoctor);
	$rsdoctor =mysqli_fetch_array($qsqldoctor);
?>
<table class="table table-bordered table-striped">
  
  
  <tr>
    <td>especialidad</td>
    <td>&nbsp;<?php echo $rsspecialty['specialtyname']; ?></td>
  </tr>
  <tr>
    <td>Doctor</td>
    <td>&nbsp;<?php echo $rsdoctor['doctorname']; ?></td>
  </tr>
  <tr>
    <td>Día de la cita</td>
    <td>&nbsp;<?php echo date("d-M-Y",strtotime($rsappointment['appointmentdate'])); ?></td>
  </tr>
  <tr>
    <td>Hora de la cita</td>
    <td>&nbsp;<?php echo date("h:i A",strtotime($rsappointment['appointmenttime'])); ?></td>
  </tr>
</table>
<?php
}
?>
<script type="application/javascript">
	function validateform() {

		if (document.frmappntdetail.select.value == "") {
			// alert("Appointment type should not be empty..");
			Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'tipo de cita no debe estar vacio',
                showConfirmButton: false,
                timer: 2000,
            });
			document.frmappntdetail.select.focus();
			return false;
		}
		else if (document.frmappntdetail.select2.value == "") {
			// alert("Room type should not be empty..");
			Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Tipo de habitacion no debe estar vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
			document.frmappntdetail.select2.focus();
			return false;
		}
		else if (document.frmappntdetail.select3.value == "") {
			// alert("Department name should not be empty..");
			Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'especialidad no debe ir vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
			document.frmappntdetail.select3.focus();
			return false;
		}
		else if (document.frmappntdetail.date.value == "") {
			// alert("Appointment date should not be empty..");
			Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'fecha no de ir vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
			document.frmappntdetail.date.focus();
			return false;
		}
		else if (document.frmappntdetail.time.value == "") {
			// alert("Appointment time should not be empty..");
			Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'hora de cita no debe ir vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
			document.frmappntdetail.time.focus();
			return false;
		}
		else if (document.frmappntdetail.select5.value == "") {
			// alert("Doctor name should not be empty..");
			Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'doctor no debe ir vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
			document.frmappntdetail.select5.focus();
			return false;
		}
		else {
			return true;
		}
	}
</script>