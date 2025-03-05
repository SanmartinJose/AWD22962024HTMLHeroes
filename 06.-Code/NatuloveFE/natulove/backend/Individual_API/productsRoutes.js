const express = require('express');
const connection = require('../db');
const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

/////////// TABLE: Products ///////////

// Obtener todos los productos
app.get('/products', (req, res) => {
  connection.query('SELECT * FROM `Products`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los productos');
    }
    res.json(results); // Devuelve los productos como JSON
  });
});

// Agregar un nuevo producto (POST)
app.post('/products', (req, res) => {
  const { id, name, category, description, images, inventory, price, reservable, status, weight, weight_unit } = req.body;

  const query = `INSERT INTO \`Products\` (id, name, category, description, images, inventory, price, reservable, status, weight, weight_unit) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`;

  connection.query(
    query,
    [id, name, category, description, JSON.stringify(images), inventory, price, reservable, status, weight, weight_unit],
    (err, results) => {
      if (err) {
        console.error('Error al agregar el producto:', err.message);
        return res.status(500).send('Error al agregar el producto');
      }
      res.status(201).json({ message: 'Producto agregado exitosamente', id: results.insertId });
    }
  );
});

// Actualizar un producto existente (PUT)
app.put('/products/:id', (req, res) => {
  const { id } = req.params; // ID del producto
  const { name, category, description, images, inventory, price, reservable, status, weight, weight_unit } = req.body;

  const query = `UPDATE \`Products\` 
                 SET name = ?, category = ?, description = ?, images = ?, inventory = ?, price = ?, reservable = ?, status = ?, weight = ?, weight_unit = ? 
                 WHERE id = ?`;

  connection.query(
    query,
    [name, category, description, JSON.stringify(images), inventory, price, reservable, status, weight, weight_unit, id],
    (err, results) => {
      if (err) {
        console.error('Error al actualizar el producto:', err.message);
        return res.status(500).send('Error al actualizar el producto');
      }
      if (results.affectedRows === 0) {
        return res.status(404).send('Producto no encontrado');
      }
      res.json({ message: 'Producto actualizado exitosamente' });
    }
  );
});

// Eliminar un producto (DELETE)
app.delete('/products/:id', (req, res) => {
  const { id } = req.params; // ID del producto

  const query = `DELETE FROM \`Products\` WHERE id = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar el producto:', err.message);
      return res.status(500).send('Error al eliminar el producto');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Producto no encontrado');
    }
    res.json({ message: 'Producto eliminado exitosamente' });
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
