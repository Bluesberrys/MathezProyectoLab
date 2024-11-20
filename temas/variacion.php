<?php
    session_name("sesion_alumno");
    session_start();
    if(isset($_SESSION["alumno"]) and $_SESSION["alumno"]==1)
    {
      include_once "../solicitudes/conexion.php";
      $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);
      $inscrito = mysqli_query($conexion, "SELECT * FROM inscripciones WHERE numCta = '$matricula'");
      if(mysqli_num_rows($inscrito) > 0)
      {
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mathez - Variación</title>
    <link rel="icon" type="image/png" href="../img/M-titanone.png" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Titan+One&display=swap" />
    <link rel="stylesheet" href="../css/styles-home.css" />
    <link rel="stylesheet" href="../css/styles-content.css" />
    <link rel="stylesheet" href="../css/styles-dark.css" />
    <link rel="stylesheet" href="../css/fonts.css" />
  </head>

  <body>
    <header>
      <div class="navbar">
        <div class="title" style="margin-top: 15px; margin-bottom: 15px;">
          <a onclick="navigateToHome(); return false;" class="alt-font">Mathez</a>
        </div>
        <div class="navbar-menu">
          <div class="user-dropdown-container">
            <button id="userDropdownToggle" class="user-icon">
              <!-- <img src="./img/test_pfp.png" alt="" /> -->
              <i class="bi bi-person-circle"></i>
            </button>
            <div class="user-dropdown" id="userDropdown">
                <a href="../homepage.php" class="btn alt-font dropdown-item" style="text-decoration: none;">Inicio</a>
                <a href="../public/configPerfil.php" class="btn alt-font dropdown-item">Configuración</a>
                <a href="../solicitudes/cerrar.php" style="text-decoration: none;">
                    <button type="button" class="btn alt-font dropdown-item">Cerrar sesión</button>
                </a>
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

    <?php
        
      $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);

      $Id_inscrip = mysqli_query($conexion, "SELECT id_inscrip FROM inscripciones WHERE numCta = '$matricula' AND id_curso = '1'");

      $contarID = mysqli_num_rows($Id_inscrip);

      if($contarID == 1)
      {
          $row = mysqli_fetch_array($Id_inscrip, MYSQLI_ASSOC);
          $idInscrip = $row['id_inscrip'];
      }

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 5");

      $contarEstatus = mysqli_num_rows($consultaEstatus);

      if($contarEstatus == 1)
      {
        $row = mysqli_fetch_array($consultaEstatus, MYSQLI_ASSOC);
        $estatus = $row['estatus'];
      }

    ?>

    <main> 
        <br> 
        <?php 
        /*if($estatus == "En progreso") 
        { 
        ?> 
            <button class="btn-tema" type="submit" onclick="actTemaTerminado('variacion')"> Marcar como visto </button> 
        <?php 
        }*/ 
        if($estatus == "Terminado") 
        { 
        ?> 
            <button class="btn-tema" type="submit" onclick="actTemaProgreso('variacion')"> Tema visto </button> 
        <?php
        } 
        ?> 

        <div class="container"> 
            <div class="container-title"> 
                <h1 class="alt-font"> Variación a Partir de un Comportamiento de Casos </h1> 
            </div> 

            <section class="topic-section"> 
                <h2 class="topic-subtitle"> Introducción a la Variación </h2> 
                <p>La variación es un concepto fundamental en matemáticas y ciencias que describe cómo cambian las cantidades en relación con otras. Este tema se centra en cómo se puede analizar la variación a partir de diferentes comportamientos observados en casos específicos. Comprender la variación es crucial para modelar fenómenos naturales, sociales y económicos.</p>
            </section>

            <section class="topic-section"> 
                <h2 class="topic-subtitle"> Tipos de Variación </h2> 

                <h3>1. Variación Directa</h3>
                <p>En la variación directa, dos variables cambian en la misma dirección. Si una variable aumenta, la otra también lo hace. Esto se puede expresar matemáticamente como:</p>
                <p><code>y = kx</code>, donde <code>k</code> es una constante positiva.</p>

                <h3>Ejemplo:</h3>
                <p>Si el precio de un producto aumenta, la cantidad demandada puede aumentar si los consumidores consideran que el producto es más valioso. En este caso, la relación entre precio y demanda es directamente proporcional.</p>

                <h3>2. Variación Inversa</h3>
                <p>En la variación inversa, dos variables cambian en direcciones opuestas. Si una variable aumenta, la otra disminuye. Esto se expresa como:</p>
                <p><code>y = k/x</code>, donde <code>k</code> es una constante positiva.</p>

                <h3>Ejemplo:</h3>
                <p>A medida que aumenta la velocidad de un vehículo, el tiempo que tarda en llegar a un destino disminuye. Esta relación inversa es común en situaciones donde el tiempo y la velocidad están involucrados.</p>
            </section>

            <section class="topic-section"> 
                <h2 class="topic-subtitle"> Comportamiento de Casos </h2> 

                <h3>Análisis de Casos</h3>
                <p>El análisis de casos permite observar cómo varían las cantidades bajo diferentes condiciones. Este enfoque es útil para identificar patrones y tendencias en datos reales.</p>

                <h3>Ejemplos de Comportamiento:</h3>
                <ul>
                    <li><strong>Crecimiento Poblacional:</strong> Estudiar cómo la población de una ciudad cambia con el tiempo debido a factores como la migración y la tasa de natalidad.</li>
                    <li><strong>Consumo Energético:</strong> Analizar cómo varía el consumo de energía según las estaciones del año y los hábitos de los consumidores.</li>
                    <li><strong>Cambio Climático:</strong> Observar cómo las temperaturas globales han cambiado a lo largo del tiempo y cómo esto afecta a los ecosistemas.</li>
                    <li><strong>Tendencias Económicas:</strong> Evaluar cómo varían los precios de los bienes y servicios en respuesta a cambios en la oferta y demanda.</li>
                </ul>
            </section>

            <section class="topic-section"> 
                <h2 class="topic-subtitle"> Aplicaciones Prácticas </h2>

                <h3>Ciencias Sociales</h3>
                <p>En sociología y economía, el análisis de variaciones permite entender fenómenos como el comportamiento del consumidor y las dinámicas del mercado. Por ejemplo, se puede estudiar cómo varía el ingreso familiar con respecto al nivel educativo alcanzado por los miembros del hogar.</p>

                <h3>Ciencias Naturales</h3>
                <p>En biología y ecología, estudiar la variación puede ayudar a comprender los efectos del cambio ambiental sobre las especies y sus hábitats. El análisis de datos sobre poblaciones animales puede revelar patrones de migración o reproducción en respuesta a cambios estacionales.</p>

                <h3>Tecnología e Ingeniería</h3>
                <p>En ingeniería, comprender cómo varían las fuerzas y tensiones en estructuras puede prevenir fallas catastróficas. Por ejemplo, al diseñar puentes o edificios, se deben considerar las variaciones en carga debidas al viento o terremotos.</p>

                <h3>Ciencias de Datos</h3>
                <p>El análisis estadístico utiliza conceptos de variación para interpretar datos complejos. Los modelos predictivos pueden mostrar cómo ciertas variables influyen en otras, permitiendo tomar decisiones informadas basadas en datos históricos.</p>
            </section>

            <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregVariacion.php'"> 
              Realizar Cuestionario 
            <div class="icon"> 
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> 
                    <path d="M0 0h24v24H0z" fill="none"></path> 
                    <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path> 
                </svg> 
            </div>
            </button>

        </div>
    </main>

    <footer>
      <div class="footer">
        <div class="">
          <p>©</p>
        </div>
        <a href="../sobreNos.html" class="btn">Sobre nosotros</a>
      </div>
    </footer>

    <script src="../js/app.js"></script>
  </body>
</html>
<?php
      }
      else
      {
        header("Location: ../homepage.php"); 
      }
      mysqli_close($conexion);
    }
    else
    {
        header("Location: ../index.php"); 
    }
?>