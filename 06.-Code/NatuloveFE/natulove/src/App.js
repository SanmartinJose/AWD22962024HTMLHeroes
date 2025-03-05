import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { AuthProvider } from './Context/AuthContext';
import { CartProvider } from './Context/CartContext';
import Navbar from './Components/navbar';
import Logo from './Components/logo';
import PrivateRoute from './Components/PrivateRoute';
import Footer from './Components/footer';
import AboutUs from './Pages/AboutUs';
import Catalog from './Pages/Catalog';
import Cart from './Pages/Cart';
import Login from './Pages/Login';
import Logout from './Pages/Logout';
import AdminDashboard from './Pages/AdminDashboard';
import Home from './Pages/Home';  // Asegúrate de importar Home

const App = () => {
    return (
        <Router>
            <AuthProvider>
                <CartProvider>
                    <Logo />
                    <Navbar />
                    <Routes>
                        <Route
                            path="/admin"
                            element={
                                <PrivateRoute role="Admin">
                                    <AdminDashboard />
                                </PrivateRoute>
                            }
                        />
                        <Route path="/" element={<Home />} />  {/* Cambiado a Home */}
                        <Route path="/about-us" element={<AboutUs />} />
                        <Route path="/catalog" element={<Catalog />} />
                        <Route path="/cart" element={<Cart />} />
                        <Route path="/login" element={<Login />} />
                        <Route path="/logout" element={<Logout />} />
                        <Route path="/admin" element={<AdminDashboard />} />
                    </Routes>
                    <Footer />
                </CartProvider>
            </AuthProvider>
        </Router>
    );
};

export default App;
