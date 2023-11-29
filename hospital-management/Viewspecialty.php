<?php
include("adformheader.php");
include("dbconnection.php");

if (isset($_GET['delid'])) {
  $sql = "DELETE FROM specialty WHERE specialtyid='$_GET[delid]'";
  $qsql = mysqli_query($con, $sql);
  if (mysqli_affected_rows($con) == 1) {
    echo "<script>
    Swal.fire({
      title: 'Done!',
      text: 'especialidad eliminada exitosamente',
      type: 'success',
      
    });
    </script>";
  }
}
?>



<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">Ver registro de la especialidad</h2>

  </div>
  <div class="card">

    <section class="container">
      <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <tbody>
          <tr>
            <td><strong>Nombre</strong></td>
            <td><strong>Descripción de la especialidad</strong></td>
            <td><strong>Estado</strong></td>
            <?php
            if (isset($_SESSION['adminid'])) {
            ?>
              <td><strong>Acción</strong></td>
            <?php
            }
            ?>
          </tr>
          <?php
          $sql = "SELECT * FROM specialty";
          $qsql = mysqli_query($con, $sql);
          while ($rs = mysqli_fetch_array($qsql)) {
            echo "<tr>
          <td>$rs[specialtyname]</td>
          <td> $rs[description]</td>
          
          <td>&nbsp;$rs[status]</td>";
            if (isset($_SESSION['adminid'])) {
              echo "<td>&nbsp;
            <a href='specialty.php?editid=$rs[specialtyid]'>Editar</a> | <a href='viewspecialty.php?delid=$rs[specialtyid]'>Borrar</a> </td>";
            }
            echo "</tr>";
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>