import React from 'react';
import Carousel from './Components/Carousel';
import Navbar from './Components/Navbar';
import Footer from './Components/Footer';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import ShoppingOptions from './ShoppingOptions';
import EternalFlower from './EternalFlower';
import Granola from './Granola';

// Componente HomePage
const Catalog = () => {
  return (
    <>
      
      
      <ShoppingOptions />
      <Routes>
          <Route path="/EnternalFlower" element={<EternalFlower />} />     
          <Route path="/Granola" element={<Granola/>} />       

        </Routes>
    </>
  );
};

export default Catalog;
