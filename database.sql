create database airbnb;
USE airbnb;
CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','traveler','host') NOT NULL,
    company_name VARCHAR(255) NULL
);
ALTER TABLE users DROP COLUMN company_name;
ALTER TABLE users ADD COLUMN status ENUM('active','banned') NOT NULL DEFAULT 'active';
CREATE TABLE rentals(
    id INT PRIMARY KEY AUTO_INCREMENT,
    host_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    city VARCHAR(255) NOT NULL,
    FOREIGN KEY (host_id) REFERENCES users(id)
);
ALTER TABLE rentals ADD COLUMN image VARCHAR(255);
CREATE TABLE reservations(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    rental_id INT NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL CHECK (check_out > check_in),
    status VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (rental_id) REFERENCES rentals(id)
);
CREATE TABLE reviews(
    id INT PRIMARY KEY AUTO_INCREMENT,
    rating INT NOT NULL,
    comment VARCHAR(255) NOT NULL,
    created_at DATE DEFAULT CURRENT_DATE,
    user_id INT NOT NULL,
    rental_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (rental_id) REFERENCES rentals(id)
);
CREATE TABLE favorites(
    user_id INT NOT NULL,
    rental_id INT NOT NULL,
    PRIMARY KEY (user_id , rental_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (rental_id) REFERENCES rentals(id)
)

SELECT * FROM rentals;