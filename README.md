# 📦 Courier Tracker

A web-based courier and shipment tracking system built with **Laravel**. This application allows users to track shipments and enables administrators to manage parcels, update statuses, and oversee logistics.

## ✨ Features

* **Public Tracking:** Customers can track parcels using a unique tracking ID.
* **Shipment Management:** Create, read, update, and delete shipment details.
* **Status Updates:** Real-time updates (e.g., "Pending", "In Transit", "Delivered").
* **Admin Dashboard:** Centralized panel for managing couriers and packages.
* **Responsive Design:** Optimized for desktop and mobile devices.

## 🛠 Tech Stack

* **Framework:** [Laravel](https://laravel.com) (PHP)
* **Frontend:** Blade Templates, Tailwind CSS / Bootstrap (Update based on your preference)
* **Database:** MySQL
* **Scripting:** JavaScript / jQuery

## 🚀 Installation & Setup

Follow these steps to set up the project locally:

### 1. Clone the Repository
```bash
git clone [https://github.com/0xChand/Courier-Tracker.git](https://github.com/0xChand/Courier-Tracker.git)
cd Courier-Tracker
2. Install Dependencies
Bash

composer install
npm install && npm run build
3. Environment Configuration
Rename the example environment file and configure your database details:

Bash

cp .env.example .env
Open the .env file and update your database credentials:

Ini, TOML

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=courier_db  # Make sure this database exists
DB_USERNAME=root
DB_PASSWORD=
4. Generate Application Key
Bash

php artisan key:generate
5. Run Migrations
Create the necessary database tables:

Bash

php artisan migrate
6. Start the Server
Bash

php artisan serve
Visit http://127.0.0.1:8000 in your browser.

📂 Project Structure
app/Models: Database models (e.g., Shipment, Courier).

app/Http/Controllers: Logic for handling tracking and admin actions.

routes/web.php: Application routes.

resources/views: Frontend Blade templates.

database/migrations: Database schema definitions.

🤝 Contributing
Contributions are welcome!

Fork the project.

Create your feature branch (git checkout -b feature/AmazingFeature).

Commit your changes (git commit -m 'Add some AmazingFeature').

Push to the branch (git push origin feature/AmazingFeature).

Open a Pull Request.

📄 License
This project is open-sourced software licensed under the MIT license.


### How to update this on GitHub:
Since you have the repository locally, you can just run this in your terminal:

1.  Open the `README.md` file in your code editor (VS Code, Notepad, etc.).
2.  Delete the existing text and paste the content above.
3.  Save the file.
4.  Run these commands to push the change:
    ```bash
    git add README.md
    git commit -m "Update README with project details"
    git push origin main
    ```
