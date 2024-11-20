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
    <title>Mathez - Variabilidad Derivada</title>
    <link rel="icon" type="image/png" href="../img/M-titanone.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    <script type="text/x-mathjax-config">
      MathJax.Hub.Config({
          tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
      });
    </script>
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

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 9");

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
        if($estatus == "Terminado")
        {
        ?>
            <button class="btn-tema" type="submit" onclick="actTemaProgreso('variabilidad')">
            Tema visto
            </button>
        <?php
        }
        ?>
      <div class="container">
        <div class="container-title">
          <h1 class="alt-font">
            <!-- Titulo general del tema -->
            Variabilidad derivada
          </h1>
        </div>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            ¿Qué es la variabilidad derivada?
          </h2>
          <!-- contenido -->
          <p>
            Es una medida estadística que se utiliza para analizar la variabilidad de la tasa de cambio en una
            serie de datos. Esta evalúa cuando cambia la diferencia entre valores consecutivos en una serie de
            tiempo.
          </p>
          <p>
            Esta se calcula tomando la diferencia entre valores sucesivos en la serie y luego analizando estos
            cambios a lo largo de todo el conjunto de datos. Si tenemos una serie de datos, la variabilidad
            derivada puede calcularse como el promedio de las diferencias entre los valores sucesivos
          </p>
          <div style="padding: 20px">\[ \frac{1}{n-1} \sum_{i=2}^n |x_i - x_{i-1}| \]</div>
          <p>En donde n es el numero total de puntos en la serie</p>
          <p>Pasos para calcular la variabilidad derivada:</p>
          <ol>
            <li>Calcular las diferencias entre los valores consecutivos de la serie.</li>
            <li>Tomar el valor absoluto de cada diferencia.</li>
            <li>Obtener el promedio de estas diferencias.</li>
          </ol>
          
        </section>
          <section class="topic-section">
            <h2 class="topic-subtitle">
              <!-- subtitulo -->
               <hr>
              Caracteristicas
            </h2>
            <!-- contenido -->
            <div >
              <h3>1. Tasa de cambio (Primera derivada)</h3>
              <p>La primera derivada <code>f'(x)</code> indica cómo cambia la función en un punto específico:</p>
              <ul>
                <li><strong>Crecimiento:</strong> Si <code>f'(x) &gt; 0</code>, la función está creciendo en ese intervalo.</li>
                <li><strong>Decrecimiento:</strong> Si <code>f'(x) &lt; 0</code>, la función está decreciendo en ese intervalo.</li>
                <li><strong>Estacionariedad:</strong> Si <code>f'(x) = 0</code>, la función puede tener un punto crítico.</li>
              </ul>
            </div>
            <div>
              <h3>2. Concavidad y puntos de inflexión (Segunda derivada)</h3>
              <p>La segunda derivada <code>f''(x)</code> describe la curvatura de la función:</p>
              <ul>
                <li><strong>Concavidad hacia arriba:</strong> Si <code>f''(x) &gt; 0</code>, la gráfica es cóncava hacia arriba.</li>
                <li><strong>Concavidad hacia abajo:</strong> Si <code>f''(x) &lt; 0</code>, la gráfica es cóncava hacia abajo.</li>
                <li><strong>Punto de inflexión:</strong> Si <code>f''(x) = 0</code> y cambia de signo, hay un punto de inflexión.</li>
              </ul>
            </div>
            <div>
              <h3>3. Monotonía de la función</h3>
              <p>La primera derivada también determina:</p>
              <ul>
                <li><strong>Intervalo creciente:</strong> La función crece donde <code>f'(x) &gt; 0</code>.</li>
                <li><strong>Intervalo decreciente:</strong> La función decrece donde <code>f'(x) &lt; 0</code>.</li>
              </ul>
            </div>
            <div>
              <h3>4. Extremos relativos</h3>
              <p>Los extremos relativos se identifican usando la primera y segunda derivada:</p>
              <ul>
                <li><strong>Máximo local:</strong> Si <code>f'(x) = 0</code> y <code>f''(x) &lt; 0</code>, hay un máximo relativo.</li>
                <li><strong>Mínimo local:</strong> Si <code>f'(x) = 0</code> y <code>f''(x) &gt; 0</code>, hay un mínimo relativo.</li>
              </ul>
            </div>
            <div >
              <h3>5. Velocidad y aceleración</h3>
              <p>En contextos físicos o de movimiento:</p>
              <ul>
                <li>La primera derivada <code>f'(x)</code> representa la <strong>velocidad</strong>.</li>
                <li>La segunda derivada <code>f''(x)</code> representa la <strong>aceleración</strong>.</li>
              </ul>
            </div>
            <hr>
          <h3>Ejemplo:</h3>
          <p>Imaginemos una serie de datos que representa la temperatura tomada cada hora:</p>
          <p>x=[20,22,21,25,24,26]</p>
          <ol>
            <li>
              Calcular las diferencias entre valores sucesivos:
              <ul>
                <li>22−20=2</li>
                <li>21−22=−1</li>
                <li>25−21=4</li>
                <li>24−25=−1</li>
                <li>26−24=2</li>
              </ul>
            </li>
            <li>
              Tomar el valor absoluto de cada diferencia:
              <ul>
                <li>∣2∣=2</li>
                <li>∣−1∣=1</li>
                <li>∣4∣=4</li>
                <li>∣−1∣=1</li>
                <li>∣2∣=2</li>
              </ul>
            </li>
            <li>
              Obtener el promedio de estas diferencias absolutas:
              <div style="padding: 20px">\[ \frac{2 + 1 + 4 + 1 + 2}{5} = \frac{10}{5} = 2 \]</div>
            </li>
          </ol>
          <hr>
          </section>

        <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregVariabilidad.php'">
            Realizar Cuestionario
            <div class="icon">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path
                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                    fill="currentColor"></path>
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