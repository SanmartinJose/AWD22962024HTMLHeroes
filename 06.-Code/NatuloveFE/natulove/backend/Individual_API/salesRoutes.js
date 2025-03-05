const express = require('express');
const connection = require('../db');
const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Sales ///////////

// Obtener todas las ventas
app.get('/sales', (req, res) => {
  connection.query('SELECT * FROM `Sales`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener las ventas');
    }
    res.json(results); // Devuelve las ventas como JSON
  });
});

// Agregar una nueva venta (POST)
app.post('/sales', (req, res) => {
  const { id_sales, id_client, sale_date, total_amount } = req.body;

  const query = `INSERT INTO \`Sales\` (id_sales, id_client, sale_date, total_amount) 
                 VALUES (?, ?, ?, ?)`;

  connection.query(query, [id_sales, id_client, sale_date, total_amount], (err, results) => {
    if (err) {
      console.error('Error al agregar la venta:', err.message);
      return res.status(500).send('Error al agregar la venta');
    }
    res.status(201).json({ message: 'Venta agregada exitosamente', id: results.insertId });
  });
});

// Actualizar una venta existente (PUT)
app.put('/sales/:id', (req, res) => {
  const { id } = req.params; // ID de la venta
  const { id_client, sale_date, total_amount } = req.body;

  const query = `UPDATE \`Sales\` 
                 SET id_client = ?, sale_date = ?, total_amount = ? 
                 WHERE id_sales = ?`;

  connection.query(query, [id_client, sale_date, total_amount, id], (err, results) => {
    if (err) {
      console.error('Error al actualizar la venta:', err.message);
      return res.status(500).send('Error al actualizar la venta');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Venta no encontrada');
    }
    res.json({ message: 'Venta actualizada exitosamente' });
  });
});

// Eliminar una venta (DELETE)
app.delete('/sales/:id', (req, res) => {
  const { id } = req.params; // ID de la venta

  const query = `DELETE FROM \`Sales\` WHERE id_sales = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar la venta:', err.message);
      return res.status(500).send('Error al eliminar la venta');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Venta no encontrada');
    }
    res.json({ message: 'Venta eliminada exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
