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

