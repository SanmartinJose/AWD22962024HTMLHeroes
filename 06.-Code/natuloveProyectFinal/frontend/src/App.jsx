import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import Navbar from "./components/Navbar.jsx";
import Footer from "./components/Footer.jsx";
import Index from "./pages/Index.jsx";

import "bootstrap/dist/css/bootstrap.min.css";

function App() {
  return (
    <Router>
      <Navbar />
      <Routes>
        <Route path="/" element={<Index />} />
        {/* Otras rutas se pueden agregar aquí */}
      </Routes>
      <Footer />
    </Router>
  );
}

export default App;
