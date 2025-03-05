const express = require('express');
const connection = require('../db');
const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Comentary ///////////

// Obtener todos los comentarios
app.get('/comentaries', (req, res) => {
  connection.query('SELECT * FROM `comentary`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los comentarios');
    }
    res.json(results); // Devuelve los comentarios como JSON
  });
});

// Agregar un nuevo comentario (POST)
app.post('/comentaries', (req, res) => {
  const { comment, created_at, product_id, rating, user_id } = req.body;

  const query = `INSERT INTO \`comentary\` (comment, created_at, product_id, rating, user_id) 
                 VALUES (?, ?, ?, ?, ?)`;

  connection.query(query, [comment, created_at, product_id, rating, user_id], (err, results) => {
    if (err) {
      console.error('Error al agregar el comentario:', err.message);
      return res.status(500).send('Error al agregar el comentario');
    }
    res.status(201).json({ message: 'Comentario agregado exitosamente', id: results.insertId });
  });
});

// Actualizar un comentario existente (PUT)
app.put('/comentaries/:id', (req, res) => {
  const { id } = req.params; // ID del comentario
  const { comment, created_at, product_id, rating, user_id } = req.body;

  const query = `UPDATE \`comentary\` 
                 SET comment = ?, created_at = ?, product_id = ?, rating = ?, user_id = ? 
                 WHERE id = ?`;

  connection.query(query, [comment, created_at, product_id, rating, user_id, id], (err, results) => {
    if (err) {
      console.error('Error al actualizar el comentario:', err.message);
      return res.status(500).send('Error al actualizar el comentario');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Comentario no encontrado');
    }
    res.json({ message: 'Comentario actualizado exitosamente' });
  });
});

// Eliminar un comentario (DELETE)
app.delete('/comentaries/:id', (req, res) => {
  const { id } = req.params; // ID del comentario

  const query = `DELETE FROM \`comentary\` WHERE id = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar el comentario:', err.message);
      return res.status(500).send('Error al eliminar el comentario');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Comentario no encontrado');
    }
    res.json({ message: 'Comentario eliminado exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
