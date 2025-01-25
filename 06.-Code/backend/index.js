const express = require('express');
const connection = require('./db');
const PDFDocument = require('pdfkit');
const fs = require('fs');
const app = express();
const PORT = 3000;

app.use(express.json());
/////////// TABLE: Avoices ///////////

// Obtener todas las facturas
app.get('/avoices', (req, res) => {
  connection.query('SELECT * FROM `Avoices`', (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener las facturas');
    }
    res.json(results); // Devuelve las facturas como JSON
  });
});

// Agregar una nueva factura (POST)
app.post('/avoices/post', (req, res) => {
  const { id_avoice, id_client, id_sale, issue_date, total_amount, payment_status, notification_sent } = req.body;

  const query = `INSERT INTO \`Avoices\` (id_avoice, id_client, id_sale, issue_date, total_amount, payment_status, notification_sent) 
                 VALUES (?, ?, ?, ?, ?, ?, ?)`;

  connection.query(query, [id_avoice, id_client, id_sale, issue_date, total_amount, payment_status, notification_sent], (err, results) => {
    if (err) {
      console.error('Error al agregar la factura:', err.message);
      return res.status(500).send('Error al agregar la factura');
    }
    res.status(201).json({ message: 'Factura agregada exitosamente', id: results.insertId });
  });
});

// Actualizar una factura existente (PUT)
app.put('/avoices/put/:id', (req, res) => {
  const { id } = req.params; // ID de la factura
  const { id_client, id_sale, issue_date, total_amount, payment_status, notification_sent } = req.body;

  const query = `UPDATE \`Avoices\` 
                 SET id_client = ?, id_sale = ?, issue_date = ?, total_amount = ?, payment_status = ?, notification_sent = ? 
                 WHERE id_avoice = ?`;

  connection.query(query, [id_client, id_sale, issue_date, total_amount, payment_status, notification_sent, id], (err, results) => {
    if (err) {
      console.error('Error al actualizar la factura:', err.message);
      return res.status(500).send('Error al actualizar la factura');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Factura no encontrada');
    }
    res.json({ message: 'Factura actualizada exitosamente' });
  });
});

// Eliminar una factura (DELETE)
app.delete('/avoices/delete/:id', (req, res) => {
  const { id } = req.params; // ID de la factura

  const query = `DELETE FROM \`Avoices\` WHERE id_avoice = ?`;

  connection.query(query, [id], (err, results) => {
    if (err) {
      console.error('Error al eliminar la factura:', err.message);
      return res.status(500).send('Error al eliminar la factura');
    }
    if (results.affectedRows === 0) {
      return res.status(404).send('Factura no encontrada');
    }
    res.json({ message: 'Factura eliminada exitosamente' });
  });
});




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
  app.post('/categories/post', (req, res) => {
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
  app.put('/categories/put/:id', (req, res) => {
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
  app.delete('/categories/delete/:id', (req, res) => {
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
app.post('/comentaries/post', (req, res) => {
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
app.put('/comentaries/put/:id', (req, res) => {
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
app.delete('/comentaries/delete/:id', (req, res) => {
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
app.post('/details_sales/post', (req, res) => {
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
app.put('/details_sales/put/:id_sale/:id_product', (req, res) => {
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
app.delete('/details_sales/delete/:id_sale/:id_product', (req, res) => {
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
app.post('/inventory/post', (req, res) => {
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
app.put('/inventory/put/:id', (req, res) => {
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
app.delete('/inventory/delete/:id', (req, res) => {
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
app.post('/payments/post', (req, res) => {
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
app.put('/payments/put/:id', (req, res) => {
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
app.delete('/payments/delete/:id', (req, res) => {
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
app.post('/products/post', (req, res) => {
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
app.put('/products/put/:id', (req, res) => {
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
app.delete('/products/delete/:id', (req, res) => {
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
app.post('/roles/post', (req, res) => {
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
app.put('/roles/put/:id', (req, res) => {
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
app.delete('/roles/delete/:id', (req, res) => {
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
app.post('/sales/post', (req, res) => {
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
app.put('/sales/put/:id', (req, res) => {
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
app.delete('/sales/delete/:id', (req, res) => {
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
app.post('/users/post', async (req, res) => {
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
app.put('/users/put/:id', async (req, res) => {
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
app.delete('/users/delete/:id', (req, res) => {
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



//View catalog
app.get('/products/catalog', (req, res) => {
  const category = req.query.category; // Se obtiene la categoría del query parameter

  if (!category) {
    return res.status(400).send('Por favor, proporciona una categoría.');
  }

  const query = 'SELECT * FROM `Products` WHERE `category` = ?'; // Consulta con filtro
  connection.query(query, [category], (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los productos');
    }

    res.json(results); // Devuelve los productos filtrados como JSON
  });
});


//Sum of sales
app.get('/sales/:year/:month', (req, res) => {
  const { year, month } = req.params; // Obtener año y mes desde la URI

  const salesQuery = `
    SELECT * 
    FROM \`Sales\`
    WHERE YEAR(sale_date) = ? AND MONTH(sale_date) = ?
  `;

  const totalQuery = `
    SELECT SUM(total_amount) AS total_earnings 
    FROM \`Sales\` 
    WHERE YEAR(sale_date) = ? AND MONTH(sale_date) = ?
  `;

  // Ejecutar ambas consultas en paralelo
  connection.query(salesQuery, [year, month], (err, salesResults) => {
    if (err) {
      console.error('Error al obtener las ventas:', err.message);
      return res.status(500).send('Error al obtener las ventas');
    }

    if (salesResults.length === 0) {
      return res.status(404).send('No se encontraron ventas para el mes especificado.');
    }

    // Ejecutar la consulta para obtener la suma total
    connection.query(totalQuery, [year, month], (err, totalResults) => {
      if (err) {
        console.error('Error al calcular las ganancias:', err.message);
        return res.status(500).send('Error al calcular las ganancias del mes');
      }

      const totalEarnings = totalResults[0].total_earnings || 0;

      // Respuesta con las ventas y la suma total
      res.json({
        totalEarnings,
        sales: salesResults,
      });
    });
  });
});



//Products sum
app.get('/details_sales/total/:id_sale', (req, res) => {
  const { id_sale } = req.params; // Obtener el ID de la venta desde la URI

  const query = `
    SELECT id_sale, SUM(subtotal) AS total_products
    FROM \`Details_Sales\`
    WHERE id_sale = ?
    GROUP BY id_sale
  `;

  connection.query(query, [id_sale], (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener la suma de los productos');
    }

    if (results.length === 0) {
      return res.status(404).send('No se encontraron detalles para el ID de venta especificado.');
    }

    // Devolver el ID de la venta y la suma total
    res.json({
      id_sale: results[0].id_sale,
      total_products: results[0].total_products
    });
  });
});



//Classify comments
app.get('/comentaries/rating/:rating', (req, res) => {
  const { rating } = req.params; // Obtener el rating desde la URI

  const query = `
    SELECT * 
    FROM \`comentary\` 
    WHERE rating = ?
  `;

  connection.query(query, [rating], (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los comentarios');
    }

    if (results.length === 0) {
      return res.status(404).json({ message: 'No se encontraron comentarios con ese rating' });
    }

    res.json(results); // Devuelve los comentarios filtrados por rating
  });
});



//Calculate age
app.get('/users/age/:age', (req, res) => {
  const { age } = req.params;

  // Validar que la edad sea un número
  if (isNaN(age)) {
    return res.status(400).send('La edad debe ser un número válido.');
  }

  const query = `
    SELECT * 
    FROM \`users\` 
    WHERE FLOOR(DATEDIFF(CURDATE(), birth_date) / 365.25) = ?`;

  connection.query(query, [age], (err, results) => {
    if (err) {
      console.error('Error al obtener los usuarios por edad:', err.message);
      return res.status(500).send('Error al obtener los usuarios por edad');
    }

    if (results.length === 0) {
      return res.status(404).send('No se encontraron usuarios con esa edad');
    }

    res.json(results);
  });
});



//Classify user
app.get('/users/role/:role', (req, res) => {
  const { role } = req.params;

  const query = 'SELECT * FROM `users` WHERE role = ?';

  connection.query(query, [role], (err, results) => {
    if (err) {
      console.error('Error al obtener los usuarios por rol:', err.message);
      return res.status(500).send('Error al obtener los usuarios por rol');
    }

    if (results.length === 0) {
      return res.status(404).send(`No se encontraron usuarios con el rol: ${role}`);
    }

    res.json(results);
  });
});



//Calculate IVA
app.get('/sales/with-tax', (req, res) => {
  const TAX_RATE = 0.15; // Define aquí el porcentaje de IVA (16% en este ejemplo)

  const query = 'SELECT id_sales, total_amount FROM `Sales`';

  connection.query(query, (err, results) => {
    if (err) {
      console.error('Error al obtener las ventas:', err.message);
      return res.status(500).send('Error al obtener las ventas');
    }

    if (results.length === 0) {
      return res.status(404).send('No se encontraron ventas');
    }

    // Calcular el IVA y el precio total con IVA para cada venta
    const salesWithTax = results.map((sale) => {
      // Asegurarse de que total_amount sea numérico
      const totalAmount = typeof sale.total_amount === 'number' ? sale.total_amount : parseFloat(sale.total_amount);

      if (isNaN(totalAmount)) {
        console.error(`El valor de total_amount no es válido para el id_sales ${sale.id_sales}`);
        return {
          id_sales: sale.id_sales,
          normal_value: "ERROR",
          tax_value: "ERROR",
          total_with_tax: "ERROR",
        };
      }

      const tax = totalAmount * TAX_RATE; // Calcula el IVA
      const totalWithTax = totalAmount + tax; // Total con IVA incluido

      return {
        id_sales: sale.id_sales,
        normal_value: totalAmount.toFixed(2), // Redondeado a 2 decimales
        tax_value: tax.toFixed(2), // Redondeado a 2 decimales
        total_with_tax: totalWithTax.toFixed(2) // Redondeado a 2 decimales
      };
    });

    res.json(salesWithTax);
  });
});


// Export to PDF
app.get('/export/:table', (req, res) => {
const tableName = req.params.table;

// Consulta la tabla especificada
connection.query(`SELECT * FROM \`${tableName}\``, (err, results) => {
  if (err) {
    console.error('Error al obtener los datos:', err.message);
    return res.status(500).send('Error al obtener los datos de la tabla');
  }

  if (results.length === 0) {
    return res.status(404).send('No se encontraron datos en la tabla');
  }

  // Crear un documento PDF
  const doc = new PDFDocument();
  const pdfPath = `./${tableName}_export.pdf`;

  // Guardar el PDF en un archivo temporal
  const writeStream = fs.createWriteStream(pdfPath);
  doc.pipe(writeStream);

  // Título del PDF
  doc.fontSize(18).text(`Exportación de la tabla: ${tableName}`, { align: 'center' });
  doc.moveDown();

  // Encabezados de la tabla
  const headers = Object.keys(results[0]);
  doc.fontSize(12).text(headers.join(' | '), { underline: true });
  doc.moveDown();

  // Datos de la tabla
  results.forEach((row) => {
    const values = headers.map((header) => row[header] ?? 'N/A'); // Valores de cada columna
    doc.text(values.join(' | '));
  });

  // Finalizar el documento PDF
  doc.end();

  // Cuando termine de guardar el PDF, envíalo al cliente
  writeStream.on('finish', () => {
    res.download(pdfPath, `${tableName}_export.pdf`, (err) => {
      if (err) {
        console.error('Error al enviar el PDF:', err.message);
        res.status(500).send('Error al enviar el archivo PDF');
      }

      // Eliminar el archivo después de enviarlo
      fs.unlinkSync(pdfPath);
    });
  });
});
});



//Classify state
app.get('/avoices/status/:payment_status', (req, res) => {
  const { payment_status } = req.params;

  const query = 'SELECT * FROM `Avoices` WHERE payment_status = ?';

  connection.query(query, [payment_status], (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener las facturas por estado de pago');
    }

    if (results.length === 0) {
      return res.status(404).send('No se encontraron facturas con el estado de pago especificado');
    }

    res.json(results); // Devuelve las facturas filtradas como JSON
  });
});



//Classify inventory
app.get('/inventory/user/:id_user', (req, res) => {
  const { id_user } = req.params;

  const query = 'SELECT * FROM `Inventory` WHERE id_user = ?';

  connection.query(query, [id_user], (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err.message);
      return res.status(500).send('Error al obtener los registros del inventario');
    }

    if (results.length === 0) {
      return res.status(404).send('No se encontraron registros del inventario para el usuario especificado');
    }

    res.json(results); // Devuelve los registros filtrados como JSON
  });
});


// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
