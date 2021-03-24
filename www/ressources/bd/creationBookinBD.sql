CREATE TABLE client(
	client_id CHAR(8) PRIMARY KEY NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	first_name VARCHAR(50) NOT NULL,
	mail VARCHAR(100) NOT NULL,
    psd VARCHAR(64) NOT NULL,
	birth_date DATE NOT NULL,
	profession VARCHAR(100) NOT NULL,
    sex CHAR(1) NOT NULL CHECK(sex IN('M','F')),
	client_money FLOAT NOT NULL
);

CREATE TABLE book(
	book_id CHAR(8) PRIMARY KEY NOT NULL,
	title VARCHAR(100) NOT NULL,
	author VARCHAR(100) NOT NULL,
	age_range VARCHAR(5) NOT NULL,
	number_pages INT NOT NULL,
	price FLOAT NOT NULL,
	quantity INT NOT NULL,
	book_image BLOB NOT NULL,
	category_name VARCHAR(20) NOT NULL REFERENCES category
);

CREATE TABLE category(
	category_name VARCHAR(20) NOT NULL PRIMARY KEY
);

CREATE TABLE administrator(
	admin_id CHAR(8) PRIMARY KEY NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	first_name VARCHAR(50) NOT NULL,
	mail VARCHAR(100) NOT NULL,
	psd VARCHAR(64) NOT NULL
);

CREATE TABLE likes(
	client_id CHAR(8) NOT NULL REFERENCES client,
    category_name VARCHAR(20) NOT NULL REFERENCES category,
    PRIMARY KEY(client_id, category_name)
);

CREATE TABLE buys(
	client_id CHAR(8) NOT NULL REFERENCES client,
    book_id CHAR(8) NOT NULL REFERENCES book,
    PRIMARY KEY(client_id, book_id),
	amount FLOAT NOT NULL
);

CREATE TABLE evaluates(
	client_id CHAR(8) NOT NULL REFERENCES client,
    book_id CHAR(8) NOT NULL REFERENCES book,
    PRIMARY KEY(client_id, book_id),
	satisfied BOOLEAN NOT NULL
);
