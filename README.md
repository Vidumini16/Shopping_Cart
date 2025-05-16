# ShoppingCart

A simple PHP-based shopping cart application.

## Features

- User authentication (login/logout)
- Product listing
- Add/remove products to/from cart
- View cart and checkout

## Requirements

- PHP 7.x or higher
- MySQL
- Apache (recommended: XAMPP)

## Setup Instructions

1. **Clone or copy the project files** into your XAMPP `htdocs` directory:
   ```
   c:\xampp\htdocs\ShoppingCart
   ```

2. **Database Setup:**
   - Create a MySQL database (e.g., `shoppingcart`).
   - Import the provided SQL file (if available) to create tables and sample data.

3. **Configure Database Connection:**
   - Edit the database configuration file (commonly `config.php` or similar) with your MySQL credentials.

4. **Start Apache and MySQL** via XAMPP Control Panel.

5. **Access the application** in your browser:
   ```
   http://localhost/ShoppingCart/
   ```

## File Structure

- `login.php` - User login page
- `logout.php` - User logout script
- `register.php` - User registration (if available)
- `products.php` - Product listing
- `cart.php` - Shopping cart page
- `checkout.php` - Checkout process
- `config.php` - Database configuration
- `README.md` - Project documentation

## Notes

- Ensure sessions are enabled in your PHP configuration.
- Update file permissions as needed for your environment.

## License

This project is for educational purposes.
