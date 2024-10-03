-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 12:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tags` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created_at`, `tags`, `status`) VALUES
(15, 9, 'Unique SEO Considerations for Devtools', '<p>SEO for devtool companies requires time and a tailored approach. Just as there&rsquo;s no one-size-fits-all devtool, there&rsquo;s no single SEO playbook that guarantees success. As Meg put it,&nbsp; &nbsp;&ldquo;There&rsquo;s a learning curve in any industry.&rdquo;</p>\r\n<p>&nbsp;</p>\r\n<p>Unlike broader consumer markets,&nbsp;<strong>technical audiences demand a higher level of precision and expertise in communication.</strong> The slightest hint of inauthenticity can erode trust and credibility.</p>\r\n<p>Meg emphasized that precision of language really matters and that&nbsp;<strong>understanding how your audience talks about their work is especially important when it comes to choosing the right keywords and optimizing your site.</strong></p>\r\n<p>Nate agreed, highlighting the challenges he faced when transitioning from consumer finance to the technical Kubernetes space. He emphasized the<strong>&nbsp;need for in-depth content like coding samples and tutorials&nbsp;</strong>to effectively engage technical audiences. Nate also mentioned that&nbsp;<strong>creating content that targets a technical SEO keyword is a lot pricier.&nbsp;</strong></p>\r\n<p><strong>Source:&nbsp;</strong>https://draft.dev/learn/seo-strategies-and-best-practices-for-technical-audiences</p>', '2024-10-03 04:57:02', '#technology, #seo', 'published'),
(16, 9, 'Places to Visit in India', '<ol>\r\n<li><strong>Leh: </strong>Prepare to be wooed by the mesmerizing mountains of Leh. You will love sightseeing and the surreal vistas of snow-capped mountains. Leh is also known for its unique wildlife.</li>\r\n<li><strong>Gokarna: </strong>Take your beach love to Gokarna. You can expect extremely hot and humid weather. Also, don&rsquo;t miss the pilgrimage sites at Gokarna.</li>\r\n<li><strong>Srinagar: </strong>A dreamy honeymoon awaits you at Srinagar. You will love sightseeing and the lively festivals. Don&rsquo;t forget to sample the delicious cuisines at Srinagar.</li>\r\n<li><strong>Havelock Island:&nbsp;</strong>Havelock is an absolute delight for romantic souls. You can expect extremely hot days with temperatures reaching up to 32&deg;C. Don&rsquo;t forget to indulge in adventure activities at Havelock.</li>\r\n<li><strong>Pondicherry:&nbsp;</strong>If you are a beach lover, you must head to Puducherry. You can expect the city is at its hottest during this time. Puducherry is a hot favourite among foodies too.</li>\r\n<li><strong>Goa:</strong> Rev up your spirits with the stunning adventures of Goa. You can expect heavy rainfall throughout the season, pleasant sea breeze. Humidity tends to be high. You can also sample delicious cuisines at Goa.</li>\r\n<li><strong>Manali:</strong> Manali is the perfect escape for romance-seekers. You will love the waterfalls and adventure sports. Additionally, you can try out various adventure activities at Manali.</li>\r\n<li><strong>Allepey:</strong> Take your beach love to Alleppey. You can expect heavy rainfalls, along with humid weather. You can also unwind amidst the tranquil surroundings of Alleppey.</li>\r\n<li><strong>Varkala:</strong> Come and fall in love with the beach vibe of Varkala. You can expect heavy to moderate rainfalls. Varkala is also very popular among relaxation-seekers.</li>\r\n<li><strong>Amritsar:</strong> Soak in the mystic hues of Amritsar, a famous pilgrimage spot! You will love exploring sightseeing attractions and attending various festivals. The local cuisines at Amritsar are worth trying out too.<br><br>Source: internet</li>\r\n</ol>', '2024-10-03 07:44:53', '#travel ', 'published'),
(17, 9, '20 Best Programming Languages in 2024', '<p>What coding and programming language should i learn? JavaScript and Python, two of the most popular languages in the startup industry, are in high demand. Most startups use Python-based backend frameworks such as Django (Python), Flask (Python), and NodeJS (JavaScript). These languages are also considered to be the best programming languages to learn for beginners.</p>\r\n<p>Below is a list of the most popular and best programming languages that will be in demand in 2024.</p>\r\n<p>1. Javascript<br>2. Python<br>3. Go<br>4. Java<br>5. Kotlin<br>6. PHP<br>7. C#<br>8. Swift<br>9. R<br>10. Ruby<br>11. C and C++<br>12. Matlab<br>13. TypeScript<br>14. Scala<br>15. SQL<br>16. HTML<br>17. CSS<br>18. NoSQL<br>19. Rust<br>20. Perl</p>', '2024-10-03 09:50:15', '#technology, #programming', 'published'),
(18, 9, 'Safeera Banu | Web Developer', '<p><strong>Summary:</strong></p>\r\n<p>I am a versatile web developer with experience in creating responsive, user-friendly websites. I have strong expertise in both front-end and back-end development, working with technologies like HTML, CSS, JavaScript, PHP, MySQL and WordPress. I focus on delivering efficient, visually appealing digital solutions that enhance user experience.</p>\r\n<p><strong>Experience:</strong></p>\r\n<p><em><strong>Web Developer</strong></em><br>Chillipages Technologies | May 2024 &ndash; Present</p>\r\n<p><em><strong>Web Designer</strong></em><br>Ztudio.in | Sep 2023 &ndash; Feb 2024</p>\r\n<p><strong>Education:</strong><br>Bachelor of Computer Applications<br>Besant Women&rsquo;s College, Mangalore | 2020 &ndash; 2023</p>\r\n<p><strong>Skills:</strong><br>Web Design &amp; Development | HTML | CSS | JavaScript | WordPress | PHP | MySQL</p>', '2024-10-03 09:59:21', '#portfolio', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(9, 'admin', 'admin@gmail.com', '$2y$10$SRcwAZalKcEYSOYhvviecOKauSud.210qO4AWWqoKI33VkZ1Q.Jba', '2024-10-03 04:55:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
