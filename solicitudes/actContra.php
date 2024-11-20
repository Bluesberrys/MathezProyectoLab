<?php
    session_name("sesion_alumno");
    session_start();
    if(isset($_SESSION["alumno"]) and $_SESSION["alumno"]==1)
    {
        include_once "../solicitudes/conexion.php";

        $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);

        $passwd = mysqli_real_escape_string($conexion, $_POST["passwd"]);
        $confirmPasswd = mysqli_real_escape_string($conexion, $_POST["confirmPasswd"]);

        $consulta = mysqli_query($conexion, "UPDATE alumnos 
        SET passwd = '$passwd'
        WHERE numCta = '$matricula'");
                    
        if($consulta)
        {
            header('Location: ../public/configPerfil.php?contrasena=contrasena'); 
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