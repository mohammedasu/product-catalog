## **Installation & Setup**

### **1 Clone the Repository**
```sh
git clone https://github.com/mohammedasu/product-catalog.git
cd product-catalog
```

### **2 Install Dependencies**
```sh
composer install
```

### **3 Configure Environment**
```sh
cp .env.example .env

Update .env
DB_CONNECTION=mysql
DB_DATABASE=product_catalog
DB_USERNAME=root
DB_PASSWORD=

For testing, configure SQLite in .env.testing:
DB_CONNECTION=sqlite
DB_DATABASE=:memory:

Uncomment 2 line from phpunit.xml file
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

### **4 Run Migrations & Seeders**
```sh
php artisan migrate --seed
```

### **5 Start the Server**
```sh
php artisan serve
```

### **6 Run Test**
```sh
php artisan test
php artisan test --filter=ProductTest
```
