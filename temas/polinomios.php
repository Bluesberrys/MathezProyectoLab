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
    <title>Mathez - Polinomios</title>
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

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 6");

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
            <button class="btn-tema" type="submit" onclick="actTemaProgreso('polinomios')">
            Tema visto
            </button>
        <?php
        }
        ?>
        <div class="container">
            <div class="container-title">
            <h1 class="alt-font">
                <!-- Titulo general del tema -->
            Polinomios
            </h1>
            </div>

            <!-- * Pueden agregar y eliminar la cantidad de secciones que necesiten segun los subtitulos del temna a trabajar -->
            <section class="topic-section">
            <h2 class="topic-subtitle">
                <!-- subtitulo -->
                Estrucutra de un polinomio
            </h2>
            <!-- contenido -->
            <p>
                Un polinomio en una variable x tien la forma general: 
                <p></p>
                <img src="../temas/img/PolinomioGeneral.png" alt="Estructura de un polinomio en una variable x tiene la forma general" style="width: 50%; height: auto;">
            </p>
            <p>
                Un polinomio es una expresión algebraica en la cual los términos son monomios.
                Así mismo un monomio es un número, una variable o un producto de números y variables.
                <p>
                Un polinomio de un término es un monomio. Ejemplo: -7X².
            <p>
                Un polinomio de dos términos es un binomio. Ejemplo: 4X+2.
            </p>
                Un polinomio de tres términos es un trinomio. Ejemplo: 7X²+5X-7.
                </p>
                Los términos de un polinomio con una variable se ordenan por lo general de tal modo que los exponentes en la variable disminuyen de izquierda a derecha. <p>Se llama orden descendente.
                El grado de un polinomio en una variable es el valor del exponente más grande en la variable.</p> <p> El grado de 4X³-3X²+6X-1 es 3. </p>
            </p> El grado de 5Y⁴-2Y³+Y²+7Y+8 es 4. </p>
            <hr>
            <h2>Caracterisiticas de un polinomio:</h2>
            <h3> - Grado del polinomio</h3>
            <p>

                El grado de un polinomio es el exponente mayor de la variable que aparece en sus terminos. Por ejemplo, en el polinomio 4𝑥^3 + 2𝑥^3 - 𝑥 + 7, el grado es 3. 
            </p>
            <p>
                El grado de un polinomio determina su comportamiento general cuando x toma valores grandes y es importante para saber cuánteas raíces reales o complejas puede tener. 
            </p>
            <h3> - Coeficiente: </h3>
            <p>
                Los coeficientes son los números que multiplican a cada potencia de la variable. En el polinomio 3𝑥^2+2𝑥−5, los coeficientes son 3, 2, y -5.
            </p>
            <p>
                El coeficiente del término de mayor grado se llama coeficiente principal. Por ejemplo, en 4𝑥^3+3𝑥^2+5, el coeficiente principal es 4.
            </p>
            <h3> - Raices o ceros del polinomio</h3>
            <p>
                Una raíz o cero de un polinomio es un valor de 𝑥 que hace que el polinomio sea igual a cero. Por ejemplo, si 𝑃(𝑥)=𝑥2−4, las raíces son: 𝑥=2 y 𝑥=−2. 
            </p>
            <p>
                El Teorema Fundamental del Álgebra nos dice que un polinomio de grado 𝑛 tiene exactamente 𝑛 raíces, aunque algunas de ellas pueden ser complejas o repetirse.
            </p>
            <h3> - Operaciones con polinomios</h3>
            <p>
                Suma y resta: Para sumar o restar polinomios, se suman o restan los términos con el mismo grado. Para mas infomración puedes checar el siguiente video de Matematicas con Grajeda: 
            </p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/DXoqQOO_UW0?si=udH6v23lavEq2jhS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p>
                Multiplicación: Para multiplicar polinomios, se aplica la propiedad distributiva. Cada término de un polinomio se multiplica por cada término del otro.
                Para mas infomración puedes chacar este video de nuestros amigos de Matematicas profe Alex:
            </p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/6-1NJt3-lTg?si=WuK6SUmYkfezWQne" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p>
            <p>
                División: La división de polinomios puede realizarse utilizando el método de división larga o la división sintética (que es más rápida en algunos casos).
                <br>
                Para mas infomración y ver un ejemplo puedes ver este video de Daniel Carreón: 
            </p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/bU9m3PF71Oo?si=2Ye2X_ZbCOpb73H8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <h3> - Tipos de factorización</h3>
            <p>
                La factorización consiste en expresar el polinomio como un producto de factores más simples. Algunas técnicas comunes son:
            </p>
            
            <p>
                - Factores comúnes: Sacar el término que es común en todos los términos del polinomio. 
            </p>
            <p>
                El máximo común divisor (MCD) de dos o más números enteros es el número entero más grande que es factor de los números enteros. El MCD de dos o más monomios es el producto del MCD de los coeficientes y de las variables comunes de cada factor. Observa que el exponente de cada variable en el mcd es igual al exponente más pequeño de esa variable en cualquiera de los monomios.
            </p>
            <img src="./img/MCDPol.png" alt="Ejemplo de el MCD" width="500px" >
            <p>
                Otro ejemplo Factoriza. A. 5X³+35X²-10X  B. 16X²Y-8X⁴Y²+12X²Y⁴</p> 
            <p> Solución AS:</p>
            <p>
                5X³ =5*X*X*X
                <br>
                35X²=5*X*X   
                <br>
                10X=5*X    
                <br>
                Solución A al problema:                       
                5X(X²+7X-2X)
            </p>
            <p>
                Solución B:
                <br>
                16X²Y=2*2*2*2*X*X*Y
                <br>
                8X⁴Y²=2*2*2*X*X*X*X*Y*Y
                <br>
                12X²Y⁴=2*2*3*X*X*Y*Y*Y*Y
                <br>
                Solución B al problema: 4X²Y(4-2X²Y+3Y³)
            </p>
            <p>Para mayor entendimiento puedes checar este video como Ejemplo: (por Daniel Carreón)</p>
            
            <iframe width="560" height="315" src="https://www.youtube.com/embed/BygK11QxQnA?si=_bET2CboNWynLtHD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p>
                - Trinomio cuadrado perfecto: Para polinomios de la forma 𝑎^2±2𝑎𝑏+𝑏^2, que se factoriza como (𝑎±𝑏)^2. Ejemplo: (por Daniel Carreón)
            </p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/TKo7NtIilWM?si=k405fzYnAlvpcBWn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p>
                - Diferencia de cuadrados: Para polinomios de la forma 𝑎^2−𝑏^2, que se factoriza como (𝑎+𝑏)(𝑎−𝑏). Ejemplo: (por Matematicas Profe Alex)
            </p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/dmUjA2V_vOQ?si=hzNeER_li-V313ml" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p>
                - Trinomio de la forma 𝑥^2+𝑏𝑥+𝑐. Que se factoriza buscando dos números que multiplicados den 𝑐 y sumados den 𝑏. Ejemplo: (por Matematicas Profe Alex)
            </p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/xZHGl-RUqHs?si=On_F5giA0OMwDz1Z" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <h3> - División de polinomios</h3>
            <p>
                La división larga de polinomios es un metodo que permite dividir un polinomio entre otro de menor o igulal grado. (por Matematicas Profe Alex)
            </p>
            <p>
                Primera Parte:
            </p>
            <iframe width="280" height="157" src="https://www.youtube.com/embed/bU9m3PF71Oo?si=hC0tLKihjNn30PYd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p>Segunda Parte: </p>
            <iframe width="280" height="157" src="https://www.youtube.com/embed/ZPrTUwQQDk4?si=y0Ev2F78AZfQc2NX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p>
                División sintética: Es un metodo abreviado para dividir polinomios cuando el divisor es de la forma x−c. Ejemplo: (por Profe Richard)
            </p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/cbQfP1Er1WU?si=cCizpgUw3VM8n5Od" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <h3> - Teorema del Resto y Teorema del Factor</h3>
            <p>
                Teorema del Resto: Si un polinomio P(𝑥) se divdie por 𝑥 - 𝑎 es el resto de la división es P(𝑎) 
            </p>
            <p>
                Teorema del Factor: Si P(𝑎) = 0, entonces 𝑥 - 𝑎 es un factor de p (𝑥)
            </p>
            <hr>
            <h3>Aplicaciones de los polinomios: </h3>
            <p>
                Los polinomios se utlizan en diversas areas: 
            </p>
            <ol>
                <li>En física, para modelar el movimietno y la trayectoria de objetos.</li>
                <li>
                En economía, para construir modelos financieros y analizar tendencias.
                </li>
                <li>En ingeniería, para resolver problemas de diseño y optimización.</li>
                <li>En estadistica, los polinomiso se usan para ajustes de curvas en datos, como en la regresión polinómica.</li>
            </ol>
            <hr>
            </section>

            </section>

            <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregPolinomios.php'">
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