TABISH ENTERPRISES — XAMPP STARTER

REQUIREMENTS
- XAMPP with Apache, PHP and MySQL/MariaDB
- Modern web browser
- Internet connection for Bootstrap CDN (can be made local later)

INSTALLATION
1. Copy the tabish_enterprises folder into C:\xampp\htdocs\
2. Open XAMPP Control Panel and start Apache and MySQL.
3. Open http://localhost/phpmyadmin
4. Choose Import, select database.sql from this project folder, then click Import/Go.
5. Open http://localhost/tabish_enterprises/

DATABASE
Local default settings are in config/database.php (localhost, database tabish_enterprises, user root, blank password). If your MySQL root account has a password, update this file.

CURRENTLY INCLUDED
- Responsive home, about, services, service details, pricing and contact pages
- Services loaded dynamically from MySQL
- Contact enquiry form with validation, PDO prepared statement and CSRF token
- Shared header/footer and custom CSS
- Database tables for services, enquiries and admins

IMPORTANT NEXT STEP
The admin login/dashboard has not been implemented yet. Do not expose this project publicly until admin authentication, rate limiting, email/consent policies, HTTPS, production database credentials and deployment security are configured. The admins table is reserved for the next build step; no default admin password is created.

Before publishing, replace placeholder business contact information, verify all service claims and set actual pricing. Do not claim official marketplace partner status unless it is confirmed.
