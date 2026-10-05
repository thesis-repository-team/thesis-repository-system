# Digital Thesis Repository Platform

A web-based **Digital Thesis Repository Platform (DTRP)** developed for **Life University** to digitally store, manage, search, and access completed thesis documents.

## Overview
The system provides a centralized repository for Life University research documents, reducing dependence on physical thesis storage and making previous research easier to access.

## Features
* Search and filter theses
* View and download PDF documents
* Submit thesis publication requests
* Approve or reject thesis requests
* Bookmark and view document history
* Email verification
* Role-based access control
* Admin, Head of Department, Student, and Guest roles
* Thesis and system management

## User Roles
| Role                   | Main Functions                                                     |
| ---------------------- | ------------------------------------------------------------------ |
| **Admin**              | Manage users, departments, theses, and thesis publication requests |
| **Head of Department** | Manage and review theses within the department                     |
| **Student**            | Search, view, download theses, and submit publication requests      |
| **Guest**              | Search, view, and download published theses                        |

## Email Verification
Life University users register using their university email.
University email addresses (@lifeun.edu.kh) are identified as student accounts.
Students must verify their email via email before accessing the student dashboard.
Guest accounts do not require university email verification (optional).
Email notifications are used for relevant account and request activities.

## Upload Permission
Students do not automatically receive thesis upload permission by default.
Upload permission can be granted by an authorized administrator or Head of Department, particularly for authorized fourth-year thesis group/team representatives.

## Technologies
* **Laravel 13**
* **PHP 8.4**
* **MySQL**
* **Blade**
* **HTML / CSS / JavaScript**
* **Vite**
* **Laravel Breeze**

## .env File
```
APP_NAME="Thesis Repository"
APP_ENV=local
APP_KEY=base64:dN1x6zahTRj4zkKj09d0spDv9tS0setOKLeQPURtxZg=
APP_DEBUG=true
APP_URL=http://localhost
# APP_URL=http://10.68.126.125:8000

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database
# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thesis-repository-system
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER="smtp"
MAIL_SCHEME=null
# MAIL_HOST=sandbox.smtp.mailtrap.io
# MAIL_PORT=2525
# MAIL_USERNAME=  ## Your Mailtrap username
# MAIL_PASSWORD= ## Your Mailtrap password

MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=phailychhy@lifeun.edu.kh ## My Gmail username
# MAIL_PASSWORD=  ## Your Google Account password
MAIL_PASSWORD=  ## My Life University Google Account password
MAIL_FROM_ADDRESS=noreply@lifeun.edu.kh
MAIL_FROM_NAME="Life University Thesis Repository" 

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}" 
```

## Installation
```bash
git clone https://github.com/your-username/thesis-repository-system.git
cd thesis-repository-system

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan storage:link

npm run dev
php artisan serve
```
Configure the database and other settings in the `.env` file before running the application.

## Testing
The system was tested using:
* Functional testing
* Role-based testing
* Email verification testing
* k6 performance testing
Final k6 test:
```text
130 Virtual Users
7,080 HTTP Requests
Average: 51.84 ms
P95: 194.80 ms
Failure Rate: 0%
Checks: 100%
```

## Academic Project
* **Project:** Digital Thesis Repository Platform
* **Institution:** Life University
* **Program:** Computer Science
* **Methodology**: Software Development Life Cycle (SDLC) with Waterfall Model & Primary Data

### Development Team
* Phai Lychhy
* Chhin SreyPich
* Ol Poleak

## Thesis Documentation
The complete project thesis is available here:
[Download / View Thesis PDF](thesis.pdf)

## License
Developed for academic purposes as a final-year Computer Science project at Life University.
