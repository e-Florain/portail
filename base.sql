USE cake_cms;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
);

CREATE TABLE adhs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adh_id INT NOT NULL,
    date_adh DATETIME NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    phonenumber VARCHAR(15) NOT NULL,
    asso_id INT NOT NULL,
    amount VARCHAR(255) NOT NULL,
    payment_type VARCHAR(255) NOT NULL,
    newsletter BOOLEAN DEFAULT FALSE,
    created DATETIME,
    modified DATETIME,
    INDEX par_ind (asso_id),
    FOREIGN KEY (asso_id)
        REFERENCES associations(id)
        ON DELETE CASCADE
) CHARSET=utf8mb4;

CREATE TABLE adhpros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adh_id INT NOT NULL,
    date_adh DATETIME NOT NULL,
    orga_name VARCHAR(255) NOT NULL,
    orga_contact VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    postcode VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    phonenumber VARCHAR(15) NOT NULL,
    asso VARCHAR(255) NOT NULL,
    amount VARCHAR(255) NOT NULL,
    payment_type VARCHAR(255) NOT NULL,
    invoice VARCHAR(255),
    newsletter BOOLEAN DEFAULT FALSE,
    annuaire BOOLEAN DEFAULT FALSE,
    created DATETIME,
    modified DATETIME
) CHARSET=utf8mb4;

CREATE TABLE asso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    activite VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
);

CREATE TABLE payment_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
);

CREATE TABLE child (
    id INT,
    parent_id INT,
    INDEX par_ind (parent_id),
    FOREIGN KEY (parent_id)
        REFERENCES parent(id)
        ON DELETE CASCADE
) ENGINE=INNODB;

INSERT INTO users (email, password, created, modified)
VALUES
('cakephp@example.com', 'secret', NOW(), NOW());

INSERT INTO articles (user_id, title, slug, body, published, created, modified)
VALUES
(1, 'First Post', 'first-post', 'This is the first post.', 1, NOW(), NOW());