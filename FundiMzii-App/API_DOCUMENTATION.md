# FundiMzii API Documentation

## Overview
This document describes the API endpoints available in the FundiMzii application. These endpoints handle client management, measurements, orders, and reporting.

## Base URL
```
http://localhost:8000
or
http://localhost/FundiMzii-App/public
```

## Clients Endpoints

### List All Clients
```
GET /clients
Response: HTML page with paginated client list
```

### Get Single Client
```
GET /clients/{id}
Response: HTML page with client details, measurements, and orders
```

### Create New Client
```
POST /clients
Parameters:
  - name (required, string)
  - phone_number (required, string, unique)
  - email (optional, string)
  - address (optional, string)
  - notes (optional, string)

Response: Redirect to /clients with success message
```

### Update Client
```
PUT /clients/{id}
Parameters:
  - name (required, string)
  - email (optional, string)
  - address (optional, string)
  - notes (optional, string)

Response: Redirect to /clients/{id} with success message
```

### Search Clients
```
GET /clients-search?search={query}
Parameters:
  - search (required, string): Search by name or phone number

Response: HTML with search results
```

## Measurements Endpoints

### Create Measurement
```
POST /clients/{client_id}/measurements
Parameters:
  - measurement_date (required, date)
  - chest (optional, decimal)
  - waist (optional, decimal)
  - hip (optional, decimal)
  - length (optional, decimal)
  - sleeve_length (optional, decimal)
  - shoulder_width (optional, decimal)
  - inseam (optional, decimal)
  - notes (optional, string)
  - photo (optional, file, max 2MB)

Response: Redirect to /clients/{client_id} with success message
```

### Update Measurement
```
PUT /measurements/{id}
Parameters: Same as Create Measurement
Response: Redirect to client profile with success message
```

### Delete Measurement
```
DELETE /measurements/{id}
Response: Redirect to client profile with success message
```

## Orders Endpoints

### Create Order
```
POST /clients/{client_id}/orders
Parameters:
  - description (required, string)
  - status (required, enum: pending, in_progress, completed, cancelled)
  - order_date (required, date)
  - due_date (optional, date)
  - amount (optional, decimal)
  - notes (optional, string)

Response: Redirect to /clients/{client_id} with success message
```

### Update Order
```
PUT /orders/{id}
Parameters: Same as Create Order
Response: Redirect to client profile with success message
```

### Delete Order
```
DELETE /orders/{id}
Response: Redirect to client profile with success message
```

## Reports Endpoints

### Dashboard
```
GET /dashboard
Response: HTML page with business statistics and recent activity

Returns:
  - totalClients: Count of all clients
  - totalOrders: Count of all orders
  - pendingOrders: Count of pending orders
  - completedOrders: Count of completed orders
  - totalMeasurements: Count of all measurements
  - recentClients: Last 5 registered clients
  - recentOrders: Last 10 orders
```

### Export Client Measurements PDF
```
GET /clients/{id}/export-pdf
Response: PDF file download with client's measurements history
Filename: {client_name}_measurements.pdf
```

## Response Codes

- **200 OK** - Request successful
- **302 Found** - Redirect (after POST/PUT/DELETE)
- **400 Bad Request** - Validation error
- **404 Not Found** - Resource not found
- **500 Internal Server Error** - Server error

## Validation Rules

### Client
- name: Required, max 255 characters
- phone_number: Required, unique
- email: Optional, valid email format
- address: Optional, string
- notes: Optional, text

### Measurement
- measurement_date: Required, valid date
- All measurements: Optional, numeric, decimal
- photo: Optional, image file, max 2MB

### Order
- description: Required, string
- status: Required, one of (pending, in_progress, completed, cancelled)
- order_date: Required, valid date
- due_date: Optional, date after or equal to order_date
- amount: Optional, numeric, minimum 0
- notes: Optional, text

## Error Messages

### Common Errors
- "The name field is required" - Client name not provided
- "The phone number has already been taken" - Phone number already registered
- "The email must be a valid email address" - Invalid email format
- "The measurement date field is required" - Date not provided
- "The due date must be a date after or equal to order date" - Invalid date range

## Offline Functionality

The application includes client-side JavaScript for offline support:
- Form submissions are queued when offline
- Data syncs automatically when connection restored
- localStorage is used for temporary storage

## Rate Limiting

No rate limiting is implemented in the local version. For production deployment, implement appropriate rate limiting.

## Authentication Note

This version does not include authentication/login. For production:
1. Add user authentication middleware
2. Implement role-based access control
3. Add audit logging for data changes
4. Encrypt sensitive data

## Database Design

### Relationships
- Client hasMany Measurements
- Client hasMany Orders
- Measurement belongsTo Client
- Order belongsTo Client

### Indexes
- clients.name
- clients.phone_number
- measurements.client_id
- measurements.measurement_date
- orders.client_id
- orders.status
- orders.order_date

## Sample Requests

### Create a Client
```
POST http://localhost:8000/clients
Content-Type: application/x-www-form-urlencoded

name=John+Doe&phone_number=254712345678&email=john@example.com&address=Nairobi
```

### Create a Measurement
```
POST http://localhost:8000/clients/1/measurements
Content-Type: application/x-www-form-urlencoded

measurement_date=2024-02-08&chest=95&waist=80&hip=98&notes=Regular+fitting
```

### Create an Order
```
POST http://localhost:8000/clients/1/orders
Content-Type: application/x-www-form-urlencoded

description=Men%27s+suit&status=pending&order_date=2024-02-08&due_date=2024-02-20&amount=5000
```

## Frontend JavaScript Functions

### Offline Storage
```javascript
offlineStorage.add(action, data)  // Queue data for sync
offlineStorage.get()              // Retrieve queued data
offlineStorage.clear()            // Clear queue
offlineStorage.isEmpty()          // Check if queue is empty
```

### Notifications
```javascript
showNotification(message, type)   // Show alert (info, success, warning, danger)
```

### Utilities
```javascript
formatCurrency(amount)     // Format number as KES currency
printPage()               // Print current page
exportData()              // Export data to JSON
syncOfflineData()         // Manually trigger sync
```

## Future API Enhancements

- [ ] RESTful JSON API
- [ ] Mobile app API endpoints
- [ ] GraphQL interface
- [ ] Webhook support for notifications
- [ ] OAuth2 authentication
- [ ] API versioning (v1, v2, etc.)
- [ ] Rate limiting and throttling
- [ ] CORS configuration for cross-origin access
