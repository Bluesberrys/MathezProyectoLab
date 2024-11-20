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
    <link rel="icon" type="image/png" href="..img/M-titanone.png" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

    <main>
      <div class="container">
        <div class="container-title">
          <h1 class="alt-font">
            <!-- Titulo general del tema -->
           Cuestionario
          </h1>
        </div>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
          </h2>
          <!-- contenido -->
           <p>Ahora que ya entendiste y practicaste los temas vistos, es tiempo de realizar un pequeño cuestionario para poder pasar a la siguiente sección del curso.</p>
           <p>Si tienes una calificación superior a 6 podras avanzar al siguiente tema, si sacas una calificación menor a 6 estaras reprobado, pero no te preocupes, podras realizar otra vez el cuestionario. ¡Mucha suerte! ;3.</p>
           <p>Si obtienes una calificación mayor o igual a 6, podrás avanzar al siguiente tema.</p>
           <br>
           <hr>
           <!-- Cuestionario -->
            <!-- Pregunta 1 -->
            <label for="1func">1.- ¿Qué característica tiene una función continua?</label>
            <form class="my-form">
                <div>
                    <input id="check-1-1" type="checkbox" name="1func" value="incorrecto">
                    <label for="check-1-1">A) Presenta saltos en su gráfico.</label><br>
                </div>
                <div>
                    <input id="check-2-1" type="checkbox" name="1func" value="correcto">
                    <label for="check-2-1">B) Se puede dibujar sin levantar el lápiz del papel.</label><br>
                </div>
                <div>
                    <input id="check-3-1" type="checkbox" name="1func" value="incorrecto">
                    <label for="check-3-1">C) Solo está definida para ciertos valores de x.</label><br>
                </div>
                <div>
                    <input id="check-4-1" type="checkbox" name="1func" value="incorrecto">
                    <label for="check-4-1">D) Tiene un límite infinito en al menos un punto.</label><br>
                </div>
                <hr>
            </form>

            <!-- Pregunta 2 -->
            <label for="2func">2.- ¿Cuál de las siguientes afirmaciones es cierta sobre una función discontinua?</label>
            <form class="my-form">
                <div>
                    <input id="check-1-2" type="checkbox" name="2func" value="incorrecto">
                    <label for="check-1-2">A) Siempre es creciente.</label><br>
                </div>
                <div>
                    <input id="check-2-2" type="checkbox" name="2func" value="correcto">
                    <label for="check-2-2">B) Tiene al menos un punto en el que la gráfica se interrumpe.</label><br>
                </div>
                <div>
                    <input id="check-3-2" type="checkbox" name="2func" value="incorrecto">
                    <label for="check-3-2">C) Se puede derivar en todos sus puntos.</label><br>
                </div>
                <div>
                    <input id="check-4-2" type="checkbox" name="2func" value="incorrecto">
                    <label for="check-4-2">D) No tiene un límite definido en ningún punto.</label><br>
                </div>
                <hr>
            </form>

            <!-- Pregunta 3 -->
            <label for="3func">3.- ¿Qué tipo de discontinuidad ocurre cuando una función cambia abruptamente de valor?</label>
            <form class="my-form">
                <div>
                    <input id="check-1-3" type="checkbox" name="3func" value="incorrecto">
                    <label for="check-1-3">A) Discontinuidad removible.</label><br>
                </div>
                <div>
                    <input id="check-2-3" type="checkbox" name="3func" value="incorrecto">
                    <label for="check-2-3">B) Discontinuidad infinita.</label><br>
                </div>
                <div>
                    <input id="check-3-3" type="checkbox" name="3func" value="correcto">
                    <label for="check-3-3">C) Discontinuidad de salto.</label><br>
                </div>
                <div>
                    <input id="check-4-3" type="checkbox" name="3func" value="incorrecto">
                    <label for="check-4-3">D) Ninguna de las anteriores.</label><br>
                </div>
                <hr>
            </form>

            <!-- Pregunta 4 -->
            <label for="4func">4.- ¿Cuál de las siguientes es una aplicación de funciones crecientes?</label>
            <form class="my-form">
                <div>
                    <input id="check-1-4" type="checkbox" name="4func" value="incorrecto">
                    <label for="check-1-4">A) Modelar el descenso de temperatura de un cuerpo enfriándose.</label><br>
                </div>
                <div>
                    <input id="check-2-4" type="checkbox" name="4func" value="incorrecto">
                    <label for="check-2-4">B) Representar el valor de un activo que se desploma repentinamente.</label><br> 
                </div> 
                <div> 
                    <input id="check-3-4" type="checkbox" name="4func" value="correcto"> 
                    <label for="check-3-4">C) Mostrar el crecimiento de ingresos respecto a la inversión. </label ><br> 
                </div> 
                <div> 
                    <input id="check-4-4" type="checkbox" name="4func" value="incorrecto"> 
                    <label for="check-4-4">D) Mostrar una función trigonométrica. </label><br> 
                </div > 
                <hr > 
            </form >

            <!-- Pregunta 5 -->
            <label for="5func">5.- ¿Qué significa que una función sea creciente en un intervalo?</label> 
            <form class="my-form"> 
                <div> 
                    <input id="check-1-5" type="checkbox" name="5func" value="incorrecto"> 
                    <label for="check-1-5">A) La función desciende de izquierda a derecha en su gráfico.</label><br> 
                </div> 
                <div> 
                    <input id="check-2-5" type="checkbox" name="5func" value="incorrecto"> 
                    <label for="check-2-5">B) La variable dependiente disminuye a medida que la variable independiente aumenta.</label><br> 
                </div> 
                <div> 
                    <input id="check-3-5" type="checkbox" name="5func" value="correcto"> 
                    <label for="check-3-5">C) Para cualquier x<sub>1</sub>&lt;x<sub>2</sub>, f(x<sub>1</sub>)&lt;f(x<sub>2</sub>).</label><br> 
                </div> 
                <div> 
                        <input id="check-4-5" type="checkbox" name="5func" value="incorrecto"> 
                        <label for="check-4-5">D) La función es siempre lineal.</label><br> 
                </div> 
                <hr>
            </form>

            <!-- Pregunta 6 -->
            <label for="6func">6.- ¿Cuál de las siguientes características describe una función decreciente?</label> 
            <form class="my-form"> 
                <div> 
                    <input id="check-1-6" type="checkbox" name="6func" value="incorrecto"> 
                    <label for="check-1-6">A) Tiene una tasa de cambio positiva.</label><br> 
                </div> 
                <div> 
                    <input id="check-2-6" type="checkbox" name="6func" value="incorrecto"> 
                    <label for="check-2-6">B) El gráfico de la función sube de izquierda a derecha.</label><br> 
                </div> 
                <div> 
                    <input id="check-3-6" type="checkbox" name="6func" value="correcto"> 
                    <label for="check-3-6">C) La variable dependiente disminuye a medida que la independiente aumenta.</label><br> 
                </div> 
                <div> 
                    <input id="check-4-6" type="checkbox" name="6func" value="incorrecto"> 
                    <label for="check-4-6">D) Es una función periódica.</label><br> 
                </div>  
                <hr>
            </form>

            <!-- Pregunta 7 -->
            <label for="7func">7.- ¿Qué tipo de función se usaría para modelar fenómenos periódicos como el movimiento de ondas?</label>
            <form class="my-form">
                <div>
                    <input id="check-1-7" type="checkbox" name="7func" value="incorrecto">
                    <label for="check-1-7">A) Función lineal.</label><br>
                </div>
                <div>
                    <input id="check-2-7" type="checkbox" name="7func" value="incorrecto">
                    <label for="check-2-7">B) Función cuadrática.</label><br>
                </div>
                <div>
                    <input id="check-3-7" type="checkbox" name="7func" value="correcto">
                    <label for="check-3-7">C) Función trigonométrica.</label><br>
                </div>
                <div>
                    <input id="check-4-7" type="checkbox" name="7func" value="incorrecto">
                    <label for="check-4-7">D) Función exponencial.</label><br>
                </div>
                <hr>
            </form>

            <!-- Pregunta 8 -->
            <label for="8func">8.- ¿Qué tipo de discontinuidad se puede eliminar redefiniendo la función en un punto específico?</label>
            <form class="my-form">
                <div>
                    <input id="check-1-8" type="checkbox" name="8func" value="incorrecto">
                    <label for="check-1-8">A) Discontinuidad infinita.</label><br>
                </div>
                <div>   
                    <input id="check-2-8" type="checkbox" name="8func" value="incorrecto">
                    <label for="check-2-8" >B) Discontinuidad de salto.</label><br>
                </div>
                <div>
                    <input id="check-3-8" type="checkbox" name="8func" value="correcto" >
                    <label for="check-3-8">C) Discontinuidad removible. </label><br>
                </div>
                <div>
                    <input id="check-4-8" type="checkbox" name="8func" value="incorrecto">
                    <label for="check-4-8" > D ) Discontinuidad oscilatoria. </label><br>
                </div >
                <hr >
            </form >

            <!-- Pregunta 9 -->
            <label for='9func'>9.- ¿Cuál de las siguientes afirmaciones es correcta sobre la composición de funciones?</label>
            <form class='my-form'>
                <div>
                    <input id='check-1-9' type='checkbox' name='9func' value='incorrecto'>
                    <label for='check-1-9'>A) No se puede aplicar a funciones continuas.</label><br>
                </div>
                <div>
                    <input id='check-2-9' type='checkbox' name='9func' value='correcto'>
                    <label for='check-2-9'>B) Permite combinar operaciones matemáticas en un solo paso.</label><br>
                </div>
                <div>
                    <input id='check-3-9' type='checkbox' name='9func' value='incorrecto'>
                    <label for='check-3-9'>C) Solo se utiliza en informática.</label><br>
                </div>
                <div>
                    <input id='check-4-9' type='checkbox' name='9func' value='incorrecto'>
                    <label for='check-4-9'>D) Es exclusiva de funciones lineales.</label><br>
                </div>
                <hr>
            </form>

            <!-- Pregunta 10 -->
            <label for='10func'>10.- ¿En qué campo se utilizan las funciones discontinuas para modelar cambios repentinos?</label>
            <form class='my-form'>
                <div>
                    <input id='check-1-10' type='checkbox' name='10func' value='incorrecto'>
                    <label for='check-1-10'> A ) En el análisis de funciones periódicas. </label><br>
                </div >
                <div> 
                    <input id='check-2-10' type='checkbox' name='10func' value='incorrecto'> 
                    <label for='check-2-10'> B ) En la modelación de crecimiento exponencial. </label><br>
                </div >
                <div> 
                    <input id='check-3-10' type='checkbox' name='10func' value='correcto'> 
                    <label for='check-3-10'> C ) En situaciones donde los precios en el mercado cambian bruscamente. </label><br>
                </div>
                <div> 
                    <input id='check-4-10' type='checkbox' name='10func' value='incorrecto' > 
                    <label for='check-4-10'> D ) En el estudio de trayectorias parabólicas. </label><br>
                </div>
                <hr>
            </form>
        </section>

        <button type="button" onclick="verificarResultados(); " class="cssbuttons-io-button">
          Finalizar Cuestionario
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

    <script>
        // Función para hacer que solo se pueda seleccionar un checkbox por pregunta
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const name = this.name;
                document.querySelectorAll(`input[name="${name}"]`).forEach(other => {
                    if (other !== this) other.checked = false;
                });
            });
        });

        // Función para verificar los resultados y hacer el conteo
        function verificarResultados() {
          const totalPreguntas = 10;
          const respuestas = document.querySelectorAll('input[type="checkbox"]:checked');
          let aciertos = 0;

          respuestas.forEach(respuesta => {
              if (respuesta.value === 'correcto') {
                  aciertos++;
              }
          });

          const promedio = (aciertos / totalPreguntas) * 10;

          if (promedio >= 6) {
              swal({
                  title: 'Tu promedio fue de:',
                  text: `${promedio.toFixed(1)} (equivalente a ${aciertos} aciertos)`,
                  icon: 'success',
                  buttons: true,
              }).then((willRedirect) => {
                  if (willRedirect) {
                      actTemaTerminado('funciones');
                  }
              });
          } else {
              swal({
                  title: 'Tu promedio fue de:',
                  text: `${promedio.toFixed(1)} (equivalente a ${aciertos} aciertos)`,
                  icon: 'error'
              });
          }
        }
    </script>

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