<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM patient WHERE patientid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('registro de paciente borrado con éxito ..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">Ver el historial del paciente</h2>

  </div>

<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

      <thead>
        <tr>
          <th width="15%" height="36"><div align="center">Nombre</div></th>
          <th width="20%"><div align="center">Admisión</div></th>
          <th width="28%"><div align="center">Dirección, Contacto</div></th>    
          <th width="20%"><div align="center">Perfil del paciente</div></th>
          <th width="17%"><div align="center">Acción</div></th>
        </tr>
      </thead>
      <tbody>
       <?php
       $sql ="SELECT * FROM patient";
       $qsql = mysqli_query($con,$sql);
       while($rs = mysqli_fetch_array($qsql))
       {
        echo "<tr>
        <td>$rs[patientname]<br>
        <strong>Usuario:</strong> $rs[loginid] </td>
        <td>
        <strong>Fecha:</strong> &nbsp;$rs[admissiondate]<br>
        <strong>Tiempo:</strong> &nbsp;$rs[admissiontime]</td>
        <td>$rs[address]<br>$rs[city] -  &nbsp;$rs[pincode]<br>
        Mob No. - $rs[mobileno]</td>
        <td><strong>Grupo de sangre</strong> - $rs[bloodgroup]<br>
        <strong>Género</strong> - &nbsp;$rs[gender]<br>
        <strong>FECHA DE NACIMIENTO</strong> - &nbsp;$rs[dob]</td>
        <td align='center'>Estado - $rs[status] <br>";
        if(isset($_SESSION['adminid']))
        {
          echo "<a href='patient.php?editid=$rs[patientid]' class='btn btn-sm btn-raised bg-green'>Editar</a><a href='viewpatient.php?delid=$rs[patientid]' class='btn btn-sm btn-raised bg-blush'>Eliminar</a> <hr>
          <a href='patientreport.php?patientid=$rs[patientid]' class='btn btn-sm btn-raised bg-cyan'>Ver el informe</a>";
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