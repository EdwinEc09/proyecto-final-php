<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE prescription SET treatment_records_id='$_POST[treatmentid]',doctorid='$_POST[select2]',patientid='$_POST[patientid]',prescriptiondate='$_POST[date]',status='$_POST[select]' WHERE prescription_id='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('prescription record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO prescription(treatment_records_id,doctorid,patientid,prescriptiondate,status,appointmentid) values('$_POST[treatmentid]','$_POST[select2]','$_POST[patientid]','$_POST[date]','Activo','$_GET[appid]')";
		if($qsql = mysqli_query($con,$sql))
		{
			$insid= mysqli_insert_id($con);
			$prescriptionid= $insid;
			$prescriptiondate= $_POST['date'];
			$billtype="Prescription charge";
			$billamt=0;
			include("insertbillingrecord.php");	
			echo "<script>alert('Registro de prescripción insertado exitosamente...');</script>";
			echo "<script>window.location='prescriptionrecord.php?prescriptionid=" . $insid . "&patientid=$_GET[patientid]&appid=$_GET[appid]';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM prescription WHERE prescriptionid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>
<div class="container-fluid">
        <div class="block-header">
            <h2>Agregar nueva receta</h2>
            
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card" style="padding: 10px">

     <form method="post" action="" name="frmpres" onSubmit="return validateform()">
     <input type="hidden" name="patientid" value="<?php echo $_GET['patientid']; ?>"  />
     <input type="hidden" name="treatmentid" value="<?php echo $_GET['treatmentid']; ?>"  />
     <input type="hidden" name="appid" value="<?php echo $_GET['appid']; ?>"  />
    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td>Paciente</td>
          <td>
            <?php
		  	$sqlpatient= "SELECT * FROM patient WHERE status='Activo' AND patientid='$_GET[patientid]'";
			$qsqlpatient = mysqli_query($con,$sqlpatient);
			while($rspatient=mysqli_fetch_array($qsqlpatient))
			{
				echo "$rspatient[patientid]- $rspatient[patientname]";
			}
		  ?></td>
        </tr>
        
  <?php
		if(isset($_SESSION['doctorid']))
		{
		?>
        <tr>
          <td>Odontologo</td>
          <td>
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN specialty ON specialty.specialtyid=doctor.specialtyid WHERE doctor.status='Activo' AND doctor.doctorid='$_SESSION[doctorid]'";
				$qsqldoctor = mysqli_query($con,$sqldoctor);
				while($rsdoctor = mysqli_fetch_array($qsqldoctor))
				{
					echo "$rsdoctor[doctorname] ( $rsdoctor[specialtyname] )";
				}
				?>
                <input type="hidden" name="select2" value="<?php echo $_SESSION['doctorid']; ?>"  />
          </td>
        <?php
		}
		else
		{
		?>        
        <tr>
          <td width="34%">Doctor</td>
          <td width="66%"><select class="form-control show-tick" name="select2" id="select2">
          <option value="">Seleccionar</option>
            <?php
          	$sqldoctor= "SELECT * FROM doctor WHERE status='Activo'";
			$qsqldoctor = mysqli_query($con,$sqldoctor);
			while($rsdoctor = mysqli_fetch_array($qsqldoctor))
			{
				if($rsdoctor['doctorid'] == $rsedit['doctorid'])
				{
				echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorid]-$rsdoctor[doctorname]</option>";
				}
				else
				{
				echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorid]-$rsdoctor[doctorname]</option>";				
				}
			}
		  ?>
          </select></td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td>Fecha de prescripción</td>
          <td><input class="form-control" type="date" name="date" id="date" value="<?php echo $rsedit['prescriptiondate']; ?>" /></td>
        </tr>
       
        <tr>
          <td colspan="2" align="center"><input class="btn btn-default" type="submit" name="submit" id="submit" value="Entregar" /></td>
        </tr>
      </tbody>
    </table>
    <p>&nbsp;</p>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
function validateform()
{
	if (document.frmpres.select2.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El nombre del odontólogo no debe estar vacío.',
    });
    document.frmpres.select2.focus();
    return false;
} else if (document.frmpres.select3.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El nombre del paciente no debe estar vacío.',
    });
    document.frmpres.select3.focus();
    return false;
} else if (document.frmpres.date.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La fecha de la receta no debe estar vacía.',
    });
    document.frmpres.date.focus();
    return false;
} else if (document.frmpres.select.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, seleccione el estado.',
    });
    document.frmpres.select.focus();
    return false;
} else {
    return true;
}
}
</script>