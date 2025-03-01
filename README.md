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

If tests fail, ensure .env.testing contains:
php artisan config:clear
```

### **7 API Endpoints**
```sh
GET	/api/v1/products	List all products with pagination
GET	/api/v1/products/{id}	Get a specific product
POST	/api/v1/products	Create a new product
PUT	/api/v1/products/{id}	Update an existing product
DELETE	/api/v1/products/{id}	Delete a product

Categories
GET	/api/v1/categories	List categories in a nested structure
```