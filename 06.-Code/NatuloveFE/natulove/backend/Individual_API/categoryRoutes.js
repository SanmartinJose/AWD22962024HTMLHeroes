const express = require('express');
const connection = require('../db');
const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Category ///////////

// Obtener todas las categorías
app.get('/categories', (req, res) => {
  connection.query('SELECT * FROM `Category`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener las categorías');
    }
    res.json(results); // Devuelve las categorías como JSON
  });
});

// Agregar una nueva categoría (POST)
app.post('/categories', (req, res) => {
  const { id_category, name, description, creation_date } = req.body;

  const query = `INSERT INTO \`Category\` (id_category, name, description, creation_date) 
                 VALUES (?, ?, ?, ?)`;

  connection.query(query, [id_category, name, description, creation_date], (err, results) => {
    if (err) {
      console.error('Error al agregar la categoría:', err.message);
      return res.status(500).send('Error al agregar la categoría');
    }
    res.status(201).json({ message: 'Categoría agregada exitosamente', id: results.insertId });
  });
});

// Actualizar una categoría existente (PUT)
app.put('/categories/:id', (req, res) => {
  const { id } = req.params; // ID de la categoría
  const { name, description, creation_date } = req.body;

  const query = `UPDATE \`Category\` 
                 SET name = ?, description = ?, creation_date = ? 
                 WHERE id_category = ?`;

  connection.query(query, [name, description, creation_date, id], (err, results) => {
    if (err) {
      console.error('Error al actualizar la categoría:', err.message);
      return res.status(500).send('Error al actualizar la categoría');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Categoría no encontrada');
    }
    res.json({ message: 'Categoría actualizada exitosamente' });
  });
});

// Eliminar una categoría (DELETE)
app.delete('/categories/:id', (req, res) => {
  const { id } = req.params; // ID de la categoría

  const query = `DELETE FROM \`Category\` WHERE id_category = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar la categoría:', err.message);
      return res.status(500).send('Error al eliminar la categoría');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Categoría no encontrada');
    }
    res.json({ message: 'Categoría eliminada exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
