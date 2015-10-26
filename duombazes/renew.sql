UPDATE `books` SET authorID = 7 WHERE bookId = 7;

DELETE b
FROM `books` as b 
LEFT JOIN `authors` as a 
ON a.authorId = b.authorId
WHERE a.authorId IS NULL;

CREATE TABLE IF NOT EXISTS `Genres` (
`id` int(11) NOT NULL AUTO_INCREMENT,  
`name` varchar(100) COLLATE utf8_general_ci NOT NULL,  
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

INSERT INTO `Genres` (`name`) VALUES
('Unknown'),
('Triller'),
('Sci-fi');

ALTER TABLE `books` 
ADD COLUMN `genreId` int(11) DEFAULT 1;

UPDATE `books`
SET genreId = 3
WHERE title LIKE '%Edition%';

CREATE TABLE IF NOT EXISTS `author_books` (
`id` int(11) NOT NULL AUTO_INCREMENT,  
`authorId` int(11) DEFAULT NULL,
`bookId` int(11) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

INSERT INTO `author_books` (authorId, bookId)
SELECT a.authorId, b.bookId
FROM `books` as b
LEFT JOIN `authors` as a
ON b.authorId = a.authorId;

INSERT INTO `author_books` (authorId, bookId)
VALUES
(3, 5),
(5, 1);

ALTER TABLE `books` 
DROP COLUMN authorId;

ALTER TABLE `books`
CHARACTER SET utf8,
COLLATE utf8_general_ci;

ALTER TABLE `books`
CHANGE COLUMN title title varchar(255) 
CHARACTER SET utf8 COLLATE utf8_general_ci;