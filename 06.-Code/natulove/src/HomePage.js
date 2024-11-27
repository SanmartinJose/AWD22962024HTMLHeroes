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
<<<<<<< HEAD
        </Routes>        
        </Router>
        <Carousel />
        <InformationNatuLove />
        <ProductsIndex />
=======
          <Route path="/IndexPage" element={<IndexPage />} />
        </Routes>
>>>>>>> 3e44e9025eb36fcd2e7e6eb46ab73276fa9632c4
        <Footer />
        </>
    
  );
};

export default HomePage;
