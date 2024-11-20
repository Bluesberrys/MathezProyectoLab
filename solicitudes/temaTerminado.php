<?php
    session_name("sesion_alumno");
    session_start();
    if(isset($_SESSION["alumno"]) and $_SESSION["alumno"]==1)
    {
        include_once "../solicitudes/conexion.php";

        $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);

        $Id_inscrip = mysqli_query($conexion, "SELECT id_inscrip FROM inscripciones WHERE numCta = '$matricula' AND id_curso = '1'");

        $contarID = mysqli_num_rows($Id_inscrip);

        if($contarID == 1)
        {
            $row = mysqli_fetch_array($Id_inscrip, MYSQLI_ASSOC);
            $idInscrip = $row['id_inscrip'];
        }

        if(isset($_GET['tema']))
        {
            $tema = $_GET['tema'];

            switch ($tema)
            {
                case 'conjuntos':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 1");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'funciones':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 2");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'regla-correspondencia':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 3");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'grafica':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 4");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'variacion':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 5");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'polinomios':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 6");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'racionalizacion':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 7");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'razones-trigonometricas':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 8");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'variabilidad':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 9");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;

                case 'sucesiones':
                    $actualizar = mysqli_query($conexion, "UPDATE avances SET estatus = 'Terminado' WHERE id_inscrip = '$idInscrip' AND id_tema = 10");
                    if($actualizar)
                    {
                        header("Location: ../homepage.php");
                    }
                break;
            }
        }
    }
    else
    {
        header("Location: ../index.php"); 
    }

    mysqli_close($conexion);
    
?>