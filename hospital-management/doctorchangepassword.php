<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	$sql = "UPDATE doctor SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND doctorid='$_SESSION[doctorid]'";
	$qsql= mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password has been updated successfully..');</script>";
	}
	else
	{
		echo "<script>alert('Failed to update password..');</script>";		
	}
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Contraseña del Odontologo</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmdoctchangepass" onSubmit="return validateform()"
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
                        <label>confirmar Contraseña</label>
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
function validateform1() {
    if (document.frmdoctchangepass.oldpassword.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La contraseña antigua no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctchangepass.oldpassword.focus();
    return false;
}
else if (document.frmdoctchangepass.newpassword.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La nueva contraseña no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctchangepass.newpassword.focus();
    return false;
}
else if (document.frmdoctchangepass.newpassword.value.length < 8) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La longitud de la nueva contraseña debe ser superior a 8 caracteres.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctchangepass.newpassword.focus();
    return false;
}
else if (document.frmdoctchangepass.newpassword.value != document.frmdoctchangepass.password.value) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La nueva contraseña y la confirmación de la contraseña deben ser iguales.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctchangepass.password.focus();
    return false;
}
else {
    return true;
}
}
</script>