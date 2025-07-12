# Register Item API

This project is a Laravel-based RESTful API for registering classified ads (آگهی), designed with clean architecture principles.

## 🚀 Features

- **🧱 Repository and Service Layer Architecture**  
  Implements a layered structure that separates business logic (services) from data access (repositories), making the application easier to maintain, test, and extend.

- **🧾 Enum Attribute Handling**  
  The `type` field supports internal values (`for_sale`, `installment`, `loan`) and is automatically mapped to their Persian equivalents (e.g., `فروشی`, `قسطی`, `وام`) using accessors and mutators in the model.

- **🔍 Query Scopes for Filtering**  
  Custom Eloquent scopes like `scopeOfType()` allow filtering records based on the `type` field, making future filtering logic simple and expressive.

- **📦 Request Validation with Form Requests**  
  Uses Laravel Form Request classes to validate incoming data, with fully customized **Persian** error messages.

- **📘 API Documentation (Swagger/OpenAPI)**  
  Integrated with `L5-Swagger` to provide interactive and auto-generated documentation. Available at:  
  [http://your-domain.com/api/documentation](http://your-domain.com/api/documentation)

- **✅ Consistent JSON Responses**  
  All responses follow a unified structure:
  ```json
  {
    "status": "success" | "error",
    "message": "Custom message",
    "data": {...}
  }
