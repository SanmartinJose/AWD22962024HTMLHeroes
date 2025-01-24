const express = require('express');
const connection = require('../db');
const app = express();
const bcrypt = require('bcrypt'); // Para manejar contraseñas
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Users ///////////

// Obtener todos los usuarios
app.get('/users', (req, res) => {
  connection.query('SELECT * FROM `users`', (err, results) => {
    if (err) {
      console.error('Error al obtener los usuarios:', err.message);
      return res.status(500).send('Error al obtener los usuarios');
    }
    res.json(results);
  });
});

// Agregar un nuevo usuario (POST)
app.post('/users', async (req, res) => {
  const { first_name, last_name, email, username, password, birth_date, role } = req.body;

  // Encriptar la contraseña antes de guardarla
  const hashedPassword = await bcrypt.hash(password, 10);

  const query = `INSERT INTO \`users\` 
                 (first_name, last_name, email, username, password, birth_date, role, created_at) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)`;

  connection.query(
    query,
    [first_name, last_name, email, username, hashedPassword, birth_date, role],
    (err, results) => {
      if (err) {
        console.error('Error al agregar el usuario:', err.message);
        return res.status(500).send('Error al agregar el usuario');
      }
      res.status(201).json({ message: 'Usuario agregado exitosamente', id: results.insertId });
    }
  );
});

// Actualizar un usuario existente (PUT)
app.put('/users/:id', async (req, res) => {
  const { id } = req.params;
  const { first_name, last_name, email, username, password, birth_date, role } = req.body;

  // Encriptar la nueva contraseña si se proporciona
  const hashedPassword = password ? await bcrypt.hash(password, 10) : null;

  const query = `UPDATE \`users\` 
                 SET 
                   first_name = ?, 
                   last_name = ?, 
                   email = ?, 
                   username = ?, 
                   password = COALESCE(?, password), 
                   birth_date = ?, 
                   role = ?
                 WHERE id = ?`;

  connection.query(
    query,
    [first_name, last_name, email, username, hashedPassword, birth_date, role, id],
    (err, results) => {
      if (err) {
        console.error('Error al actualizar el usuario:', err.message);
        return res.status(500).send('Error al actualizar el usuario');
      }
      if (results.affectedRows === 0) {
        return res.status(404).send('Usuario no encontrado');
      }
      res.json({ message: 'Usuario actualizado exitosamente' });
    }
  );
});

// Eliminar un usuario (DELETE)
app.delete('/users/:id', (req, res) => {
  const { id } = req.params;

  const query = `DELETE FROM \`users\` WHERE id = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar el usuario:', err.message);
      return res.status(500).send('Error al eliminar el usuario');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Usuario no encontrado');
    }
    res.json({ message: 'Usuario eliminado exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
