const express = require('express');
const connection = require('../db');
const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Details_Sales ///////////

// Obtener todos los detalles de ventas
app.get('/details_sales', (req, res) => {
  connection.query('SELECT * FROM `Details_Sales`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los detalles de ventas');
    }
    res.json(results); // Devuelve los detalles como JSON
  });
});

// Agregar un nuevo detalle de venta (POST)
app.post('/details_sales', (req, res) => {
  const { id_sale, id_product, id_avoice, amount, unit_price, subtotal } = req.body;

  const query = `INSERT INTO \`Details_Sales\` (id_sale, id_product, id_avoice, amount, unit_price, subtotal) 
                 VALUES (?, ?, ?, ?, ?, ?)`;

  connection.query(query, [id_sale, id_product, id_avoice, amount, unit_price, subtotal], (err, results) => {
    if (err) {
      console.error('Error al agregar el detalle de venta:', err.message);
      return res.status(500).send('Error al agregar el detalle de venta');
    }
    res.status(201).json({ message: 'Detalle de venta agregado exitosamente', id: results.insertId });
  });
});

// Actualizar un detalle de venta existente (PUT)
app.put('/details_sales/:id_sale/:id_product', (req, res) => {
  const { id_sale, id_product } = req.params; // IDs del detalle de venta
  const { id_avoice, amount, unit_price, subtotal } = req.body;

  const query = `UPDATE \`Details_Sales\` 
                 SET id_avoice = ?, amount = ?, unit_price = ?, subtotal = ? 
                 WHERE id_sale = ? AND id_product = ?`;

  connection.query(query, [id_avoice, amount, unit_price, subtotal, id_sale, id_product], (err, results) => {
    if (err) {
      console.error('Error al actualizar el detalle de venta:', err.message);
      return res.status(500).send('Error al actualizar el detalle de venta');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Detalle de venta no encontrado');
    }
    res.json({ message: 'Detalle de venta actualizado exitosamente' });
  });
});

// Eliminar un detalle de venta (DELETE)
app.delete('/details_sales/:id_sale/:id_product', (req, res) => {
  const { id_sale, id_product } = req.params; // IDs del detalle de venta

  const query = `DELETE FROM \`Details_Sales\` WHERE id_sale = ? AND id_product = ?`;

  connection.query(query, [id_sale, id_product], (err, results) => {
    if (err) {
      console.error('Error al eliminar el detalle de venta:', err.message);
      return res.status(500).send('Error al eliminar el detalle de venta');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Detalle de venta no encontrado');
    }
    res.json({ message: 'Detalle de venta eliminado exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
