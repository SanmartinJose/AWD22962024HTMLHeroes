const express = require("express");
const router = express.Router();

// Simulación de autenticación (sin base de datos por ahora)
let users = [{ id: 1, username: "admin", loggedIn: true }];

router.get("/user", (req, res) => {
  const user = users.find((u) => u.loggedIn);
  res.json(user || { loggedIn: false });
});

router.post("/logout", (req, res) => {
  users = users.map((u) => ({ ...u, loggedIn: false }));
  res.json({ message: "Sesión cerrada" });
});

module.exports = router;
