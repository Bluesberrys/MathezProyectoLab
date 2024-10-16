// Shared functions
function navigateToHome() {
  const token = localStorage.getItem("authToken");
  if (token) {
    window.location.href = "/homepage.html";
  } else {
    window.location.href = "/index.html";
  }
}

function logout() {
  const token = localStorage.getItem("authToken");
  if (!token) {
    console.log("No token found, redirecting to login page");
    window.location.href = "/index.html";
    return;
  }

  fetch("/logout", {
    method: "POST",
    headers: {
      Authorization: `Bearer ${token}`,
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Logout failed");
      }
      return response.json();
    })
    .then((data) => {
      console.log("Logout successful");
      localStorage.removeItem("authToken");
      window.location.href = "/index.html";
    })
    .catch((error) => {
      console.error("Error during logout:", error);
      alert("Logout failed. Please try again.");
    });
}

// Index page specific functions
function initializeIndexPage() {
  console.log("Index page loaded");
  const token = localStorage.getItem("authToken");
  if (token) {
    console.log("Token found, redirecting to homepage");
    window.location.href = "./homepage.html";
    return;
  }

  // Initialize dark mode
  initializeDarkMode();

  // View switching
  window.showView = function (viewId) {
    document.querySelectorAll(".view").forEach((view) => view.classList.remove("active"));
    document.getElementById(viewId + "View").classList.add("active");
  };

  // Registration form handling
  const registroForm = document.getElementById("registroForm");
  const page1 = document.getElementById("page1");
  const page2 = document.getElementById("page2");
  const nextBtn = document.getElementById("nextBtn");
  const prevBtn = document.getElementById("prevBtn");

  if (nextBtn) {
    nextBtn.addEventListener("click", function () {
      if (validatePage1()) {
        page1.classList.remove("active");
        page2.classList.add("active");
      }
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener("click", function () {
      page2.classList.remove("active");
      page1.classList.add("active");
    });
  }

  if (registroForm) {
    registroForm.addEventListener("submit", handleRegistration);
  }

  // Login form handling
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", handleLogin);
  }
}

function validatePage1() {
  const email = document.getElementById("email").value;
  const passwd = document.getElementById("passwd").value;
  const confirmPasswd = document.getElementById("confirmPasswd").value;

  if (!email || !passwd || !confirmPasswd) {
    alert("Por favor, completa todos los campos");
    return false;
  }

  if (passwd !== confirmPasswd) {
    alert("Las contraseñas no coinciden");
    return false;
  }

  return true;
}

function handleRegistration(event) {
  event.preventDefault();

  const email = document.getElementById("email").value;
  const passwd = document.getElementById("passwd").value;
  const apellidoP = document.getElementById("apellidoP").value;
  const apellidoM = document.getElementById("apellidoM").value;
  const nombres = document.getElementById("nombres").value;

  fetch("/register", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ apellidoP, apellidoM, nombres, email, passwd }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert(`Registro exitoso! Tu número de cuenta es: ${data.numCta}`);
        showView("login");
      } else {
        alert("Error en el registro: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Ocurrió un error. Por favor, intenta de nuevo.");
    });
}

function handleLogin(event) {
  event.preventDefault();
  console.log("Login form submitted");

  const numCta = document.getElementById("loginNumCta").value;
  const passwd = document.getElementById("loginPasswd").value;

  fetch("/login", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ numCta, passwd }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Login response:", data);
      if (data.success) {
        localStorage.setItem("authToken", data.token);
        console.log("Login successful, redirecting to homepage");
        window.location.href = "./homepage.html";
      } else {
        console.error("Login error:", data.message);
        alert("Error en el login: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Login fetch error:", error);
      alert("Ocurrió un error. Por favor, intenta de nuevo.");
    });
}

// Homepage specific functions
function initializeHomePage() {
  console.log("Homepage loaded");
  const token = localStorage.getItem("authToken");
  if (!token) {
    console.log("No token found, redirecting to index");
    window.location.href = "./index.html";
    return;
  }

  // Initialize dark mode
  initializeDarkMode();

  console.log("Token found, fetching user data");
  fetchUserData();

  const userDropdownToggle = document.getElementById("userDropdownToggle");
  const userDropdown = document.getElementById("userDropdown");

  if (userDropdownToggle && userDropdown) {
    userDropdownToggle.addEventListener("click", function (e) {
      e.stopPropagation();
      userDropdown.classList.toggle("active");
    });

    // Close the dropdown when clicking outside of it
    document.addEventListener("click", function (e) {
      if (!userDropdown.contains(e.target) && !userDropdownToggle.contains(e.target)) {
        userDropdown.classList.remove("active");
      }
    });
  }
}

function fetchUserData() {
  const token = localStorage.getItem("authToken");
  console.log("Fetching user data with token:", token);
  fetch("/homepage", {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  })
    .then((response) => {
      console.log("Homepage response status:", response.status);
      if (!response.ok) {
        return response.text().then((text) => {
          throw new Error(`Not authorized: ${text}`);
        });
      }
      return response.json();
    })
    .then((userData) => {
      console.log("User data received:", userData);
      displayUserInfo(userData);
      if (userData.inscrito) {
        displayCourseContent();
      } else {
        displayNotEnrolledMessage();
      }
    })
    .catch((error) => {
      console.error("Error fetching user data:", error);
      if (error.message.includes("Not authorized")) {
        console.log("Not authorized, removing token and redirecting to index");
        localStorage.removeItem("authToken");
        window.location.href = "./index.html";
      } else {
        alert("An error occurred while loading your data. Please try refreshing the page.");
      }
    });
}

function displayUserInfo(userData) {
  const userGreeting = document.getElementById("userGreeting");
  if (userGreeting) {
    userGreeting.textContent = `Hola: ${userData.nombre} ${userData.apellidoP} ${userData.apellidoM}`;
  } else {
    console.error("userGreeting element not found");
  }
}

function displayCourseContent() {
  const mainContent = document.getElementById("mainContent");
  if (mainContent) {
    mainContent.innerHTML = `
          <div class="col">
            <a href="#" class="card">
              <h2>1</h2>
              <h3 class="card-title">Conjuntos</h3>
            </a>
            <a href="#" class="card">
              <h2>2</h2>
              <h3 class="card-title">Tipos de funciones</h3>
            </a>
            <a href="#" class="card">
              <h2>3</h2>
              <h3 class="card-title">Regla de correspondencia</h3>
            </a>
            <a href="#" class="card">
              <h2>4</h2>
              <h3 class="card-title">Características de la gráfica</h3>
            </a>
            <a href="#" class="card">
              <h2>5</h2>
              <h3 class="card-title">Variación a partir de un comportamiento de casos</h3>
            </a>
          </div>
  
          <div class="col">
            <a href="#" class="card">
              <h2>6</h2>
              <h3 class="card-title">Polinomios</h3>
            </a>
            <a href="#" class="card">
              <h2>7</h2>
              <h3 class="card-title">Racionalización</h3>
            </a>
            <a href="#" class="card">
              <h2>8</h2>
              <h3 class="card-title">Razones trigonométricas</h3>
            </a>
            <a href="#" class="card">
              <h2>9</h2>
              <h3 class="card-title">Variabilidad</h3>
            </a>
            <a href="#" class="card">
              <h2>10</h2>
              <h3 class="card-title">Sucesiones</h3>
            </a>
          </div>
    `;
  } else {
    console.error("mainContent element not found");
  }
}

function displayNotEnrolledMessage() {
  const mainContent = document.getElementById("mainContent");
  if (mainContent) {
    mainContent.innerHTML = `
            <h2>No estás inscrito en algún curso.</h2>
      `;
  } else {
    console.error("mainContent element not found");
  }
}

// Initialize the appropriate page based on the current URL
document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname;
  if (currentPath.includes("index.html") || currentPath === "/") {
    initializeIndexPage();
  } else if (currentPath.includes("homepage.html")) {
    initializeHomePage();
  } else {
    // For other pages (like sobreNos.html), just initialize dark mode
    initializeDarkMode();
  }
});

// Dark mode functions
function initializeDarkMode() {
  const darkModeToggle = document.getElementById("darkModeToggle");
  const body = document.body;

  // Check for saved dark mode preference
  if (localStorage.getItem("darkMode") === "enabled") {
    body.classList.add("dark-mode");
    if (darkModeToggle) {
      darkModeToggle.checked = true;
    }
  }

  // Toggle dark mode
  if (darkModeToggle) {
    darkModeToggle.addEventListener("change", function () {
      if (this.checked) {
        enableDarkMode();
      } else {
        disableDarkMode();
      }
    });
  }
}

function enableDarkMode() {
  document.body.classList.add("dark-mode");
  localStorage.setItem("darkMode", "enabled");
}

function disableDarkMode() {
  document.body.classList.remove("dark-mode");
  localStorage.setItem("darkMode", null);
}
