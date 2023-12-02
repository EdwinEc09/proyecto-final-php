<?php
include("adformheader.php");
include("dbconnection.php");

if (isset($_GET['delid'])) {
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $sql = "DELETE FROM medicine WHERE medicineid='$_GET[delid]'";
        $qsql = mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) == 1) {
            echo "<script>
            Swal.fire({
              title: 'Eliminado!',
              text: 'Se ha eliminado el registro de medicina con éxito',
              icon: 'success'
            }).then(function() {
                window.location.href = 'viewmedicine.php'; // Redirige a la página deseada después de la eliminación
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
                window.location.href = 'viewmedicine.php?delid=" . $_GET['delid'] . "&confirm=true';
            } else {
                window.location.href = 'viewmedicine.php'; 
            }
        });
        </script>";
    }
}
?>

<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View Medicine List</h2>

  </div>
</div>
<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

          <thead>
            <tr>
              <th>Nombre</th>
              <th>Costo</th>
              <th>Descripción</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead> 
          <tbody>

            <?php
            $sql ="SELECT * FROM medicine";
            $qsql = mysqli_query($con,$sql);
            while($rs = mysqli_fetch_array($qsql))
            {
              echo "<tr>
              <td>&nbsp;$rs[medicinename]</td>
              <td>&nbsp;$$rs[medicinecost]</td>
              <td>&nbsp;$rs[description]</td>
              <td>&nbsp;$rs[status]</td>
              <td>&nbsp;
              <a href='medicine.php?editid=$rs[medicineid]' class='btn btn-raised bg-green'>Editar</a> 
              <a href='viewmedicine.php?delid=$rs[medicineid]' class='btn btn-raised bg-blush'>Eliminar</a></td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </section>
     
    </div>
  </div>
</div>

</div>
</div>
<?php
include("adformfooter.php");
?>