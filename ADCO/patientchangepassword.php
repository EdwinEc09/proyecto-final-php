<?php
include("adheader.php");


include("dbconnection.php");
if(isset($_POST['submit']))
{
	$sql = "UPDATE patient SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND patientid='$_SESSION[patientid]'";
	$qsql= mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'La contraseña se ha actualizado exitosamente',
                    icon: 'success'
                });
            }, 100);
          </script>"; 
	}
	else
	{
		echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Algo malo ha sucedido',
                    icon: 'warning'
                });
            }, 100);
          </script>"; 	
	}
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Contraseña del paciente</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
               <form method="post" action="" name="frmpatchange" onSubmit="return validateform()"
                    style="padding: 10px">
                    <div class="form-group">
                        <label>Contraseña anterior</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="oldpassword" id="oldpassword" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nueva contraseña</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="newpassword" id="newpassword" />

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="password" id="password" />
                        </div>
                    </div>

                    <input class="btn btn-raised g-bg-cyan" type="submit" name="submit" id="submit" value="Enviar" />


                </form>
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
function validateform()
{
    if (document.frmpatchange.oldpassword.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La contraseña anterior no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatchange.oldpassword.focus();
    return false;
}
else if (document.frmpatchange.newpassword.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La nueva contraseña no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatchange.newpassword.focus();
    return false;
}
else if (document.frmpatchange.newpassword.value.length < 6) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La longitud de la nueva contraseña debe tener más de 6 caracteres.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatchange.newpassword.focus();
    return false;
}
else if (document.frmpatchange.newpassword.value != document.frmpatchange.password.value) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La nueva contraseña y la confirmación de contraseña deben ser iguales.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatchange.password.focus();
    return false;
}
else {
    return true;
}
}
</script>
