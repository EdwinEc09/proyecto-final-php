<?php
session_start();
include("dbconnection.php");
?>
		
<table class="table table-bordered table-striped">
          <tr>
            <td><strong>Tipo de tratamiento</strong></td>
            <td><strong>Fecha y hora del tratamiento</strong></td>
            <td><strong>Odontologo</strong></td>
            <td><strong>Descripción del tratamiento</strong></td>
            <td><strong>Descripción del tratamiento</strong></td>
          </tr>
          <?php
		 $sql ="SELECT * FROM treatment_records LEFT JOIN treatment ON treatment_records.treatmentid=treatment.treatmentid WHERE treatment_records.patientid='$_GET[patientid]' AND treatment_records.appointmentid='$_GET[appointmentid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpat = mysqli_query($con,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoc = mysqli_query($con,$sqldoc);
			$rsdoc = mysqli_fetch_array($qsqldoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$rs[treatmentid]'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			$rstreatment = mysqli_fetch_array($qsqltreatment);
				
			echo "<tr>
					<td>&nbsp;$rstreatment[treatmenttype]</td>
					</td><td>&nbsp;" . date("d-m-Y",strtotime($rs['treatment_date'])). "  &nbsp;". date("h:i A",strtotime($rs['treatment_time'])) . "</td>
					<td>&nbsp;$rsdoc[doctorname]</td>
					<td>&nbsp;$rs[treatment_description]";
if(file_exists("treatmentfiles/$rs[uploads]"))
{
	if($rs['uploads'] != "")
	{
		echo "<br><a href='treatmentfiles/$rs[uploads]'>Descargar</a>";
	}
}
					echo "</td>";
			echo "<td>$$rs[treatment_cost]</td></tr>";
		}
		?>
</table>
<?php
if(isset($_SESSION['doctorid']))
{
?>  
<hr>
	<table>
	<tr>
	<td><div align="center"><strong><a href="treatmentrecord.php?patientid=<?php echo $_GET['patientid']; ?>&appid=<?php echo $rsappointment['appointmentid']; ?>">Agregar registros de tratamiento</a></strong></div></td>
	</tr>
	</table>
<?php
}
?>
<script type="application/javascript">
function validateform()
{
	if (document.frmtreatdetail.select.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El nombre del tratamiento no debe estar vacío.',
    });
    document.frmtreatdetail.select.focus();
    return false;
} else if (document.frmtreatdetail.select2.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El nombre del odontólogo no debe estar vacío.',
    });
    document.frmtreatdetail.select2.focus();
    return false;
} else if (document.frmtreatdetail.textarea.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La descripción del tratamiento no debe estar vacía.',
    });
    document.frmtreatdetail.textarea.focus();
    return false;
} else if (document.frmtreatdetail.treatmentfile.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La carga del archivo no debe estar vacía.',
    });
    document.frmtreatdetail.treatmentfile.focus();
    return false;
} else if (document.frmtreatdetail.date.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La fecha del tratamiento no debe estar vacía.',
    });
    document.frmtreatdetail.date.focus();
    return false;
} else if (document.frmtreatdetail.time.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La hora del tratamiento no debe estar vacía.',
    });
    document.frmtreatdetail.time.focus();
    return false;
} else {
    return true;
}
}
</script>
