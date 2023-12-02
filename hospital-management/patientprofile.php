<?php
include("adheader.php");
include("dbconnection.php");
if (isset($_POST['submit'])) {
	$sql = "UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',bloodgroup='$_POST[select2]',EPS='$_POST[select3]',suffering='$_POST[select4]',gender='$_POST[select5]',dob='$_POST[dateofbirth]' WHERE patientid='$_SESSION[patientid]'";
	if ($qsql = mysqli_query($con, $sql)) {
		echo "<script>alert('registro del paciente actualizado exitosamente...');</script>";
	} else {
		echo mysqli_error($con);
	}
}
if (isset($_SESSION['patientid'])) {
	$sql = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
	$qsql = mysqli_query($con, $sql);
	$rsedit = mysqli_fetch_array($qsql);

}
?>



<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center">Perfil de paciente</h2>

	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<form method="post" action="" name="frmpatprfl" onSubmit="return validateform()">
					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label for="">Nombre de paciente</label>
									<div class="form-line">

										<input class="form-control" type="text" name="patientname" id="patientname"
											value="<?php echo $rsedit['patientname']; ?>" />
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label for="">Fecha de admisión</label>
									<div class="form-line">

										<input class="form-control" type="date" name="admissiondate" id="admissiondate"
											value="<?php echo $rsedit['admissiondate']; ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label for="admissiontme">Tiempo de admision</label>
									<div class="form-line">

										<input class="form-control" type="time" name="admissiontme" id="admissiontme"
											value="<?php echo $rsedit['admissiontime']; ?>" />
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group ">
									<label for="">DIRECCIÓN</label>
									<div class="form-line">
										<input class="form-control" name="address" id="address"
											value="<?php echo $rsedit['address']; ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label for="">telefono</label>
									<div class="form-line">
										<input class="form-control" type="text" name="mobilenumber" id="mobilenumber"
											value="<?php echo $rsedit['mobileno']; ?>" />
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<div class="form-line">
										<label for="">Ciudad</label>
										<div class="form-line">
											<input class="form-control" type="text" name="city" id="city"
												value="<?php echo $rsedit['city']; ?>" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<label for="">Cedula</label>
										<div class="form-line">

											<input class="form-control" type="text" name="pincode" id="pincode"
												value="<?php echo $rsedit['pincode']; ?>" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<label for="">Correo electronico</label>
										<div class="form-line">
											<input class="form-control" type="text" name="loginid" id="loginid"
												value="<?php echo $rsedit['loginid']; ?>" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<label for="blood group">Grupo sanguíneo</label>
										<div class="form-line">
											<select name="select2" id="select2" class="form-control show-tick">
												<option value="" selected hidden="">Selecionar</option>
												<?php
												$arr = array("A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-");
												foreach ($arr as $val) {
													if ($val == $rsedit['bloodgroup']) {
														echo "<option value='$val' selected>$val</option>";
													} else {
														echo "<option value='$val'>$val</option>";
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<label for="">EPS</label>
										<div class="form-line">
											<select name="select3" id="select3" class="form-control show-tick">
												<option value="" selected="" hidden="">Seleccionar</option>
												<?php
												$arr = array("Sura", "Conmeva", "Sanitas", "Coosalud");
												foreach ($arr as $val) {
													if ($val == $rsedit['EPS']) {
														echo "<option value='$val' selected>$val</option>";
													} else {
														echo "<option value='$val'>$val</option>";
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<label for="">Padecimiento</label>
										<div class="form-line">
											<select name="select4" id="select4" class="form-control show-tick">
												<option value="" selected="" hidden="">Seleccionar</option>
												<?php
												$arr = array("Hipertensión", "Diabetes", "Alergia", "Artritis", "Problemas auditivos ovisión");
												foreach ($arr as $val) {
													if ($val == $rsedit['suffering']) {
														echo "<option value='$val' selected>$val</option>";
													} else {
														echo "<option value='$val'>$val</option>";
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<label for="">Genero</label>
										<div class="form-line">
											<select name="select5" id="select5" class="form-control show-tick">
												<option value="" selected="" hidden="">Seleccionar</option>
												<?php
												$arr = array("Masculino", "Femenino");
												foreach ($arr as $val) {
													if ($val == $rsedit['gender']) {
														echo "<option value='$val' selected>$val</option>";
													} else {
														echo "<option value='$val'>$val</option>";
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="">Fecha de nacimiento</label>
										<div class="form-line">
											<input class="form-control" type="date" name="dateofbirth" id="dateofbirth"
												value="<?php echo $rsedit['dob']; ?>" />
										</div>
									</div>
								</div>
							</div>





							<div class="col-sm-12">
								<input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"
									value="Actualizar" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>







<?php
include("adfooter.php");
?>
<script type="application/javascript">

	var alphaExp = /^[a-zA-Z]+$/; // Variable para validar solo letras
	var alphaspaceExp = /^[a-zA-Z\s]+$/; // Variable para validar solo letras y espacios
	var numericExpression = /^[0-9]+$/; // Variable para validar solo números
	var alphanumericExp = /^[0-9a-zA-Z]+$/; // Variable para validar números y letras
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; // Variable para validar una dirección de correo electrónico

	function validateform() {
		if (document.frmpatprfl.patientname.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El nombre del paciente no debe estar vacío.',
    });
    document.frmpatprfl.patientname.focus();
    return false;
} else if (!document.frmpatprfl.patientname.value.match(alphaspaceExp)) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El nombre del paciente no es válido.',
    });
    document.frmpatprfl.patientname.focus();
    return false;
} else if (document.frmpatprfl.admissiondate.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La fecha de admisión no debe estar vacía.',
    });
    document.frmpatprfl.admissiondate.focus();
    return false;
} else if (document.frmpatprfl.admissiontme.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La hora de admisión no debe estar vacía.',
    });
    document.frmpatprfl.admissiontme.focus();
    return false;
} else if (document.frmpatprfl.address.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La dirección no debe estar vacía.',
    });
    document.frmpatprfl.address.focus();
    return false;
} else if (document.frmpatprfl.mobilenumber.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El número de móvil no debe estar vacío.',
    });
    document.frmpatprfl.mobilenumber.focus();
    return false;
} else if (!document.frmpatprfl.mobilenumber.value.match(numericExpression)) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El número de móvil no es válido.',
    });
    document.frmpatprfl.mobilenumber.focus();
    return false;
} else if (document.frmpatprfl.city.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La ciudad no debe estar vacía.',
    });
    document.frmpatprfl.city.focus();
    return false;
} else if (!document.frmpatprfl.city.value.match(alphaspaceExp)) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La ciudad no es válida.',
    });
    document.frmpatprfl.city.focus();
    return false;
} else if (document.frmpatprfl.pincode.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El código postal no debe estar vacío.',
    });
    document.frmpatprfl.pincode.focus();
    return false;
} else if (!document.frmpatprfl.pincode.value.match(numericExpression)) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El código postal no es válido.',
    });
    document.frmpatprfl.pincode.focus();
    return false;
} else if (document.frmpatprfl.loginid.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El ID de inicio de sesión no debe estar vacío.',
    });
    document.frmpatprfl.loginid.focus();
    return false;
} else if (!document.frmpatprfl.loginid.value.match(emailExp)) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El ID de inicio de sesión no es válido.',
    });
    document.frmpatprfl.loginid.focus();
    return false;
} else if (document.frmpatprfl.password.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La contraseña no debe estar vacía.',
    });
    document.frmpatprfl.password.focus();
    return false;
} else if (document.frmpatprfl.password.value.length < 8) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La longitud de la contraseña debe ser de al menos 8 caracteres.',
    });
    document.frmpatprfl.password.focus();
    return false;
} else if (document.frmpatprfl.password.value != document.frmpatprfl.confirmpassword.value) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La contraseña y la confirmación de la contraseña deben coincidir.',
    });
    document.frmpatprfl.confirmpassword.focus();
    return false;
} else if (document.frmpatprfl.select2.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El grupo sanguíneo no debe estar vacío.',
    });
    document.frmpatprfl.select2.focus();
    return false;
} else if (document.frmpatprfl.select3.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'El género no debe estar vacío.',
    });
    document.frmpatprfl.select3.focus();
    return false;
} else if (document.frmpatprfl.dateofbirth.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La fecha de nacimiento no debe estar vacía.',
    });
    document.frmpatprfl.dateofbirth.focus();
    return false;
} else if (document.frmpatprfl.select.value == "") {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, seleccione el estado.',
    });
    document.frmpatprfl.select.focus();
    return false;
} else {
    return true;
}
	}

</script>