import React from 'react';
import Navbar from './Components/Navbar';
import Footer from './Components/Footer';
import GranolaDescription from './Components/GranolaDescription';
// Componente Granola
const Granola = () => {
  return (
    <>
      <Navbar />
      <GranolaDescription />
      <Footer />
    </>
  );
};

export default Granola;