-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2015 at 06:05 PM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ilennox_bookshelf`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Isobel Lennox'),
(8, 'new author'),
(9, 'Fred Benenson'),
(10, 'Jim Henson'),
(11, 'neat'),
(12, 'nelson'),
(13, 'catwoman'),
(14, 'Patrick Goodman'),
(15, 'Jordan M Ehrlich'),
(16, 'Larry Ullman'),
(17, 'Test Author'),
(18, 'new'),
(19, 'Veronica Roth'),
(20, 'Lois Lowry'),
(21, '2'),
(22, '4'),
(23, 'dfsdfsdf'),
(24, 'qwe'),
(25, 'ellen something'),
(26, 'Ellen Lupton'),
(27, 'William Cooper'),
(28, 'Lary Ullman'),
(29, 'Larry Niven'),
(30, 'Samisa Abeysinghe'),
(31, 'Todd Burpo (And his Mom)'),
(32, 'Todd Burpo'),
(33, 'Rick Sternbach and Michael Okuda');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(900) NOT NULL,
  `ISBN` varchar(20) NOT NULL COMMENT 'STRIP DASHES',
  `published` int(4) NOT NULL COMMENT 'YEAR',
  `uploaded_by` int(11) NOT NULL,
  `date_uploaded` varchar(60) NOT NULL,
  `file` varchar(99) NOT NULL,
  `author_id` int(11) NOT NULL,
  `color` varchar(11) NOT NULL COMMENT 'cover color class',
  `genre` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `ISBN`, `published`, `uploaded_by`, `date_uploaded`, `file`, `author_id`, `color`, `genre`) VALUES
(6, 'Canvas Student Guide', 'A guide to Canvas for Clark College Students.', '2', 2015, 2, 'March 11, 2015 a	 4:18pm', 'uploads/CanvasStudentGuide.pdf', 1, 'red', 0),
(25, 'Emoji Dick', ' Moby Dick in its entirety written in emoji.', '2147483647', 2010, 2, 'March 12, 2015 a	 4:16pm', 'uploads/emojidick7.pdf', 9, '', 0),
(28, 'Muppet City', 'The muppets at their finest. Join us on this adventure, but don''t bring your kids!', '523521', 2015, 2, 'March 12, 2015 a	 4:30pm', 'uploads/emojidick10.pdf', 10, 'gold', 0),
(33, 'Romulan Bird Of Prey', ' Itâ€™s unspoken but understood goal is the expansion of the Empire', '0', 2012, 3, 'March 15, 2015 a	 2:12am', 'uploads/Romulan_BoP_2150.pdf', 14, 'seagreen', 35),
(34, 'World Of Shawn', 'This is the story of a lonely kid who develops a computer game, using what little of quantum physics that he has read, that renders game levels from maps of any format; the result is just a little too realistic. When he tries to combine this "World of Shawn" with a favorite game of his childhood, "World of One," he soon finds Worlds colliding, to the detriment of his friends. Shawn must step up and rectify things, rescue the princess and save the World. \r\n', '1492714909', 2013, 5, 'March 15, 2015 a	 10:55pm', 'uploads/world-of-shawn.pdf', 15, 'red', 35),
(46, 'The Giver', 'The haunting story centers on twelve-year-old Jonas, who lives in a seemingly ideal, if colorless, world of conformity and contentment. Not until he is given his life assignment as the Receiver of Memory does he begin to understand the dark, complex secrets behind his fragile community. Lois Lowry has written three companion novels to The Giver, including Gathering Blue, Messenger, and Son.', '544336267', 1993, 5, 'March 16, 2015 a	 11:10pm', 'uploads/TheGiver.epub', 20, 'purple', 0),
(58, 'Behold a Pale Horse', 'Former U.S. Naval Intelligence Briefing Team Member reveals information kept secret by our government since the 1940s. UFOs, the J.F.K. assassination, the Secret Government, the war on drugs and more by the world''s leading expert on UFOs.', '0929385225', 1991, 3, 'March 18, 2015 a	 5:21pm', 'uploads/williamcooperbeholdapalehorse1991copy.pdf', 27, 'gold', 51),
(64, 'PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition)', 'Required reading for CTEC127: PHP and SQL', '0321784073', 2012, 3, 'March 18, 2015 a	 7:21pm', 'uploads/PHP.and.MySQL.for.Dynamic.Web.Sites.4th.Edition.pdf', 16, 'gold', 48),
(69, 'Ringworld', 'A new place is being built, a world of huge dimensions, encompassing millions of miles, stronger than any planet before it. There is gravity, and with high walls and its proximity to the sun, a livable new planet that is three million times the area of the Earth can be formed. We can start again!', '0345333926', 1970, 3, 'March 18, 2015 a	 7:56pm', 'uploads/Niven,LarryRingworld1Ringworld.pdf', 29, 'seagreen', 35),
(70, 'PHP Team Development', 'A core concept of the book is the idea of Agile Development. Samisa introduces the reader to the popular Model-View-Controller (MVC) pattern of development, and drives this model forward as an ideal framework for agile development styles.\r\n\r\nRather than delving into any coding, Samisa sticks to the fundamentals of the project as a whole: development cycles, use-case diagrams, and interaction with stakeholders and clients, while continually stressing and emphasizing agile development through diagrams and examples.\r\n\r\nIn fact, one could argue that the whole book could be used as a foundation for Web development as a whole. All of the concepts and processes within offer value to web development teams that use scripting languages.', '1847195067', 2009, 3, 'March 18, 2015 a	 8:11pm', 'uploads/PHPTeamDevelopment.pdf', 30, 'seagreen', 11),
(72, 'Heaven is for Reals', 'Todd''s four year old son went to heaven, and then he came back.', '0849946158', 2010, 7, 'March 18, 2015 a	 11:50pm', 'uploads/HeavenIsforRealToddBurpowithLynnVincent.epub', 32, 'purple', 26),
(73, 'Star Trek: The Next Generation Technical Manual', 'Join Chewbacca and Doctor Octopus as they share exclusive behind the scenes knowledge and factoids from the Star Wars Universe.  Great Scott!', '0671704273', 1991, 7, 'March 19, 2015 a	 12:03am', 'uploads/StarTrekTNGTechnicalManual.pdf', 33, 'purple', 33);

-- --------------------------------------------------------

--
-- Table structure for table `bookshelves`
--

CREATE TABLE IF NOT EXISTS `bookshelves` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookshelves`
--

INSERT INTO `bookshelves` (`user_id`, `book_id`, `id`) VALUES
(2, 25, 3),
(2, 6, 4),
(2, 33, 7),
(3, 34, 8),
(3, 33, 9),
(3, 70, 10),
(8, 69, 12);

-- --------------------------------------------------------

--
-- Table structure for table `books_viewed`
--

CREATE TABLE IF NOT EXISTS `books_viewed` (
  `book_id` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT 'to record history in reverse chronilogical order',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1 COMMENT='to show most read books';

--
-- Dumping data for table `books_viewed`
--

INSERT INTO `books_viewed` (`book_id`, `id`, `user_id`) VALUES
(6, 19, 3),
(6, 28, 3),
(25, 12, 3),
(25, 13, 3),
(25, 14, 3),
(25, 15, 3),
(25, 16, 3),
(25, 26, 3),
(25, 27, 3),
(25, 57, 3),
(25, 58, 3),
(25, 59, 3),
(25, 60, 3),
(25, 55, 5),
(25, 63, 7),
(28, 1, 2),
(28, 3, 2),
(28, 4, 2),
(28, 10, 2),
(28, 11, 2),
(28, 9, 3),
(28, 24, 3),
(33, 22, 3),
(33, 23, 3),
(33, 29, 3),
(33, 30, 3),
(33, 31, 3),
(33, 32, 3),
(33, 33, 3),
(33, 34, 3),
(33, 35, 3),
(33, 36, 3),
(33, 37, 3),
(33, 38, 3),
(33, 39, 3),
(33, 40, 3),
(33, 41, 3),
(33, 42, 3),
(33, 43, 3),
(33, 44, 3),
(33, 45, 3),
(33, 46, 3),
(33, 47, 3),
(33, 48, 3),
(33, 54, 3),
(33, 56, 3),
(34, 50, 3),
(34, 49, 5),
(46, 61, 3),
(46, 66, 3),
(72, 64, 3),
(72, 62, 7),
(73, 65, 3);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `book_id` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `comment` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`book_id`, `user_id`, `comment`, `datetime`, `id`) VALUES
(25, 7, 'This book stinks', 'March 19, 2015 11:37 AM', 1),
(33, 3, 'Does it have a coffee maker?', 'March 19, 2015 a	 5:52pm', 6),
(73, 3, 'Trololol', 'March 19, 2015 a	 7:41pm', 7),
(69, 8, 'this book is so good. the bbc adaptation as well as the graphic novel is also pretty dang decent.', 'March 20, 2015 a	 9:04pm', 8);

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE IF NOT EXISTS `following` (
  `you` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`you`, `following`, `id`) VALUES
(3, 4, 7),
(3, 5, 6),
(3, 2, 5),
(5, 3, 8),
(7, 3, 9),
(7, 5, 10),
(7, 4, 11),
(7, 2, 12),
(7, 7, 13),
(3, 7, 14),
(3, 3, 15),
(7, 8, 16);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Adventure'),
(2, 'Animals'),
(3, 'Art and Design'),
(4, 'Autobiography and Memior'),
(5, 'Biography'),
(6, 'Childrens'),
(7, 'Business and Finance'),
(8, 'Chick lit'),
(9, 'Classics'),
(10, 'Comics and Graphic Novels'),
(11, 'Computing'),
(12, 'Crafts and Hobbies'),
(13, 'Crime Fiction'),
(14, 'Fantasy'),
(15, 'Fiction'),
(16, 'Economics'),
(17, 'Film'),
(18, 'Food and Drink'),
(19, 'Humor'),
(20, 'Health'),
(21, 'Historical Fiction'),
(22, 'History'),
(23, 'Horror'),
(24, 'House and Garden'),
(25, 'Music'),
(26, 'Non-Fiction'),
(27, 'Philosophy'),
(28, 'Picture Books'),
(29, 'Poetry'),
(30, 'Politics'),
(31, 'Reference and Languages'),
(32, 'Religion'),
(33, 'Romance'),
(34, 'School'),
(35, 'Sci-Fi'),
(36, 'Science and Nature'),
(37, 'Short Stories'),
(38, 'Sports and Leisure'),
(39, 'Teen'),
(40, 'Travel guides'),
(41, 'Travel Writing'),
(42, 'Thrillers'),
(43, 'True Crime'),
(44, 'TV and Radio'),
(45, 'Vampires'),
(46, 'War'),
(48, 'Web Design and Development'),
(51, 'Mythology and Legend'),
(52, 'Mathematics'),
(53, 'Erotica');

-- --------------------------------------------------------

--
-- Table structure for table `pdf`
--

CREATE TABLE IF NOT EXISTS `pdf` (
  `id` int(11) NOT NULL,
  `file` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `user_id` int(7) NOT NULL,
  `book_id` int(7) NOT NULL,
  `rating` int(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`user_id`, `book_id`, `rating`, `id`) VALUES
(3, 64, 2, 26),
(3, 70, 2, 25),
(2, 34, 2, 24),
(3, 34, 5, 23),
(3, 73, 3, 27),
(3, 46, 4, 28),
(8, 69, 5, 29);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL COMMENT 'public',
  `email` varchar(60) NOT NULL COMMENT 'login',
  `password` varchar(60) NOT NULL,
  `is_admin` int(1) NOT NULL,
  `avatar` varchar(60) NOT NULL,
  `profile_content` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `avatar`, `profile_content`) VALUES
(2, 'admin', 'isolennox@gmail.com', '$2y$10$LYFdO2NLqxVBcF3cO8S8wOzdzdY/0YFdTiuQyaW0l0e0h6DyYRDVe', 0, '', ''),
(3, 'Chmod760', 'admin', '$2y$10$2nzmmdUGtuNv63kNhK/vX.uojB/FsWY0duS7smaROwDA6hwi3HWIe', 0, '', 'I can''t read.'),
(4, 'comet', 'perkinsrosemaryl@gmail.com', '$2y$10$E5/TGcMme9ZRsAtrbKolde0SH3.iSirM0KjAFiAPLq.UljqwGvHQW', 0, '', ''),
(5, 'SassyCassie', 'cascas2693@gmail.com', '$2y$10$1WP0hf/nkafD3wZGnHH4v.0EPHdEUUHAnqhj6UxI0tPlVfRivu68G', 0, '', ''),
(7, 'doobiebros69', 'crfaulconer@gmail.com', '$2y$10$CafcmqIRGFhwGjtDveQmqeOH8k9mLvBP8QkxQKlPcGQ9uPGsOp/6u', 0, '', ''),
(8, 'jp00p', 'asimovsghost@gmail.com', '$2y$10$SKRr9eX6tVy9ixWRizjyD.C7s0dDGMCfKmMox5xEm.pya5ugrAP/q', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookshelves`
--
ALTER TABLE `bookshelves`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `books_viewed`
--
ALTER TABLE `books_viewed`
  ADD PRIMARY KEY (`id`), ADD KEY `book_id` (`book_id`,`user_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `bookshelves`
--
ALTER TABLE `bookshelves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `books_viewed`
--
ALTER TABLE `books_viewed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'to record history in reverse chronilogical order',AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `following`
--
ALTER TABLE `following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `pdf`
--
ALTER TABLE `pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookshelves`
--
ALTER TABLE `bookshelves`
ADD CONSTRAINT `bookshelves_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `bookshelves_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books_viewed`
--
ALTER TABLE `books_viewed`
ADD CONSTRAINT `books_viewed_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `books_viewed_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
