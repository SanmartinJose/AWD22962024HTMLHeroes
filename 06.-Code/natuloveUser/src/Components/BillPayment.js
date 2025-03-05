import React, { useState } from 'react';
import './css/Bill.css';

const Bill = () => {
  const [formData, setFormData] = useState({
    fullName: '',
    email: '',
    address: '',
    city: '',
    state: '',
    zip: '',
    country: '',
    paymentMethod: '',
  });

  const [errors, setErrors] = useState({});

  const validateForm = () => {
    const newErrors = {};
    if (!formData.fullName.trim()) {
      newErrors.fullName = 'Full Name is required.';
    } else if (/[\d]/.test(formData.fullName)) {
      newErrors.fullName = 'Full Name cannot contain numbers.';
    }
    if (!formData.email.trim()) {
      newErrors.email = 'Email is required.';
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
      newErrors.email = 'Enter a valid email.';
    }
    if (!formData.address.trim()) newErrors.address = 'Address is required.';
    if (!formData.city.trim()) {
      newErrors.city = 'City is required.';
    } else if (/[\d]/.test(formData.city)) {
      newErrors.city = 'City cannot contain numbers.';
    }
    if (!formData.state.trim()) {
      newErrors.state = 'State is required.';
    } else if (/[\d]/.test(formData.state)) {
      newErrors.state = 'State cannot contain numbers.';
    }
    if (!formData.zip.trim()) {
      newErrors.zip = 'ZIP Code is required.';
    } else if (!/^\d{5}$/.test(formData.zip)) {
      newErrors.zip = 'ZIP Code must be a 5-digit number.';
    }
    if (!formData.country.trim()) {
      newErrors.country = 'Country is required.';
    } else if (/[\d]/.test(formData.country)) {
      newErrors.country = 'Country cannot contain numbers.';
    }
    if (!formData.paymentMethod.trim()) newErrors.paymentMethod = 'Payment Method is required.';
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData({ ...formData, [id]: value });
    setErrors({ ...errors, [id]: '' }); // Clear the error for this field
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (validateForm()) {
      alert('Form submitted successfully!');
      // Aquí puedes manejar el envío del formulario
    }
  };

  return (
    <div className="card p-4" style={{ maxWidth: '50em', margin: 'auto', marginTop: '2em' }}>
      <h2 className="card-title">Billing Information</h2>
      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label htmlFor="fullName" className="form-label">Full Name</label>
          <input
            type="text"
            className={`form-control ${errors.fullName ? 'is-invalid' : ''}`}
            id="fullName"
            placeholder="John Doe"
            value={formData.fullName}
            onChange={handleChange}
          />
          {errors.fullName && <div className="invalid-feedback">{errors.fullName}</div>}
        </div>
        <div className="mb-3">
          <label htmlFor="email" className="form-label">Email</label>
          <input
            type="email"
            className={`form-control ${errors.email ? 'is-invalid' : ''}`}
            id="email"
            placeholder="name@example.com"
            value={formData.email}
            onChange={handleChange}
          />
          {errors.email && <div className="invalid-feedback">{errors.email}</div>}
        </div>
        <div className="mb-3">
          <label htmlFor="address" className="form-label">Address</label>
          <input
            type="text"
            className={`form-control ${errors.address ? 'is-invalid' : ''}`}
            id="address"
            placeholder="123 Main St"
            value={formData.address}
            onChange={handleChange}
          />
          {errors.address && <div className="invalid-feedback">{errors.address}</div>}
        </div>
        <div className="mb-3">
          <label htmlFor="city" className="form-label">City</label>
          <input
            type="text"
            className={`form-control ${errors.city ? 'is-invalid' : ''}`}
            id="city"
            placeholder="Quito"
            value={formData.city}
            onChange={handleChange}
          />
          {errors.city && <div className="invalid-feedback">{errors.city}</div>}
        </div>
        <div className="mb-3">
          <label htmlFor="state" className="form-label">State</label>
          <input
            type="text"
            className={`form-control ${errors.state ? 'is-invalid' : ''}`}
            id="state"
            placeholder="Pichincha"
            value={formData.state}
            onChange={handleChange}
          />
          {errors.state && <div className="invalid-feedback">{errors.state}</div>}
        </div>
        <div className="mb-3">
          <label htmlFor="zip" className="form-label">ZIP Code</label>
          <input
            type="text"
            className={`form-control ${errors.zip ? 'is-invalid' : ''}`}
            id="zip"
            placeholder="170902"
            value={formData.zip}
            onChange={handleChange}
          />
          {errors.zip && <div className="invalid-feedback">{errors.zip}</div>}
        </div>
        <div className="mb-3">
          <label htmlFor="country" className="form-label">Country</label>
          <input
            type="text"
            className={`form-control ${errors.country ? 'is-invalid' : ''}`}
            id="country"
            placeholder="Ecuador"
            value={formData.country}
            onChange={handleChange}
          />
          {errors.country && <div className="invalid-feedback">{errors.country}</div>}
        </div>
        <div className="mb-3">
          <label htmlFor="paymentMethod" className="form-label">Payment Method</label>
          <select
            className={`form-control ${errors.paymentMethod ? 'is-invalid' : ''}`}
            id="paymentMethod"
            value={formData.paymentMethod}
            onChange={handleChange}
          >
            <option value="">Select a method</option>
            <option value="creditCard">Credit Card</option>
            <option value="debitCard">Debit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bankTransfer">Bank Transfer</option>
          </select>
          {errors.paymentMethod && <div className="invalid-feedback">{errors.paymentMethod}</div>}
        </div>
        <button type="submit" className="btn btn-primary btn-green">Pay</button>
      </form>
    </div>
  );
};

export default Bill;
