const express = require('express');
const connection = require('../db');
const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Inventory ///////////

// Obtener todos los registros del inventario
app.get('/inventory', (req, res) => {
  connection.query('SELECT * FROM `Inventory`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los registros del inventario');
    }
    res.json(results); // Devuelve los registros como JSON
  });
});

// Agregar un nuevo registro al inventario (POST)
app.post('/inventory', (req, res) => {
  const { id_inventory, id_product, id_user, date } = req.body;

  const query = `INSERT INTO \`Inventory\` (id_inventory, id_product, id_user, date) 
                 VALUES (?, ?, ?, ?)`;

  connection.query(query, [id_inventory, id_product, id_user, date], (err, results) => {
    if (err) {
      console.error('Error al agregar el registro al inventario:', err.message);
      return res.status(500).send('Error al agregar el registro al inventario');
    }
    res.status(201).json({ message: 'Registro de inventario agregado exitosamente', id: results.insertId });
  });
});

// Actualizar un registro del inventario existente (PUT)
app.put('/inventory/:id', (req, res) => {
  const { id } = req.params; // ID del registro del inventario
  const { id_product, id_user, date } = req.body;

  const query = `UPDATE \`Inventory\` 
                 SET id_product = ?, id_user = ?, date = ? 
                 WHERE id_inventory = ?`;

  connection.query(query, [id_product, id_user, date, id], (err, results) => {
    if (err) {
      console.error('Error al actualizar el registro del inventario:', err.message);
      return res.status(500).send('Error al actualizar el registro del inventario');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Registro del inventario no encontrado');
    }
    res.json({ message: 'Registro de inventario actualizado exitosamente' });
  });
});

// Eliminar un registro del inventario (DELETE)
app.delete('/inventory/:id', (req, res) => {
  const { id } = req.params; // ID del registro del inventario

  const query = `DELETE FROM \`Inventory\` WHERE id_inventory = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar el registro del inventario:', err.message);
      return res.status(500).send('Error al eliminar el registro del inventario');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Registro del inventario no encontrado');
    }
    res.json({ message: 'Registro de inventario eliminado exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
