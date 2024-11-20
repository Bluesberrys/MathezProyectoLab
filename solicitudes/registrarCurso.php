<?php
    session_name("sesion_alumno");
    session_start();
    if(isset($_SESSION["alumno"]) and $_SESSION["alumno"]==1)
    {
        include_once "conexion.php";

        $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);
        $id_curso = mysqli_real_escape_string($conexion, $_POST["idcurso"]);

        $consulta = mysqli_query($conexion, "SELECT * FROM inscripciones 
        WHERE numCta = '$matricula' AND id_curso = '$id_curso'");

        $cursos = mysqli_num_rows($consulta);

        if($cursos == 1)
        {
            header("Location: ../homepage.php?mensaje=error");
        }
        else
        {
            $insertar = mysqli_query($conexion, "INSERT INTO inscripciones(id_curso, numCta)
            VALUES ('$id_curso', '$matricula')");

            if($insertar)
            {
                header("Location: ../homepage.php?successful=sucessful");
            }
        }
        
        mysqli_close($conexion);

    }
    else
    {
        header("Location:index.php"); 
    }
?>