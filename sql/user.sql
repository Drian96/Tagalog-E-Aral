CREATE TABLE users(
    Id int PRIMARY KEY AUTO_INCREMENT,
    Username varchar(55),
    Email varchar(55),
    Password varchar(255),
    isAdmin TINYINT(1) DEFAULT 0,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE learn (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(55) NOT NULL,
    imagePath VARCHAR(255) NOT NULL,   -- Path to image in /uploads/learn/images
    audioPath VARCHAR(255) NOT NULL,   -- Path to audio in /uploads/learn/audio
    pageValue INT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    questionText VARCHAR(255) NOT NULL,
    imagePath VARCHAR(255),            -- Path to image in /uploads/questions/images
    audioPath VARCHAR(255),            -- Path to audio in /uploads/questions/audio  
    choice1 VARCHAR(55) NOT NULL,
    choice2 VARCHAR(55) NOT NULL,
    choice3 VARCHAR(55) NOT NULL,
    correctChoice INT NOT NULL, 
    starsValue INT CHECK (starsValue BETWEEN 1 AND 3)
);

/*UPDATE users SET is_admin = 1 WHERE Email = 'admin@gmail.com';

DROP TABLE table_name;

ALTER TABLE questions ADD stars_value INT(1) NOT NULL DEFAULT 1;


/*old
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
*/