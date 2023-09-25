DROP TABLE IF EXISTS Art_Genre;
DROP TABLE IF EXISTS Payment;
DROP TABLE IF EXISTS Transactions;
DROP TABLE IF EXISTS Arts;
DROP TABLE IF EXISTS Genre;
DROP TABLE IF EXISTS Seller;
DROP TABLE IF EXISTS Artist;
DROP TABLE IF EXISTS admins;


CREATE TABLE Artist (
  artistId INT NOT NULL AUTO_INCREMENT,
  CREATE TABLE Artist (
    artistId INT NOT NULL AUTO_INCREMENT,
    fName VARCHAR(100) NOT NULL,
    lName VARCHAR(100) NOT NULL,
    PRIMARY KEY (artistId)
  );

  CREATE TABLE Seller (
    sellerId INT NOT NULL AUTO_INCREMENT,
    fName VARCHAR(100) NOT NULL,
    lName VARCHAR(100) NOT NULL,
    email VARCHAR(254) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address TEXT,
    PRIMARY KEY (sellerId)
  );

  CREATE TABLE Genre (
    genreId INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (genreId)
  );

  CREATE TABLE Arts (
    artId INT NOT NULL AUTO_INCREMENT,
    artistId INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    image BLOB,
    price DOUBLE(10,2) NOT NULL,
    PRIMARY KEY (artId),
    FOREIGN KEY (artistId) REFERENCES Artist(artistId)
  );
  artistId INT NOT NULL,
  title VARCHAR(100) NOT NULL,
  description TEXT,
  image BLOB,
  price DOUBLE(10,2) NOT NULL,
  PRIMARY KEY (artId),
  FOREIGN KEY (artistId) REFERENCES Artist(artistId)
);

CREATE TABLE Art_Genre (
  artId INT NOT NULL,
  genreId INT NOT NULL,
  PRIMARY KEY (artId, genreId),
  FOREIGN KEY (artId) REFERENCES Arts(artId),
  FOREIGN KEY (genreId) REFERENCES Genre(genreId)
);

CREATE TABLE Payment (
  paymentId INT NOT NULL AUTO_INCREMENT,
  userId INT NOT NULL,
  artId INT NOT NULL,
  date DATE NOT NULL,
  cardNum VARCHAR(16) NOT NULL,
  cardName VARCHAR(30) NOT NULL,
  expDate DATE NOT NULL,
  CVV INT NOT NULL,
  PRIMARY KEY (paymentId),
  FOREIGN KEY (userId) REFERENCES Seller(sellerId),
  FOREIGN KEY (artId) REFERENCES Arts(artId)
);

CREATE TABLE Transactions (
  tranId INT NOT NULL AUTO_INCREMENT,
  userId INT NOT NULL,
  artId INT NOT NULL,
  type VARCHAR(30) NOT NULL,
  date DATE NOT NULL,
  amount DOUBLE(10,2) NOT NULL,
  PRIMARY KEY (tranId),
  FOREIGN KEY (userId) REFERENCES Seller(sellerId),
  FOREIGN KEY (artId) REFERENCES Arts(artId)
);

INSERT INTO admin (username, hashed_password)
VALUES
  ('asubedi', 'asubedi1'),
  ('adhakal', 'adhakal1'),
  ('Testuser', 'secret');


INSERT INTO Artist (fName,lName) VALUES ('Leonardo','da Vinci');
INSERT INTO Artist (fName,lName) VALUES ('Vincent','van Gogh');
INSERT INTO Artist (fName,lName) VALUES ('Salvador','Dali');
INSERT INTO Artist (fName,lName) VALUES ('Pablo','Picasso');
INSERT INTO Artist (fName,lName) VALUES ('Sandro','Botticelli');
INSERT INTO Artist (fName, lName) VALUES ('Claude', 'Monet');
INSERT INTO Artist (fName, lName) VALUES ('Edvard', 'Munch');
INSERT INTO Artist (fName, lName) VALUES ('Jackson', 'Pollock');
INSERT INTO Artist (fName,lName) VALUES ('Rembrandt','van Rijn');
INSERT INTO Artist (fName,lName) VALUES ('Michelangelo','Buonarroti');
INSERT INTO Artist (fName,lName) VALUES ('Raphael','Sanzio');
INSERT INTO Artist (fName,lName) VALUES ('Johannes','Vermeer');
INSERT INTO Artist (fName,lName) VALUES ('Gustav','Klimt');
INSERT INTO Artist (fName,lName) VALUES ('Henri','Matisse');
INSERT INTO Artist (fName,lName) VALUES ('Georges','Seurat');
INSERT INTO Artist (fName,lName) VALUES ('Wassily','Kandinsky');
INSERT INTO Artist (fName,lName) VALUES ('Edgar','Degas');
INSERT INTO Artist (fName,lName) VALUES ('Paul','Cézanne');


INSERT INTO Arts (artistId, title, description, image, price) VALUES (1, 'Mona Lisa', 'Famous portrait painting by Leonardo da Vinci', NULL, 678.99 );
INSERT INTO Arts (artistId, title, description, image, price) VALUES (2, 'The Starry Night', 'Famous landscape painting by Vincent van Gogh', NULL, 800.89);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (2, 'Van Gogh Self Portrait', 'Self Potrait by Vincent van Gogh', NULL, 600.99);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (3, 'The Persistence of Memory', 'Famous surrealist painting by Salvador Dali', NULL, 120.99);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (2, 'The potato Eaters', 'Bunch of people eating potatoes', NULL, 672.39);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (4, 'Les Demoiselles d''Avignon', 'Famous cubist painting by Pablo Picasso', NULL, 900.39);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (3, 'The Birth of Venus', 'Famous mythological painting by Sandro Botticelli', NULL, 110.49);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (6, 'Water Lilies', 'Famous series of impressionist paintings by Claude Monet', NULL, 750.69);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (2, 'The Scream', 'Famous expressionist painting by Edvard Munch', NULL, 50.89);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (2, 'Number 5, 1948', 'Famous abstract expressionist painting by Jackson Pollock', NULL, 140.99);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (1, 'The Last Supper', 'Famous mural painting by Leonardo da Vinci', NULL, 900.99);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (4, 'Guernica', 'Famous anti-war painting by Pablo Picasso', NULL, 970.49);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (5, 'Primavera', 'Famous mythological painting by Sandro Botticelli', NULL, 650.79);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (6, 'Impression, Sunrise', 'Famous impressionist painting by Claude Monet', NULL, 540.99);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (7, 'The Dance of Life', 'Famous expressionist painting by Edvard Munch', NULL, 210.99);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (8, 'Blue Poles', 'Famous abstract expressionist painting by Jackson Pollock', NULL, 1200.49);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (9, 'The Treachery of Images', 'Famous surrealist painting by Rene Magritte', NULL, 320.89);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (10, 'Campbell''s Soup Cans', 'Famous pop art painting by Andy Warhol', NULL, 1500.29);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (11, 'The Great Wave off Kanagawa', 'Famous Japanese woodblock print by Hokusai', NULL, 870.99);
INSERT INTO Arts (artistId, title, description, image, price) VALUES (12, 'Les Nymphéas', 'Famous series of impressionist paintings by Claude Monet', NULL, 980.49);

INSERT INTO Seller (fName, lName, email, password, address)
VALUES
  ('John', 'Doe', 'johndoe@example.com', 'password123', '123 Main St, Anytown USA'),
  ('Jane', 'Doe', 'janedoe@example.com', 'password456', '456 Elm St, Anytown USA'),
  ('Bob', 'Smith', 'bobsmith@example.com', 'password789', '789 Oak St, Anytown USA'),
  ('Alice', 'Johnson', 'alicejohnson@example.com', 'password101', '101 Maple St, Anytown USA'),
  ('David', 'Lee', 'davidlee@example.com', 'password202', '202 Pine St, Anytown USA'),
  ('Charlie', 'Brown', 'charliebrown@example.com', 'password303', '303 Cherry St, Anytown USA'),
  ('Lucy', 'Van Pelt', 'lucyvanpelt@example.com', 'password404', '404 Walnut St, Anytown USA'),
  ('Linus', 'Van Pelt', 'linusvanpelt@example.com', 'password505', '505 Chestnut St, Anytown USA');


INSERT INTO Payment (userId, artId, date, cardNum, cardName, expDate, CVV)
VALUES
  (1, 2, '2023-04-08', '1234567812345678', 'Bob Marley', '2025-04-01', 123),
  (2, 4, '2023-04-08', '2345678923456789', 'Joe Biden', '2025-05-01', 234),
  (3, 1, '2023-04-08', '3456789034567890', 'Daju Bhai', '2025-06-01', 345),
  (4, 5, '2023-04-08', '4567890145678901', 'Alu Khayo', '2025-07-01', 456),
  (5, 3, '2023-04-08', '5678901256789012', 'Hya Chup', '2025-08-01', 567),
  (6, 6, '2023-04-09', '6789012367890123', 'Pet Dukhyo', '2025-09-01', 678),
  (7, 2, '2023-04-09', '7890123478901234', 'Van Patel', '2025-10-01', 789),
  (8, 1, '2023-04-09', '8901234589012345', 'Pelt Hugan', '2025-11-01', 890);


-- to make sure that the price and transaction amount are same  
INSERT INTO Transactions (userId, artId, type, date, amount)
VALUES
  (1, 2, 'Sale', '2022-03-15', (SELECT price FROM Arts WHERE artId = 2)),
  (3, 4, 'Sale', '2022-03-16', (SELECT price FROM Arts WHERE artId = 4)),
  (2, 3, 'Sale', '2022-03-17', (SELECT price FROM Arts WHERE artId = 3)),
  (5, 1, 'Sale', '2022-03-18', (SELECT price FROM Arts WHERE artId = 1)),
  (4, 5, 'Sale', '2022-03-19', (SELECT price FROM Arts WHERE artId = 5)),
  (6, 6, 'Sale', '2022-03-20', (SELECT price FROM Arts WHERE artId = 6)),
  (7, 7, 'Sale', '2022-03-21', (SELECT price FROM Arts WHERE artId = 7)),
  (8, 8, 'Sale', '2022-03-22', (SELECT price FROM Arts WHERE artId = 8));



-- Insert into the Genre table
INSERT INTO Genre (name) VALUES ('Portrait');
INSERT INTO Genre (name) VALUES ('Landscape');
INSERT INTO Genre (name) VALUES ('Surrealism');
INSERT INTO Genre (name) VALUES ('Cubism');
INSERT INTO Genre (name) VALUES ('Mythology'); 
INSERT INTO Genre (name) VALUES ('Impressionism');
INSERT INTO Genre (name) VALUES ('Expressionism');
INSERT INTO Genre (name) VALUES ('Abstract Expressionism');  
INSERT INTO Genre (name) VALUES ('Realism');
INSERT INTO Genre (name) VALUES ('Pop Art');
INSERT INTO Genre (name) VALUES ('Photorealism');
INSERT INTO Genre (name) VALUES ('Fauvism');
INSERT INTO Genre (name) VALUES ('Minimalism');
INSERT INTO Genre (name) VALUES ('Op Art');
INSERT INTO Genre (name) VALUES ('Post-Impressionism');
INSERT INTO Genre (name) VALUES ('Conceptual Art');
INSERT INTO Genre (name) VALUES ('Street Art');
INSERT INTO Genre (name) VALUES ('Installation Art');


-- Insert into the Art_Genre table
INSERT INTO Art_Genre (artId, genreId) VALUES (1, 1);
INSERT INTO Art_Genre (artId, genreId) VALUES (2, 1);
INSERT INTO Art_Genre (artId, genreId) VALUES (3, 2);
INSERT INTO Art_Genre (artId, genreId) VALUES (4, 15);
INSERT INTO Art_Genre (artId, genreId) VALUES (5, 15);
INSERT INTO Art_Genre (artId, genreId) VALUES (5, 4);
INSERT INTO Art_Genre (artId, genreId) VALUES (6, 8); 
INSERT INTO Art_Genre (artId, genreId) VALUES (7, 10); 
INSERT INTO Art_Genre (artId, genreId) VALUES (8, 4);
INSERT INTO Art_Genre (artId, genreId) VALUES (9, 2);
INSERT INTO Art_Genre (artId, genreId) VALUES (10, 5);
INSERT INTO Art_Genre (artId, genreId) VALUES (10, 2);
INSERT INTO Art_Genre (artId, genreId) VALUES (11, 3);
INSERT INTO Art_Genre (artId, genreId) VALUES (12, 1);
INSERT INTO Art_Genre (artId, genreId) VALUES (8, 5);
INSERT INTO Art_Genre (artId, genreId) VALUES (9, 1);
INSERT INTO Art_Genre (artId, genreId) VALUES (4, 6);
INSERT INTO Art_Genre (artId, genreId) VALUES (5, 7);
INSERT INTO Art_Genre (artId, genreId) VALUES (9, 11);
INSERT INTO Art_Genre (artId, genreId) VALUES (10, 12);
INSERT INTO Art_Genre (artId, genreId) VALUES (1, 13);
INSERT INTO Art_Genre (artId, genreId) VALUES (3, 3);
INSERT INTO Art_Genre (artId, genreId) VALUES (11, 4);
INSERT INTO Art_Genre (artId, genreId) VALUES (12, 3);


-- Query 2)
-- query changed to display multiple rows
SELECT a.title, CONCAT(ar.fName, ' ' ,ar.lName) as artist
FROM Arts a
JOIN Artist ar ON a.artistId = ar.artistId
WHERE a.price > 200
AND a.artistId IN (
    SELECT artistId
    FROM Artist
    WHERE lName IN ('van Gogh', 'Picasso')
);




-- Query 3) 
SELECT 
  CONCAT(Artist.fName, ' ', Artist.lName) AS artist_name,
  GROUP_CONCAT(CONCAT(Seller.fName, ' ', Seller.lName) ORDER BY Seller.lName ASC SEPARATOR ', ') AS users
FROM Payment
JOIN Arts ON Payment.artId = Arts.artId
JOIN Artist ON Arts.artistId = Artist.artistId
JOIN Seller ON Payment.userId = Seller.sellerId
GROUP BY Artist.artistId, artist_name
ORDER BY Artist.lName ASC;


-- Query 1) 
SELECT 
  g.name AS genre_name,
  COUNT(a.artId) AS num_artworks,
  ROUND(AVG(a.price), 2) AS average_price
FROM Art_Genre ag
JOIN Genre g ON ag.genreId = g.genreId
JOIN Arts a ON ag.artId = a.artId
GROUP BY g.name
ORDER BY g.name;


-- Query 3)
SELECT CONCAT(Seller.lname, ' ', Seller.fname) AS seller, Transactions.date, SUM(Transactions.amount) AS total_amount
FROM Transactions
JOIN Seller ON Transactions.userId = Seller.sellerId
GROUP BY Transactions.userId, Transactions.date
ORDER BY Transactions.date, Seller.lname ASC;



-- Query test new (different from milestone3 had to edit to concatenate genre)
--This query retrieves a list of artworks along with their details, including art ID, title, artist name, description, price, and a comma-separated list of associated genres.
-- It combines data from the Art_Genre, Genre, Arts, and Artist tables using INNER JOINs, groups the results by artId, title, artist, description, and price, and sorts the results
-- in ascending order based on the artId.
SELECT a.artId, a.title, CONCAT(ar.fName, ' ', ar.lName) AS artist, a.description, a.price, 
    GROUP_CONCAT(DISTINCT g.name ORDER BY g.name SEPARATOR ',') AS genre
    FROM Art_Genre ag
    JOIN Genre g ON ag.genreId = g.genreId
    JOIN Arts a ON ag.artId = a.artId
    JOIN Artist ar ON a.artistId = ar.artistId
    GROUP BY a.artId, a.title, artist, a.description, a.price
    ORDER BY a.artId ASC;