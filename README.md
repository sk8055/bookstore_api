# bookstore_api


The Bookstore API is a backend solution designed to facilitate the management of a virtual bookstore. It provides functionalities for browsing, purchasing, and managing books, along with seamless integration with Amazon for fetching book cover images.
# Features

<ul>
        <li> Book Listing: Browse through a wide range of books available in the bookstore.  </li>
        <li> Book Creation: Add new books to the bookstore inventory, including title, writer, cover image, price, and tags. </li>
        <li> Order Management: Place orders for books using points earned by users, with options to cancel orders. </li>
        <li> User Authentication: Authenticate users to ensure secure access to bookstore functionalities. </li>
        <li> Data Generation: Utilize Faker to generate dummy data for testing purposes, ensuring realistic scenarios. </li>
        <li> Pagination: Handle large datasets efficiently with pagination support. </li>
</ul>

# Technologies Used
Laravel: Backend framework providing robustness and scalability.
Faker: PHP library for generating fake data, facilitating testing.
Sanctum : For Authentication

# Installation
Clone the repository: <code>git clone https://github.com/your-username/bookstore-api.git </code>
Install dependencies: : <code> composer install </code>

# Set up environment variables:
<ul>
        <li>Copy the .env.example file and rename it to .env.</li>
        <li>Configure database and other environment variables in the .env file.</li>
</ul>

# Run migrations:
<ul>
        <li>php artisan migrate </li>
</ul>

# Serve the application:
<ul>
        <li>php artisan serve </li>
</ul>

# Usage

<h5>Use API endpoints to interact with the bookstore:</h5>
<ul>
        <li> GET /api/books: List all books. </li>
        <li> POST /api/books: Create a new book. </li>
        <li> GET /api/orders: List user orders. </li>
        <li> POST /api/orders: Place a new order. </li>
        <li> DELETE /api/orders/{id}: Cancel an order. </li
</ul>

# Contributing
Contributions are welcome! Feel free to submit issues or pull requests.

# License
This project is licensed under the MIT License.
