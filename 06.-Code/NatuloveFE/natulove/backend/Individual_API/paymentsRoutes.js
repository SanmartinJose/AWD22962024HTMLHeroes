const express = require('express');
const connection = require('../db');
const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Payment ///////////

// Obtener todos los pagos
app.get('/payments', (req, res) => {
  connection.query('SELECT * FROM `Payment`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los pagos');
    }
    res.json(results); // Devuelve los pagos como JSON
  });
});

// Agregar un nuevo pago (POST)
app.post('/payments', (req, res) => {
  const { id_payment, id_avoice, amount, payment_date, payment_method } = req.body;

  const query = `INSERT INTO \`Payment\` (id_payment, id_avoice, amount, payment_date, payment_method) 
                 VALUES (?, ?, ?, ?, ?)`;

  connection.query(query, [id_payment, id_avoice, amount, payment_date, payment_method], (err, results) => {
    if (err) {
      console.error('Error al agregar el pago:', err.message);
      return res.status(500).send('Error al agregar el pago');
    }
    res.status(201).json({ message: 'Pago agregado exitosamente', id: results.insertId });
  });
});

// Actualizar un pago existente (PUT)
app.put('/payments/:id', (req, res) => {
  const { id } = req.params; // ID del pago
  const { id_avoice, amount, payment_date, payment_method } = req.body;

  const query = `UPDATE \`Payment\` 
                 SET id_avoice = ?, amount = ?, payment_date = ?, payment_method = ? 
                 WHERE id_payment = ?`;

  connection.query(query, [id_avoice, amount, payment_date, payment_method, id], (err, results) => {
    if (err) {
      console.error('Error al actualizar el pago:', err.message);
      return res.status(500).send('Error al actualizar el pago');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Pago no encontrado');
    }
    res.json({ message: 'Pago actualizado exitosamente' });
  });
});

// Eliminar un pago (DELETE)
app.delete('/payments/:id', (req, res) => {
  const { id } = req.params; // ID del pago

  const query = `DELETE FROM \`Payment\` WHERE id_payment = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar el pago:', err.message);
      return res.status(500).send('Error al eliminar el pago');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Pago no encontrado');
    }
    res.json({ message: 'Pago eliminado exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
