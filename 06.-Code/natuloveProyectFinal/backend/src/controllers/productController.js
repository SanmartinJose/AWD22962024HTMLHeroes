const Product = require('../models/product');

exports.getProducts = (req, res) => {
    Product.getAllProducts((err, results) => {
        if (err) {
            res.status(500).json({ error: err.message });
        } else {
            res.json(results);
        }
    });
};
