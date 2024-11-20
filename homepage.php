<?php
    session_name("sesion_alumno");
    session_start();
    if(isset($_SESSION["alumno"]) and $_SESSION["alumno"]==1)
    {
?>
<?php

  include_once "solicitudes/conexion.php";
  $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);

  $avance = '';
  $fecha_inicio = '';
  $fecha_termino = '';

  $consultaavance = mysqli_query($conexion, "SELECT fecha_inicio, progreso, fecha_termino FROM inscripciones WHERE numCta = '$matricula'");

  $contarAvance = mysqli_num_rows($consultaavance);

  if ($contarAvance > 0) 
  {
    $row = mysqli_fetch_array($consultaavance, MYSQLI_ASSOC);

    $avance = intval($row["progreso"]);
    $inicio = $row["fecha_inicio"];
    $dateInicio = DateTime::createFromFormat('Y-m-d', $inicio);  
    $fecha_inicio = $dateInicio->format('d-m-Y');

    $termino = $row["fecha_termino"];

    if ($termino !== NULL) {
      $dateTermino = DateTime::createFromFormat('Y-m-d', $termino);
      if ($dateTermino) 
      {
        $fecha_termino = $dateTermino->format('d-m-Y');
      }
    }
  }

  $Id_inscrip = mysqli_query($conexion, "SELECT id_inscrip FROM inscripciones WHERE numCta = '$matricula' AND id_curso = '1'");

  $contarID = mysqli_num_rows($Id_inscrip);

  if($contarID == 1)
  {
      $row = mysqli_fetch_array($Id_inscrip, MYSQLI_ASSOC);
      $idInscrip = $row['id_inscrip'];
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mathez - Home</title>
    <link rel="icon" type="image/png" href="./img/M-titanone.png" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Titan+One&display=swap" />
    <link rel="stylesheet" href="./css/styles-home.css" />
    <link rel="stylesheet" href="./css/styles-dark.css" />
    <link rel="stylesheet" href="./css/fonts.css" />
  </head>

  <body>
    <?php
      $nombre = mysqli_real_escape_string($conexion, $_SESSION["nombre"]);
      $materno = mysqli_real_escape_string($conexion, $_SESSION["apellidoM"]);
      $paterno = mysqli_real_escape_string($conexion, $_SESSION["apellidoP"]);
    ?>
    <!-- Header -->
    <header>
      <div class="navbar">
        <div class="title" style="font-size: 10px;">
          <a onclick="navigateToHome(); return false;" class="alt-font">Mathez</a>
        </div>
        <h2 id="userGreeting" class="greeting">
          <?php echo "Hola " . htmlspecialchars($nombre) . " " . htmlspecialchars($paterno) . " " . htmlspecialchars($materno) ?>
        </h2>
        
        <div class="navbar-menu">
          <div class="user-dropdown-container">
            <button id="userDropdownToggle" class="user-icon">
              <!-- <img src="./img/test_pfp.png" alt="" /> -->
              <i class="bi bi-person-circle"></i>
            </button>
            <div class="user-dropdown" id="userDropdown">
              <a href="graficadora.html" class="btn alt-font dropdown-item">Graficadora</a>
              <a href="./public/configPerfil.php" class="btn alt-font dropdown-item">Configuración</a>
              <button onclick="logout()" class="btn alt-font dropdown-item">Cerrar sesión</button>
              <div class="darkmode-container dropdown-item">
                <h4>Modo oscuro</h4>
                <label class="switch">
                  <input type="checkbox" id="darkModeToggle" />
                  <span class="slider"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- body -->
    <main>

      <?php
          if(isset($_GET['successful']))
          {
      ?>
      <div class="custom-success">
          <strong>Te has inscrito al curso</strong>
      </div>
      <?php
          }
      ?>
      <?php
          if(isset($_GET['mensaje']))
          {
      ?>
      <div class="custom-alert">
          <strong>Ya te has inscrito al curso</strong>
      </div>
      <?php
          }
      ?>      

      <div class="container">
        <h3><?php echo "Inicio: " . $fecha_inicio . " | Termino: " . $fecha_termino; ?></h3>
        <div class="container-title">
          <h2 class="alt-font">Tabla de contenidos</h2>
        </div>
        
        <?php
          $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);
          $inscrito = mysqli_query($conexion, "SELECT * FROM inscripciones WHERE numCta = '$matricula'");
          if(mysqli_num_rows($inscrito) > 0)
          {
        ?>
        <div class="barra-contenedor">
            <div class="barra-avance" style="width: <?php echo $avance; ?>%;">
                <?php echo $avance . "%" ?>
            </div>
        </div>
        <?php

          $estatusTema = mysqli_query($conexion, "SELECT id_tema, estatus FROM avances WHERE id_inscrip = '$idInscrip' ");
          $temas = [];
          while ($row = mysqli_fetch_assoc($estatusTema)) 
          {
            $temas[$row['id_tema']] = $row['estatus'];
          }

          $mostrarTema = true;
          
        ?>
        <div class="row" id="mainContent">
          <div class="col">
              <?php
              // Array de datos de los temas de la primera columna
              $temasCol1 = [
                  1 => ['url' => 'temas/conjuntos.php', 'titulo' => 'Conjuntos'],
                  2 => ['url' => 'temas/funciones.php', 'titulo' => 'Tipos de funciones'],
                  3 => ['url' => 'temas/reglaCorrespondencia.php', 'titulo' => 'Regla de correspondencia'],
                  4 => ['url' => 'temas/grafica.php', 'titulo' => 'Características de la gráfica'],
                  5 => ['url' => 'temas/variacion.php', 'titulo' => 'Variación a partir de un comportamiento de casos']
              ];

              // Imprimir los cards de la primera columna
              foreach ($temasCol1 as $id => $info) 
              {
                  if ($id == 1) 
                  {
                      // Mostrar siempre el primer card sin importar el estatus
                      echo "<a href='{$info['url']}' class='card'>
                              <h2>{$id}</h2>
                              <h3 class='card-title'>{$info['titulo']}</h3>
                            </a>";
                  } 
                  elseif ($mostrarTema && isset($temas[$id - 1]) && $temas[$id - 1] == 'Terminado') 
                  {
                      // Mostrar el card si el tema anterior está en estado "Terminado"
                      echo "<a href='{$info['url']}' class='card'>
                              <h2>{$id}</h2>
                              <h3 class='card-title'>{$info['titulo']}</h3>
                            </a>";
                  } 
                  else 
                  {
                      // Imprimir un card deshabilitado
                      echo "<div class='card disabled'>
                              <h2>{$id}</h2>
                              <h3 class='card-title'>{$info['titulo']}</h3>
                            </div>";
                      $mostrarTema = false;
                  }
              }
              ?>
          </div>
          <div class="col">
              <?php
              // Reiniciar la variable para la segunda columna
              $mostrarTema = true;

              // Array de datos de los temas de la segunda columna
              $temasCol2 = [
                  6 => ['url' => 'temas/polinomios.php', 'titulo' => 'Polinomios'],
                  7 => ['url' => 'temas/racionalizacion.php', 'titulo' => 'Racionalización'],
                  8 => ['url' => 'temas/razonesTrigonometricas.php', 'titulo' => 'Razones trigonométricas'],
                  9 => ['url' => 'temas/variabilidad.php', 'titulo' => 'Variabilidad'],
                  10 => ['url' => 'temas/sucesiones.php', 'titulo' => 'Sucesiones']
              ];

              // Imprimir los cards de la segunda columna
              foreach ($temasCol2 as $id => $info) 
              {
                  if ($mostrarTema && isset($temas[$id - 1]) && $temas[$id - 1] == 'Terminado') 
                  {
                      echo "<a href='{$info['url']}' class='card'>
                              <h2>{$id}</h2>
                              <h3 class='card-title'>{$info['titulo']}</h3>
                            </a>";
                  } 
                  else 
                  {
                      // Imprimir un card deshabilitado
                      echo "<div class='card disabled'>
                              <h2>{$id}</h2>
                              <h3 class='card-title'>{$info['titulo']}</h3>
                            </div>";
                      $mostrarTema = false;
                  }
              }
              ?>
          </div>
        </div>
        <?php
          }
        ?>

        <!-- Course enrollment and registration -->
        <div class="course-bttn">
          <button id="showCourseRegistrationButton" class="btn alt-font">Registrar Curso</button>
        </div>
      </div>

      <!-- Course registration form -->
      <div id="courseRegistrationContainer" class="container hidden">
        <h2 id="registrar-curso" class="container-title">Registro de curso</h2>
        <form action="solicitudes/registrarCurso.php" method="POST" id="courseRegistrationForm">
          <div class="form-group">
            <label for="courseSelect">Selecciona un curso:</label>
            <select id="courseOptions" name="idcurso" required>
              <?php
                $consultaCursos = mysqli_query($conexion, "SELECT * FROM cursos ORDER BY id_curso");
                if (mysqli_num_rows($consultaCursos) > 0)
                {
                  
                  echo "<option value=''>[Seleccione]</option>";
                  while ($fila = mysqli_fetch_array($consultaCursos, MYSQLI_ASSOC))
                  { 
                      echo '<option value="' . $fila['id_curso'] . '">' . $fila["nombre"]  . '</option>';
                  }  
                }
                mysqli_close($conexion);
              ?>
            </select>
          </div>
          <!-- <button type="submit" class="btn alt-font">Registrar</button> -->
          <button type="submit" class="cssbuttons-io-button alt-font">
            Registrar
            <div class="icon">
              <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path
                  d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                  fill="currentColor"></path>
              </svg>
            </div>
          </button>
        </form>
      </div>
    </main>

    <!-- Footer -->
    <footer>
      <div class="footer">
        <div class="">
          <p>©</p>
        </div>
        <a href="./sobreNos.html" class="btn">Sobre nosotros</a>
      </div>
    </footer>

    <script src="./js/app.js"></script>

    <script>
        //Script para que al momento de refrescar la página, no aparezca el alert
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

  </body>
</html>

<?php
    }
    else
    {
        header("Location:index.php"); 
    }
?>