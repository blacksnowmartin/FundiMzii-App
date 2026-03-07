# Classic / Static Structure (UML diagrams)

classDiagram
    class Client {
        +int id
        +string name
        +string phone_number
        +string email
        +string address
        +text notes
        +measurements()
        +orders()
    }
    class Measurement {
        +int id
        +int client_id
        +decimal chest
        +decimal waist
        +decimal hip
        +decimal length
        +decimal sleeve_length
        +decimal shoulder_width
        +decimal inseam
        +date measurement_date
        +string photo_path
        +text notes
        +client()
    }
    class Order {
        +int id
        +int client_id
        +string description
        +enum status {pending, in_progress, completed, cancelled}
        +date order_date
        +date due_date
        +decimal amount
        +text notes
        +client()
    }
    Client "1" -- "0..*" Measurement : hasMany
    Client "1" -- "0..*" Order : hasMany
    Measurement "0..*" -- "1" Client : belongsTo
    Order "0..*" -- "1" Client : belongsTo

# Key Use-Case Sequences
 a. Creating a client

 sequenceDiagram
    participant User
    participant Browser
    participant ClientController
    participant ClientModel
    participant Database

    User->>Browser: GET /clients/create
    Browser->>ClientController: create()
    ClientController-->>Browser: render form
    User->>Browser: POST /clients (form data)
    Browser->>ClientController: store(request)
    ClientController->>ClientModel: Client::create(...)
    ClientModel->>Database: INSERT clients
    Database-->>ClientModel: success
    ClientController-->>Browser: redirect to /clients

 b. Recording a measurement

sequenceDiagram
    participant User
    participant Browser
    participant MeasurementController
    participant MeasurementModel
    participant ClientModel
    participant Storage
    participant Database

    User->>Browser: GET /clients/{id}/measurements/create
    Browser->>MeasurementController: create(client)
    MeasurementController-->>Browser: form with client data
    User->>Browser: POST measurement + photo
    Browser->>MeasurementController: store(...)
    MeasurementController->>Storage: save photo (optional)
    MeasurementController->>MeasurementModel: Measurement::create(...)
    MeasurementModel->>Database: INSERT measurements
    Database-->>MeasurementModel: ok
    MeasurementController-->>Browser: redirect to client.show

 c. Generating report (dashboard/pdf)

 sequenceDiagram
    participant User
    participant Browser
    participant ReportController
    participant ClientModel
    participant OrderModel
    participant MeasurementModel
    participant Database
    participant PDF

    User->>Browser: GET /reports/dashboard
    Browser->>ReportController: dashboard()
    ReportController->>Database: multiple COUNT/SELECT queries
    Database-->>ReportController: stats
    ReportController-->>Browser: render dashboard view

    User->>Browser: GET /reports/{client}/export-pdf
    Browser->>ReportController: exportPdf(client)
    ReportController->>ClientModel: load measurements
    ReportController->>PDF: loadHTML(...)
    PDF-->>ReportController: generated file
    ReportController-->>Browser: download response
