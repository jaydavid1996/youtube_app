-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2019 at 09:09 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youtube_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `youtube_channels`
--

CREATE TABLE `youtube_channels` (
  `id` int(11) NOT NULL,
  `channel_id` varchar(150) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descriptions` varchar(300) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `youtube_channels`
--

INSERT INTO `youtube_channels` (`id`, `channel_id`, `title`, `descriptions`, `photo`) VALUES
(1, 'UCWJ2lWNubArHWmf3FIHbfcQ', 'NBA', 'National Basketball Association.  Official home of the most compelling basketball action from the NBA', 'https://yt3.ggpht.com/a/AGF-l78U5c2H6ecI8vrMu9seGbF3K3fHJ7rtaU8n=s88-c-k-c0xffffffff-no-rj-mo');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_channel_videos`
--

CREATE TABLE `youtube_channel_videos` (
  `id` int(11) NOT NULL,
  `channel_id` varchar(150) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descriptions` varchar(300) NOT NULL,
  `thumbnails` varchar(250) NOT NULL,
  `video_id` varchar(150) NOT NULL,
  `playlist_id` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `youtube_channel_videos`
--

INSERT INTO `youtube_channel_videos` (`id`, `channel_id`, `title`, `descriptions`, `thumbnails`, `video_id`, `playlist_id`) VALUES
(1, 'UCWJ2lWNubArHWmf3FIHbfcQ', 'NBA&#39;s Best Between The Legs Assists  2018-19 NBA Season  #NBAAssistWeek', ' ', 'https://i.ytimg.com/vi/imLkGKt9dCE/mqdefault.jpg', 'imLkGKt9dCE', ''),
(51, 'UCWJ2lWNubArHWmf3FIHbfcQ', 'Best of 2019 NBA Finals', ' ', 'https://i.ytimg.com/vi/LMi7j68gecs/mqdefault.jpg', '', 'PLlVlyGVtvuVnu70yF1tnWQ373207auB1o');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `youtube_channels`
--
ALTER TABLE `youtube_channels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `channel_id` (`channel_id`);

--
-- Indexes for table `youtube_channel_videos`
--
ALTER TABLE `youtube_channel_videos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_id` (`video_id`),
  ADD UNIQUE KEY `playlist_id` (`playlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `youtube_channels`
--
ALTER TABLE `youtube_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `youtube_channel_videos`
--
ALTER TABLE `youtube_channel_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
