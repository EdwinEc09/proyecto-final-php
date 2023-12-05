<?php
session_start();
include("dbconnection.php");

if (isset($_GET['delid'])) {
	if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
		$sql = "DELETE FROM billing_records WHERE billingid='$_GET[delid]'";
		$qsql = mysqli_query($con, $sql);

		if (mysqli_affected_rows($con) == 1) {
			echo "<script>
            Swal.fire({
              title: 'Eliminado!',
              text: 'Se ha eliminado el registro de facturación con éxito',
              icon: 'success'
            }).then(function() {
                window.location.href = 'patientreport.php'; // Redirige a la página deseada después de la eliminación
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
                window.location.href = 'viewpaymentreport.php?delid=" . $_GET['delid'] . "&confirm=true';
            } else {
                window.location.href = 'patientreport.php'; 
            }
        });
        </script>";
	}
}
?>

<section class="container">
	<?php
	$sqlbilling_records = "SELECT * FROM billing WHERE appointmentid='$billappointmentid'";
	$qsqlbilling_records = mysqli_query($con, $sqlbilling_records);
	$rsbilling_records = mysqli_fetch_array($qsqlbilling_records);
	?>
	<table class="table table-bordered table-striped">
		<tbody>
			<tr>
				<th scope="col">
					<div align="right">Número de factura &nbsp; </div>
				</th>
				<td>
					<?php echo $rsbilling_records['billingid']; ?>
				</td>
				<td>Numero de cita &nbsp;</td>
				<td>
					<?php echo $rsbilling_records['appointmentid']; ?>
				</td>
			</tr>
			<tr>
				<th width="442" scope="col">
					<div align="right">Fecha de facturación &nbsp; </div>
				</th>
				<td width="413">
					<?php echo $rsbilling_records['billingdate']; ?>
				</td>
				<td width="413">tiempo de facturacion&nbsp; </td>
				<td width="413">
					<?php echo $rsbilling_records['billingtime']; ?>
				</td>
			</tr>

			<tr>
				<th scope="col">
					<div align="right"></div>
				</th>
				<td></td>
				<th scope="col">
					<div align="right">Total de la factura &nbsp; </div>
				</th>
				<td>
					<?php
					$sql = "SELECT * FROM billing_records where billingid='$rsbilling_records[billingid]'";
					$qsql = mysqli_query($con, $sql);
					$billamt = 0;
					while ($rs = mysqli_fetch_array($qsql)) {
						$billamt = $billamt + $rs['bill_amount'];
					}
					?>
					&nbsp;$
					<?php echo $billamt; ?>
				</td>
			</tr>
			<tr>
				<th width="442" scope="col">
					<div align="right"></div>
				</th>
				<td width="413">&nbsp;</td>
				<th width="442" scope="col">
					<div align="right">Monto del impuesto (5%) &nbsp; </div>
				</th>
				<td width="413">&nbsp;$
					<?php echo $taxamt = 5 * ($billamt / 100); ?>
				</td>
			</tr>

			<tr>
				<th scope="col">
					<div align="right">Motivo de descuento</div>
				</th>
				<td rowspan="4" valign="top">
					<?php echo $rsbilling_records['discountreason']; ?>
				</td>
				<th scope="col">
					<div align="right">Descuento &nbsp; </div>
				</th>
				<td>&nbsp;$
					<?php echo $rsbilling_records['discount']; ?>
				</td>
			</tr>

			<tr>
				<th rowspan="3" scope="col">&nbsp;</th>
				<th scope="col">
					<div align="right">Gran total &nbsp; </div>
				</th>
				<td>&nbsp;$
					<?php echo $grandtotal = ($billamt + $taxamt) - $rsbilling_records['discount']; ?>
				</td>
			</tr>
			<tr>
				<th scope="col">
					<div align="right">Monto de pago </div>
				</th>
				<td>$
					<?php
					$sqlpayment = "SELECT sum(paidamount) FROM payment where appointmentid='$billappointmentid'";
					$qsqlpayment = mysqli_query($con, $sqlpayment);
					$rspayment = mysqli_fetch_array($qsqlpayment);
					echo $rspayment[0];
					?>
				</td>
			</tr>
			<tr>
				<th scope="col">
					<div align="right">Balance de Cuenta</div>
				</th>
				<td>$
					<?php echo $balanceamt = $grandtotal - $rspayment[0]; ?>
				</td>
			</tr>
		</tbody>
	</table>
	<p><strong>Informe de pago:</strong></p>
	<?php
	$sqlpayment = "SELECT * FROM payment where appointmentid='$billappointmentid'";
	$qsqlpayment = mysqli_query($con, $sqlpayment);
	if (mysqli_num_rows($qsqlpayment) == 0) {
		echo "<strong>No se encontraron detalles de la transacción..</strong>";
	} else {
		?>
		<table class="table table-bordered table-striped">
			<tbody>
				<tr>
					<th scope="col">Fecha de pago</th>
					<th scope="col">Tiempo pagado</th>
					<th scope="col">Monto de pago</th>
				</tr>
				<?php
				while ($rspayment = mysqli_fetch_array($qsqlpayment)) {
					?>
					<tr>
						<td>&nbsp;
							<?php echo $rspayment['paiddate']; ?>
						</td>
						<td>&nbsp;
							<?php echo $rspayment['paidtime']; ?>
						</td>
						<td>&nbsp;$
							<?php echo $rspayment['paidamount']; ?>
						</td>
					</tr>
					<?php
				}
				?>

			</tbody>
		</table>
		<?php
	}
	?>
	<p><strong></strong></p>
</section>