CREATE TABLE users(
    Id int PRIMARY KEY AUTO_INCREMENT,
    Username varchar(55),
    Email varchar(55),
    Password varchar(255),
    verified BOOLEAN DEFAULT FALSE,
    verificationCode VARCHAR(6),
    isAdmin TINYINT(1) DEFAULT 0,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE learn (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(55) NOT NULL,
    imagePath VARCHAR(255) NOT NULL,   -- Path to image in /uploads/learn/images
    audioPath VARCHAR(255) NOT NULL,   -- Path to audio in /uploads/learn/audio
    pageValue INT NOT NULL,
    starsValue INT CHECK (starsValue BETWEEN 1 AND 3)
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
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE quiz_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    score INT NOT NULL,
    starsEarned INT NOT NULL,
    difficultyLevel ENUM('easy', 'average', 'hard'),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(Id)
);
CREATE TABLE badges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    requiredStars INT NOT NULL,
    imagePath VARCHAR(255) -- Path to badges in /uploads/badges
);

CREATE TABLE user_badges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    badgeId INT NOT NULL,
    isUnlocked BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (userId) REFERENCES users(Id) ON DELETE CASCADE,
    FOREIGN KEY (badgeId) REFERENCES badges(id) ON DELETE CASCADE
);

ALTER TABLE users ADD COLUMN totalStars INT DEFAULT 0;

CREATE TABLE daily_quiz_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    score INT NOT NULL,
    starsEarned INT NOT NULL,
    difficultyLevel ENUM('easy', 'average', 'hard'),
    date DATE NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(Id)
);

/*
UPDATE users SET isAdmin = 1 WHERE Email = 'earaltagalog@gmail.com';

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