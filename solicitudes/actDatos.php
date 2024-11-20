<?php
    session_name("sesion_alumno");
    session_start();
    if(isset($_SESSION["alumno"]) and $_SESSION["alumno"]==1)
    {
        include_once "../solicitudes/conexion.php";

        $matricula = mysqli_real_escape_string($conexion, $_POST["numCta"]);
        $nombre = mysqli_real_escape_string($conexion, $_POST["nombres"]);
        $paterno = mysqli_real_escape_string($conexion, $_POST["apellidoP"]);
        $materno = mysqli_real_escape_string($conexion, $_POST["apellidoM"]);
        $correo = mysqli_real_escape_string($conexion, $_POST["email"]);

        $consulta = mysqli_query($conexion, "UPDATE alumnos 
        SET apellidoP = '$paterno', apellidoM = '$materno', nombres = '$nombre', email = '$correo'
        WHERE numCta = '$matricula' ");
                    
        if($consulta)
        {
            header('Location: ../public/configPerfil.php?editado=editado'); 
        }
        else
        {
            header('Location: ../public/configPerfil.php?error=error');
        }

        mysqli_close($conexion);

    }
    else
    {
        echo "No tienes acceso al sistema";
    }
?>