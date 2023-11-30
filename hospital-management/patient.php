<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',password='$_POST[password]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]',status='$_POST[select]' WHERE patientid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Ficha del paciente actualizada correctamente...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,city,pincode,loginid,password,bloodgroup,gender,dob,status) values('$_POST[patientname]','$dt','$tim','$_POST[address]','$_POST[mobilenumber]','$_POST[city]','$_POST[pincode]','$_POST[loginid]','$_POST[password]','$_POST[select2]','$_POST[select3]','$_POST[dateofbirth]','Activo')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Registro de pacientes insertado con éxito...');</script>";
			$insid= mysqli_insert_id($con);
			if(isset($_SESSION['adminid']))
			{
				echo "<script>window.location='appointment.php?patid=$insid';</script>";	
			}
			else
			{
				echo "<script>window.location='patientlogin.php';</script>";	
			}		
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Panel de registro de pacientes</h2>

    </div>
    <div class="card">

        <form method="post" action="" name="frmpatient" onSubmit="return validateform()" style="padding: 10px">



            <div class="form-group"><label>Nombre del paciente</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="patientname" id="patientname"
                        value="<?php echo $rsedit['patientname']; ?>" />
                </div>
            </div>

            <?php
			if(isset($_GET['editid']))
			{
				?>

            <div class="form-group"><label>Fecha de admisión</label>
                <div class="form-line">
                    <input class="form-control" type="date" name="admissiondate" id="admissiondate"
                        value="<?php echo $rsedit['admissiondate']; ?>" readonly />
                </div>
            </div>


            <div class="form-group"><label>Tiempo de admision</label>
                <div class="form-line">
                    <input class="form-control" type="time" name="admissiontme" id="admissiontme"
                        value="<?php echo $rsedit['admissiontime']; ?>" readonly />
                </div>
            </div>

            <?php
			}
			?>
            <div class="form-group">
                <label>Dirección</label>
                <div class="form-line">
                    <input class="form-control " name="address" id="tinymce" value="<?php echo $rsedit['address']; ?>">
                </div>
            </div>

            <div class="form-group"><label>Número de móvil</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="mobilenumber" id="mobilenumber"
                        value="<?php echo $rsedit['mobileno']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Ciudad</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="city" id="city"
                        value="<?php echo $rsedit['city']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Código PIN</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="pincode" id="pincode"
                        value="<?php echo $rsedit['pincode']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Nombre Usuario</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="loginid" id="loginid"
                        value="<?php echo $rsedit['loginid']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Contraseña</label>
                <div class="form-line">
                    <input class="form-control" type="password" name="password" id="password"
                        value="<?php echo $rsedit['password']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Confirmar contraseña</label>
                <div class="form-line">
                    <input class="form-control" type="password" name="confirmpassword" id="confirmpassword"
                        value="<?php echo $rsedit['confirmpassword']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Grupo sanguíneo</label>
                <div class="form-line"><select class="form-control show-tick" name="select2" id="select2">
                        <option value="">Seleccione</option>
                        <?php
					$arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
					foreach($arr as $val)
					{
						if($val == $rsedit['bloodgroup'])
						{
							echo "<option value='$val' selected>$val</option>";
						}
						else
						{
							echo "<option value='$val'>$val</option>";			  
						}
					}
					?>
                    </select>
                </div>
            </div>


            <div class="form-group"><label>Género</label>
                <div class="form-line"><select class="form-control show-tick" name="select3" id="select3">
                        <option value="">Seleccione</option>
                        <?php
				$arr = array("Masculino","Femenino");
				foreach($arr as $val)
				{
					if($val == $rsedit['gender'])
					{
						echo "<option value='$val' selected>$val</option>";
					}
					else
					{
						echo "<option value='$val'>$val</option>";			  
					}
				}
				?>
                    </select>
                </div>
            </div>


            <div class="form-group"><label>Fecha de nacimiento</label>
                <div class="form-line">
                    <input class="form-control" type="date" name="dateofbirth" max="<?php echo date("Y-m-d"); ?>"
                        id="dateofbirth" value="<?php echo $rsedit['dob']; ?>" />
                </div>
            </div>





            <input class="btn btn-default" type="submit" name="submit" id="submit" value="Enviar" />




        </form>
        <p>&nbsp;</p>
    </div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<?php
include("adformfooter.php");
?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform() {
    if (document.frmpatient.patientname.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El nombre del paciente no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.patientname.focus();
    return false;
}
else if (!document.frmpatient.patientname.value.match(alphaspaceExp)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El nombre del paciente no es válido.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.patientname.focus();
    return false;
}
else if (document.frmpatient.admissiondate.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La fecha de admisión no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.admissiondate.focus();
    return false;
}
else if (document.frmpatient.admissiontme.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El tiempo de admisión no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.admissiontme.focus();
    return false;
}
else if (document.frmpatient.address.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La dirección no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.address.focus();
    return false;
}
else if (document.frmpatient.mobilenumber.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El número de móvil no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.mobilenumber.focus();
    return false;
}
else if (!document.frmpatient.mobilenumber.value.match(numericExpression)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Número de móvil no válido.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.mobilenumber.focus();
    return false;
}
else if (document.frmpatient.city.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Ciudad no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.city.focus();
    return false;
}
else if (!document.frmpatient.city.value.match(alphaspaceExp)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Ciudad no válida.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.city.focus();
    return false;
}
else if (document.frmpatient.pincode.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Pincode no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.pincode.focus();
    return false;
}
else if (!document.frmpatient.pincode.value.match(numericExpression)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Pincode no válido.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.pincode.focus();
    return false;
}
else if (document.frmpatient.loginid.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'ID de inicio de sesión no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.loginid.focus();
    return false;
}
else if (!document.frmpatient.loginid.value.match(alphanumericExp)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Login ID no válido.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.loginid.focus();
    return false;
}
else if (document.frmpatient.password.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La contraseña no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.password.focus();
    return false;
}
else if (document.frmpatient.password.value.length < 8) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La longitud de la contraseña debe ser superior a 8 caracteres.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.password.focus();
    return false;
}
else if (document.frmpatient.password.value != document.frmpatient.confirmpassword.value) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La contraseña y la contraseña de confirmación deben ser iguales.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.confirmpassword.focus();
    return false;
}
else if (document.frmpatient.select2.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Grupo sanguíneo no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.select2.focus();
    return false;
}
else if (document.frmpatient.select3.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El género no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.select3.focus();
    return false;
}
else if (document.frmpatient.dateofbirth.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Fecha de nacimiento no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.dateofbirth.focus();
    return false;
}
else if (document.frmpatient.select.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Por favor, seleccione el estado.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmpatient.select.focus();
    return false;
}
else {
    return true;
}
}
</script>