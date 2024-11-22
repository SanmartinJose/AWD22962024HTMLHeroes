import React from 'react';
import './css/Footer.css';

// Footer 
const Footer = () => {
    return (
      <footer className="footer bg-black text-light py-4">
        <div className="container">
          <div className="row">
            {/* Logo Section */}
            <div className="col-md-2 text-md-start">
              <img src="/img/Logo.png" alt="Develop Team Logo" className="ffooter-logo mb-3 img-fluid w-50" />
             
            </div>
            {/* Navigation Links */}
            <div className="col-md-3 text-center">
              <h5 className="text-uppercase mb-3">Quick Links</h5>
              <ul className="list-unstyled ">
                <li><a href="/" className="footer-link text-decoration-none text-white">Home</a></li>
                <li><a href="/about" className="footer-link text-decoration-none text-white">About Us</a></li>
                <li><a href="/products" className="footer-link text-decoration-none text-white">Products</a></li>
                <li><a href="/contact" className="footer-link text-decoration-none text-white">Contact</a></li>
              </ul>
            </div>
            {/* Contact Info */}
            <div className="col-md-6  text-md-end">
              <h5 className="text-uppercase mb-3">Contact Us</h5>
              <ul className="list-unstyled">
                <li>Email: <a href="mailto:support@natulove.com" className="footer-link">support@natulove.com</a></li>
                <li>Phone: +593 992536817</li>
                <li>Address: San Carlos, Quito , Ecuador</li>
              </ul>
            </div>
          </div>
          <div className="text-center mt-4">
            <small>&copy; 2024 Natulove. All Rights Reserved.</small>
          </div>
        </div>
      </footer>
    );
  };
  
  export default Footer;