SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `node_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `name`, `email_id`, `password`, `status`, `created_at`) VALUES
(1, 'Admin', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2017-12-28 06:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `livehelp_chats`
--

CREATE TABLE `livehelp_chats` (
  `id` bigint(20) NOT NULL,
  `hash` varchar(36) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `refresh` datetime DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `server` text COLLATE utf8_unicode_ci NOT NULL,
  `department` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `ipaddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `useragent` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `resolution` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `referrer` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `livehelp_messages`
--

CREATE TABLE `livehelp_messages` (
  `id` bigint(20) NOT NULL,
  `chat` bigint(20) NOT NULL DEFAULT '0',
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `align` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `livehelp_operatormessages`
--

CREATE TABLE `livehelp_operatormessages` (
  `id` bigint(20) NOT NULL,
  `from` bigint(20) NOT NULL DEFAULT '0',
  `to` bigint(20) NOT NULL DEFAULT '0',
  `datetime` datetime DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `align` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livehelp_requests`
--

CREATE TABLE `livehelp_requests` (
  `id` bigint(20) NOT NULL,
  `ipaddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `useragent` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `resolution` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `request` datetime DEFAULT NULL,
  `refresh` datetime DEFAULT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `referrer` text COLLATE utf8_unicode_ci NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `initiate` bigint(20) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for table `livehelp_chats`
--
ALTER TABLE `livehelp_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livehelp_messages`
--
ALTER TABLE `livehelp_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat` (`chat`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `livehelp_operatormessages`
--
ALTER TABLE `livehelp_operatormessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livehelp_requests`
--
ALTER TABLE `livehelp_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `livehelp_chats`
--
ALTER TABLE `livehelp_chats`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `livehelp_messages`
--
ALTER TABLE `livehelp_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `livehelp_operatormessages`
--
ALTER TABLE `livehelp_operatormessages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `livehelp_requests`
--
ALTER TABLE `livehelp_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
