CREATE DATABASE cutnfold;

CREATE TABLE admin (
    id INT NOT NULL AUTO_INCREMENT,
    fName VARCHAR(100) NOT NULL,
    lName VARCHAR(100) NOT NULL,
    uName VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    CONSTRAINT pk_admin PRIMARY KEY(id)
);

CREATE TABLE events (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    image_name VARCHAR(255) NOT NULL,
    CONSTRAINT pk_events PRIMARY KEY(id)
);

CREATE TABLE menus_types (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DECIMAL(11, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    CONSTRAINT pk_menus_types PRIMARY KEY(id)
);

CREATE TABLE extras_types (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DECIMAL(11, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    CONSTRAINT pk_extras_types PRIMARY KEY(id)
); 

CREATE TABLE payment_details (
    id INT NOT NULL AUTO_INCREMENT,
    extras_total DECIMAL(11, 2),
    menus_total DECIMAL(11, 2),
    total DECIMAL(11, 2) NOT NULL,
    minPayment DECIMAL(11, 2) NOT NULL,
    paid DECIMAL(11, 2) NOT NULL,
    balance DECIMAL(11, 2) NOT NULL,
    pay_method INT NOT NULL,
    status enum('Confirmed', 'Cancelled'),
    CONSTRAINT pk_payment_details PRIMARY KEY(id)
);

CREATE TABLE bookings (
    id INT NOT NULL,
    eventID INT,
    customer_name VARCHAR(200) NOT NULL,
    customer_contact_no VARCHAR(11) NOT NULL,
    customer_email VARCHAR(200) NOT NULL,
    status enum('Confirmed', 'Cancelled'),
    event_status enum('To Be Held', 'Finished'),
    transaction_status enum('Processing', 'Successful', 'Failed'),
    receiptID INT,
    CONSTRAINT pk_bookings PRIMARY KEY(id)
);

CREATE TABLE menus_bookings (
    type INT NOT NULL,
    bookingID INT NOT NULL,
    quantity INT NOT NULL,
    CONSTRAINT fk_book_menu FOREIGN KEY(bookingID) REFERENCES bookings(id),
    CONSTRAINT fk_type_menu FOREIGN KEY(type) REFERENCES menus_types(id)
);

CREATE TABLE extras_bookings (
    type INT NOT NULL,
    bookingID INT NOT NULL,
    quantity INT NOT NULL,
    CONSTRAINT fk_book_extras FOREIGN KEY(bookingID) REFERENCES bookings(id),
    CONSTRAINT fk_type_extras FOREIGN KEY(type) REFERENCES extras_types(id)
);

CREATE TABLE event_details (
    id INT NOT NULL,
    eventID INT,
    startTime VARCHAR(200) NOT NULL,
    endTime VARCHAR(200) NOT NULL,
    eventAddress VARCHAR(200) NOT NULL,
    event_type INT NOT NULL,
    CONSTRAINT fk_event_details FOREIGN KEY(event_type) REFERENCES events(id),
    CONSTRAINT pk_event_details PRIMARY KEY(id)
);