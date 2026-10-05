CREATE DATABASE IF NOT EXISTS course_db; USE course_db;
CREATE TABLE students(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(100) UNIQUE NOT NULL,mobile VARCHAR(15) NOT NULL,password VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE courses(id INT AUTO_INCREMENT PRIMARY KEY,course_name VARCHAR(150) NOT NULL,description TEXT NOT NULL,duration VARCHAR(50) NOT NULL,fees DECIMAL(10,2) NOT NULL,image VARCHAR(255),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE registrations(id INT AUTO_INCREMENT PRIMARY KEY,student_id INT NOT NULL,course_id INT NOT NULL,registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(student_id) REFERENCES students(id) ON DELETE CASCADE,FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE);
CREATE TABLE payments(id INT AUTO_INCREMENT PRIMARY KEY,registration_id INT NOT NULL,student_id INT NOT NULL,course_id INT NOT NULL,amount DECIMAL(10,2) NOT NULL,payment_method VARCHAR(50) NOT NULL,transaction_id VARCHAR(100) UNIQUE NOT NULL,payment_status VARCHAR(30) DEFAULT 'PAID',payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(registration_id) REFERENCES registrations(id) ON DELETE CASCADE,FOREIGN KEY(student_id) REFERENCES students(id) ON DELETE CASCADE,FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE);
INSERT INTO courses(course_name,description,duration,fees,image) VALUES
('Web Development','HTML, CSS, JavaScript, PHP and MySQL','3 Months',5000,'web.jpg'),
('Python Programming','Python programming, automation and projects','2 Months',4000,'python.jpg'),
('Java Programming','Java and object oriented programming','3 Months',5500,'java.jpg'),
('Data Science','Data analytics and machine learning basics','4 Months',7000,'data-science.jpg'),
('Cloud Computing','Cloud concepts, AWS and deployment basics','3 Months',6500,'cloud.jpg'),
('Artificial Intelligence','AI and machine learning fundamentals','4 Months',8000,'ai.jpg');