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
    <title>Mathez - Conjuntos</title>
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

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 1");

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
        <button class="btn-tema" type="submit" onclick="actTemaTerminado('conjuntos')">
        Marcar como visto
        </button>
      <?php
      }*/
      if($estatus == "Terminado")
      {
      ?>
        <button class="btn-tema" type="submit" onclick="actTemaProgreso('conjuntos')">
        Tema visto
        </button>
      <?php
      }
      ?>
      <div class="container">
        <div class="container-title">
          <h1 class="alt-font">
            <!-- Titulo general del tema -->
            Conjuntos
          </h1>
        </div>

        <!-- * Pueden agregar y eliminar la cantidad de secciones que necesiten segun los subtitulos del temna a trabajar -->
        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Concepto de conjunto
          </h2>
          <!-- contenido -->
          <p>
            Un conjunto es una colección de objetos o elementos bien definidos, entendidos como una unidad.
            Aunque no tiene una definición matemática estricta, es intuitivo para nuestra mente agrupar
            elementos en conjuntos, como letras, días de la semana o números.
          </p>
          <h3>Ejemplo</h3>
          <p>
            El conjunto de las vocales en español puede ser representado como
            <span class="italic"> 𝐴 = { 𝑎 , 𝑒 , 𝑖 , 𝑜 , 𝑢 }</span>
          </p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Notación de Conjuntos
          </h2>
          <!-- contenido -->
          <p>
            Para expresar la pertenencia de un elemento a un conjunto se utiliza el símbolo ∈. Por ejemplo,
            <span class="italic">𝑎 ∈ 𝐴</span> significa que 𝑎 es un elemento del conjunto 𝐴.
          </p>
          <p>
            La no pertenencia se expresa con ∉. Así, <span class="italic">𝑏 ∉ 𝐴</span> indica que 𝑏 no está en
            el conjunto 𝐴.
          </p>
          <p>
            Esta notación facilita identificar qué elementos forman parte de un conjunto en distintos
            contextos.
          </p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Formas de Especificar un Conjunto
          </h2>
          <!-- contenido -->
          <h3>Por Extensión</h3>
          <p>
            Se enumeran todos los elementos del conjunto dentro de llaves, separados por comas. Esta forma es
            útil para conjuntos finitos y permite visualizar todos los elementos.
          </p>
          <h4>Ejemplo</h4>
          <p>
            El conjunto de vocales, <span class="italic">𝐴 = { 𝑎 , 𝑒 , 𝑖 , 𝑜 , 𝑢 }</span>, muestra
            explícitamente todos sus elementos.
          </p>

          <h3>Por Comprensión</h3>
          <p>
            Se define un conjunto usando una propiedad que caracterice a sus elementos, sin enumerarlos. Se
            expresa en la forma <span class="italic"> 𝐴 = { 𝑥 ∣ 𝑥 tiene cierta propiedad }.</span>
          </p>
          <h4>Ejemplo</h4>
          <p><span class="italic"> B={x∣x es un número par menor que 10}={2,4,6,8}. </span></p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Clases de Conjuntos
          </h2>
          <!-- contenido -->
          <h3>Conjunto Vacío</h3>
          <p>
            Representado por ∅ o { }, es un conjunto que no tiene elementos. Ejemplo: El conjunto de números
            naturales entre 6 y 7, que es vacío.
          </p>
          <h3>Conjuntos Finitos</h3>
          <p>
            Tienen un número limitado de elementos, como el conjunto de días de la semana. Ejemplo: 𝐶 = {
            𝑙𝑢𝑛𝑒𝑠, 𝑚𝑎𝑟𝑡𝑒𝑠, 𝑚𝑖𝑒𝑟𝑐𝑜𝑙𝑒𝑠, 𝑗𝑢𝑒𝑣𝑒𝑠, 𝑣𝑖𝑒𝑟𝑛𝑒𝑠, 𝑠𝑎𝑏𝑎𝑑𝑜, 𝑑𝑜𝑚𝑖𝑛𝑔𝑜 }.
          </p>
          <h3>Conjuntos Infinitos</h3>
          <p>
            Tienen un número ilimitado de elementos y se representan usando una propiedad. Ejemplo: El
            conjunto de números naturales, 𝑁 = { 1, 2, 3, …   }.
          </p>
          <h3>Conjunto Unitario</h3>
          <p>Contiene solo un elemento. Ejemplo: 𝐷 = { 5 }, que es un conjunto con el único elemento 5.</p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Relaciones entre Conjuntos
          </h2>
          <!-- contenido -->
          <h3>Conjuntos Equivalentes</h3>
          <p>
            Dos conjuntos son equivalentes si tienen la misma cantidad de elementos y se puede hacer una
            correspondencia uno a uno entre ellos.
          </p>
          <h4>Ejemplo</h4>
          <p>A={1,2,3} y 𝐵 = { 𝑎 , 𝑏 , 𝑐 } son equivalentes.</p>

          <h3>Igualdad de Conjuntos</h3>
          <p>Dos conjuntos son iguales si tienen exactamente los mismos elementos, sin importar el orden.</p>
          <h4>Ejemplo</h4>
          <p>Si 𝐶 = { 𝑎 , 𝑏 , 𝑐 } y 𝐷 = { 𝑏 , 𝑎 , 𝑐 }, entonces 𝐶 = 𝐷.</p>

          <h3>Subconjuntos y Subconjuntos Propios</h3>
          <p>A⊆B: 𝐴 es subconjunto de 𝐵 si todos los elementos de 𝐴 también están en 𝐵.</p>
          <p>A⊂B: 𝐴 es subconjunto propio de 𝐵 si todos los elementos de 𝐴 están en 𝐵 y además 𝐴 ≠ 𝐵.</p>
          <h4>Ejemplo</h4>
          <p>Si 𝐴 = { 1 , 2 } y 𝐵 = { 1 , 2 , 3 }, entonces 𝐴 ⊂ 𝐵</p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Operaciones con Conjuntos
          </h2>
          <!-- contenido -->
          <h3>Intersección (𝐴 ∩ 𝐵)</h3>
          <p>Es el conjunto de elementos comunes a 𝐴 y 𝐵.</p>
          <h4>Ejemplo</h4>
          <p>Si 𝐴 = { 1 , 2 , 3 } y 𝐵 = { 2 , 3 , 4 }, entonces 𝐴 ∩ 𝐵 = { 2 , 3 }.</p>

          <h3>Unión (𝐴 ∪ 𝐵)</h3>
          <p>Es el conjunto de todos los elementos que pertenecen a 𝐴, 𝐵, o ambos.</p>
          <h4>Ejemplo</h4>
          <p>Si 𝐴 = { 1 , 2 } y 𝐵 = { 2 , 3 }, entonces 𝐴 ∪ 𝐵 = { 1 , 2 , 3 }.</p>

          <h3>Diferencia (𝐴 − 𝐵)</h3>
          <p>Conjunto de elementos que pertenecen a 𝐴 pero no a 𝐵.</p>
          <h4>Ejemplo</h4>
          <p>Conjunto de elementos en el universo 𝑈 que no están en 𝐴.</p>

          <h3>Complemento (𝐴′)</h3>
          <p>Conjunto de elementos en el universo 𝑈 que no están en 𝐴.</p>
          <h4>Ejemplo</h4>
          <p>Si el universo 𝑈 = { 1 , 2 , 3 , 4 } y 𝐴 = { 1 , 2 }, entonces 𝐴 ′ = { 3 , 4 }.</p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Diagramas de Venn
          </h2>
          <!-- contenido -->
          <p>
            Representan gráficamente las relaciones entre conjuntos y se usan para ilustrar intersecciones,
            uniones, diferencias y complementos.
          </p>
          <p>
            En un diagrama de Venn, los conjuntos se representan por círculos dentro de un rectángulo que
            simboliza el conjunto universal.
          </p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Producto Cartesiano
          </h2>
          <!-- contenido -->
          <p>
            El producto cartesiano 𝐴 × 𝐵 es el conjunto de todos los pares ordenados posibles formados por un
            elemento de 𝐴 y uno de 𝐵. Se denota como:
          </p>
          <p>A×B={(a,b)∣a∈A y b∈B}</p>
          <h3>Ejemplo</h3>
          <p>
            Si 𝐴 = { 1 , 2 } y 𝐵 = { 𝑎 , 𝑏 }, entonces 𝐴 × 𝐵 = { ( 1 , 𝑎 ) , ( 1 , 𝑏 ) , ( 2 , 𝑎 ) , ( 2 , 𝑏 )
            } A×B={(1,a),(1,b),(2,a),(2,b)}.
          </p>
          <h3>Propiedades</h3>
          <p>El producto cartesiano no es conmutativo ( 𝐴 × 𝐵 ≠ 𝐵 × 𝐴 ).</p>
        </section>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            Sistema de Coordenadas Cartesianas
          </h2>
          <!-- contenido -->
          <p>
            Es una representación gráfica del producto cartesiano en dos dimensiones, usando dos ejes
            perpendiculares que se cruzan en el origen (0,0).
          </p>
          <p>
            El eje horizontal se llama eje 𝑥 y el eje vertical, eje 𝑦. Cada par ordenado ( 𝑥 , 𝑦 ) representa
            la posición de un punto en este plano.
          </p>
          <h3>Cuadrantes</h3>
          <p>
            El plano cartesiano se divide en cuatro cuadrantes que ayudan a ubicar la posición de los puntos:
          </p>
          <ul>
            <li>Primer cuadrante: 𝑥 y 𝑦 positivos.</li>
            <li>Segundo cuadrante: 𝑥 negativo y 𝑦 positivo.</li>
            <li>Tercer cuadrante: 𝑥 y 𝑦 negativos.</li>
            <li>Cuarto cuadrante: 𝑥 positivo y 𝑦 negativo.</li>
          </ul>
          <h3>Ejemplo de Localización</h3>
          <p>Para el punto (3, 2), se marca 3 unidades en el eje 𝑥 y 2 en el eje 𝑦.</p>
        </section>

        <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregConjuntos.php'">
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