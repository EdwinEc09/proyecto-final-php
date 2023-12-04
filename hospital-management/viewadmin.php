<?php
include("adformheader.php");
include("dbconnection.php");

if (isset($_GET['delid'])) {
  if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
    $sql = "DELETE FROM admin WHERE adminid='$_GET[delid]'";
    $qsql = mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) == 1) {
      echo "<script>
            Swal.fire({
              title: 'Eliminado!',
                text: 'Se ha eliminado con exito',
                icon: 'success'
            }).then(function() {
                window.location.href = 'viewadmin.php'; // Redirect to desired page after deletion
            });
            </script>";
    } 
  } else {
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
                window.location.href = 'viewadmin.php?delid=" . $_GET['delid'] . "&confirm=true';
            }else{
              window.location.href = 'viewadmin.php'; 
            }
        });
        </script>";
  }
}
?>

<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">Ver administrador</h2>
  </div>
</div>
<div class="card">
  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">


      <thead>
        <tr>
          <td width="12%" height="40">Nombre del admin</td>
          <td width="11%">Usuario</td>
          <td width="12%">Estado</td>
          <td width="10%">Accion</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM admin";
        $qsql = mysqli_query($con, $sql);
        while ($rs = mysqli_fetch_array($qsql)) {
          echo "<tr>
      <td>$rs[adminname]</td>
      <td>$rs[loginid]</td>
      <td>$rs[status]</td>
      <td>
      <a href='admin.php?editid=$rs[adminid]' class='btn btn-raised g-bg-cyan'>Editar</a> <a href='viewadmin.php?delid=$rs[adminid]' class='btn btn-raised g-bg-blush2'>Borrar</a></td>
      </tr>";
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