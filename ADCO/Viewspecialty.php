
<?php
include("adformheader.php");
include("dbconnection.php");

if (isset($_GET['delid'])) {
    // Check if the delete confirmation is set
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $sql = "DELETE FROM specialty WHERE specialtyid='" . $_GET['delid'] . "'";
        $qsql = mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) == 1) {
            echo "<script>
            Swal.fire({
                title: 'Eliminado!',
                text: 'Se ha eliminado con exito',
                icon: 'success',
                showConfirmButton: false,
                timer:920
            }).then(function() {
                window.location.href = 'Viewspecialty.php'; // Redirect to desired page after deletion
            });
            </script>";
        }
    } else {
        // If confirmation is not set, show confirmation dialog
        echo "<script>
        Swal.fire({
            title: 'Estas seguro?',
            text: 'No podras revertir!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, cancelar!',

            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'Viewspecialty.php?delid=" . $_GET['delid'] . "&confirm=true';
            }else{
              window.location.href = 'Viewspecialty.php';
            }
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
            <a href='specialty.php?editid=$rs[specialtyid]' class='btn btn-sm btn-raised g-bg-cyan'>Editar</a>  <a href='viewspecialty.php?delid=$rs[specialtyid]'  class='btn btn-sm btn-raised g-bg-blush2'>Borrar</a> </td>";
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