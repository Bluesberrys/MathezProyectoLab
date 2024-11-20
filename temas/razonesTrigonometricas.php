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

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 8");

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
            <button class="btn-tema" type="submit" onclick="actTemaProgreso('razones-trigonometricas')">
            Tema visto
            </button>
        <?php
        }
        ?>
      <div class="container">
        <div class="container-title">
          <h1 class="alt-font">
            Funciones trigonométricas
          </h1>
        </div>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            ¿Qué son las funciones trigonométricas?
          </h2>
          <!-- contenido -->
          <p>Las funciones trigonométricas se basan en las relaciones entre los lados de un triángulo rectángulo y sus ángulos, y son fundamentales para describir fenómenos periódicos en matemáticas, física, y muchas otras áreas. Las principales funciones trigonométricas son el seno, coseno y tangente, y existen otras derivadas como cotangente, secante y cosecante. <br> Las funciones trigonométricas se definen en términos de un ángulo θ en un triángulo rectángulo:<br>
            <ol>
              - Seno (sin⁡): es el cociente entre el cateto opuesto y la hipotenusa.<br> <br>
              - Coseno (cos⁡): es el cociente entre el cateto adyacente y la hipotenusa.<br> <br>
              - Tangente (tan): es el cociente entre el cateto opuesto y el cateto adyacente.<br> <br>
            </ol>
            <img src="./img/Tri-1.png" alt="Representación de la hipotenusa, opuesto, y adyacente" width="500px">
            <hr>
            <h3>Formulas</h3>
            <ol>
              <p>
                Seno 0 = Cateto opuesto / hipotenusa
               </p>
               <p>
                 Coseno 0 = Cateto adyacente / hipotenusa
               </p>
               <p>
                 Tangente 0 = Cateto adyacente / Cateto opuesto
               </p>
               <p>
                Cotangente 0 = Cateto Adyacente / Cateto opuesto
               </p>
               <p>
                Secante 0 = Hipotenusa / Cateto adyacente
               </p>
               <p>
                Cosecante 0 = Hipotenusa / Cateto opuesto
               </p>
              </ol>
              <p>
                Al meter el resultado en una calculadora científica o ayudándonos de una tabla guía podemos obtener el valor del ángulo en grados.
              </p>
              <p>
                Otro dato a considerar es que en un triángulo rectángulo los ángulos agudos son complementarios, la suma de ambos suman 90°, por lo que sus Funciones Complementarias son: <br> <br>
                Seno (Sen) A = Coseno (Cos) C <br> <br>
                Tangente (Tan) A  =  Cotangente (Cot) C <br> <br>
                Secante (Sec) A = Cosecante (Csc) C <br> <br>
                
                Con estas fórmulas podemos obtener los grados faltantes, catetos o la hipotenusa de un triángulo usando las fórmulas de la manera correcta.
              </p>
              <hr>
              <h3>
                Ejemplos: 
              </h3>
              <p>
                <ol>
                  <li>
                    Si tenemos un triángulo con un ángulo de 42° y un  cateto adyacente de 12, cual es el valor del cateto opuesto. <br> <br>
                    tan  42° = x / 12 <br> <br>
                    x = 12 tan 42° = 10.8
                  </p>
                  <img src="./img/Tri-2.png" alt="Tri-2" width="500px">
                  </li>
                  <li>
                    <p>
                      Si tenemos un triángulo con hipotenusa de 10, cateto opuesto de 6 y cateto adyacente de 8:
                    </p>
                    <p>
                      sin⁡(θ)= 6 /10 =0.6 <br><br>
                      cos⁡(θ)= 8/10=0.8 <br><br>
                      tan(θ)= 6/8​=0.75 <br><br>
                    </p>
                    <img src="./img/Tri-3.png" alt="Tri-3" width="500px">
                  </li>
                </ol>
              <hr>
              <h3>Circulo Trigonométrico</h3>
            <p>
              El círculo trigonométrico es una representación en el plano cartesiano que permite visualizar los valores de las funciones trigonométricas para cualquier ángulo, tanto en grados como en radianes. Es una herramienta clave para entender las funciones seno, coseno y tangente.
            </p>
            <img src="./img/Tri-4.png" alt="" width="700px">
            <p>
              El círculo trigonométrico tiene radio 1 y está centrado en el origen (0,0). Cada punto en el borde del círculo corresponde a un ángulo y tiene coordenadas (cos⁡(θ),sin⁡(θ))
            </p>
            <hr>
            <h3>Gráficas de Funciones Trigonométricas</h3>
            <p>
              Las gráficas de las funciones trigonométricas muestran la relación entre el ángulo (generalmente en el eje x) y el valor de la función (en el eje y). <br> <br>
              Las funciones seno y coseno producen ondas sinusoidales, mientras que la tangente tiene una forma periódica con asíntotas verticales. <br> <br>
              <ol>
                Seno y Coseno: Son funciones periódicas con periodo  \(2\pi\), y oscilan entre -1 y 1. <br> <br>
                Tangente: Tiene un periodo de π\π , y se extiende hacia el infinito positivo y negativo.    
              </ol>
              <ol>
                <ol>
                  <ol>
                    <ol>
                      <img src="./img/Tri-5.png" alt="Tri-5">
                    </ol>
                  </ol>
                </ol>
              </ol>
            </p>
            <p>
              <h4>Fórmulas</h4>
              <ol>
                <p>Seno: \(y = \sin(x)\)</p>
                <p>Coseno: \(y = \cos(x)\)</p>
                <p>Tangente \(y = \tan(x)\)</p>
              </ol>
              <h4>Ejemplo</h4>
              <p>La gráfica de \( y = \sin(x) \) comienza en \( (0, 0) \), alcanza su valor máximo de 1 en \( \frac{\pi}{2} \), vuelve a 0 en \( \pi \), y su mínimo en \( \frac{3\pi}{2} \).</p>
            </p>
            <hr>
            <h3>Identidades Trigonométricas</h3>
            <p>
              Las identidades trigonométricas son igualdades que involucran funciones trigonométricas y son ciertas para cualquier valor de las variables involucradas. Son útiles para simplificar expresiones y resolver ecuaciones trigonométricas.
            </p>
            <p>
              Las identidades trigonométricas son ecuaciones que involucran las funciones trigonométricas que son verdaderas para cada valor de las variables involucradas. <br><br>
              Algunas de las más comúnmente usadas identidades trigonométricas son derivadas del teorema de Pitágoras , como las siguientes: <br><br>
              \[\sin^2 x + \cos^2 x = 1\]
              \[1 + \tan^2 x = \sec^2 x\]
              \[1 + \cot^2 x = \csc^2 x\]
              <br><br>
              Hay también las: <br> <br> <li>Identidades recíprocas :</li>
            </p>
            <p> $$\sin x = \frac{1}{\csc x}$$ <br> $$\cos x = \frac{1}{\sec x}$$ <br> $$\tan x = \frac{1}{\cot x}$$ <br> $$\csc x = \frac{1}{\sin x}$$ <br> $$\sec x = \frac{1}{\cos x}$$ <br> $$\cot x = \frac{1}{\tan x}$$ </p>
            <p>
              <li>Identidades cocientes: </li>
            </p>
            <p> $$\tan u = \frac{\sin u}{\cos u}$$ <br> $$\cot u = \frac{\cos u}{\sin u}$$ </p>
            <li>Identidades co-funcion: </li>
            <p> $$\sin\left(\frac{\pi}{2} - x\right) = \cos x$$ <br> $$\cos\left(\frac{\pi}{2} - x\right) = \sin x$$ <br> $$\tan\left(\frac{\pi}{2} - x\right) = \cot x$$ <br> $$\csc\left(\frac{\pi}{2} - x\right) = \sec x$$ <br> $$\sec\left(\frac{\pi}{2} - x\right) = \csc x$$ <br> $$\cot\left(\frac{\pi}{2} - x\right) = \tan x$$</p>

            <li>identidades pares-impares </li>
            <p> $$\sin(-x) = -\sin x$$ <br> $$\cos(-x) = \cos x$$ <br> $$\tan(-x) = -\tan x$$ <br> $$\csc(-x) = -\csc x$$ <br> $$\sec(-x) = \sec x$$ <br> $$\cot(-x) = -\cot x$$ </p>
            <p>Entre otras s encuentran las:
              <ol>
                <li>
                  Fórmulas de suma y diferencia Bhaskara Acharya,
                </li>
                <li>
                  Fórmulas de ángulo doble,
                </li>
                <li>
                  Fórmulas del ángulo medio o de reducción de potencias
                </li>
                <li>
                  Fórmulas suma al producto
                </li>
                <li>
                  Y las fórmulas producto a la suma.
                </li>
              </ol> 
            </p>
            <hr>
            <h3>Ecuaciones trigonometricas</h3>
            <p>Las ecuaciones trigonométricas son aquellas en las que las incógnitas son ángulos que forman parte del argumento de una o varias razones trigonométricas. Dado que se trata de ángulos, tienen infinitas soluciones que pueden pertenecer a uno o dos cuadrantes como máximo. 
            </p>
            <h4>Ejemplos:</h4>
            <p>
              Encontrar la solución general a cada una de las siguientes ecuaciones trigonométricas:
            </p>
            <ol>
              <li>
                <p>sen X = 0</p>
              </li> 
            </ol>
            <p>
              Solución: De la grafica de la funcion seno en el intervalo (0, 2π), observamos que la funcione es cero en los valores x=0,π. Ya que la funcion sen tiene periodo: 2π, entonces tenemos que: 
            </p>
            <p>
              $$\sin x = 0 \implies x = 0 + 2\pi k \text{ / } x = \pi + 2\pi k$$
            </p>
            <p>
              Así, la solución general a la ecuación, escribiendo lo anterior en una manera más sencilla, es
            </p>
            <img src="./img/Tri-6.png" alt="Tri-6" width="500xñ">
            <p>
              \( \tan x = 0 \)</p>
              <p>
                <strong>Solución:</strong> Recordemos que la función tangente puede escribirse como:
            </p>
            <p>
              \[
              \tan x = \frac{\sin x}{\cos x}
              \]
              Por lo tanto:
          </p>
          <p>
            \[
        \tan x = 0 \implies \frac{\sin x}{\cos x} = 0 \implies \sin x = 0.
          </p>
          <p>
            Esto ya lo hemos calculado antes y tiene como solución: \( x = \pi k \). <br>Esto es, la solución a la ecuación \( \tan x = 0 \) es \( x = \pi k \).
          </p>
          <p><strong>• \( \cos x = 1 \)</strong></p>
    <p>
        <strong>Solución:</strong> Como en la ecuación anterior, la función \( \arccos \) es la función inversa de la función \( \cos \) en el intervalo \( [-\pi/2, \pi/2] \). 
        Así, usando este hecho tenemos que:
    </p>
    <p>
        \[
        \cos x = 1 \implies x = \arccos(1) \implies x = 0.
        \]
        Entonces, la solución a la ecuación es \( x = 0 + 2 \pi k = 2 \pi k \), por periodicidad.
    </p>

    <p><strong>• \( \sin x = -1 \)</strong></p>
    <p>
        <strong>Solución:</strong> Usando la función \( \arcsen \), tenemos que:
    </p>
    <p>
        \[
        \sin x = -1 \implies x = \arcsin(-1) \implies x = -\frac{\pi}{2}.
        \]
        Por lo tanto, la solución general es \( x = -\frac{\pi}{2} + 2 \pi k \).
    </p>

    <p><strong>• \( \cos x = -1 \)</strong></p>
    <p>
        <strong>Solución:</strong> Usando la función \( \arccos \), tenemos que:
    </p>
    <p>
        \[
        \cos x = -1 \implies x = \arccos(-1) \implies x = \pi.
        \]
        Por lo tanto, la solución general es \( x = \pi + 2 \pi k \).
    </p>

    <p><strong>• \( \tan x = -1 \)</strong></p>
    <p>
        <strong>Solución:</strong> Usando la función \( \arctan \), tenemos que:
    </p>
    <p>
        \[
        \tan x = -1 \implies x = \arctan(-1) \implies x = -\frac{\pi}{4}.
        \]
        Por lo tanto, la solución general es \( x = -\frac{\pi}{4} + \pi k \).
    </p>
          
        </section>


        <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregRazonesTrig.php'">
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