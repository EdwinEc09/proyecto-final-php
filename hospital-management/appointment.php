<?php

include("adheader.php");
include("dbconnection.php");
if (isset($_POST['submit'])) {
    if (isset($_GET['editid'])) {
        $sql = "UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>
           
            Swal.fire({
                title: '¡Exito!',
                text: '¡Cita actualizada exitosamente!',
                icon: 'success'
              });
            </script>";
        } else {
            echo mysqli_error($con);
        }
    } else {
        $sql = "UPDATE patient SET status='Activo' WHERE patientid='$_POST[select4]'";
        $qsql = mysqli_query($con, $sql);

        $sql = "INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]','$_POST[appreason]')";
        if ($qsql = mysqli_query($con, $sql)) {

            include("insertbillingrecord.php");
            echo "<script>
            Swal.fire({
                title: '¡Exito!',
                text: '¡Cita insertada exitosamente!',
                icon: 'success'
              });
            </script>";
            echo "<script>window.location='patientreport.php?patientid=$_POST[select4]';</script>";
        } else {
            echo mysqli_error($con);
        }
    }
}
if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Reservar una cita</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>INFORMACIÓN DE LA CITA</h2>

                </div>
                <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
                    <input type="hidden" name="select2" value="Offline">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        if (isset($_GET['patid'])) {
                                            $sqlpatient = "SELECT * FROM patient WHERE patientid='$_GET[patid]'";
                                            $qsqlpatient = mysqli_query($con, $sqlpatient);
                                            $rspatient = mysqli_fetch_array($qsqlpatient);
                                            echo $rspatient['patientname'] . " (Patient ID - $rspatient[patientid])";
                                            echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
                                        } else {
                                            ?>
                                            <select name="select4" id="select4" class=" form-control show-tick">
                                                <option value="">Seleccionar paciente</option>
                                                <?php
                                                $sqlpatient = "SELECT * FROM patient WHERE status='Activo'";
                                                $qsqlpatient = mysqli_query($con, $sqlpatient);
                                                while ($rspatient = mysqli_fetch_array($qsqlpatient)) {
                                                    if ($rspatient['patientid'] == $rsedit['patientid']) {
                                                        echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
                                                    } else {
                                                        echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select5" id="select5" class=" form-control show-tick">
                                            <option value="">Seleccionar departamento</option>
                                            <?php
                                            $sqldepartment = "SELECT * FROM department WHERE status='Activo'";
                                            $qsqldepartment = mysqli_query($con, $sqldepartment);
                                            while ($rsdepartment = mysqli_fetch_array($qsqldepartment)) {
                                                if ($rsdepartment['departmentid'] == $rsedit['departmentid']) {
                                                    echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
                                                } else {
                                                    echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="date" name="appointmentdate"
                                            id="appointmentdate" value="<?php echo $rsedit['appointmentdate']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="time" name="time" id="time"
                                            value="<?php echo $rsedit['appointmenttime']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select6" id="select6" class=" form-control show-tick">
                                            <option value="">Seleccionar medico</option>
                                            <?php
                                            $sqldoctor = "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Activo'";
                                            $qsqldoctor = mysqli_query($con, $sqldoctor);
                                            while ($rsdoctor = mysqli_fetch_array($qsqldoctor)) {
                                                if ($rsdoctor['doctorid'] == $rsedit['doctorid']) {
                                                    echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
                                                } else {
                                                    echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p>Motivo de la cita</p>
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" name="appreason"
                                            id="appreason" s><?php echo $rsedit['app_reason']; ?></textarea>


                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <div class="form-group drop-custum">
                                    <select name="select" id="select" class=" form-control show-tick">

                                        <option value="">Seleccionar estado</option>
                                        <?php
                                        $arr = array("Pendiente", "Aprobado");
                                        foreach ($arr as $val) {
                                            if ($val == $rsedit['status']) {
                                                echo "<option value='$val' selected>$val</option>";
                                            } else {
                                                echo "<option value='$val'>$val</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12">

                                <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"
                                    value="Entregar" />

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
















<?php include 'adfooter.php'; ?>
<script type="application/javascript">
    function validateform() {
        if (document.frmappnt.select4.value == "") {
            // alert("El nombre del paciente no debe estar vacío.");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'El nombre del paciente no debe estar vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
            document.frmappnt.select4.focus();
            return false;

        } else if (document.frmappnt.select5.value == "") {
            // alert("El tipo de habitación no debe estar vacía.");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'El departamento no debe estar vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
            document.frmappnt.select5.focus();
            return false;
        } else if (document.frmappnt.appointmentdate.value == "") {
            // alert("La fecha de la cita no debe estar vacía.");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'la fecha de la cita no debe estar vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
            document.frmappnt.appointmentdate.focus();
            return false;
        } else if (document.frmappnt.time.value == "") {
            // alert("El tiempo de la cita no debe estar vacío.");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'la hora de la cita no debe estar vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
            document.frmappnt.time.focus();
            return false;
        } else if (document.frmappnt.select6.value == "") {
            // alert("El nombre del médico no debe estar vacío.");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'el nombre del medico no debe estar vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
            document.frmappnt.select6.focus();
            return false;
        } else if (document.frmappnt.appreason.value == "") {
            // alert("Room type should not be empty..");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'El motivo no debe estar vacio.',
                showConfirmButton: false,
                timer: 2000,
            });
            document.frmappnt.appreason.focus();
            return false;
        } else if (document.frmappnt.select.value == "") {
            // alert("Por favor seleccione el estado.");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Por favor, seleccione estado',
                showConfirmButton: false,
                timer: 2000,
            });
            document.frmappnt.select.focus();
            return false;
        } else {
            return true;
        }
    }
</script>