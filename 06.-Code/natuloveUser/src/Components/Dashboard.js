import React from 'react';
import { Line, Bar } from 'react-chartjs-2';
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, ArcElement } from 'chart.js';

// Register required Chart.js components
ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
  ArcElement
);

const Dashboard = () => {
  // Monthly Earnings Data
  const earningsData = {
    labels: ['Previous Month', 'This Month'],
    datasets: [
      {
        label: 'Earnings in $',
        data: [22000, 25000],
        backgroundColor: ['#4caf50', '#2196f3'],
        borderColor: ['#388e3c', '#1976d2'],
        borderWidth: 1,
      },
    ],
  };

  // Products Data
  const productsData = {
    labels: ['Almonds', 'Pistachios', 'Raisins', 'Dark Chocolate', 'Milk Chocolate', 'White Chocolate'],
    datasets: [
      {
        label: 'Units Sold',
        data: [700, 450, 350, 600, 550, 50],
        backgroundColor: ['#ff9800', '#4caf50', '#f44336', '#2196f3', '#9c27b0', '#ffeb3b'],
        borderColor: ['#f57c00', '#388e3c', '#d32f2f', '#1976d2', '#7b1fa2', '#fbc02d'],
        borderWidth: 1,
      },
    ],
  };

  // Sales Trend Data (2024)
  const trendData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [
      {
        label: 'Sales in $',
        data: [12000, 15000, 18000, 14000, 16000, 19000, 22000, 24000, 20000, 21000, 23000, 25000],
        borderColor: '#2196f3',
        backgroundColor: 'rgba(33, 150, 243, 0.2)',
        borderWidth: 2,
        fill: true,
      },
    ],
  };

  return (
    <div className="container-fluid mt-5">
      <div className="row">
        {/* Sales Statistics */}
        <div className="col-lg-4 mb-4">
          <div className="card">
            <div className="card-header">
              <h4>Sales Statistics</h4>
            </div>
            <div className="card-body">
              <h5>Total Sales</h5>
              <p>$85,000</p>
              <h5>Clients Served</h5>
              <p>540</p>
            </div>
          </div>
        </div>

        {/* Monthly Earnings */}
        <div className="col-lg-4 mb-4">
          <div className="card">
            <div className="card-header">
              <h4>Monthly Earnings</h4>
            </div>
            <div className="card-body">
              <h5>This Month</h5>
              <p>$25,000</p>
              <h5>Previous Month</h5>
              <p>$22,000</p>

              {/* Bar chart for monthly earnings */}
              <Bar data={earningsData} options={{ responsive: true, scales: { y: { beginAtZero: true } } }} />
            </div>
          </div>
        </div>

        {/* Best and Worst Selling Products */}
        <div className="col-lg-4 mb-4">
          <div className="card">
            <div className="card-header">
              <h4>Best and Worst Selling Products</h4>
            </div>
            <div className="card-body">
              <h5>Best Seller</h5>
              <p>Almonds (700 units)</p>
              <h5>Worst Seller</h5>
              <p>White Chocolate (50 units)</p>

              {/* Bar chart for best and worst selling products */}
              <Bar data={productsData} options={{ responsive: true, scales: { y: { beginAtZero: true } } }} />
            </div>
          </div>
        </div>
      </div>

      {/* Sales Trend Chart */}
      <div className="row mt-4">
        <div className="col-12">
          <div className="card">
            <div className="card-header">
              <h4>Sales Trend Chart 2024</h4>
            </div>
            <div className="card-body">
              {/* Line chart for sales trend */}
              <Line data={trendData} options={{ responsive: true, plugins: { legend: { position: 'top' } }, scales: { y: { beginAtZero: true } } }} />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
