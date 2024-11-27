import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Carousel from './Carousel';
import InformationNatuLove from './Components/InformationNatuLove';
import ProductsIndex from './Components/ProductsIndex';



const IndexPage = () => {
  return (
   
      <>
        
        <Carousel />
       <InformationNatuLove />
        <ProductsIndex />

      </>
   
  );
};

export default IndexPage;