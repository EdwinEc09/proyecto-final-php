<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	 $sql ="DELETE FROM prescription_records WHERE prescription_record_id='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
			echo "<script>window.location='prescriptionrecord.php?prescriptionid=$_GET[prescriptionid]';</script>";
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
			echo "<script>
			Swal.fire({
				title: 'Registro¡',
				text: 'registro de prescripción actualizado exitosamente...',
				icon: 'secces',
				showConfirmButton: false,
			  });
			</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO prescription_records(prescription_id,medicine_name,cost,unit,dosage,status) values('$_POST[prescriptionid]','$_POST[medicineid]','$_POST[cost]','$_POST[unit]','$_POST[select2]','Activo')";
		if($qsql = mysqli_query($con,$sql))
		{	
			$presamt=$_POST['cost']*$_POST['unit'];
			$billtype = "Prescription update";
			$prescriptionid= $_POST['prescriptionid'];
			include("insertbillingrecord.php");
			echo "<script>alert('Registro de prescripción insertado exitosamente...');</script>";
			echo "<script>setTimeout(function () {window.location='prescriptionrecord.php?prescriptionid=$_GET[prescriptionid]&patientid=$_GET[patientid]&appid=$_GET[appid]';},1000);</script>";
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


<div class="container-fluid">
	<div class="block-header"><h2>Agregar nueva receta</h2></div>
  <div class="card" style="padding:10px">
 <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td><strong>Odontologo</strong></td>
          <td><strong>Paciente</strong></td>
          <td><strong>Fecha de prescripción</strong></td>
          <td><strong>Estado</strong></td>
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
	</div>
	
	<div class="card" style="padding:10px">
  
           <?php
			if(!isset($_SESSION['patientid']))
			{
		  ?>  
<form method="post" action="" name="frmpresrecord" onSubmit="return validateform()"> 
  <input type="hidden" name="prescriptionid" value="<?php echo $_GET['prescriptionid']; ?>"  />
    <table class="table table-striped">
      <tbody>
      
        <tr>
          <td width="34%">Medicamento</td>
          <td width="66%">
		  <select class="form-control show-tick" name="medicineid" id="medicineid" onchange="loadmedicine(this.value)">
		  <option value="">Seleccione Medicamento</option>
		  <?php
		$sqlmedicine ="SELECT * FROM medicine WHERE status='Activo'";
		$qsqlmedicine = mysqli_query($con,$sqlmedicine);
		while($rsmedicine = mysqli_fetch_array($qsqlmedicine))
		{
			echo "<option value='$rsmedicine[medicineid]'>$rsmedicine[medicinename] ( $ $rsmedicine[medicinecost] )</option>";
		}
		?>
		  </select>
		  </td>
        </tr>
        <tr>
          <td>Costo</td>
          <td><input class="form-control" type="text" name="cost" id="cost" value="<?php echo $rsmedicine['medicinecost']; ?>" readonly style="background-color:pink;" /></td>
        </tr>
        <tr>
          <td>Unidad</td>
          <td><input class="form-control" type="number" min="1" name="unit" id="unit" value="<?php echo $rsedit['unit']; ?>" onkeyup="calctotalcost(cost.value,this.value)" onchange="" /></td>
        </tr>
        <tr>
          <td>Costo total</td>
          <td><input class="form-control" type="text" name="totcost" id="totcost" value="<?php echo $rsedit['cost']; ?>" readonly style="background-color:pink;" /></td>
        </tr>
        <tr>
          <td>Dosis</td>
          <td><select class="form-control show-tick" name="select2" id="select2">
           <option value="">Seleccionar</option>
          <?php
		  $arr = array("0-0-1","0-1-1","1-0-1","1-1-1","1-1-0","0-1-0","1-0-0");
		  foreach($arr as $val)
		  {
			 if($val == $rsedit['dosage'])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
          </select></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input class="btn btn-raised bg-cyan" type="submit" name="submit" id="submit" value="Entregar" /> </td>
        </tr>
      </tbody>
    </table>
    </form>
    <?php
			}
		?>
	</div>
	<div class="block-header"><h2>Ver registro de prescripción</h2></div>
    
  	<div class="card" style="padding:10px">
    <table class="table table-hover table-striped">
      <tbody>
        <tr>
          <td><strong>Medicamento</strong></td>
          <td><strong>Dosis</strong></td>
          <td><strong>Costo</strong></td>
          <td><strong>Unidad</strong></td>
          <td><strong>Total</strong></td>
                    <?php
			if(!isset($_SESSION['patientid']))
			{
		  ?>  
          <td><strong>Acción</strong></td>
          <?php
			}
			?>
        </tr>
         <?php
		 $gtotal=0;
		$sql ="SELECT * FROM prescription_records LEFT JOIN medicine on prescription_records.medicine_name=medicine.medicineid WHERE prescription_id='$_GET[prescriptionid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[medicinename]</td>
		    <td>&nbsp;$rs[dosage]</td>
          <td>&nbsp;$$rs[cost]</td>
		   <td>&nbsp;$rs[unit]</td>
		   <td >$" . $rs['cost'] * $rs['unit'] . "</td>";
			if(!isset($_SESSION['patientid']))
			{
			 echo " <td>&nbsp; <a href='prescriptionrecord.php?delid=$rs[prescription_record_id]&prescriptionid=$_GET[prescriptionid]'>Eliminar</a> </td>"; 
			}
		echo "</tr>";
		$gtotal = $gtotal+($rs['cost'] * $rs['unit']);
		}
		?>
        <tr>
          <th colspan="4" align="right">Gran total </th>
		  <th align="right">$<?php echo $gtotal; ?></th>
		  <td></td>
          </tr>
        <tr>
          <td colspan="6"><div align="center">
            <input Class="btn btn-raised bg-cyan" type="submit" name="print" id="print" value="Imprimir" onclick="myFunction()"/>
          </div></td>
          </tr>
      </tbody>
    </table>
	
	<table>
	<tr><td>
	 <center><a href='patientreport.php?patientid=<?php echo $_GET['patientid']; ?>&appointmentid=<?php echo $_GET['appid']; ?>'><strong>Ver reporte de paciente>></strong></a></center>
	</td></tr>
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
include("adfooter.php");
?>
<script type="application/javascript">
function loadmedicine(medicineid)
{
	if (window.XMLHttpRequest) 
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("totcost").value = this.responseText;
			document.getElementById("cost").value = this.responseText;
			document.getElementById("unit").value = 1;
		} 
	};
	xmlhttp.open("GET","ajaxmedicine.php?medicineid="+medicineid,true);
	xmlhttp.send();
}

function calctotalcost(cost,qty)
{
	 document.getElementById("totcost").value = parseFloat(cost) * parseFloat(qty);
} 

function validateform()
{
	if (document.frmpresrecord.prescriptionid.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El ID de la prescripción no debe estar vacío.',
    });
    document.frmpresrecord.prescriptionid.focus();
    return false;
} else if (document.frmpresrecord.medicine.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El campo de medicamento no debe estar vacío.',
    });
    document.frmpresrecord.medicine.focus();
    return false;
} else if (document.frmpresrecord.cost.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El costo no debe estar vacío.',
    });
    document.frmpresrecord.cost.focus();
    return false;
} else if (document.frmpresrecord.unit.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La unidad no debe estar vacía.',
    });
    document.frmpresrecord.unit.focus();
    return false;
} else if (document.frmpresrecord.select2.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La dosis no debe estar vacía.',
    });
    document.frmpresrecord.select2.focus();
    return false;
} else if (document.frmpresrecord.select.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, seleccione el estado.',
    });
    document.frmpresrecord.select.focus();
    return false;
} else {
    return true;
}
}
</script>