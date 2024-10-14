CREATE TABLE users(
    Id int PRIMARY KEY AUTO_INCREMENT,
    Username varchar(55),
    Email varchar(55),
    Password varchar(255),
    is_admin TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE learn (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(55) NOT NULL,
    image MEDIUMBLOB NOT NULL,
    audio MEDIUMBLOB NOT NULL,
    page_value INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    question_text VARCHAR(255) NOT NULL,
    image MEDIUMBLOB,
    audio MEDIUMBLOB,    
    choice1 VARCHAR(55) NOT NULL,
    choice2 VARCHAR(55) NOT NULL,
    choice3 VARCHAR(55) NOT NULL,
    choice4 VARCHAR(55) NOT NULL,
    correct_choice INT NOT NULL, 
    stars_value INT CHECK (stars_value BETWEEN 1 AND 3)
);

/*UPDATE users SET is_admin = 1 WHERE Email = 'admin@gmail.com';

DROP TABLE table_name;

ALTER TABLE questions ADD stars_value INT(1) NOT NULL DEFAULT 1;