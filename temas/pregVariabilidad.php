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
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
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
           <br>
           <hr>
           <!-- Cuestionario -->
            <!-- Pregunta 1 -->
            <label for="1poli">1.- ¿Qué es la variabilidad derivada?        
            </label> 
              <form class="my-form">
                <div>
                  <input id="check-1" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-1"> Una técnica para medir la dispersión de los datos</label><br>
                </div>
                <div>
                  <input id="check-2" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-2"> Un método para calcular el promedio de una serie de datos</label><br>
                </div>
                <div>
                  <input id="check-3" type="checkbox" name="1poli" value="correcto">
                  <label for="check-3">Una medida estadística para analizar la variabilidad de la tasa de cambio en una serie de dato</label><br>
                </div>
                <div>
                  <input id="check-4" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-4">Un procedimiento para calcular la media de las diferencias en una serie de tiempo</label><br>
                </div> <hr>
              </form>
            <!-- Pregunta 2 -->
            <label for="2poli">2.- ¿Cómo se calcula la variabilidad derivada?          
            </label> 
              <form class="my-form">
                <div>
                  <input id="check-1-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-1-2">Tomando la diferencia entre el valor máximo y el mínimo</label><br>
                </div>
                <div>
                  <input id="check-2-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-2-2">Calculando la diferencia entre el primer y último valor de la serie</label><br>
                </div>
                <div>
                  <input id="check-3-2" type="checkbox" name="2poli" value="correcto">
                  <label for="check-3-2">Tomando la diferencia entre los valores sucesivos y luego obteniendo el promedio de sus valores absolutos</label><br>
                </div>
                <div>
                  <input id="check-4-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-4-2">Sumando los valores absolutos de todos los puntos en la serie</label><br>
                </div> <hr>
              </form>
            <!-- Pregunta 3 -->
            <label for="3poli">3.- ¿Qué representa la primera derivada 𝑓′(𝑥)?  
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-1-3">La aceleración de la función</label><br>
              </div>
              <div>
                <input id="check-2-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-2-3">La concavidad de la función</label><br>
              </div>
              <div>
                <input id="check-3-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-3-3">La velocidad de la función</label><br>
              </div>
              <div>
                <input id="check-4-3" type="checkbox" name="3poli" value="correcto">
                <label for="check-4-3">La tasa de cambio o el crecimiento de la función</label><br>
              </div><hr>
            </form>
              <!-- Pregunta 4 -->
              <label for="4poli">4.- Si 𝑓′(𝑥)>0, ¿qué significa? 
              </label> 
              <form class="my-form">
                <div>
                  <input id="check-1-4" type="checkbox" name="4poli" value="incorrecto">
                  <label for="check-1-4">La función está en su punto más bajo</label><br>
                </div>
                <div>
                  <input id="check-2-4" type="checkbox" name="4poli" value="correcto">
                  <label for="check-2-4">La función está creciendo en ese intervalo</label><br>
              </div>
              <div>
                <input id="check-3-4" type="checkbox" name="4poli" value="incorrecto">
                <label for="check-3-4">La función está decreciendo</label><br>
              </div>
              <div>
                <input id="check-4-4" type="checkbox" name="4poli" value="incorrecto">
                <label for="check-4-4">La función tiene un punto de inflexión</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 5 -->
            <label for="5poli">5.- ¿Qué describe la segunda derivada 𝑓′′(𝑥)?
            </label>
            <form class="my-form">
              <div>
                <input id="check-1-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-1-5">La velocidad de la función</label><br>
              </div>
              <div>
                <input id="check-2-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-2-5">La tasa de cambio de la función</label><br>
              </div>
              <div>
                <input id="check-3-5" type="checkbox" name="5poli" value="correcto">
                <label for="check-3-5">La curvatura de la función y su concavidad</label><br>
              </div>
              <div>
                <input id="check-4-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-4-5">El valor máximo o mínimo de la función</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 6 -->
            <label for="6poli">6.- ¿Cómo se determina si hay un punto de inflexión?  
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-1-6"> Si 𝑓′(𝑥)=0</label><br>
              </div>
              <div>
                <input id="check-2-6" type="checkbox" name="6poli" value="correcto">
                <label for="check-2-6"> Si 𝑓′′(𝑥)=0 y cambia de signo</label><br>
              </div>
              <div>
                <input id="check-3-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-3-6">Si la función es cóncava hacia arriba</label><br>            
              </div>
              <div>
                <input id="check-4-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-4-6">Si 𝑓′(𝑥)>0</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 7 -->
            <label for="7poli">7.- Si 𝑓′(𝑥)=0 y 𝑓′′(𝑥)>0, ¿qué se puede concluir? 
            </label>
            <form class="my-form"> 
              <div>
                <input type="checkbox" id="check-1-7" name="7poli" value="incorrecto">
                <label for="check-1-7">La función es creciente</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-2-7" name="7poli" value="incorrecto">
                <label for="check-2-7"> La función tiene un máximo relativo</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-3-7" name="7poli" value="incorrecto">
                <label for="check-3-7">La función está estacionaria</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-4-7" name="7poli" value="correcto">
                <label for="check-4-7">La función tiene un mínimo relativo</label><br>
              </div><hr>
            </form>     
            <!-- Pregunta 8 -->
            <label for="8poli">8.- ¿En el contexto de la física, ¿qué representa la primera derivada de una función?
            </label>  
            <form class="my-form">
              <div>
                <input type="checkbox" id="check-1-8" name="8poli" value="incorrecto">
                <label for="check-1-8"> La aceleración</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-2-8" name="8poli" value="correcto">
                <label for="check-2-8"> La velocidad</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-3-8" name="8poli" value="incorrecto">
                <label for="check-3-8">Círculo trigonométrico</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-4-8" name="8poli" value="incorrecto">
                <label for="check-4-8">La fuerza</label><br>
              </div><hr>
            </form>     
            <!-- Pregunta 9 -->
            <label for="9poli">9.- ¿Qué valores se utilizan para calcular la variabilidad derivada en un conjunto de datos?   
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-1-9"> Las diferencias cuadradas entre los valores</label><br>
              </div>
              <div>
                <input id="check-2-9" type="checkbox" name="9poli" value="correcto">
                <label for="check-2-9">Las diferencias absolutas entre los valores sucesivos</label><br>
              </div>
              <div>
                <input id="check-3-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-3-9">Las medias de los valores</label><br>
              </div>
              <div>
                <input id="check-4-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-4-9">Las sumas de los valores sucesivos</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 10 -->
            <label for="10poli">10.- En el siguiente conjunto de datos 
              𝑥=[20,22,21,25,24,26], ¿cuál es la variabilidad derivada?  
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-1-10"> 3.2</label><br>
              </div>
              <div>
                <input id="check-2-10" type="checkbox" name="10poli" value="correcto">
                <label for="check-2-10">2</label><br>
              </div>
              <div>
                <input id="check-3-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-3-10">1.5</label><br>
              </div>
              <div>
                <input id="check-4-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-4-10">1.2</label><br>
              </div><hr>
            </form>
        </section>

        <button type="button" onclick="verificarResultados()" class="cssbuttons-io-button">
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
                      actTemaTerminado('variabilidad');
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