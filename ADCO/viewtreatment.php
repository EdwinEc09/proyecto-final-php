<?php
include("adformheader.php");
include("dbconnection.php");

if (isset($_GET['delid'])) {
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $sql = "DELETE FROM treatment WHERE treatmentid='$_GET[delid]'";
        $qsql = mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) == 1) {
            echo "<script>
            Swal.fire({
              title: 'Eliminado!',
              text: 'Se ha eliminado el tratamiento con éxito',
              icon: 'success',
              showConfirmButton: false,
              timer: 1500,
            }).then(function() {
                // window.location.href = 'viewtreatment.php';
            });
            </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
          title: '¿Estás seguro?',
          text: 'No podrás revertirlo.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'No, cancelar',
          confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'viewtreatment.php?delid=" . $_GET['delid'] . "&confirm=true';
            } else {
                // window.location.href = 'viewtreatment.php'; 
            }
        });
        </script>";
    }
}
?>



<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">Ver tratamientos disponibles</h2>

  </div>

  <div class="card">

    <section class="container">
     <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
      <tbody>
        <tr>
          <td><strong>Tipo de tratamiento</strong></td>
          <td><strong>Costo</strong></td>
          <td><strong>Nota</strong></td>
          <td><strong>Estado</strong></td>
          <?php
          if(isset($_SESSION['adminid']))
          {
            ?>
            <td><strong>Acción</strong></td>
            <?php
          }
          ?>
        </tr>
        <?php
        $sql ="SELECT * FROM treatment";
        $qsql = mysqli_query($con,$sql);
        while($rs = mysqli_fetch_array($qsql))
        {
          echo "<tr>
          <td>&nbsp;$rs[treatmenttype]</td>
          <td>&nbsp;$$rs[treatment_cost]</td>
          <td>&nbsp;$rs[note]</td>
          <td>&nbsp;$rs[status]</td>";
          if(isset($_SESSION['adminid']))
          {
            echo "<td>&nbsp;
            <a href='treatment.php?editid=$rs[treatmentid]' class='btn btn-raised bg-green'>Editar</a> 
            <a href='viewtreatment.php?delid=$rs[treatmentid]' class='btn btn-raised bg-blush'>Eliminar</a> </td>";
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