import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Carousel from './Components/Carousel';
import Navbar from './Components/Navbar';
import Footer from './Components/Footer';
import Logo from './Components/Logo';
import InformationNatuLove from './Components/InformationNatuLove';
import ProductsIndex from './Components/ProductsIndex';
import Catalog from './Catalog';
import Login from './Login';
import Cart from './Cart';
import Bill from './Bill';
import ClientRegister from './ClientRegister';
import Register from './Register';
import EternalFlower from './EternalFlower';

const HomePage = () => {
  return (
    
    <>
      <Logo />           
      <Router>
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
        </Routes>        
        </Router>
        <Carousel />
        <InformationNatuLove />
        <ProductsIndex />
        <Footer />
        </>
    
  );
};

export default HomePage;
