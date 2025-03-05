const express = require("express");
const router = express.Router();

const categories = [
  { id: 1, name: "General", link: "/catalog" },
];

router.get("/categories", (req, res) => {
  res.json(categories);
});

module.exports = router;
