# IoT Water Level Monitor

A complete full-stack IoT project that monitors water levels in a container using an ESP32 and displays real-time data via a secure web interface built with PHP and MySQL. The system is designed for home or small business automation use cases.

---

## 🌐 Live Demo

🔗 [Try it live](https://www.selisar.com/portfolio/medidor)

> Username: `demo_user`  
> Password: `demo_pass`

---

## 🔩 How It Works

### 🧠 Hardware Side (Embedded IoT)
- Uses **ESP32 microcontroller**
- Detects water levels using **2N2222 transistors**
- Sends **HTTP POST** requests to a PHP endpoint when:
  - Water level changes are detected
  - 1 hour passes with no level change (used as a heartbeat signal)
- Data is saved to a **MySQL** database via backend API

### 💻 Software Side (Web Interface)
- Built with **PHP**, **HTML**, **CSS**, and **JavaScript**
- Authenticated user login to view tank status
- Displays:
  - Level as % and estimated liters
  - Online/offline status
  - Last water input time
  - Daily consumption
- Dynamic UI with **data visualization and responsive design**

![Dashboard Screenshot](https://github.com/eliastuzo/iot-water-level-monitor/assets/README-screenshot.png) <!-- Replace if image is hosted -->

---

## 🚀 Features

- Real-time IoT monitoring
- Secure database interaction using `.env`
- RESTful data ingestion via POST
- User authentication
- UI built from scratch with clean layout
- Designed for extensibility (multiple tank types)

---

## ⚙️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP, Composer
- **Database:** MySQL
- **Embedded:** ESP32 (C++)
- **Security:** [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) for managing credentials

---

## 📁 Folder Structure
```markdown
/Medidor/
├── php/
│ ├── conexion-db.php # DB connection logic
│ ├── inicio-sesion.php # User authentication
│ ├── .env # NOT COMMITTED - stores DB credentials
├── inicio/
│ ├── inicio.php # Main dashboard
│ ├── styles.css # UI styles
├── vendor/ # Composer dependencies (ignored)
├── img/ # UI Icons
├── index.php # Redirect entry
├── .gitignore
└── composer.json
```
---

## 🛠️ Installation & Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/eliastuzo/iot-water-level-monitor.git
   cd iot-water-level-monitor/php
2. Install dependencies:
   ```bash
   composer install
3. Create a .env file:
   ```ini
   DB_HOST=your_host
   DB_NAME=your_db_name
   DB_USER=your_db_user
   DB_PASS=your_db_password
5. Run a PHP local server:
   ```bash
   php -S localhost:8000 -t .
6. Access the site:
   http://localhost:8000/inicio.php
 
---

## 🧪 Demo Credentials

For evaluation purposes:
```makefile
Username: demo_user
Password: demo_pass
``` 
---

## Contribution

This project is part of a personal portfolio. If you're a recruiter, feel free to explore and reach out.
For suggestions, feel free to open an issue or fork and test on your own setup.

---

## 🪪 License

This project is released under the MIT License.
