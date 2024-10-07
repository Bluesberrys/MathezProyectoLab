const express = require("express");
const mysql = require("mysql2/promise");
const bodyParser = require("body-parser");
const path = require("path");

const app = express();
const port = process.env.port || 8080;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Serve static files
app.use(express.static(path.join(__dirname)));

// MySQL connection pool
const pool = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "Mathez",
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
});

// Login route
app.post("/login", async (req, res) => {
  const { numCta, passwd } = req.body;

  try {
    const [results] = await pool.query("SELECT numCta, passwd FROM Alumnos WHERE numCta = ? AND passwd = ?", [
      numCta,
      passwd,
    ]);

    if (results.length === 1) {
      // Generate a simple token (in a real app, use a more secure method)
      const token = Buffer.from(`${numCta}-${Date.now()}`).toString("base64");
      res.json({ success: true, message: "Login successful", token: token });
    } else {
      res.status(401).json({ success: false, message: "Invalid username or password" });
    }
  } catch (error) {
    console.error("Error executing query:", error);
    res.status(500).json({ error: "Internal server error" });
  }
});

// Updated Register route
app.post("/register", async (req, res) => {
  const { apellidoP, apellidoM, nombres, email, passwd } = req.body;

  // Basic validation
  if (!apellidoP || !apellidoM || !nombres || !email || !passwd) {
    return res.status(400).json({ success: false, message: "All fields are required" });
  }

  try {
    const connection = await pool.getConnection();

    // Get the current max numCta
    const [maxResult] = await connection.query("SELECT MAX(numCta) as maxNumCta FROM Alumnos");
    let nextNumCta = 1001; // Start from 1001 if no existing records

    if (maxResult[0].maxNumCta) {
      nextNumCta = Math.max(1001, maxResult[0].maxNumCta + 1);
    }

    // Insert new user
    const query =
      "INSERT INTO Alumnos (numCta, apellidoP, apellidoM, nombres, email, passwd) VALUES (?, ?, ?, ?, ?, ?)";
    await connection.query(query, [nextNumCta, apellidoP, apellidoM, nombres, email, passwd]);

    connection.release();

    res.json({ success: true, message: "Registration successful", numCta: nextNumCta });
  } catch (error) {
    console.error("Database error:", error);
    res.status(500).json({ success: false, message: "Internal server error" });
  }
});

// Password recovery route (placeholder - implement actual logic)
app.post("/recover", (req, res) => {
  const { numCta } = req.body;

  // Placeholder response - implement actual password recovery logic
  res.json({ success: true, message: "Password recovery initiated" });
});

app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
