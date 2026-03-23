# POS & Inventory Management System

A comprehensive point-of-sale and inventory management solution designed for companies specializing in phone and accessory sales, along with device maintenance services.

## 🎯 Overview

This system streamlines retail operations by integrating three core functions:
- **Point of Sale (POS)** - Process sales transactions efficiently
- **Inventory Management** - Track stock levels in real-time
- **Service Tracking** - Monitor device maintenance progress and customer communications

Built to reduce operational errors, improve customer satisfaction, and provide data-driven insights for business growth.

## ✨ Features

### POS Module
- Quick product search and checkout
- Multiple payment methods support
- Receipt generation and printing
- Sales history and transaction logs
- Customer purchase tracking

### Inventory Management
- Real-time stock level monitoring
- Low-stock alerts and auto-reorder points
- Product categorization (phones, accessories, parts)
- Batch/serial number tracking
- Supplier management
- Stock adjustment and audit logs

### Service Tracking
- Device repair job intake and registration
- Maintenance status updates (received, diagnosing, waiting for parts, repaired, ready for pickup)
- Customer SMS/email notifications on status changes
- Technician assignment and workload tracking
- Service history and warranty management

### Reporting & Analytics
- Daily/weekly/monthly sales reports
- Inventory turnover analysis
- Top-selling products
- Service revenue breakdown
- Customer purchase behavior insights
- Exportable reports (PDF, Excel)

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | Laravel 10.x |
| Frontend | Vue.js 3.x |
| Styling | Tailwind CSS + Bootstrap 5 |
| Database | MySQL 8.x |
| Authentication | Laravel Sanctum |
| Real-time | Laravel Echo / Pusher |

## 📦 Installation

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL 8.x
- Git

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Mikuller/Pos-And-Inventory-Mgmt-System.git
   cd Pos-And-Inventory-Mgmt-System
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Update database credentials in `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pos_inventory_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   # or for development:
   npm run dev
   ```

8. **Start the application**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the system.

## 👥 Default Users

After seeding, you can log in with:
- **Admin**: `admin@company.com` / `password`
- **Cashier**: `cashier@company.com` / `password`
- **Technician**: `tech@company.com` / `password`

## 📁 Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Request handlers
│   │   └── Requests/        # Form requests
│   ├── Models/              # Eloquent models
│   └── Services/            # Business logic
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Sample data
├── resources/
│   ├── js/                  # Vue components
│   └── views/               # Blade templates
├── routes/
│   └── web.php              # Application routes
└── ...
```

## 🔐 Security Features

- Role-based access control (Admin, Manager, Cashier, Technician)
- CSRF protection
- SQL injection prevention via Eloquent ORM
- XSS protection
- Encrypted passwords using bcrypt
- Session management

## 📊 Key Metrics

The dashboard provides real-time insights on:
- Today's sales revenue
- Pending service jobs
- Low-stock items
- Customer wait times
- Technician workload

## 🚀 Future Enhancements

- Multi-branch support
- E-commerce integration
- Mobile app for customers
- Advanced analytics with charts
- Barcode scanner integration
- Payment gateway integration (Chapa, YeWetab)

## 📝 License

This project is proprietary software developed for client use.

## 👨‍💻 Author

**Myko** - Project Manager & Backend Engineer

---

*Built with Laravel & Vue.js for scalable retail operations management.*
