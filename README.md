# 🏗️ UNANDA BRICKS - Employee Management System

A modern, responsive Employee Management System built with PHP, MySQL, and Bootstrap. Designed specifically for **UNANDA BRICKS** - Building and Material Suppliers.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

## ✨ Features

### 🔐 **Dual Authentication System**
- **Admin Portal** - Complete management access
- **Employee Portal** - Task management and tracking

### 👥 **Employee Management**
- Add, edit, and delete employees
- View employee details and joining dates
- Professional employee profiles with avatars

### 📋 **Task Management**
- Assign tasks to employees
- Track task completion status
- Real-time task updates
- Task history and analytics

### 🎨 **Modern UI/UX**
- **Glass Morphism Design** with backdrop blur effects
- **Gradient Backgrounds** and smooth animations
- **Responsive Design** for all devices
- **Interactive Elements** with hover effects
- **Professional Branding** for UNANDA BRICKS

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 8.0 or higher
- Web server (Apache/Nginx) or PHP built-in server

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/unanda-bricks-ems.git
   cd unanda-bricks-ems
   ```

2. **Database Setup**
   ```bash
   # Import the database schema
   mysql -u root -p < employee_management.sql
   ```

3. **Configure Database Connection**
   - Update database credentials in `assets/backend/db_connection.php`
   - Set your MySQL username and password

4. **Start the Server**
   ```bash
   # Using PHP built-in server
   php -S localhost:8000
   
   # Or configure your web server to point to the project directory
   ```

5. **Access the Application**
   - **Admin Portal**: `http://localhost:8000/admin/`
   - **Employee Portal**: `http://localhost:8000/`

## 🔑 Default Login Credentials

### Admin Access
- **Email**: `admin@unandabricks.com`
- **Password**: `admin123`

### Employee Access
- Create employees through the admin panel
- Employees can login with their assigned credentials

## 📁 Project Structure

```
unanda-bricks-ems/
├── admin/                  # Admin panel files
│   ├── index.php          # Admin login
│   ├── home.php           # Admin dashboard
│   ├── addEmployee.php    # Add new employee
│   ├── addTask.php        # Assign tasks
│   └── updateEmployee.php # Edit employee details
├── assets/
│   ├── backend/           # PHP backend logic
│   │   ├── db_connection.php
│   │   ├── adminAuth.php
│   │   ├── employeeAuth.php
│   │   └── task.php
│   ├── css/
│   │   └── style.css      # Modern styling
│   └── logo.png           # Company logo
├── index.php              # Employee login
├── home.php               # Employee dashboard
├── employee_management.sql # Database schema
└── README.md
```

## 🎨 Design Features

- **Ultra-Modern Interface** with glass morphism effects
- **Gradient Animations** and smooth transitions
- **Responsive Grid System** using Bootstrap 5
- **Professional Color Scheme** with brand consistency
- **Interactive Elements** with hover animations
- **Mobile-First Design** for all screen sizes

## 🛠️ Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL 8.0
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5.2.3
- **Icons**: Font Awesome 6.4.0
- **Fonts**: Inter (Google Fonts)

## 📊 Database Schema

### Tables
- **admin** - Administrator accounts
- **employee** - Employee information
- **tasklist** - Task assignments and status

## 🔧 Configuration

### Database Connection
Update `assets/backend/db_connection.php` with your database credentials:

```php
$mysql_path = '"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe"';
$username = 'root';
$password = 'your_password';
$database = 'employee_management';
```

## 🚀 Deployment

### Local Development
```bash
php -S localhost:8000
```

### Production Deployment
1. Upload files to your web server
2. Configure database connection
3. Set proper file permissions
4. Configure web server (Apache/Nginx)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🏢 About UNANDA BRICKS

**UNANDA BRICKS** is a leading building and material supplier committed to providing quality construction materials and excellent service to our clients.

## 📞 Support

For support and inquiries, please contact:
- **Company**: UNANDA BRICKS
- **Business**: Building and Material Suppliers
- **System**: Employee Management Portal

---

**Built with ❤️ for UNANDA BRICKS**