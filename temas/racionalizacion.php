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
    <title>Mathez - Racionalización</title>
    <link rel="icon" type="image/png" href="..img/M-titanone.png" />
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
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
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

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 7");

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
          <button class="btn-tema" type="submit" onclick="actTemaProgreso('racionalizacion')">
          Tema visto
          </button>
      <?php
      }
      ?>
      <div class="container">
        <div class="container-title">
          <h1 class="alt-font">
            <!-- Titulo general del tema -->
          Racionalización de radicales
          </h1>
        </div>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            ¿Que es la Racionalización de radicales?
          </h2>
          <!-- contenido -->
          <p>La racionalización de radicales implica eliminar las raíces del denominador de una fracción, 
            lo que simplifica ciertos cálculos y operaciones matemáticas, haciéndolos más fáciles de resolver 
            y entender. <br><br> Esto es útil, por ejemplo, cuando se manejan fracciones con expresiones que incluyen 
            raíces cuadradas u otros radicales en el denominador, lo que mejora la claridad de las soluciones.</p><hr>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Características
          </h2>
          <!-- contenido -->
          <p>La racionalización en matemáticas es una técnica utilizada para simplificar expresiones que tienen radicales en el denominador de una fracción. </p> 
          <p>
            El objetivo principal es transformar el denominador en un número racional (sin raíces), lo cual facilita el manejo de la expresión en cálculos y análisis algebraicos. </p> 
          <p>
            Este proceso puede implicar multiplicar el numerador y el denominador por el radical correspondiente, o por su conjugado en el caso de expresiones más complejas. </p> 
          <p>  Por ejemplo, si el denominador es una suma como , se utiliza el conjugado  para eliminar el radical.</p>
            <div>
              <ol>
                <li>
                  <p>Racionalización de un solo término : Cuando el denominador tiene solo un término irracional, como una raíz cuadrada, multiplicamos el numerador y el denominador por el mismo término para eliminar la raíz.</p>
                </li>
                <li>
                  <p>
                    Racionalización de dos términos (binomio): Si el denominador tiene dos términos, como una suma o resta de una raíz y otro número, multiplicamos por el conjugado del denominador. El conjugado cambia el signo entre los términos, eliminando la raíz en el proceso.
                  </p>
                </li>
              </ol>
            </div><hr>
            <h2 class="topic-subtitle"> ¿En donde se puede utlizar? </h2>
            <div>
              <ol>
                <p>
                  Cálculos exactos en trigonometría y geometría.</p>
                <p>
                Solución de ecuaciones y simplificación de fracciones.</p>
                <p>
                  Derivadas e integrales en cálculo.</p>
                <p>
                  Expresiones matemáticas en física y ciencias.</p>
                <p>Expresiones matemáticas en física y ciencias.</p>
                <p>Programación y algoritmos.</p> 
              </ol>
            </div><hr>
            <h2 class="topic-subtitle">
              <!-- subtitulo -->
              Ejemplos Practicos: 
            </h2>
            <!-- contenido -->
            <p>
              Para mejor entendimiento vamos a realizar un pequeño ejercicio: 
            </p>
            <h3>Ejemplo de Racionalización sencillo </h3>
            <p>Queremos racionalizar la siguiente fracción:</p>
            <p>\[
            \frac{5}{\sqrt{3}}
            \]</p>
            
            <p>Multiplicamos el numerador y el denominador por \(\sqrt{3}\):</p>
            <p>\[
            \frac{5}{\sqrt{3}} \cdot \frac{\sqrt{3}}{\sqrt{3}} = \frac{5 \cdot \sqrt{3}}{\sqrt{3} \cdot \sqrt{3}}
            \]</p>
            
            <p>Al simplificar, obtenemos:</p>
            <p>\[
            \frac{5 \cdot \sqrt{3}}{3} = \frac{5\sqrt{3}}{3}
            \]</p>
            
            <p>Por lo tanto, el resultado es:</p>
            <p>\[
            \frac{5}{\sqrt{3}} = \frac{5\sqrt{3}}{3}
            \]</p>
            <h3>Ejemplo de Racionalización Avanzada</h3>
            <p>Queremos racionalizar la siguiente fracción:</p>
            <p>\[
            \frac{4}{\sqrt{5} + \sqrt{3}}
            \]</p>

            <p>Multiplicamos el numerador y el denominador por el conjugado del denominador, que es \(\sqrt{5} - \sqrt{3}\):</p>
            <p>\[
            \frac{4}{\sqrt{5} + \sqrt{3}} \cdot \frac{\sqrt{5} - \sqrt{3}}{\sqrt{5} - \sqrt{3}} = \frac{4 (\sqrt{5} - \sqrt{3})}{(\sqrt{5} + \sqrt{3})(\sqrt{5} - \sqrt{3})}
            \]</p>

            <p>Al simplificar el denominador usando la diferencia de cuadrados:</p>
            <p>\[
            (\sqrt{5} + \sqrt{3})(\sqrt{5} - \sqrt{3}) = (\sqrt{5})^2 - (\sqrt{3})^2 = 5 - 3 = 2
            \]</p>

            <p>Entonces la fracción se convierte en:</p>
            <p>\[
            \frac{4 (\sqrt{5} - \sqrt{3})}{2} = 2(\sqrt{5} - \sqrt{3})
            \]</p>

            <p>Por lo tanto, el resultado final es:</p>
            <p>\[
            \frac{4}{\sqrt{5} + \sqrt{3}} = 2(\sqrt{5} - \sqrt{3})
            \]</p><hr>
        </section>
        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Aplicación
          </h2>
          <!-- contenido -->
          <p>La racionalización tiene aplicaciones importantes en varios campos de las matemáticas y las ciencias. 
            En álgebra y cálculo, se utiliza para simplificar expresiones y facilitar la resolución de ecuaciones.</p> 
          <p>
            Esto es especialmente útil en problemas de límites y derivadas donde, al racionalizar, se pueden resolver 
            indeterminaciones que surgen al evaluar directamente expresiones en el contexto del cálculo diferencial.
          </p> 
          <p>
            matemáticas y áreas relacionadas, y sirve principalmente para simplificar expresiones, especialmente cuando involucran raíces cuadradas u otros tipos de raíces, algunas de sus principales aplicaciónes y utlidades serian:
          </p>
          <div>
            <ol>
              <li>
                <p>
                  Simplificación de fracciones: <br>
                  Racionalizar una fracción es útil para eliminar raíces en el denominador, lo que hace la expresión más sencilla de manejar y visualizar</p> 
              </li>
              <li>
                <p>
                  Cálculo de límites: <br>
                  La racionalización es útil cuando se calculan límites en cálculo, especialmente si una fracción tiene una indeterminación como \( \frac{0}{0} \). <br>
                  Al racionalizar el numerador o el denominador, podemos eliminar la indeterminación y encontrar el límite de forma más directa.
                </p>
              </li>
              <li>
                <p>
                  Cálculo de integrales: <br>
                  Las integrales con raíces en el numerador o denominador a menudo requieren racionalización para simplificar la expresión antes de ser integradas. Esto permite usar técnicas de integración más directas y puede hacer que el proceso de encontrar la integral sea más sencillo.
                </p>
              </li>
              <li>
                <p>
                  Resolución de ecuaciones algebraicas: <br>
                  Muchas veces, al resolver ecuaciones que involucran fracciones con raíces, la racionalización facilita despejar incógnitas o transformar la ecuación en una forma más fácil de resolver.
                </p>
              </li>
              <li>
                <p>
                  Solución de problemas con radicales: <br>
                  En álgebra, al tratar con ecuaciones o expresiones que contienen radicales, la racionalización ayuda a reducir la complejidad al eliminar las raíces del denominador. Esto es muy común cuando se trabajan con fracciones y expresiones algebraicas.
                </p>

              </li>
              <li>
                <p>
                  Aplicaciones en física y otras ciencias: <br>
                  En áreas como la física, la ingeniería y la economía, las expresiones que incluyen raíces son comunes. Racionalizar estas expresiones facilita la manipulación algebraica y la interpretación de resultados. Por ejemplo, en la fórmula de la ley de Coulomb para la fuerza eléctrica, o en cálculos relacionados con el movimiento de partículas, las raíces pueden ser racionalizadas para obtener una expresión más manejable.
                </p>
              </li>
              <li>
                <p>
                  Desarrollo de conceptos más avanzados: <br>
                  En matemáticas avanzadas, como en el estudio de series, fracciones continuas, o al trabajar con algunos teoremas de álgebra, la racionalización es un paso que puede facilitar la comprensión y resolución de problemas más complejos.
                </p>
              </li>
            </ol>
          </div>
            
        </section>

        <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregRacionalizacion.php'">
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