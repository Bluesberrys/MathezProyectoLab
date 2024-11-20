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
    <title>Mathez - Razones Trigonométricas</title>
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
            <label for="1poli">1.- ¿Qué relación describe la función seno en un triángulo rectángulo?        
            </label> 
              <form class="my-form">
                <div>
                  <input id="check-1" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-1">  Cociente entre el cateto adyacente y la hipotenusa </label><br>
                </div>
                <div>
                  <input id="check-2" type="checkbox" name="1poli" value="correcto">
                  <label for="check-2">Cociente entre el cateto opuesto y la hipotenusa </label><br>
                </div>
                <div>
                  <input id="check-3" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-3">Cociente entre el cateto opuesto y el cateto adyacente</label><br>
                </div>
                <div>
                  <input id="check-4" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-4">Cociente entre la hipotenusa y el cateto opuesto</label><br>
                </div> <hr>
              </form>
            <!-- Pregunta 2 -->
            <label for="2poli">2.- ¿Cuál es el periodo de la función seno?           
            </label> 
              <form class="my-form">
                <div>
                  <input id="check-1-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-1-2">π</label><br>
                </div>
                <div>
                  <input id="check-2-2" type="checkbox" name="2poli" value="correcto">
                  <label for="check-2-2">2π</label><br>
                </div>
                <div>
                  <input id="check-3-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-3-2">3π</label><br>
                </div>
                <div>
                  <input id="check-4-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-4-2">4π</label><br>
                </div> <hr>
              </form>
            <!-- Pregunta 3 -->
            <label for="3poli">3.- ¿En el círculo trigonométrico, ¿cuáles son las coordenadas de un punto asociado a un ángulo θ?     
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-3" type="checkbox" name="3poli" value="correcto">
                <label for="check-1-3">(cos(θ), sin(θ)) </label><br>
              </div>
              <div>
                <input id="check-2-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-2-3"> (sin(θ), cos(θ))</label><br>
              </div>
              <div>
                <input id="check-3-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-3-3">(tan(θ), cot(θ))</label><br>
              </div>
              <div>
                <input id="check-4-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-4-3">(sec(θ), cosec(θ))</label><br>
              </div><hr>
            </form>
              <!-- Pregunta 4 -->
              <label for="4poli">4.- ¿Si un triángulo tiene un ángulo de 45° y un cateto adyacente de 10, ¿cuál es el cateto opuesto?  
              </label> 
              <form class="my-form">
                <div>
                  <input id="check-1-4" type="checkbox" name="4poli" value="incorrecto">
                  <label for="check-1-4">5</label><br>
                </div>
                <div>
                  <input id="check-2-4" type="checkbox" name="4poli" value="incorrecto">
                  <label for="check-2-4"> 10</label><br>
              </div>
              <div>
                <input id="check-3-4" type="checkbox" name="4poli" value="correcto">
                <label for="check-3-4">10 tan(45°)</label><br>
              </div>
              <div>
                <input id="check-4-4" type="checkbox" name="4poli" value="incorrecto">
                <label for="check-4-4">No se puede determinar</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 5 -->
            <label for="5poli">5.- ¿Qué identidad trigonométrica describe la relación entre seno y coseno?
            </label>
            <form class="my-form">
              <div>
                <input id="check-1-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-1-5">sin²(θ) + tan²(θ) = 1</label><br>
              </div>
              <div>
                <input id="check-2-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-2-5">tan²(θ) + 1 = sec²(θ) </label><br>
              </div>
              <div>
                <input id="check-3-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-3-5">cos²(θ) − sin²(θ) = 1</label><br>
              </div>
              <div>
                <input id="check-4-5" type="checkbox" name="5poli" value="correcto">
                <label for="check-4-5">sin²(θ) + cos²(θ) = 1</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 6 -->
            <label for="6poli">6.- ¿Qué ángulos son complementarios en un triángulo rectángulo?     
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-1-6"> Dos ángulos que suman 45°</label><br>
              </div>
              <div>
                <input id="check-2-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-2-6"> Dos ángulos que suman 180°</label><br>
              </div>
              <div>
                <input id="check-3-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-3-6">Dos ángulos que suman 60°</label><br>            
              </div>
              <div>
                <input id="check-4-6" type="checkbox" name="6poli" value="correcto">
                <label for="check-4-6">Dos ángulos que suman 90°</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 7 -->
            <label for="7poli">7.- ¿Cuál es el valor máximo que puede alcanzar la función seno?        
            </label>
            <form class="my-form"> 
              <div>
                <input type="checkbox" id="check-1-7" name="7poli" value="incorrecto">
                <label for="check-1-7">2</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-2-7" name="7poli" value="correcto">
                <label for="check-2-7"> 1</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-3-7" name="7poli" value="incorrecto">
                <label for="check-3-7"> 0</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-4-7" name="7poli" value="incorrecto">
                <label for="check-4-7">-1</label><br>
              </div><hr>
            </form>     
            <!-- Pregunta 8 -->
            <label for="8poli">8.- ¿Qué herramienta permite visualizar los valores de las funciones trigonométricas para cualquier ángulo?
            </label>  
            <form class="my-form">
              <div>
                <input type="checkbox" id="check-1-8" name="8poli" value="incorrecto">
                <label for="check-1-8"> Tabla de valores trigonométricos</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-2-8" name="8poli" value="incorrecto">
                <label for="check-2-8"> Gráfica seno-coseno</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-3-8" name="8poli" value="correcto">
                <label for="check-3-8">Círculo trigonométrico</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-4-8" name="8poli" value="incorrecto">
                <label for="check-4-8"> Fórmulas de ángulo doble</label><br>
              </div><hr>
            </form>     
            <!-- Pregunta 9 -->
            <label for="9poli">9.- ¿Cuál es el valor de la tangente de un ángulo de 45°?       
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-1-9">  0 </label><br>
              </div>
              <div>
                <input id="check-2-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-2-9">0.5</label><br>
              </div>
              <div>
                <input id="check-3-9" type="checkbox" name="9poli" value="correcto">
                <label for="check-3-9">1</label><br>
              </div>
              <div>
                <input id="check-4-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-4-9"> ∞</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 10 -->
            <label for="10poli">10.- ¿Qué fórmula es válida para calcular un ángulo usando tangente?         
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-10" type="checkbox" name="10poli" value="correcto">
                <label for="check-1-10"> tan(θ) = cateto opuesto / cateto adyacente</label><br>
              </div>
              <div>
                <input id="check-2-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-2-10">tan(θ) = cateto adyacente / hipotenusa</label><br>
              </div>
              <div>
                <input id="check-3-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-3-10">tan(θ) = hipotenusa / cateto opuesto</label><br>
              </div>
              <div>
                <input id="check-4-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-4-10">tan(θ) = cateto adyacente / cateto opuesto</label><br>
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
                      actTemaTerminado('razones-trigonometricas');
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