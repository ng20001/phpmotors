-- Writing SQL statements
-- Q.1
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) Values ('Tony', 'Stark', 'tony@starkent.com', ' IamironM@n', 'I am the real Ironman');

-- Q.2
UPDATE clients SET clientLevel = 3 WHERE clientFirstname = 'Tony' AND clientLastname = 'Stark';

-- Q.3
UPDATE inventory 
SET invDescription = Replace(invDescription, 'small interiors', 'spacious interior') 
WHERE invMake = 'GM' AND invModel = 'Hummer';

-- Q.4
SELECT i.invModel, c.classificationName
FROM inventory i
INNER JOIN carclassification c ON i.classificationId = c.classificationId
WHERE i.classificationId = 1;

-- Q.5
DELETE FROM inventory WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

-- Q.6
UPDATE inventory 
SET invImage = concat('/phpmotors', invImage), 
    invThumbnail = concat('/phpmotors', invThumbnail);