
# Laravel Mini ERP System

This is a Laravel 11-based Mini ERP system for managing **inventory and sales orders**.

## 🔧 Features

- Laravel 11 + MySQL + Breeze
- Role-based access using Spatie
- Product CRUD for Admin
- Sales Order creation for Salesperson
- PDF invoice generation (DomPDF)
- REST API secured with Laravel Sanctum

---

## 🔐 Default Login Credentials

| Role        | Email                  | Password |
|-------------|------------------------|----------|
| Admin       | admin@example.com      | password |
| Salesperson | salesperson@example.com| password |

---

## 🚀 Project Setup

```bash
# Clone the repo
git clone https://github.com/YadavAnju/mini-erp-system.git
cd mini-erp-system

# Install dependencies
composer install

# Copy .env and configure DB
cp .env.example .env
php artisan key:generate

# Update .env with your DB credentials, then run:
php artisan migrate --seed

# Start dev server
php artisan serve
```

---

## 📡 API Authentication & Usage

This project includes API support with **Laravel Sanctum**.

### Login to get API Token

```http
POST /api/login
```

**Body (JSON):**
```json
{
  "email": "salesperson@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "token": "1|abc123xyzTOKEN"
}
```

Use this token in all future requests:

```
Authorization: Bearer <token>
Accept: application/json
```

---

### API Endpoints

> All routes below require the Bearer Token in header.

#### ✅ List all products

```http
GET /api/products
```

Returns all product list.

#### ✅ Get Single Sales Order
```http
GET /api/sales-orders/{id}
```

Returns a specific order with its products and totals.

#### ✅ Create Sales Order

```http
POST /api/sales-orders
```

**Body:**
```json
{
  "products": [
    { "product_id": 1, "quantity": 2 },
    { "product_id": 3, "quantity": 1 }
  ]
}
```

**Response:**
```json
{
  "message": "Order created successfully",
  "order": {
    "id": 5,
    "order_number": "SO-XD93FJ",
    "total_amount": 1700,
    "items": [
      { "product": { "name": "Mouse" }, "quantity": 2, "line_total": 600 }
    ]
  }
}
```

---

## Sample `.env` Setup

```
APP_NAME=ERPSystem
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=erp_demo
DB_USERNAME=root
DB_PASSWORD=
```

---

## Stack

- Laravel 11
- MySQL
- Laravel Breeze (Auth UI)
- Spatie Permissions
- Sanctum API Auth
- DOMPDF (PDF invoice)
- Tailwind CSS (default Breeze layout)

---







