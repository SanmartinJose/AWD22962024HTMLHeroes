import React from 'react';
import Navbar from './Components/Navbar';
import Footer from './Components/Footer';
import { ProductsCart } from './Components/ProductsCart'; 


const Cart = () => {
  return (
    <>
      <Navbar />
      <center><h1 class="card title">Carrito de Compras</h1>
      <ProductsCart />
      <button class="btn btn-primary btn-green">Pagar</button></center>
      <Footer />
    </>
  );
};

export default Cart;
