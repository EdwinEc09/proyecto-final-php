<?php
include("dbconnection.php");
require 'vendor/autoload.php'; // Asegúrate de incluir la librería Twilio

use Twilio\Rest\Client;

$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroTelefono = trim($_POST['telefono']);

    // Verificar si el número de teléfono tiene el formato correcto
    if (!preg_match('/^\d{10}$/', $numeroTelefono)) {
        $error = true;
        echo "<script>
            alert('Número de teléfono incorrecto. Por favor, ingresa un número válido');
            window.location.href = 'Forgotpassword.php'; // Redirigir a la página principal o a donde desees
        </script>";
    } else {
        // Verificar si el número de teléfono existe en la base de datos
        $checkNumero = "SELECT * FROM patient WHERE mobileno = '$numeroTelefono'";
        $resultCheck = mysqli_query($con, $checkNumero);

        if (mysqli_num_rows($resultCheck) == 0) {
            $error = true;
            echo "<script>
                alert('El número de teléfono no existe en la base de datos.');
                window.location.href = 'Forgotpassword.php'; // Redirigir a la página principal o a donde desees
            </script>";
        } else {
            $nuevaClave = generarNuevaClave();
            $hashClave = ($nuevaClave);
            $updateClave = "UPDATE patient SET password='$hashClave' WHERE mobileno='$numeroTelefono'";
            $queryResult = mysqli_query($con, $updateClave);
            if ($queryResult) {
                enviarSMS($numeroTelefono, $nuevaClave);
                echo "<script>
                    alert('Contraseña actualizada correctamente y mensaje enviado.');
                    window.location.href = 'patientlogin.php'; // Redirigir a la página principal o a donde desees
                </script>";
                exit();
            } else {
                $error = true;
                echo "<script>
                    alert('Error al actualizar la contraseña.');
                </script>";
            }
        }
    }
}

function generarNuevaClave()
{
    $longitudClave = 10;
    return substr(md5(microtime()), 1, $longitudClave);
}

function enviarSMS($numeroTelefono, $nuevaClave)
{
    $accountSid = 'ACc5785075a91f5395a2de924da64d7901';
    $authToken = '262ae2bd1093a4e135c22d5122c358d2';
    $twilioNumber = '+18643852858';
    $client = new Client($accountSid, $authToken);
    try {
        $client->messages->create(
            '+57' . $numeroTelefono,
            array(
                'from' => $twilioNumber,
                'body' => 'Tu nueva contraseña temporal de adco es: ' . $nuevaClave,
            )
        );
        echo 'Mensaje enviado correctamente.';
    } catch (Exception $e) {
        $error = true;
        echo 'Error al enviar el mensaje: ' . $e->getMessage();
    }
}

if ($error) {
    // Puedes manejar el error aquí, si es necesario hacer algo adicional
}
?>
