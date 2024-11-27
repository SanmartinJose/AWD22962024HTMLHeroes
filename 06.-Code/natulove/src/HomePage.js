import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './Components/Navbar';
import Footer from './Components/Footer';
import Logo from './Components/Logo';
import Catalog from './Catalog';
import Login from './Login';
import Cart from './Cart';
import Bill from './Bill';
import ClientRegister from './ClientRegister';
import Register from './Register';
import EternalFlower from './EternalFlower';
import IndexPage from './IndexPage';

const HomePage = () => {
  return (
    <Router>
      <>
        <Logo />
        <Navbar />
        <Routes>
          <Route path="/HomePage" element={<HomePage />} />
          <Route path="/Cart" element={<Cart />} />
          <Route path="/Catalog" element={<Catalog />} />
          <Route path="/ClientRegister" element={<ClientRegister />} />
          <Route path="/Login" element={<Login />} />
          <Route path="/Bill" element={<Bill />} />
          <Route path="/Register" element={<Register />} />
          <Route path="/EternalFlower" element={<EternalFlower />} />
          <Route path="/IndexPage" element={<IndexPage />} />
        </Routes>
        <Footer />
      </>
    </Router>
  );
};

export default HomePage;
