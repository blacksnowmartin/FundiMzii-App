# FundiMzii - Web-Based Application for Recording Client Measurements for Tailors

A simple, affordable, offline-capable digital tool designed specifically for Kenyan tailors to capture, store, search, and retrieve client measurements and order history.

## Features

✅ **Simple Client Registration** - Bilingual forms (English/Swahili)  
✅ **Offline Data Capture** - Works without internet, syncs automatically  
✅ **Quick Search** - Find clients by name, phone number, or date  
✅ **Photo Attachment** - Attach reference photos of styles  
✅ **PDF Export** - Generate and share measurement sheets via WhatsApp or print  
✅ **Order Management** - Track pending, in-progress, and completed orders  
✅ **Business Reports** - View statistics: total clients, pending orders, measurements trends  
✅ **Touch-Friendly UI** - Minimal interface, learnable in under 10 minutes  

## Technology Stack

- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript
- **Backend**: PHP with Laravel 10
- **Database**: MySQL
- **Server**: Apache (via XAMPP)

## Installation & Setup

### Prerequisites

- XAMPP (Apache, MySQL, PHP) installed
- PHP 8.1 or higher
- Composer (for PHP dependencies)
- Node.js & npm (for frontend build tools - optional)

### Step 1: Download & Extract

```bash
# Navigate to XAMPP htdocs directory
cd C:\xampp\htdocs  # Windows
# or
cd /opt/lampp/htdocs  # Linux

# Clone or extract the FundiMzii-App folder
unzip FundiMzii-App.zip
cd FundiMzii-App
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies via Composer
composer install

# Copy .env file and generate app key
cp .env.example .env
php artisan key:generate
```

### Step 3: Database Setup

```bash
# Open XAMPP Control Panel and start Apache & MySQL

# Create database
mysql -u root -p
> CREATE DATABASE fundimzii;
> EXIT;

# Run migrations to create tables
php artisan migrate

# Optional: Seed sample data
php artisan db:seed
```

### Step 4: Configure Database Connection

Edit `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fundimzii
DB_USERNAME=root
DB_PASSWORD=
```

### Step 5: Start the Application

```bash
# Using built-in Laravel development server
php artisan serve

# Or access via XAMPP:
# http://localhost/FundiMzii-App/public
```

## Usage Guide

### Registering a New Client

1. Click **"+ New Client"** button
2. Fill in client information:
   - Full Name (required)
   - Phone Number (required)
   - Email (optional)
   - Address (optional)
   - Notes (optional)
3. Click **"Register Client"**

### Recording Measurements

1. Navigate to a client's profile
2. Click **"+ Add"** under Measurements section
3. Fill in measurement details (all in cm):
   - Chest, Waist, Hip
   - Length, Sleeve Length
   - Shoulder Width, Inseam
4. Optionally attach a reference photo
5. Click **"Record Measurement"**

### Managing Orders

1. On client profile, click **"+ Add"** under Orders
2. Enter order details:
   - Description of garment/service
   - Order date and due date
   - Status (Pending/In Progress/Completed/Cancelled)
   - Amount (in KES)
3. Click **"Create Order"**

### Searching for Clients

1. Use the search box at the top of Clients page
2. Search by:
   - Client name
   - Phone number
3. Click **"Search"**

### Generating Reports

1. Click **"Dashboard"** in navigation
2. View statistics:
   - Total number of clients
   - Order status breakdown
   - Recent clients and orders
   - System-wide metrics

### Exporting Measurements to PDF

1. Go to client profile
2. Click **"Export PDF"** button
3. A PDF file with all measurements will download
4. Share via WhatsApp or print directly

## Offline Mode

FundiMzii works in offline mode:

- When internet is unavailable, all changes are saved locally
- Data automatically syncs when connection is restored
- No data loss or service disruption

## File Structure

```
FundiMzii-App/
├── app/
│   ├── Http/Controllers/        # Application controllers
│   │   ├── ClientController.php
│   │   ├── MeasurementController.php
│   │   ├── OrderController.php
│   │   └── ReportController.php
│   ├── Models/                  # Database models
│   │   ├── Client.php
│   │   ├── Measurement.php
│   │   └── Order.php
├── database/
│   ├── migrations/              # Database schema
│   └── seeders/                 # Sample data
├── resources/views/             # Blade templates
│   ├── layout.blade.php        # Master layout
│   ├── clients/                # Client views
│   ├── measurements/           # Measurement views
│   ├── orders/                 # Order views
│   └── reports/                # Report views
├── public/
│   ├── css/style.css           # Custom styles
│   ├── js/app.js               # JavaScript functionality
│   └── img/                    # Images & photos storage
├── routes/web.php              # Application routes
├── config/database.php          # Database configuration
└── .env.example                # Environment template
```

## Database Schema

### Clients Table
```sql
- id: Auto-increment primary key
- name: Client full name
- phone_number: Unique phone number
- email: Optional email
- address: Optional address
- notes: Optional notes
- created_at, updated_at: Timestamps
```

### Measurements Table
```sql
- id: Auto-increment primary key
- client_id: Foreign key to clients
- chest, waist, hip, length, sleeve_length, shoulder_width, inseam: Decimal measurements
- notes: Optional notes
- measurement_date: Date of measurement
- photo_path: Optional photo path
- created_at, updated_at: Timestamps
```

### Orders Table
```sql
- id: Auto-increment primary key
- client_id: Foreign key to clients
- description: Order description
- status: pending, in_progress, completed, cancelled
- order_date: Date order was placed
- due_date: Expected completion date
- amount: Order amount in KES
- notes: Optional notes
- created_at, updated_at: Timestamps
```

## Troubleshooting

### Database Connection Error
- Ensure MySQL is running in XAMPP
- Check `.env` file has correct credentials
- Verify database exists: `mysql -u root -p` then `SHOW DATABASES;`

### Page Not Found (404)
- Make sure you're accessing `http://localhost:8000` (not just localhost)
- If using XAMPP, navigate to `http://localhost/FundiMzii-App/public`

### Cannot Upload Photos
- Create `storage/app/public/measurements` directory
- Run: `php artisan storage:link`
- Check folder permissions

### Forms Not Submitting
- Clear browser cache
- Check console for JavaScript errors (F12)
- Ensure offline storage is enabled in browser

## Future Enhancements

- [ ] Mobile app version (React Native/Flutter)
- [ ] WhatsApp integration for order notifications
- [ ] Multi-tailor accounts with permission levels
- [ ] Email reminders for due orders
- [ ] Inventory management for fabrics
- [ ] Payment integration (M-Pesa)
- [ ] Cloud backup and sync
- [ ] Swahili language full support

## Support & Contribution

For issues, questions, or suggestions:
1. Check this README first
2. Test with sample data
3. Clear browser cache and try again
4. Contact the development team

### Reporting Issues
- Describe what you were doing
- Include error messages from browser console
- Specify operating system and browser

## License

MIT License - FundiMzii 2024

## Acknowledgments

This project was developed as part of a research initiative to solve practical challenges faced by small-scale tailors in Kenya's informal economy. Built with input from over 35 professional tailors at Kariobangi North Market.

---

**Version**: 1.0.0  
**Last Updated**: February 2024  
**Status**: Active Development
