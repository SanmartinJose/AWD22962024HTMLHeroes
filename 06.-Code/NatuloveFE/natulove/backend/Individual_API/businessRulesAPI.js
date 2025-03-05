const express = require('express');
const connection = require('../db');
const PDFDocument = require('pdfkit');
const fs = require('fs');
const app = express();
const PORT = 3000;


app.use(express.json());

//View catalog
app.get('/products', (req, res) => {
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
  


app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
