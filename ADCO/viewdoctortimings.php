<?php
include("adformheader.php");
include("dbconnection.php");

if (isset($_GET['delid'])) {
  if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
    $sql = "DELETE FROM doctor_timings WHERE doctor_timings_id='$_GET[delid]'";
    $qsql = mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) == 1) {
      echo "<script>
            Swal.fire({
              title: 'Eliminado!',
              text: 'Se ha eliminado el registro de horarios del doctor con éxito',
              icon: 'success',
              showConfirmButton: false,
              timer:920
            }).then(function() {
                // window.location.href = 'viewdoctortimings.php';
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
                window.location.href = 'viewdoctortimings.php?delid=" . $_GET['delid'] . "&confirm=true';
            } else {
                // window.location.href = 'viewdoctortimings.php'; 
            }
        });
        </script>";
  }
}
?>

<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">Ver horarios de médicos</h2>

  </div>

  <div class="card">

    <section class="container">
      <table class="table table-bordered table-striped table-hover js-exportable dataTable">
        <thead>
          <tr>
            <td>Odontologo</td>
            <td>Horarios disponibles</td>
            <td>Estado</td>
            <td>Acción</td>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT * FROM doctor_timings where doctorid='$_SESSION[doctorid]'";
          $qsql = mysqli_query($con, $sql);
          while ($rs = mysqli_fetch_array($qsql)) {
            $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
            $qsqldoctor = mysqli_query($con, $sqldoctor);
            $rsdoctor = mysqli_fetch_array($qsqldoctor);

            $sqldoct = "SELECT * FROM doctor_timings WHERE doctor_timings_id='$rs[doctor_timings_id]'";
            $qsqldoct = mysqli_query($con, $sqldoct);
            $rsdoct = mysqli_fetch_array($qsqldoct);

            echo "<tr>
          <td>&nbsp;$rsdoctor[doctorname]</td>
          <td>&nbsp;$rsdoct[start_time] - $rsdoct[end_time]</td>
          <td>&nbsp;$rs[status]</td>
          <td width='250'>&nbsp;<a href='doctortimings.php?editid=$rs[doctor_timings_id]' class='btn btn-raised btn-sm g-bg-cyan'>Editar</a>  <a href='viewdoctortimings.php?delid=$rs[doctor_timings_id]' class='btn btn-raised btn-sm g-bg-blush2'>Eliminar</a> </td>
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