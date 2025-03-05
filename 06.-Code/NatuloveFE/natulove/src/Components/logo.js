import React from 'react';
import logo from '../resources/img/logo1.png';

const Logo = () => {
    return (
        <div className="text-center my-3">
            <img src={logo} alt="Test Image" className="img-fluid" width="410" height="112" />
        </div>
    );
};

export default Logo;