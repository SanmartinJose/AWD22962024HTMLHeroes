const express = require('express');
const connection = require('../db');
const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Role ///////////

// Obtener todos los roles
app.get('/roles', (req, res) => {
  connection.query('SELECT * FROM `Role`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los roles');
    }
    res.json(results); // Devuelve los roles como JSON
  });
});

// Agregar un nuevo rol (POST)
app.post('/roles', (req, res) => {
  const { id_role, name_role, description, access } = req.body;

  const query = `INSERT INTO \`Role\` (id_role, name_role, description, access) 
                 VALUES (?, ?, ?, ?)`;

  connection.query(query, [id_role, name_role, description, access], (err, results) => {
    if (err) {
      console.error('Error al agregar el rol:', err.message);
      return res.status(500).send('Error al agregar el rol');
    }
    res.status(201).json({ message: 'Rol agregado exitosamente', id: results.insertId });
  });
});

// Actualizar un rol existente (PUT)
app.put('/roles/:id', (req, res) => {
  const { id } = req.params; // ID del rol
  const { name_role, description, access } = req.body;

  const query = `UPDATE \`Role\` 
                 SET name_role = ?, description = ?, access = ? 
                 WHERE id_role = ?`;

  connection.query(query, [name_role, description, access, id], (err, results) => {
    if (err) {
      console.error('Error al actualizar el rol:', err.message);
      return res.status(500).send('Error al actualizar el rol');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Rol no encontrado');
    }
    res.json({ message: 'Rol actualizado exitosamente' });
  });
});

// Eliminar un rol (DELETE)
app.delete('/roles/:id', (req, res) => {
  const { id } = req.params; // ID del rol

  const query = `DELETE FROM \`Role\` WHERE id_role = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar el rol:', err.message);
      return res.status(500).send('Error al eliminar el rol');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Rol no encontrado');
    }
    res.json({ message: 'Rol eliminado exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
