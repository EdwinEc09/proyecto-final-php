<?php
include("adheader.php");
include("dbconnection.php");

    session_start();
    if(!isset($_SESSION['adminid'])){
        echo "<script>window.location='adminlogin.php';</script>";
    }
    if(!isset($_SESSION['adminid'])){
        echo "<script>window.location='adminlogin.php';</script>";
    }

?>


<div class="container-fluid">
    <div class="block-header">
        <h2>Panel</h2>
        <small class="text-muted">Bienvenido al panel de administración</small>
    </div>

    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="info-box-4 hover-zoom-effect">
                <div class="icon"> <i class="zmdi zmdi-male-female col-blush"></i> </div>
                <div class="content">
                    <div class="text">Total Pacientes</div>
                    <div class="number">
                        <?php
                        $sql = "SELECT * FROM patient WHERE status='Activo'";
                        $qsql = mysqli_query($con,$sql);
                        echo mysqli_num_rows($qsql);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="info-box-4 hover-zoom-effect">
                <div class="icon"> <i class="zmdi zmdi-account-circle col-cyan"></i> </div>
                <div class="content">
                    <div class="text">Total Doctores </div>
                    <div class="number">
                        <?php
                        $sql = "SELECT * FROM doctor WHERE status='Activo' ";
                        $qsql = mysqli_query($con,$sql);
                        echo mysqli_num_rows($qsql);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="info-box-4 hover-zoom-effect">
                <div class="icon"> <i class="zmdi zmdi-account-box-mail col-blue"></i> </div>
                <div class="content">
                    <div class="text">Total Administratores</div>
                    <div class="number">
                        <?php
                        $sql = "SELECT * FROM admin WHERE status='Activo'";
                        $qsql = mysqli_query($con,$sql);
                        echo mysqli_num_rows($qsql);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="info-box-4 hover-zoom-effect">
                <div class="icon"> <i class="zmdi zmdi-money col-green"></i> </div>
                <div class="content">
                    <div class="text">Ingresos hospitalarios</div>
                    <div class="number">$ 
                        <?php 
              $sql = "SELECT sum(bill_amount) as total  FROM `billing_records` ";
              $qsql = mysqli_query($con,$sql);
              while ($row = mysqli_fetch_assoc($qsql))
              { 
               echo $row['total'];
             }
              ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


   

    <div class="clear"></div>
</div>
</div>
<?php
include("adfooter.php");
?>
