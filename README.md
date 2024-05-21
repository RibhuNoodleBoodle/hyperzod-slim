# Hyperzod Slim - Market Web App

Hyperzod Slim is a slim version of a market web application built with Laravel 9 and Vue.js. It allows users to browse and purchase products from nearby merchants, manage their cart, and track their orders in real-time.
I am currently not working on it anymore. I made this little project to learn and practice PHP/Laravel concepts. It is superincomplete and if you're looking into it, please understand I am still learning :)

## Features

- Products and Merchants Creation: Test data for products and merchants can be generated using seeders and Faker.
- Inventory Management: The application displays products' inventory status, indicating whether a product is in stock or out of stock.
- Nearby Merchant Search: Users can search for nearby merchants based on their location using GeoQuery on MySQL.
- Cart Functionality: Users can add products to their cart and proceed to checkout.
- Place Order: Users can place orders for selected products.
- Real-Time Order Status Updates: Order status updates are shown in real-time on the Order Tracking Screen.

## Technologies Used

- Laravel 9: The powerful PHP framework used for backend development.
- Vue.js: The progressive JavaScript framework used for frontend interactions.
- TailwindCSS: A utility-first CSS framework for styling the application.
- Laravel Mix: Asset compilation and build system for Laravel applications.
- MySQL: The relational database used for storing product, merchant, and order data.
- Docker: Containerization tool used to package the application and its dependencies.

## Getting Started

### Prerequisites

- Docker and Docker Compose should be installed on your system.

### Installation

1. Clone the repository:

```bash
git clone <repository_url>
cd hyperzod-slim
```

2. Build and run the Docker containers:

```bash
docker-compose up -d --build
```

3. Install PHP dependencies:

```bash
docker-compose exec app composer install
```

4. Install JavaScript dependencies:

```bash
docker-compose exec app npm install
```

5. Generate test data:

```bash
docker-compose exec app php artisan db:seed
```

6. Compile assets:

```bash
docker-compose exec app npm run dev
```

7. Access the application:

The application can be accessed at http://localhost:8000 in your web browser.

## Usage

- Browse the products and nearby merchants on the homepage.
- Use the search feature to find nearby merchants based on your location.
- Add products to your cart and proceed to checkout.
- Place an order for the selected products.
- Track your order status in real-time on the Order Tracking Screen.

## Contribution

Contributions are welcome! If you find any issues or want to add new features, feel free to submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgments

Special thanks to the contributors and the developers of Laravel, Vue.js, TailwindCSS, and Docker for their amazing tools and frameworks.
