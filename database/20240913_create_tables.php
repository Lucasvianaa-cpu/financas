
CREATE DATABASE postgres;

-- Table for users
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for categories
CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    is_pay BOOLEAN NOT NULL DEFAULT FALSE,
    is_receive BOOLEAN NOT NULL DEFAULT FALSE,
    user_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table for expenses
CREATE TABLE expenses (
    id SERIAL PRIMARY KEY,
    description VARCHAR(50) NOT NULL,
    value DECIMAL(10, 2) NOT NULL,
    date_maturity DATE NOT NULL,
    status BOOLEAN NOT NULL DEFAULT FALSE, -- FALSE = pending, TRUE = paid
    category_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table for receives
CREATE TABLE receives (
    id SERIAL PRIMARY KEY,
    description VARCHAR(50) NOT NULL,
    value DECIMAL(10, 2) NOT NULL,
    date_receive DATE NOT NULL,
    status BOOLEAN NOT NULL DEFAULT FALSE, -- FALSE = pending, TRUE = receive
    is_recurring BOOLEAN NOT NULL DEFAULT FALSE, -- FALSE = no, TRUE = yes
    category_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table for credit cards
CREATE TABLE credit_cards (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    operator VARCHAR(50) NOT NULL,
    credit_limit DECIMAL(10, 2) NOT NULL,
    limit_utility DECIMAL(10, 2) DEFAULT 0,
    user_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table for shopping cards
CREATE TABLE shopping_cards (
    id SERIAL PRIMARY KEY,
    date_shopping DATE NOT NULL,
    value_total DECIMAL(10, 2) NOT NULL,
    description VARCHAR(100) NOT NULL,
    is_parcel BOOLEAN NOT NULL DEFAULT FALSE, -- FALSE = no, TRUE = yes
    parcel_number INTEGER,
    parcel_actual INTEGER,
    user_id INTEGER NOT NULL,
    credit_card_id INTEGER,  
    origin_parcel_id INTEGER,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (credit_card_id) REFERENCES credit_cards(id),
);
