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
import NewProduct from './NewProduct';
import Granola from './Granola';

const HomePage = () => {
  return (
    <>
      <Logo />
      <Router>
        <Navbar />
        <Routes>
          
          <Route path="/Cart" element={<Cart />} />
          <Route path="/Catalog" element={<Catalog />} />
          <Route path="/ClientRegister" element={<ClientRegister />} />
          <Route path="/Login" element={<Login />} />
          <Route path="/Bill" element={<Bill />} />
          <Route path="/Register" element={<Register />} />          
          <Route path="/EternalFlower" element={<EternalFlower />} />
          <Route path="/IndexPage" element={<IndexPage />} />
          <Route path="/NewProduct" element={<NewProduct />} />
          <Route path="/Granola" element={<Granola/>} />   
        </Routes>
        <Footer />
      </Router>
    </>
  );
};

export default HomePage;
