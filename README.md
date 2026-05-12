# Web Linh Phụ Kiện - E-Commerce Platform

Website bán phụ kiện kỹ thuật số được xây dựng bằng **Laravel 12** - một framework PHP hiện đại và mạnh mẽ.

## 📋 Mục Đích Dự Án

Dự án này là một nền tảng thương mại điện tử hoàn chỉnh cho việc bán các sản phẩm phụ kiện. Nó cung cấp các tính năng cho cả khách hàng và quản trị viên:

- **Cho khách hàng**: Duyệt sản phẩm, thêm vào giỏ hàng, đặt hàng, quản lý đơn hàng
- **Cho quản trị viên**: Quản lý sản phẩm, danh mục, xem đơn hàng

## 🛠️ Công Nghệ Sử Dụng

### Backend
- **Laravel 12** - Framework PHP
- **PHP 8.2+** - Ngôn ngữ lập trình
- **SQLite** - Cơ sở dữ liệu (mặc định)

### Frontend
- **Blade Template** - View engine của Laravel
- **Bootstrap 5** - CSS Framework (có thể tuỳ chọn)
- **Vite** - Build tool cho assets

### Dependencies chính
- Laravel Framework 12.0
- Laravel Tinker 2.10.1
- Faker PHP - Tạo dữ liệu giả
- PHPUnit - Testing Framework

## 📁 Cấu Trúc Thư Mục

```
web-linh-phu-kien/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controllers xử lý logic
│   │   │   ├── ProductController.php    # Sản phẩm
│   │   │   ├── CartController.php       # Giỏ hàng
│   │   │   └── AdminController.php      # Admin
│   │   └── Middleware/         # Middleware
│   ├── Models/                 # Eloquent Models
│   │   ├── Product.php         # Model Sản phẩm
│   │   ├── Category.php        # Model Danh mục
│   │   ├── Order.php           # Model Đơn hàng
│   │   ├── OrderItem.php       # Model Chi tiết đơn hàng
│   │   └── User.php            # Model Người dùng
│   └── Providers/              # Service Providers
├── config/                     # File cấu hình
├── database/
│   ├── migrations/             # Migrations tạo bảng
│   └── seeders/                # Seeders tạo dữ liệu
├── resources/
│   ├── views/                  # Blade templates
│   │   ├── admin/              # Admin views
│   │   ├── welcome.blade.php   # Trang chủ
│   │   ├── products.blade.php  # Danh sách sản phẩm
│   │   ├── cart.blade.php      # Giỏ hàng
│   │   ├── orders.blade.php    # Đơn hàng
│   │   └── ...
│   ├── css/                    # CSS files
│   └── js/                     # JavaScript files
├── routes/
│   ├── web.php                 # Web routes
│   └── console.php             # Console routes
├── storage/                    # File storage
├── tests/                      # Test files
├── public/                     # Public directory (web root)
├── .env.example               # Ví dụ file .env
├── composer.json              # Dependencies PHP
├── package.json               # Dependencies Node.js
├── vite.config.js             # Vite configuration
└── artisan                    # Laravel CLI

```

## 🗄️ Cơ Sở Dữ Liệu

### Các Bảng Chính

| Bảng | Mô Tả |
|------|--------|
| `users` | Thông tin người dùng (khách hàng & admin) |
| `products` | Sản phẩm bán trên website |
| `categories` | Danh mục sản phẩm |
| `orders` | Đơn hàng từ khách hàng |
| `order_items` | Chi tiết sản phẩm trong mỗi đơn hàng |
| `cache` | Bảng cache |
| `jobs` | Bảng queue jobs |

## 🚀 Hướng Dẫn Cài Đặt & Cấu Hình

### 1. Yêu Cầu Hệ Thống

- **PHP**: 8.2 trở lên
- **Composer**: Phiên bản mới nhất
- **Node.js & npm**: Để build frontend assets
- **SQLite**: (hoặc MySQL/PostgreSQL tuỳ chọn)

### 2. Clone Dự Án

```bash
# Clone từ git repository (nếu có)
git clone https://github.com/yourusername/web-linh-phu-kien.git
cd web-linh-phu-kien

# Hoặc sao chép thủ công vào thư mục
```

### 3. Tạo File Cấu Hình `.env`

```bash
# Copy file ví dụ thành .env
cp .env.example .env
```

**Hoặc chỉnh sửa nội dung .env:**

```env
APP_NAME="Web Linh Phụ Kiện"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database configuration (SQLite - mặc định)
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Hoặc nếu dùng MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=web-linh-phu-kien
# DB_USERNAME=root
# DB_PASSWORD=

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### 4. Cài Đặt Dependencies

#### PHP Dependencies:
```bash
composer install
```

#### Node.js Dependencies (cho frontend):
```bash
npm install
```

### 5. Khởi Tạo Ứng Dụng

#### Bước 1: Tạo Application Key
```bash
php artisan key:generate
```

#### Bước 2: Tạo Database File (nếu dùng SQLite)
```bash
touch database/database.sqlite
```

#### Bước 3: Chạy Database Migrations
```bash
php artisan migrate
```

#### Bước 4: (Tuỳ chọn) Seed dữ liệu giả
```bash
php artisan db:seed
```

#### Bước 5: Build Frontend Assets
```bash
npm run build
```

### 6. Khởi Động Server

#### Cách 1: Dùng Artisan Command
```bash
php artisan serve
```
Server sẽ chạy tại `http://localhost:8000`

#### Cách 2: Dùng XAMPP (hoặc WAMP/LAMP)
- Đặt thư mục vào `htdocs` (XAMPP) hoặc thư mục root tương ứng
- Trỏ Virtual Host đến thư mục `public`
- Cấu hình Virtual Host (Optional)

**Ví dụ cấu hình Apache (httpd-vhosts.conf):**
```apache
<VirtualHost *:80>
    ServerName linh-phu-kien.local
    DocumentRoot "D:/xampp/htdocs/web-linh-phu-kien/public"
    
    <Directory "D:/xampp/htdocs/web-linh-phu-kien/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## 📱 Tính Năng Chính

### Cho Khách Hàng (User)
- ✅ Xem danh sách sản phẩm
- ✅ Tìm kiếm & lọc sản phẩm theo danh mục
- ✅ Xem chi tiết sản phẩm
- ✅ Thêm/xóa sản phẩm vào giỏ hàng
- ✅ Cập nhật số lượng trong giỏ hàng
- ✅ Thanh toán & đặt hàng
- ✅ Xem lịch sử đơn hàng

### Cho Quản Trị Viên (Admin)
- ✅ Dashboard hiển thị thống kê
- ✅ Quản lý sản phẩm (Thêm, sửa, xóa)
- ✅ Quản lý danh mục sản phẩm
- ✅ Xem danh sách đơn hàng
- ✅ Quản lý người dùng

### Authentication
- ✅ Đăng ký tài khoản mới
- ✅ Đăng nhập
- ✅ Đăng xuất
- ✅ Phân quyền (User/Admin)

## 🔧 Các Lệnh Hữu Ích

### Development
```bash
# Xem hết các route
php artisan route:list

# Tạo migration mới
php artisan make:migration create_table_name

# Tạo model mới
php artisan make:model ModelName

# Tạo controller mới
php artisan make:controller ControllerName

# Chạy tests
php artisan test

# Xóa cache
php artisan cache:clear

# Clear tất cả cache
php artisan optimize:clear
```

### Production
```bash
# Optimize ứng dụng cho production
php artisan optimize

# Build assets tối ưu
npm run build

# Set maintenance mode
php artisan down
php artisan up
```

## 🗝️ Tài Khoản Mặc Định

Nếu chạy seeder, bạn sẽ có tài khoản:

| Vai trò | Email | Mật khẩu |
|--------|-------|---------|
| Admin | admin@example.com | password |
| User | bao@gmail.com | 12345678 |


## 📝 Cấu Trúc Routes

### Routes Công Khai
```
GET  /                      - Trang chủ / Danh sách sản phẩm
GET  /san-pham              - Danh sách sản phẩm
GET  /san-pham/{id}         - Chi tiết sản phẩm
GET  /cart                  - Xem giỏ hàng
POST /cart/add/{id}         - Thêm vào giỏ hàng
```

### Routes Yêu Cầu Authentication
```
GET  /dashboard             - Dashboard người dùng
GET  /don-hang              - Lịch sử đơn hàng
POST /checkout              - Thanh toán
```

### Routes Auth
```
GET  /dang-ky               - Trang đăng ký
POST /register              - Xử lý đăng ký
GET  /dang-nhap             - Trang đăng nhập
POST /login-action          - Xử lý đăng nhập
POST /logout                - Đăng xuất
```

### Routes Admin
```
GET  /admin                 - Dashboard admin
GET  /admin/san-pham        - Danh sách sản phẩm
GET  /admin/them-moi        - Form thêm sản phẩm
POST /admin/luu-san-pham    - Lưu sản phẩm
GET  /admin/sua/{id}        - Form chỉnh sửa
PUT  /admin/cap-nhat/{id}   - Cập nhật sản phẩm
```

## 🔐 Bảo Mật

- ✅ SQL Injection Prevention (sử dụng Eloquent ORM)
- ✅ CSRF Protection (tất cả POST/PUT/DELETE yêu cầu token)
- ✅ Password Hashing (bcrypt)
- ✅ Authentication & Authorization Middleware
- ✅ Input Validation

## 📊 Middleware

| Middleware | Mục Đích |
|-----------|---------|
| `auth` | Yêu cầu người dùng phải đăng nhập |
| `guest` | Chỉ cho phép người dùng chưa đăng nhập |
| `admin` | Chỉ cho phép admin access |
| `web` | Middleware mặc định cho web routes |

## 🐛 Troubleshooting

### Lỗi: "No application key has been generated"
```bash
php artisan key:generate
```

### Lỗi: "Class not found"
```bash
composer dump-autoload
```

### Lỗi: "Permission denied" trên storage
```bash
chmod -R 755 storage bootstrap/cache
```

### Lỗi: Trang không tìm thấy (404)
- Kiểm tra routes trong `routes/web.php`
- Clear route cache: `php artisan route:clear`
- Kiểm tra Virtual Host configuration

### Database không synchronize
```bash
# Reset migrations và seed lại
php artisan migrate:fresh --seed
```

## 📖 Tài Liệu & Liên Kết

- [Laravel Documentation](https://laravel.com/docs)
- [Blade Template Syntax](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Migrations](https://laravel.com/docs/migrations)

## 👥 Tác Giả & Liên Hệ

**Email**: nguyenquocbao6204@gmail.com

## 📄 License

MIT License - Xem file [LICENSE](LICENSE) để biết thêm chi tiết.

---

**Ghi Chú**: Đây là phiên bản development. Trước khi triển khai lên production, hãy đảm bảo:
- Đổi `APP_DEBUG=false` trong `.env`
- Cài đặt SSL/HTTPS
- Cấu hình Cơ sở dữ liệu Production
- Tối ưu hoá Performance
