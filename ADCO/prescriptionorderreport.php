<?php
include("header.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	 $sql ="DELETE FROM prescription_records WHERE prescription_record_id='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('prescription deleted successfully..');</script>";
	}
}
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
			$sql ="UPDATE prescription_records SET prescription_id='$_POST[prescriptionid]',medicine_name='$_POST[medicine]',cost='$_POST[cost]',unit='$_POST[unit]',dosage='$_POST[select2]',status=' $_POST[select]' WHERE prescription_record_id='$_GET[editid]'";
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
		$sql ="INSERT INTO prescription_records(prescription_id,medicine_name,cost,unit,dosage,status) values('$_POST[prescriptionid]','$_POST[medicine]','$_POST[cost]','$_POST[unit]','$_POST[select2]','$_POST[select]')";
		if($qsql = mysqli_query($con,$sql))
		{	
			$billtype = "Prescription update";
			$prescriptionid= $_POST['prescriptionid'];
			echo "<script>alert('Registro de prescripción insertado exitosamente...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM prescription_records WHERE prescription_record_id='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Add New Prescription Record</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
 <table width="200" border="3">
      <tbody>
        <tr>
          <td><strong>Odontologo</strong></td>
          <td><strong>Patient</strong></td>
          <td><strong>Prescription Date</strong></td>
          <td><strong>Status</strong></td>
        </tr>
          <?php
		$sql ="SELECT * FROM prescription WHERE prescriptionid='$_GET[prescriptionid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpatient = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpatient = mysqli_query($con,$sqlpatient);
			$rspatient = mysqli_fetch_array($qsqlpatient);
			
			
		$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoctor = mysqli_query($con,$sqldoctor);
			$rsdoctor = mysqli_fetch_array($qsqldoctor);
			
        echo "<tr>
          <td>&nbsp;$rsdoctor[doctorname]</td>
          <td>&nbsp;$rspatient[patientname]</td>
		   <td>&nbsp;$rs[prescriptiondate]</td>
		<td>&nbsp;$rs[status]</td>
		
        </tr>";
		}
		?>
      </tbody>
    </table>
    
  <h1>View Prescription record</h1>
    <table width="200" border="3">
      <tbody>
        <tr>
          <td><strong>Medicine</strong></td>
          <td><strong>Cost</strong></td>
          <td><strong>Unit</strong></td>
          <td><strong>Dosage</strong></td>
                    <?php
			if(!isset($_SESSION['patientid']))
			{
		  ?>  
          <td><strong>Action</strong></td>
          <?php
			}
			?>
        </tr>
         <?php
		$sql ="SELECT * FROM prescription_records WHERE prescription_id='$_GET[prescriptionid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[medicine_name]</td>
          <td>&nbsp;Rs. $rs[cost]</td>
		   <td>&nbsp;$rs[unit]</td>
		    <td>&nbsp;$rs[dosage]</td>";
			if(!isset($_SESSION['patientid']))
			{
			 echo " <td>&nbsp; <a href='prescriptionrecord.php?delid=$rs[prescription_record_id]&prescriptionid=$_GET[prescriptionid]'>Delete</a> </td>"; 
			}
		echo "</tr>";
		}
		?>
        <tr>
          <td colspan="6"><div align="center">
            <input type="submit" name="print" id="print" value="Print" onclick="myFunction()"/>
          </div></td>
          </tr>
      </tbody>
    </table>
<script>
function myFunction() {
    window.print();
}
</script>

    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
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
        text: 'La fecha de la prescripción no debe estar vacía.',
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