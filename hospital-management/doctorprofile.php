<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_SESSION['doctorid']))
	{
		$sql ="UPDATE doctor SET doctorname='$_POST[doctorname]',mobileno='$_POST[mobilenumber]',specialtyid='$_POST[select3]',loginid='$_POST[loginid]',education='$_POST[education]',experience='$_POST[experience]',consultancy_charge='$_POST[consultancy_charge]' WHERE doctorid='$_SESSION[doctorid]'";
		if($qsql = mysqli_query($con,$sql))
		{
            echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Perfil de Odontologo actualizado exitosamente...',
                    icon: 'success'
                });
            }, 100);
          </script>"; 
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO doctor(doctorname,mobileno,specialtyid,loginid,password,status,education,experience) values('$_POST[doctorname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','$_POST[select]','$_POST[education]','$_POST[experience]')";
		if($qsql = mysqli_query($con,$sql))
		{
            echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Registro del paciente actualizado exitosamente...',
                    icon: 'success'
                });
            }, 100);
          </script>"; 
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_SESSION['doctorid']))
{
	$sql="SELECT * FROM doctor WHERE doctorid='$_SESSION[doctorid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Perfil del médico</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <form method="post" action="" name="frmdoctprfl" onSubmit="return validateform()" style="padding: 10px">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre del médico</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="doctorname" id="doctorname"
                                        value="<?php echo $rsedit['doctorname']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Número de teléfono móvil</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="mobilenumber" id="mobilenumber"
                                        value="<?php echo $rsedit['mobileno']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>especialidad</label>
                                <div class="form-line">
                                    <select name="select3" id="select3" class="form-control show-tick">
                                        <option value="">Seleccionar</option>
                                        <?php
													$sqlspecialty= "SELECT * FROM specialty WHERE status='Activo'";
													$qsqlspecialty = mysqli_query($con,$sqlspecialty);
													while($rsspecialty=mysqli_fetch_array($qsqlspecialty))
													{
														if($rsspecialty['specialtyid'] == $rsedit['specialtyid'])
														{
															echo "<option value='$rsspecialty[specialtyid]' selected>$rsspecialty[specialtyname]</option>";
														}
														else
														{
															echo "<option value='$rsspecialty[specialtyid]'>$rsspecialty[specialtyname]</option>";
														}

													}
													?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Ingresar identificación</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="loginid" id="loginid"
                                        value="<?php echo $rsedit['loginid']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Educación</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="education" id="education"
                                        value="<?php echo $rsedit['education']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Experiencia</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="experience" id="experience"
                                        value="<?php echo $rsedit['experience']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Cargo por consultoría</label>
                                <div class="form-line">

                                    <input class="form-control" type="text" name="consultancy_charge"
                                        id="consultancy_charge" value="<?php echo $rsedit['consultancy_charge']; ?>" />
                                </div>
                            </div>

                            <input class="btn btn-raised g-bg-cyan" type="submit" name="submit" id="submit" value="Enviar" />
                        </div>
                    </div>

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
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform() {
    if (document.frmdoctprfl.doctorname.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El nombre del Odontólogo no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.doctorname.focus();
    return false;
}
else if (!document.frmdoctprfl.doctorname.value.match(alphaspaceExp)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El nombre del Odontólogo no es válido.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.doctorname.focus();
    return false;
}
else if (document.frmdoctprfl.mobilenumber.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El número de teléfono móvil no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.mobilenumber.focus();
    return false;
}
else if (!document.frmdoctprfl.mobilenumber.value.match(numericExpression)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El número de teléfono móvil no es válido.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.mobilenumber.focus();
    return false;
}
else if (document.frmdoctprfl.select3.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El ID de especialidad no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.select3.focus();
    return false;
}
else if (document.frmdoctprfl.loginid.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El ID de inicio de sesión no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.loginid.focus();
    return false;
}
else if (!document.frmdoctprfl.loginid.value.match(alphanumericExp)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El ID de inicio de sesión no es válido.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.loginid.focus();
    return false;
}
else if (document.frmdoctprfl.password.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La contraseña no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.password.focus();
    return false;
}
else if (document.frmdoctprfl.password.value.length < 8) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La longitud de la contraseña debe ser superior a 8 caracteres.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.password.focus();
    return false;
}
else if (document.frmdoctprfl.password.value != document.frmdoctprfl.cnfirmpassword.value) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La contraseña y la confirmación de la contraseña deben ser iguales.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.password.focus();
    return false;
}
else if (document.frmdoctprfl.education.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La educación no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.education.focus();
    return false;
}
else if (!document.frmdoctprfl.education.value.match(alphaExp)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La educación no es válida.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.education.focus();
    return false;
}
else if (document.frmdoctprfl.experience.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La experiencia no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.experience.focus();
    return false;
}
else if (!document.frmdoctprfl.experience.value.match(numericExpression)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La experiencia no es válida.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.experience.focus();
    return false;
}
else if (document.frmdoctprfl.select.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Por favor, selecciona el estado.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctprfl.select.focus();
    return false;
}
else {
    return true;
}
}
</script>