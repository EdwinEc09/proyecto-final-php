<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
			$sql ="UPDATE doctor SET doctorname='$_POST[doctorname]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[select]',education='$_POST[education]',experience='$_POST[experience]',consultancy_charge='$_POST[consultancy_charge]' WHERE doctorid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Registro de médico actualizado exitosamente...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO doctor(doctorname,mobileno,departmentid,loginid,password,status,education,experience,consultancy_charge) values('$_POST[doctorname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','Activo','$_POST[education]','$_POST[experience]','$_POST[consultancy_charge]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Registro médico insertado exitosamente...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM doctor WHERE doctorid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center"> Agregar nuevo doctor </h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">


				<form method="post" action="" name="frmdoct" onSubmit="return validateform()" style="padding: 10px">


					
					<div class="form-group"><label>Nombre del medico</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="doctorname" id="doctorname" value="<?php echo $rsedit['doctorname']; ?>" />
				</div>
				</div>


					<div class="form-group"><label>Numero de telefono movil</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit['mobileno']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Especialidad</label> 
						<div class="form-line">
					<select  name="select3" id="select3" class="form-control show-tick">
						<option value="">Seleccionar</option>
						<?php
						$sqldepartment= "SELECT * FROM department WHERE status='Activo'";
						$qsqldepartment = mysqli_query($con,$sqldepartment);
						while($rsdepartment=mysqli_fetch_array($qsqldepartment))
						{
							if($rsdepartment['departmentid'] == $rsedit['departmentid'])
							{
								echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
							}
							else
							{
								echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
							}

						}
						?>
					</select>
				</div>
			</div>

					<div class="form-group"><label>Ingresar identificación</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="loginid" id="loginid" value="<?php echo $rsedit['loginid']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Contraseña</label> 
					<div class="form-line">
					<input class="form-control" type="password" name="password" id="password" value="<?php echo $rsedit['password']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Confirmar contraseña</label> 
					<div class="form-line">
					<input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword" value="<?php echo $rsedit['password']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Educación</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="education" id="education" value="<?php echo $rsedit['education']; ?>" />
				</div>
				</div>


					<div class="form-group"><label>Experiencia</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="experience" id="experience" value="<?php echo $rsedit['experience']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Cargo por consultoría</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="consultancy_charge" id="consultancy_charge" value="<?php echo $rsedit['experience']; ?>"/>
				</div>
				</div>

					<div class="form-group">
					<label>Estado</label> 
					<div class="form-line">
					<select class="form-control show-tick" name="select" id="select">
						<option value="" selected="" hidden>Seleccionar</option>
						<?php
						$arr= array("Activo","Inactivo");
						foreach($arr as $val)
						{
							if($val == $rsedit['status'])
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


					
					<input class="btn btn-default" type="submit" name="submit" id="submit" value="Entregar" />
				


				</form>
			</div>
		</div>
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

function validateform()
{
	if(document.frmdoct.doctorname.value == "")
	{
		alert("El nombre del médico no debe estar vacío.");
		document.frmdoct.doctorname.focus();
		return false;
	}
	else if(!document.frmdoct.doctorname.value.match(alphaspaceExp))
	{
		alert("Nombre del médico no válido.");
		document.frmdoct.doctorname.focus();
		return false;
	}
	else if(document.frmdoct.mobilenumber.value == "")
	{
		alert("El número de móvil no debe estar vacío.");
		document.frmdoct.mobilenumber.focus();
		return false;
	}
	else if(!document.frmdoct.mobilenumber.value.match(numericExpression))
	{
		alert("Número de móvil no válido.");
		document.frmdoct.mobilenumber.focus();
		return false;
	}
	else if(document.frmdoct.select3.value == "")
	{
		alert("El ID del departamento no debe estar vacío.");
		document.frmdoct.select3.focus();
		return false;
	}
	else if(document.frmdoct.loginid.value == "")
	{
		alert("La identificación no debe estar vacía .");
		document.frmdoct.loginid.focus();
		return false;
	}
	else if(!document.frmdoct.loginid.value.match(alphanumericExp))
	{
		alert("La identificación no es valida.");
		document.frmdoct.loginid.focus();
		return false;
	}
	else if(document.frmdoct.password.value == "")
	{
		alert("La contraseña no debe estar vacía.");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.password.value.length < 8)
	{
		alert("La longitud de la contraseña debe tener más de 8 caracteres...");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.password.value != document.frmdoct.cnfirmpassword.value )
	{
		alert("La contraseña y la contraseña de confirmación deben ser iguales.");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.education.value == "")
	{
		alert("La educación no debe estar vacía.");
		document.frmdoct.education.focus();
		return false;
	}
	else if(!document.frmdoct.education.value.match(alphaExp))
	{
		alert("Educación no válida.");
		document.frmdoct.education.focus();
		return false;
	}
	else if(document.frmdoct.experience.value == "")
	{
		alert("La experiencia no debe estar vacía.");
		document.frmdoct.experience.focus();
		return false;
	}
	else if(!document.frmdoct.experience.value.match(numericExpression))
	{
		alert("Experiencia no válida.");
		document.frmdoct.experience.focus();
		return false;
	}
	else if(document.frmdoct.select.value == "" )
	{
		alert("Por favor seleccione el estado.");
		document.frmdoct.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>