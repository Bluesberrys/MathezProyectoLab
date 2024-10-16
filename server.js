const express = require("express");
const mysql = require("mysql2/promise");
const bodyParser = require("body-parser");
const path = require("path");
const jwt = require("jsonwebtoken");
const bcrypt = require("bcrypt");

const app = express();
const port = process.env.PORT || 8080;
const JWT_SECRET = process.env.JWT_SECRET || "la_ia_nos_esta_carreando"; // Use an environment variable in production

// Middleware
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname)));

// MySQL connection pool
const pool = mysql.createPool({
  host: process.env.DB_HOST || "localhost",
  user: process.env.DB_USER || "root",
  password: process.env.DB_PASSWORD || "root",
  database: process.env.DB_NAME || "Mathez",
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
});

// Middleware to verify JWT
const verifyToken = (req, res, next) => {
  const token = req.headers["authorization"]?.split(" ")[1];

  if (!token) {
    return res.status(403).json({ error: "No token provided" });
  }

  jwt.verify(token, JWT_SECRET, (err, decoded) => {
    if (err) {
      return res.status(401).json({ error: "Unauthorized" });
    }
    req.userId = decoded.id;
    next();
  });
};

// Login route
app.post("/login", async (req, res) => {
  const { numCta, passwd } = req.body;
  console.log("Login attempt for numCta:", numCta);

  try {
    const [results] = await pool.query("SELECT numCta, passwd FROM Alumnos WHERE numCta = ?", [numCta]);

    if (results.length === 1) {
      const isMatch = await bcrypt.compare(passwd, results[0].passwd);
      if (isMatch) {
        const token = jwt.sign({ id: results[0].numCta }, JWT_SECRET, { expiresIn: "1h" });
        console.log("Login successful for numCta:", numCta);
        res.json({ success: true, message: "Login successful", token: token });
      } else {
        console.log("Invalid password for numCta:", numCta);
        res.status(401).json({ success: false, message: "Invalid username or password" });
      }
    } else {
      console.log("User not found for numCta:", numCta);
      res.status(401).json({ success: false, message: "Invalid username or password" });
    }
  } catch (error) {
    console.error("Error executing query:", error);
    res.status(500).json({ error: "Internal server error" });
  }
});

// Register route
app.post("/register", async (req, res) => {
  const { apellidoP, apellidoM, nombres, email, passwd } = req.body;

  if (!apellidoP || !apellidoM || !nombres || !email || !passwd) {
    return res.status(400).json({ success: false, message: "All fields are required" });
  }

  try {
    const connection = await pool.getConnection();
    const [maxResult] = await connection.query("SELECT MAX(numCta) as maxNumCta FROM Alumnos");
    let nextNumCta = Math.max(1001, (maxResult[0].maxNumCta || 1000) + 1);

    const hashedPassword = await bcrypt.hash(passwd, 10);

    const query =
      "INSERT INTO Alumnos (numCta, apellidoP, apellidoM, nombres, email, passwd) VALUES (?, ?, ?, ?, ?, ?)";
    await connection.query(query, [nextNumCta, apellidoP, apellidoM, nombres, email, hashedPassword]);

    connection.release();

    res.json({ success: true, message: "Registration successful", numCta: nextNumCta });
  } catch (error) {
    console.error("Database error:", error);
    res.status(500).json({ success: false, message: "Internal server error" });
  }
});

// Homepage route
app.get("/homepage", verifyToken, async (req, res) => {
  console.log("Homepage request for userId:", req.userId);
  try {
    const [userResults] = await pool.query(
      "SELECT apellidoP, apellidoM, nombres FROM Alumnos WHERE numCta = ?",
      [req.userId]
    );
    const [inscripcionResults] = await pool.query("SELECT * FROM inscripciones WHERE numCta = ?", [
      req.userId,
    ]);

    if (userResults.length === 0) {
      console.log("User not found for userId:", req.userId);
      return res.status(404).json({ error: "User not found" });
    }

    const userData = {
      nombre: userResults[0].nombres,
      apellidoP: userResults[0].apellidoP,
      apellidoM: userResults[0].apellidoM,
      matricula: req.userId,
      inscrito: inscripcionResults.length > 0,
    };

    console.log("Sending user data:", userData);
    res.json(userData);
  } catch (error) {
    console.error("Error fetching user data:", error);
    res.status(500).json({ error: "Internal server error" });
  }
});

// Catch-all route to serve index.html for any unmatched routes
app.get("*", (req, res) => {
  // Only serve index.html for routes that should be handled by the frontend router
  if (req.path.startsWith("/api/") || req.path === "/logout") {
    res.status(404).json({ error: "Not found" });
  } else {
    res.sendFile(path.join(__dirname, "index.html"));
  }
});

// Routes for specific pages
app.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "index.html"));
});

app.get("/homepage", verifyToken, (req, res) => {
  res.sendFile(path.join(__dirname, "homepage.html"));
});

app.get("/sobreNos", (req, res) => {
  res.sendFile(path.join(__dirname, "sobreNos.html"));
});

// API routes
app.get("/api/user", verifyToken, async (req, res) => {
  // ... (user data fetching logic)
});

app.post("/logout", (req, res) => {
  res.json({ success: true, message: "Logout successful" });
});

// Catch-all route for API requests
app.all("/api/*", (req, res) => {
  res.status(404).json({ error: "API endpoint not found" });
});

app.listen(port, "0.0.0.0", () => {
  console.log(`Server running on http://0.0.0.0:${port}`);
});
