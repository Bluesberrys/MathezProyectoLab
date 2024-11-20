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
    <title>Mathez - Características de la Gráfica</title>
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

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 4");

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
            <button class="btn-tema" type="submit" onclick="actTemaProgreso('grafica')">
            Tema visto
            </button>
        <?php
        }
        ?>
        <div class="container">
            <div class="container-title">
            <h1 class="alt-font">
                <!-- Titulo general del tema -->
            Características de la Gráfica
            </h1>
            </div>

            <!-- * Pueden agregar y eliminar la cantidad de secciones que necesiten segun los subtitulos del temna a trabajar -->
            <section class="topic-section">
            <h2 class="topic-subtitle">
                <!-- subtitulo -->
                ¿Qué es una gráfica?
            </h2>
            <!-- contenido -->
            <p>
            Una gráfica es una representación visual de datos que se utiliza para comunicar información de manera clara y efectiva. 
            Se trata de una herramienta que permite mostrar patrones, relaciones y tendencias en los datos, lo que facilita su comprensión
             e interpretación.
            </p>
            <p>
            Las características de la Gráfica en cálculo, es fundamental para el análisis y comprensión de funciones a través de sus 
            representaciones gráficas. Este tema abarca varios conceptos clave que ayudan a entender cómo una función se comporta y se 
            representa visualmente. A continuación, detallo las características principales, con ejemplos y problemas resueltos.    
            </p>
            <hr>
            <h2>Partes de la gráfica</h2>
            <p>
            Una gráfica está compuesta por varias partes fundamentales que ayudan a interpretar la información visualmente de manera efectiva. 
            Las principales partes de una gráfica son:
            <p>Título: Indica de qué se trata la gráfica y proporciona contexto al lector.</p>
            <p>Ejes:</p>
            <p>Eje X (horizontal): Generalmente se usa para representar la variable independiente.</p>
            <p>Eje Y (vertical): Se utiliza para la variable dependiente.</p>
            <p>Escalas: Las divisiones numéricas o categóricas en los ejes que permiten cuantificar los datos presentados.</p>
            <p>Etiquetas de los ejes: Descripciones breves de lo que representan los ejes X e Y, como "Tiempo (meses)" o "Ventas (miles de unidades)".</p>
            <p>Datos o barras/curvas/puntos: Las representaciones visuales que muestran los valores o datos. Pueden ser barras en un gráfico de barras, 
                líneas en un gráfico de líneas, o puntos en un diagrama de dispersión.</p>
            <p>Cuerpo de la gráfica: La parte central donde se encuentran las barras, líneas, puntos u otros elementos que representan los datos.</p>
            </p>
            <hr>
            <h2>Coordenadas en el Plano</h2>
            <p>
            Para representar los puntos en el plano, necesitamos dos rectas perpendiculares, llamados ejes cartesianos o ejes de coordenadas:
            <li>El eje horizontal se llama eje X o eje de abscisas.</li>
            <li>El eje vertical se llama eje Y o eje de ordenadas.</li>
            <li>El punto O, donde se cortan los dos ejes, es el origen de coordenadas.</li>
            <p>
            Las coordenadas de un punto cualquiera P se representan por (x, y).
            <br>
            Los ejes de coordenadas dividen al plano en cuatro partes iguales y a cada una de ellas se les llama cuadrante.
            </p>
            <img src="./img/grafica.png" alt="grafica" width="500">
            </p>
            <p>Signos de los cuadrantes</p>
            <img src="./img/tabla.png" alt="grafica" width="700">
            <p>Una tabla es una representación de datos, mediante pares ordenados, que expresan 
                la relación existente entre dos magnitudes o dos situaciones.
            </p>
            <hr>
            <h2>Características de la gráfica creciente</h2>
            <p><b>Gráfica creciente:</b> Una gráfica es creciente si al aumentar la variable independiente aumenta la otra variable.</p>
            <p><b>La gráfica sube cuando se mueve de izquierda a derecha; ocurre cuando f′(x)>0 en un intervalo.</b></p>
            <p>
            Una gráfica creciente se caracteriza por representar un aumento en los valores de la variable mostrada a lo largo del eje de las 
            abscisas (horizontal). A continuación, se detallan sus principales características:
            </p>
            <p><b>Pendiente Positiva:</b> La línea o curva se mueve de abajo hacia arriba conforme se avanza de izquierda a derecha.</p>
            <p><b>Intervalos de Crecimiento:</b> La gráfica presenta segmentos donde, para dos puntos <i>x<sub>1</sub></i> y <i>x<sub>2</sub></i> 
            (con <i>x<sub>1</sub></i> &lt; <i>x<sub>2</sub></i>), se cumple que <i>f(x<sub>1</sub>)</i> &lt; <i>f(x<sub>2</sub>)</i>. Esto 
            indica un aumento en los valores de la función.</p>
            <p><b>Curvatura:</b> La gráfica puede ser lineal (una línea recta) o no lineal (una curva). Las curvas pueden tener concavidades hacia 
                arriba (crecimiento acelerado) o hacia abajo (crecimiento desacelerado).</p>
            <p><b>Velocidad de Crecimiento:</b></p>
            <ul>
                <li><strong>Constante:</strong> Si la gráfica es una línea recta, el crecimiento es uniforme.</li>
                <li><strong>Acelerado:</strong> Si la curva es convexa (concavidad hacia arriba), el crecimiento es más rápido.</li>
                <li><strong>Desacelerado:</strong> Si la curva es cóncava (concavidad hacia abajo), el crecimiento se ralentiza.</li>
            </ul>
            <p><b>Puntos Críticos:</b> La gráfica puede tener puntos de inflexión o máximos/mínimos locales donde el ritmo de crecimiento cambia.</p>
            <p><b>Ejemplos Comunes:</b> Las gráficas crecientes se usan para representar crecimiento económico, ventas de empresas, funciones 
                exponenciales y tasas de cambio positivas.</p>
            <img src="./img/creciente.jpg" alt="grafica" width="300">
            </p>
            <hr>
            <h2>Características de la gráfica decreciente</h2>
            <p>
            Una gráfica decreciente se caracteriza por mostrar una disminución en los valores de la variable representada a lo largo del eje de 
            las abscisas (horizontal). A continuación, se explican sus principales características:
            </p>
            <p>
            <b>La gráfica baja al moverse de izquierda a derecha; ocurre cuando 𝑓′(𝑥) < 0 en un intervalo. </b></p>
            <p><b>Pendiente Negativa:</b> La línea o curva desciende de arriba hacia abajo conforme se avanza de izquierda a derecha.</p>
            <p><b>Intervalos de Decrecimiento:</b> La gráfica presenta segmentos donde, para dos puntos <i>x<sub>1</sub></i> y <i>x<sub>2</sub></i> 
            (con <i>x<sub>1</sub></i> &lt; <i>x<sub>2</sub></i>), se cumple que <i>f(x<sub>1</sub>)</i> &gt; <i>f(x<sub>2</sub>)</i>. Esto indica
             una disminución en los valores de la función.</p>
            <p><b>Curvatura:</b> La gráfica puede ser lineal (una línea recta) o no lineal (una curva). Las curvas pueden tener concavidades hacia arriba 
                o hacia abajo, lo que indica la velocidad de decrecimiento.</p>
            <p>Velocidad de Decrecimiento:</p>
            <ul>
                <li><strong>Constante:</strong> Si la gráfica es una línea recta, el decrecimiento es uniforme.</li>
                <li><strong>Acelerado:</strong> Si la curva es cóncava (concavidad hacia arriba), el decrecimiento se vuelve más rápido.</li>
                <li><strong>Desacelerado:</strong> Si la curva es convexa (concavidad hacia abajo), el decrecimiento se ralentiza.</li>
            </ul>
            <p><b>Puntos Críticos:</b> La gráfica puede incluir puntos de inflexión o mínimos/máximos locales donde el ritmo de decrecimiento varía.</p>
            <p><b>Ejemplos Comunes:</b> Las gráficas decrecientes se usan para representar pérdidas económicas, disminución en las ventas, funciones 
                exponenciales decrecientes y tasas de cambio negativas.</p>
            <img src="./img/decreciente.jpg" alt="grafica" width="300">
            <hr>
            <h2>Características de la gráfica constante</h2>
            <p>
            Una gráfica constante se caracteriza por representar un valor que no cambia a lo largo del eje de las abscisas (horizontal). 
            A continuación, se detallan sus principales características:
            </p>
            <p></b>Pendiente Nula:</b> La línea es completamente horizontal, lo que indica que no hay aumento ni disminución en los valores de la función.</p>
            <p><b>Valores Iguales:</b> Para cualquier par de puntos <i>x<sub>1</sub></i> y <i>x<sub>2</sub></i> 
            en el eje X, se cumple que <i>f(x<sub>1</sub>)</i> = <i>f(x<sub>2</sub>)</i>. Esto significa que el valor de la función es 
            el mismo en todo el intervalo.</p>
            <p><b>Curvatura:</b> No tiene curvatura, ya que la línea es completamente recta y paralela al eje X.</p>
            <p><b>Intervalos Constantes:</b> Toda la gráfica representa un solo intervalo constante en el que no hay variaciones.</p>
            <p><b>Puntos Críticos:</b> No existen puntos de inflexión ni máximos/mínimos locales, ya que el valor no cambia.</p>
            <p><b>Ejemplos Comunes:</b> Las gráficas constantes se utilizan para representar situaciones donde una variable mantiene el mismo valor, 
                como una temperatura constante a lo largo del tiempo, un precio fijo de un producto o un nivel de producción invariable.</p>
            <img src="./img/constante.jpg" alt="grafica" width="300">
            <hr>
            <h2>Ejemplo de gráfica creciente y decreciente</h2>
            <p>
            Consideremos la función <i>f(x) = x<sup>3</sup> − 3x<sup>2</sup></i>.
            </p>
            <p><strong>Derivada:</strong> <i>f′(x) = 3x<sup>2</sup> − 6x</i>.</p>
            <p>Resolver <i>3x<sup>2</sup> − 6x = 0</i> da las soluciones <i>x = 0</i> y <i>x = 2</i>.</p>
            <p>
            Analizando los intervalos <i>(−∞, 0)</i>, <i>(0, 2)</i>, y <i>(2, ∞)</i>:
            </p>
            <ul>
                <li>En el intervalo <i>(−∞, 0)</i> y <i>(2, ∞)</i>, <i>f′(x) > 0</i>, por lo que la función es <strong>creciente</strong>.</li>
                <li>En el intervalo <i>(0, 2)</i>, <i>f′(x) < 0</i>, por lo que la función es <strong>decreciente</strong>.</li>
            </ul>
            <p>Este análisis indica que la función es creciente en los intervalos <i>(−∞, 0)</i> y <i>(2, ∞)</i>, y decreciente en el
             intervalo <i>(0, 2)</i>.</p>
            <hr>
            <h2>Ejemplo de gráfica creciente</h2>
            <p>
            Considere la función <i>f(x) = 2x + 1</i>.
            </p>
            <p>
            Para determinar si la gráfica es creciente, observamos la pendiente de la función. En la ecuación <i>f(x) = mx + b</i>, <i>m</i> 
            representa la pendiente. En este caso, <i>m = 2</i>, que es un valor positivo.
            </p>
            <p>
            <strong>Conclusión:</strong> Cuando la pendiente (<i>m</i>) es positiva, la función es <strong>creciente</strong>, ya que la línea sube
             a medida que se avanza de izquierda a derecha en el eje X.
            </p>
            <p>Ejemplo: Esta función puede representar un incremento constante, como un crecimiento mensual en ventas.</p>
            <hr>

            <h2>Ejemplo de gráfica decreciente</h2>
            <p>
            Considere la función <i>f(x) = −3x + 5</i>.
            </p>
            <p>
            Para determinar si la gráfica es decreciente, observamos la pendiente. En la ecuación <i>f(x) = mx + b</i>, la pendiente <i>m</i> 
            es -3, que es un valor negativo.
            </p>
            <p>
            <strong>Conclusión:</strong> Cuando la pendiente (<i>m</i>) es negativa, la función es <strong>decreciente</strong>, ya que la 
            línea desciende a medida que se avanza de izquierda a derecha en el eje X.
            </p>
            <p>Ejemplo: Esta función podría representar una disminución en el valor de un activo financiero con el tiempo.</p>
            <hr>

            <h2>Ejemplo de gráfica constante</h2>
            <p>
            Considere la función <i>f(x) = 4</i>.
            </p>
            <p>
            Para determinar si la gráfica es constante, observamos que no hay término en <i>x</i>, lo que significa que la función tiene la 
            misma salida para cualquier valor de <i>x</i>. Esto se traduce en una pendiente <i>m = 0</i>.
            </p>
            <p>
            <strong>Conclusión:</strong> Cuando la pendiente es 0, la función es <strong>constante</strong>, y la gráfica es una línea horizontal 
            que indica que no hay cambio en el valor de <i>f(x)</i> a lo largo del eje X.
            </p>
            <p>Ejemplo: Esta función podría representar un precio fijo de un producto a lo largo del tiempo.</p>
            <hr>

            </section>

            <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregGrafica.php'">
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