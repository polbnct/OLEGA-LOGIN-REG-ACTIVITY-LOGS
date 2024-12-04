CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,  -- Primary key for authors
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL, 
    user_name VARCHAR(100) NOT NULL UNIQUE,      -- Name of the author
    age INT,  
    specialty VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP         -- Email address (must be unique)
);

CREATE TABLE user_accounts (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    password VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE activity_logs (
    activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
    operation VARCHAR(255),
    user_id INT,  -- Primary key for authors
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL, 
    user_name VARCHAR(100) NOT NULL,      -- Name of the author
    age INT,  
    specialty VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);