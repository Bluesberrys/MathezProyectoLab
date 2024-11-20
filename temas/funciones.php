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
    <title>Mathez - Funciones</title>
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

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 2");

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
            <button class="btn-tema" type="submit" onclick="actTemaTerminado('funciones')">
            Marcar como visto
            </button>
        <?php
        }*/
        if($estatus == "Terminado")
        {
        ?>
            <button class="btn-tema" type="submit" onclick="actTemaProgreso('funciones')">
            Tema visto
            </button>
        <?php
        }
        ?>
      <div class="container">
        <div class="container-title">
          <h1 class="alt-font">
            <!-- Titulo general del tema -->
            Tipos de funciones
          </h1>
        </div>

        <!-- * Pueden agregar y eliminar la cantidad de secciones que necesiten segun los subtitulos del temna a trabajar -->
        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Gráfica Continua
          </h2>
          <img src="./img/FunCont.png" alt="Representación de una grafica continua" width="500">
          <!-- contenido -->
          <p>
            Las funciones continuas son esenciales en el cálculo y análisis matemático porque permiten el uso
            de herramientas como la derivación e integración. Una función continua no tiene interrupciones, lo
            que la hace más fácil de analizar en términos de límites, tasas de cambio y áreas bajo la curva.
          </p>

          <h3>Aplicación:</h3>
          <p>
            En fisica, las funciones continuas se usan para modelar fenómenos que ocurren sin interrupciones,
            como el movimiento de un objeto o el crecimiento de una población.
          </p>

          <h3>Caracterisiticas:</h3>
          <p>
            Una función continua es aquella cuyo gráfico no presenta saltos ni interrupciones. Esto significa
            que puedes dibujar la gráfica sin levantar el lápiz del papel.
          </p>
          <p>Formalmente, una función 𝑓(𝑥) es continua en su punto x=𝑎 si:</p>
          <ol>
            <li>𝑓(𝑎) está definida.</li>
            <li>Existe el limite de 𝑓(𝑥) cuando 𝑥 tiene a 𝑎.</li>
            <li>El limite de 𝑓(𝑥) cuando 𝑥 tiene a 𝑎 es igual a 𝑓(𝑎).</li>
          </ol>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <hr>
            <!-- subtitulo -->
            Grafica discontinua
          </h2>
          <img src="./img/FunDisc.png" alt="Representación de una funcion disontinua" width="500">
          <!-- contenido -->
          <p>
            Las discontinuidades ayudan a identificar cambios abruptos en el comportamiento de una función o
            sistema. En algunos casos, estas discontinuidades pueden representar eventos físicos importantes,
            como una falla en un sistema mecánico o un salto de fase en termodinámica.
          </p>
          <h3>Aplicación</h3>
          <p>
            Se utilizan para modelar situaciones donde hay cambios repentinos, como cuando un interruptor se
            apaga, o cuando los precios en el mercado cambian bruscamente.
          </p>
          <h3>Características:</h3>
          <p>
            na función discontinua tiene al menos un punto en el cual la gráfica se interrumpe, es decir, hay
            saltos, asintotas o agujeros.Existen varios tipos de discontinuidades:
          </p>
          <ol>
            <li>Discontinuidad de salto: La función cambia abruptamente de valor.</li>
            <li>Discontinuidad infinita: Cuando la función tiende a infinito en algún punto.</li>
            <li>
              Discontinuidad removible: Un punto donde la función no está definida, pero podría redefinirse
              para hacerla continua.
            </li>
          </ol>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
             <hr>
            Función creciente
          </h2>
          <img src="./img/FunCrec.png" alt="Representación de una funcion creciente" width="500">
          <!-- contenido -->
          <p>
            Identificar una función creciente permite comprender que la variable dependiente aumenta a medida
            que aumenta la variable independiente. Esto es útil en economía, donde puede representar el
            crecimiento de ingresos respecto a la inversión, o en biología, donde muestra el aumento de una
            población con el tiempo.
          </p>
          <h3>Aplicación</h3>
          <p>
            Se usa para modelar tendencias positivas, como el crecimiento económico, el incremento de la
            temperatura o la aceleración de un objeto.
          </p>
          <h3>Características</h3>
          <ol>
            <li>
              Una función 𝑓 (𝑥) f(x) es creciente en un intervalo si, para cualesquiera dos puntos 𝑥 1 x 1 ​ y
              𝑥 2 x 2 ​ en ese intervalo, si 𝑥 1 Menor que 𝑥 2 x 1 ​ Menor que x 2 ​ , entonces 𝑓 ( 𝑥 1 )
              Menor que 𝑓 ( 𝑥 2 ) f(x 1 ​ ) Menor que f(x 2 ​ ).
            </li>
            <li>
              Esto significa que, a medida que avanzas en la gráfica de izquierda a derecha, la curva sube.
            </li>
          </ol>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
             <hr>
            Función decreciente
          </h2>
          <img src="./img/FunDecr.png" alt="Representación de una función grafica" width="500">
          <!-- contenido -->
          <p>
            Las funciones decrecientes son útiles para modelar situaciones en las que una cantidad disminuye
            conforme otra aumenta. Esto podría representar el agotamiento de recursos, la depreciación de
            activos o la velocidad de desaceleración de un objeto.
          </p>
          <h3>Aplicación</h3>
          <p>
            Son comunes en escenarios como la descomposición de materiales, el descenso de temperatura de un
            cuerpo enfriándose o la reducción en la cantidad de un producto en el inventario.
          </p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
             <hr>
            Clasificación de funciones
          </h2>
          <!-- contenido -->
          <h3>Propósito</h3>
          <p>
            Clasificar funciones ayuda a entender su estructura y comportamiento. Por ejemplo, saber que una
            función es lineal te dice que tendrá una tasa de cambio constante, mientras que una cuadrática
            describe situaciones donde el cambio es acelerado o desacelerado.
          </p>
          <h3>Aplicación</h3>
          <ul>
            <li>
              Funciones lineales: Se usan en economía para modelar ingresos y costos que crecen de manera
              proporcional.
            </li>
            <li>
              Funciones cuadráticas: Son útiles para modelar trayectorias en física, como el movimiento de un
              objeto bajo la influencia de la gravedad.
            </li>
            <li>
              Funciones exponenciales: Se usan para modelar fenómenos de crecimiento rápido, como la
              propagación de una enfermedad o el interés compuesto en finanzas.
            </li>
            <li>
              Funciones trigonométricas: Modelan fenómenos periódicos, como el movimiento de ondas o la
              vibración de cuerdas.
            </li>
          </ul>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
             <hr>
            Composición de funciones
          </h2>
          <!-- contenido -->
          <p>
            La composición de funciones permite combinar varias operaciones matemáticas en un solo paso. Es
            útil cuando un proceso depende de varios factores, y uno de esos factores depende de otro.
          </p>
          <h3>Aplicación</h3>
          <p>
            Se usa en muchos campos: En la física, para describir sistemas en los que una variable depende de
            otra, que a su vez depende de una tercera. En informática, para combinar algoritmos y operaciones
            que se aplican en secuencia. En economía, por ejemplo, si quieres modelar el ingreso en función de
            la demanda, y la demanda depende del precio.
          </p>
          <h3>Ejemplos</h3>
          <ul>
            <li>
              Función continua: Modelar el crecimiento de una planta donde no hay saltos en su altura con el
              tiempo.
            </li>
            <li>Función discontinua: Representar el valor de un activo que se desploma repentinamente.</li>
            <li>Función creciente: El ingreso que aumenta a medida que se venden más productos.</li>
            <li>Función decreciente: El consumo de combustible a medida que se acelera un vehículo.</li>
            <li>
              Clasificación de funciones: Usar una función cuadrática para describir el movimiento de una
              pelota lanzada al aire.
            </li>
            <li>
              Composición de funciones: Si tienes una función que describe la distancia recorrida en función
              del tiempo, y otra que describe la velocidad en función de la distancia, puedes componer ambas
              para obtener una relación directa entre la velocidad y el tiempo.
            </li>
          </ul>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
          </h2>
          <!-- contenido -->
          <p></p>
        </section>

        <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregFunciones.php'">
          Realizar cuestionario
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