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
    <title>Mathez - Sucesiones y Series</title>
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
            <label for="1poli">1.- ¿Que es una sucesión?          
            </label> 
              <form class="my-form">
                <div>
                  <input id="check-1" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-1"> Un conjunto desordenado de números </label><br>
                </div>
                <div>
                  <input id="check-2" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-2">Una suma infinita de números</label><br>
                </div>
                <div>
                  <input id="check-3" type="checkbox" name="1poli" value="correcto">
                  <label for="check-3">Un conjunto ordenado de elementos que responden a una regla específica</label><br>
                </div>
                <div>
                  <input id="check-4" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-4">Una función lineal con un límite definido</label><br>
                </div> <hr>
              </form>
            <!-- Pregunta 2 -->
            <label for="2poli">2.- ¿Cómo se llama la diferencia constante entre los términos consecutivos de una sucesión aritmética?           
            </label> 
              <form class="my-form">
                <div>
                  <input id="check-1-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-1-2"> Razón común </label><br>
                </div>
                <div>
                  <input id="check-2-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-2-2">Cociente común</label><br>
                </div>
                <div>
                  <input id="check-3-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-3-2">Producto común</label><br>
                </div>
                <div>
                  <input id="check-4-2" type="checkbox" name="2poli" value="correcto">
                  <label for="check-4-2">Diferencia común</label><br>
                </div> <hr>
              </form>
            <!-- Pregunta 3 -->
            <label for="3poli">3.- Si una sicesion geometrica tiene a1=2 y r=3, ¿cual es el termino a4?            
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-1-3"> 18</label><br>
              </div>
              <div>
                <input id="check-2-3" type="checkbox" name="3poli" value="correcto">
                <label for="check-2-3"> 54</label><br>
              </div>
              <div>
                <input id="check-3-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-3-3"> 27</label><br>
              </div>
              <div>
                <input id="check-4-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-4-3"> 162</label><br>
              </div><hr>
            </form>
              <!-- Pregunta 4 -->
              <label for="4poli">4.- ¿Qué tipo de sucesión tiene como regla general an=n^2?          
              </label> 
              <form class="my-form">
                <div>
                  <input id="check-1-4" type="checkbox" name="4poli" value="incorrecto">
                  <label for="check-1-4"> Aritmética </label><br>
                </div>
                <div>
                  <input id="check-2-4" type="checkbox" name="4poli" value="incorrecto">
                  <label for="check-2-4"> Geométrica</label><br>
              </div>
              <div>
                <input id="check-3-4" type="checkbox" name="4poli" value="correcto">
                <label for="check-3-4"> Cuadrática</label><br>
              </div>
              <div>
                <input id="check-4-4" type="checkbox" name="4poli" value="incorrecto">
                <label for="check-4-4"> Armónica</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 5 -->
            <label for="5poli">5.- ¿Qué caracteriza a las sucesiones armónicas?
            </label>
            <form class="my-form">
              <div>
                <input id="check-1-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-1-5"> Tienen una diferencia constante entre términos </label><br>
              </div>
              <div>
                <input id="check-2-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-2-5"> Los términos son resultados de una función cuadrática</label><br>
              </div>
              <div>
                <input id="check-3-5" type="checkbox" name="5poli" value="correcto">
                <label for="check-3-5"> Los términos son el recíproco de los números naturales </label><br>
              </div>
              <div>
                <input id="check-4-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-4-5"> El cociente entre términos consecutivos es constante </label><br>
              </div><hr>
            </form>
            <!-- Pregunta 6 -->
            <label for="6poli">6.- ¿Qué es una serie numérica?         
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-1-6"> Una lista de números en orden creciente </label><br>
              </div>
              <div>
                <input id="check-2-6" type="checkbox" name="6poli" value="correcto">
                <label for="check-2-6"> La suma de los términos de una sucesión </label><br>
              </div>
              <div>
                <input id="check-3-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-3-6"> Una sucesión de números infinitos </label><br>            
              </div>
              <div>
                <input id="check-4-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-4-6"> Una función matemática que genera números </label><br>
              </div><hr>
            </form>
            <!-- Pregunta 7 -->
            <label for="7poli">7.- Calcula la suma de los primeros 5 términos de una serie aritmética donde a1=3 y a5=15         
            </label>
            <form class="my-form"> 
              <div>
                <input type="checkbox" id="check-1-7" name="7poli" value="correcto">
                <label for="check-1-7"> 30 </label><br>
              </div>
              <div>
                <input type="checkbox" id="check-2-7" name="7poli" value="incorrecto">
                <label for="check-2-7"> 45</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-3-7" name="7poli" value="incorrecto">
                <label for="check-3-7"> 40 </label><br>
              </div>
              <div>
                <input type="checkbox" id="check-4-7" name="7poli" value="incorrecto">
                <label for="check-4-7"> 60 </label><br>
              </div><hr>
            </form>     
            <!-- Pregunta 8 -->
            <label for="8poli">8.- ¿Qué sucede con una serie geométrica infinita si r es menor que 1?
            </label>  
            <form class="my-form">
              <div>
                <input type="checkbox" id="check-1-8" name="8poli" value="correcto">
                <label for="check-1-8">  La serie converge a un límite finito</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-2-8" name="8poli" value="incorrecto">
                <label for="check-2-8"> La serie diverge </label><br>
              </div>
              <div>
                <input type="checkbox" id="check-3-8" name="8poli" value="incorrecto">
                <label for="check-3-8"> No se puede determinar </label><br>
              </div>
              <div>
                <input type="checkbox" id="check-4-8" name="8poli" value="incorrecto">
                <label for="check-4-8"> La serie alterna entre positivo y negativo </label><br>
              </div><hr>
            </form>     
            <!-- Pregunta 9 -->
            <label for="9poli">9.- ¿Qué tipo de serie se obtiene al sumar los términos de una sucesión armónica?      
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-9" type="checkbox" name="9poli" value="correcto">
                <label for="check-1-9"> Una serie que diverge lentamente hacia el infinito </label><br>
              </div>
              <div>
                <input id="check-2-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-2-9">Una serie finita con límite</label><br>
              </div>
              <div>
                <input id="check-3-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-3-9">Una serie que converge rápidamente</label><br>
              </div>
              <div>
                <input id="check-4-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-4-9"> Una serie cuadrática</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 10 -->
            <label for="10poli">10.- ¿Qué indica que una serie infinita converge?         
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-1-10"> Los términos son mayores a 1 </label><br>
              </div>
              <div>
                <input id="check-2-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-2-10"> La suma crece sin límite </label><br>
              </div>
              <div>
                <input id="check-3-10" type="checkbox" name="10poli" value="correcto">
                <label for="check-3-10"> El límite de las sumas parciales es finito </label><br>
              </div>
              <div>
                <input id="check-4-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-4-10"> Los términos consecutivos son iguales </label><br>
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
                      actTemaTerminado('sucesiones');
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