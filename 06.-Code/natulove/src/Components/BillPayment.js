import React from 'react';
import './css/Bill.css';

const Bill = () => {
  return (
    <div className="card p-4 " style={{ maxWidth: '50em', margin: 'auto', marginTop: '2em' }}>
      <h2 className="card-title">Billing Information</h2>
      <form>
        <div className="mb-3">
          <label htmlFor="fullName" className="form-label">Full Name</label>
          <input type="text" className="form-control" id="fullName" placeholder="John Doe" />
        </div>
        <div className="mb-3">
          <label htmlFor="email" className="form-label">Email</label>
          <input type="email" className="form-control" id="email" placeholder="name@example.com" />
        </div>
        <div className="mb-3">
          <label htmlFor="address" className="form-label">Address</label>
          <input type="text" className="form-control" id="address" placeholder="123 Main St" />
        </div>
        <div className="mb-3">
          <label htmlFor="city" className="form-label">City</label>
          <input type="text" className="form-control" id="city" placeholder="Quito" />
        </div>
        <div className="mb-3">
          <label htmlFor="state" className="form-label">State</label>
          <input type="text" className="form-control" id="state" placeholder="Pichincha" />
        </div>
        <div className="mb-3">
          <label htmlFor="zip" className="form-label">ZIP Code</label>
          <input type="text" className="form-control" id="zip" placeholder="170902" />
        </div>
        <div className="mb-3">
          <label htmlFor="country" className="form-label">Country</label>
          <input type="text" className="form-control" id="country" placeholder="Ecuador" />
        </div>
        <div className="mb-3">
          <label htmlFor="paymentMethod" className="form-label">Payment Method</label>
          <select className="form-control" id="paymentMethod">
            <option value="creditCard">Credit Card</option>
            <option value="debitCard">Debit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bankTransfer">Bank Transfer</option>
          </select>
        </div>
        <button type="submit" className="btn btn-primary btn-green">Pay</button>
      </form>
    </div>
  );
};

export default Bill;
