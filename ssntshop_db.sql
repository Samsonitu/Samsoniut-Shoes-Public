-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 11, 2025 at 04:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssntshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int NOT NULL,
  `brandName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `brandSlug` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` bit(1) DEFAULT b'1',
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `brandName`, `brandSlug`, `image`, `description`, `active`, `createAt`) VALUES
(9, 'Nike Air', 'nike-air', './uploads/img/productBrand/OIP (1).jpg', '', b'1', '2025-02-19 16:39:55'),
(10, 'Nike Air Max', 'nike-air-max', './uploads/img/productBrand/669058.webp', '', b'1', '2025-02-19 16:39:55'),
(11, 'Air Jodan', 'air-jordan', './uploads/img/productBrand/logo-giay-2-1-1.jpeg', '', b'1', '2025-02-19 16:39:55'),
(12, 'Puma', 'puma', './uploads/img/productBrand/10-logo-thuong-hieu-giay-3.jpg', '', b'1', '2025-02-19 16:39:55'),
(13, 'Jordan', 'jordan', './uploads/img/productBrand/thiet_ke_chua_co_ten_-_2023-04-28t102736.782_c5dbce3f7f9943debe4f2d2cad325292_2048x2048.png', '', b'1', '2025-02-19 16:39:55'),
(14, 'Converse', 'converse', './uploads/img/productBrand/10-logo-thuong-hieu-giay-4.png', '', b'1', '2025-02-19 16:39:55'),
(15, 'Nike', 'nike', './uploads/img/productBrand/10-mau-logo-thuong-hieu-4.jpg', '', b'1', '2025-02-19 16:39:55'),
(16, 'Adidas', 'adidas', './uploads/img/productBrand/10-mau-logo-thuong-hieu-2.png', '', b'1', '2025-03-04 09:23:55'),
(18, 'Alexander McQueen', 'alexander-mc-queen', './uploads/img/productBrand/10-logo-thuong-hieu-giay-5.png', '', b'1', '2025-03-07 08:48:28'),
(19, 'Balenciaga ', 'balenciaga', './uploads/img/productBrand/Balenciaga-Logo.png', '', b'1', '2025-03-11 10:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `verificationCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` enum('register','reset_password','change_email','2fa') NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expiresAt` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `email_verifications`
--

INSERT INTO `email_verifications` (`id`, `email`, `verificationCode`, `type`, `createdAt`, `expiresAt`) VALUES
(18, 'samsonitu3505@gmail.com', '95377', 'register', '2025-03-07 07:40:36', '2025-03-07 07:50:36'),
(19, 'samsonitu3505@gmail.com', '30454', 'register', '2025-03-07 07:48:00', '2025-03-07 07:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `mapping_pro_cat`
--

CREATE TABLE `mapping_pro_cat` (
  `mpId` int NOT NULL,
  `proId` int NOT NULL,
  `catId` int NOT NULL,
  `mainMapping` bit(1) NOT NULL DEFAULT b'0',
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapping_pro_cat`
--

INSERT INTO `mapping_pro_cat` (`mpId`, `proId`, `catId`, `mainMapping`, `createAt`, `active`, `description`) VALUES
(24, 13, 5, b'1', '2025-02-25 14:25:43', b'1', NULL),
(35, 13, 4, b'0', '2025-02-26 14:38:05', b'1', NULL),
(38, 13, 18, b'0', '2025-02-26 14:38:17', b'1', NULL),
(40, 14, 4, b'1', '2025-02-27 16:14:57', b'1', NULL),
(54, 24, 4, b'1', '2025-02-28 09:50:26', b'1', NULL),
(55, 25, 4, b'1', '2025-02-28 09:53:50', b'1', NULL),
(56, 26, 4, b'1', '2025-02-28 09:59:32', b'1', NULL),
(57, 27, 16, b'1', '2025-02-28 10:04:55', b'1', NULL),
(58, 28, 4, b'1', '2025-02-28 10:09:10', b'1', NULL),
(59, 29, 4, b'1', '2025-02-28 10:12:07', b'1', NULL),
(60, 30, 4, b'1', '2025-02-28 10:14:11', b'1', NULL),
(61, 31, 4, b'1', '2025-02-28 10:16:09', b'1', NULL),
(62, 32, 4, b'1', '2025-02-28 10:26:13', b'1', NULL),
(63, 13, 22, b'0', '2025-02-28 14:13:14', b'1', NULL),
(64, 31, 15, b'0', '2025-02-28 14:14:17', b'1', NULL),
(65, 32, 18, b'0', '2025-02-28 14:14:53', b'1', NULL),
(66, 14, 15, b'0', '2025-02-28 14:15:25', b'1', NULL),
(67, 14, 19, b'0', '2025-02-28 14:15:25', b'1', NULL),
(68, 24, 18, b'0', '2025-02-28 14:16:03', b'1', NULL),
(69, 25, 18, b'0', '2025-02-28 14:21:58', b'1', NULL),
(70, 26, 15, b'0', '2025-02-28 14:23:14', b'1', NULL),
(71, 26, 22, b'0', '2025-02-28 14:23:14', b'1', NULL),
(72, 28, 18, b'0', '2025-02-28 14:25:48', b'1', NULL),
(73, 28, 20, b'0', '2025-02-28 14:25:48', b'1', NULL),
(74, 28, 22, b'0', '2025-02-28 14:25:48', b'1', NULL),
(75, 29, 18, b'0', '2025-02-28 14:26:22', b'1', NULL),
(76, 29, 19, b'0', '2025-02-28 14:26:22', b'1', NULL),
(77, 30, 6, b'0', '2025-02-28 14:26:55', b'1', NULL),
(78, 30, 20, b'0', '2025-02-28 14:26:55', b'1', NULL),
(79, 33, 4, b'1', '2025-03-11 09:29:18', b'1', NULL),
(80, 33, 19, b'0', '2025-03-11 09:29:18', b'1', NULL),
(83, 35, 24, b'1', '2025-03-11 09:57:13', b'1', NULL),
(84, 35, 22, b'0', '2025-03-11 09:57:13', b'1', NULL),
(85, 36, 5, b'1', '2025-03-11 10:03:14', b'1', NULL),
(86, 36, 20, b'0', '2025-03-11 10:03:14', b'1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `userId` int DEFAULT NULL,
  `newsCatId` int NOT NULL,
  `newsId` int NOT NULL,
  `title` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `newsSlug` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdated` datetime DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`userId`, `newsCatId`, `newsId`, `title`, `newsSlug`, `excerpt`, `content`, `thumbnail`, `createAt`, `lastUpdated`, `status`, `active`) VALUES
(1, 4, 8, 'Cách chọn giày cho người viêm khớp bàn chân', 'cach-chon-giay-cho-nguoi-viem-khop-ban-chan', 'Người bị viêm khớp bàn chân nên chọn giày có kích thước vừa vặn, điều chỉnh được phần mu bàn chân, có phần đế dày, cong để giảm áp lực lên các điểm đau. ', '&lt;h1&gt;&lt;strong style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;C&aacute;ch chọn gi&agrave;y cho người vi&ecirc;m khớp b&agrave;n ch&acirc;n&lt;/strong&gt;&lt;/h1&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Người bị vi&ecirc;m khớp b&agrave;n ch&acirc;n n&ecirc;n chọn gi&agrave;y c&oacute; k&iacute;ch thước vừa vặn, điều chỉnh được phần mu b&agrave;n ch&acirc;n, c&oacute; phần đế d&agrave;y, cong để giảm &aacute;p lực l&ecirc;n c&aacute;c điểm đau.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Vi&ecirc;m khớp c&oacute; thể ảnh hưởng đến nhiều khớp trong cơ thể, bao gồm khớp b&agrave;n ch&acirc;n. C&aacute;c loại vi&ecirc;m khớp thường ảnh hưởng đến b&agrave;n ch&acirc;n l&agrave; tho&aacute;i h&oacute;a khớp (OA), vi&ecirc;m khớp dạng thấp (RA) v&agrave; vi&ecirc;m khớp hậu chấn thương.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Vi&ecirc;m khớp b&agrave;n ch&acirc;n ảnh hưởng đến sinh hoạt hằng ng&agrave;y của người bệnh v&igrave; b&agrave;n ch&acirc;n n&acirc;ng đỡ, hấp thụ sốc, giữ thăng bằng v&agrave; c&aacute;c chức năng quan trọng kh&aacute;c đối với chuyển động. Chọn gi&agrave;y ph&ugrave; hợp gi&uacute;p người bệnh giảm c&aacute;c triệu chứng. Dụng cụ chỉnh h&igrave;nh b&agrave;n ch&acirc;n (như nẹp b&agrave;n ch&acirc;n) v&agrave; gi&agrave;y d&eacute;p chuy&ecirc;n dụng c&oacute; thể hữu &iacute;ch với người bị vi&ecirc;m khớp nhờ thay đổi c&aacute;ch k&iacute;ch hoạt cơ, d&aacute;ng đi để giảm lượng &aacute;p lực l&ecirc;n khớp b&agrave;n ch&acirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Một đ&aacute;nh gi&aacute; tổng hợp hơn 1.400 nghi&ecirc;n cứu tại New Zealand cho thấy c&aacute;c biện ph&aacute;p can thiệp n&agrave;y c&oacute; t&aacute;c dụng giảm đau ch&acirc;n, suy yếu v&agrave; khuyết tật ở người bị vi&ecirc;m khớp dạng thấp, đồng thời cải thiện t&igrave;nh trạng đau ch&acirc;n, chức năng ở ch&acirc;n của người tho&aacute;i h&oacute;a khớp. Những đ&ocirc;i gi&agrave;y trong c&aacute;c nghi&ecirc;n cứu bao gồm gi&agrave;y d&eacute;p c&oacute; sẵn, gi&agrave;y trị liệu v&agrave; gi&agrave;y trị liệu kết hợp với dụng cụ chỉnh h&igrave;nh b&agrave;n ch&acirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Ngược lại, đi gi&agrave;y kh&ocirc;ng ph&ugrave; hợp c&oacute; thể khiến cơn đau khớp nặng hơn, đẩy nhanh qu&aacute; tr&igrave;nh tiến triển bệnh. Đi gi&agrave;y qu&aacute; ngắn hoặc qu&aacute; hẹp so với ch&acirc;n dễ g&acirc;y bầm t&iacute;m ở ng&oacute;n ch&acirc;n hoặc b&agrave;n ch&acirc;n, tổn thương m&oacute;ng ch&acirc;n, rộp, chai ch&acirc;n, k&iacute;ch ứng da.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-suckhoe.vnecdn.net/2024/05/17/126d51f6-4ebb-4e13-8ef0-b412cb-4492-1835-1715917440.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=pxxtD35oxo-iXlSs74vqpw&quot; alt=&quot;Người bị vi&ecirc;m khớp ch&acirc;n n&ecirc;n chọn gi&agrave;y ph&ugrave; hợp để giảm đau, dễ di chuyển, vận động. Ảnh: Th&agrave;nh Dương&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Người bị vi&ecirc;m khớp b&agrave;n ch&acirc;n n&ecirc;n chọn gi&agrave;y ph&ugrave; hợp để giảm đau, dễ di chuyển, vận động. Ảnh:&lt;/span&gt;&lt;em style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt; Th&agrave;nh Dương&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Để đảm bảo chọn gi&agrave;y vừa vặn, người bệnh vi&ecirc;m khớp n&ecirc;n lưu &yacute; những điều sau:&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;em style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Kiểm tra chiều d&agrave;i, chiều rộng của ch&acirc;n&lt;/em&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt; trước khi mua gi&agrave;y. B&aacute;c sĩ chuy&ecirc;n khoa c&oacute; thể hỗ trợ người bệnh đo k&iacute;ch thước b&agrave;n ch&acirc;n ch&iacute;nh x&aacute;c, tư vấn kiểu gi&agrave;y ph&ugrave; hợp.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;em style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y điều chỉnh được phần mu b&agrave;n ch&acirc;n&lt;/em&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;. K&iacute;ch thước v&agrave; h&igrave;nh dạng của phần mu b&agrave;n ch&acirc;n c&oacute; thể thay đổi, nhất l&agrave; khi cơn đau khớp b&ugrave;ng ph&aacute;t, ch&acirc;n c&oacute; thể sưng tấy. Người bệnh n&ecirc;n t&igrave;m những đ&ocirc;i gi&agrave;y thể thao v&agrave; gi&agrave;y trị liệu c&oacute; mu b&agrave;n ch&acirc;n điều chỉnh được bằng d&acirc;y buộc hoặc quai d&aacute;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;em style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Phần bao ng&oacute;n ch&acirc;n của gi&agrave;y phải đủ thoải m&aacute;i&lt;/em&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt; nếu người bệnh gặp c&aacute;c loại biến dạng như ng&oacute;n ch&acirc;n h&igrave;nh b&uacute;a, vẹo ng&oacute;n ch&acirc;n c&aacute;i. Tuy nhi&ecirc;n, kh&ocirc;ng n&ecirc;n tăng cỡ gi&agrave;y v&igrave; c&oacute; thể l&agrave;m mất đi khả năng hỗ trợ b&agrave;n ch&acirc;n l&uacute;c di chuyển.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;em style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Đế cao su hoặc đế d&agrave;y, cong: &lt;/em&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Phần đế cao su đ&oacute;ng vai tr&ograve; như bộ giảm x&oacute;c, trong khi đế d&agrave;y, cong gi&uacute;p ph&acirc;n phối lại &aacute;p lực ở l&ograve;ng b&agrave;n ch&acirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;em style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;L&oacute;t gi&agrave;y c&oacute; thể th&aacute;o rời: &lt;/em&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Người bệnh c&oacute; thể ho&aacute;n đổi miếng l&oacute;t t&ugrave;y chỉnh để ph&acirc;n bổ đều trọng lượng v&agrave; giảm &aacute;p lực l&ecirc;n c&aacute;c điểm đau.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Loại gi&agrave;y chạy bộ ổn định c&oacute; phần giữa đế v&agrave; g&oacute;t d&agrave;y được khuyến nghị cho người vi&ecirc;m khớp. Ch&uacute;ng hỗ trợ kiểm so&aacute;t chuyển động, giảm trọng lượng của b&agrave;n ch&acirc;n, hữu &iacute;ch cho người bị vi&ecirc;m khớp h&aacute;ng, &lt;/span&gt;&lt;a href=&quot;https://vnexpress.net/thay-ca-hai-khop-goi-do-thoai-hoa-giai-doan-cuoi-4746224.html&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot; style=&quot;background-color: rgb(255, 255, 255); color: rgb(7, 109, 182);&quot;&gt;khớp gối&lt;/a&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;, b&agrave;n ch&acirc;n hoặc mắt c&aacute; ch&acirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Người bệnh vi&ecirc;m khớp n&ecirc;n tr&aacute;nh đi gi&agrave;y cao g&oacute;t bởi ch&uacute;ng g&oacute;p phần l&agrave;m hao m&ograve;n khớp, tăng nguy cơ &lt;/span&gt;&lt;a href=&quot;https://vnexpress.net/khop-nao-de-bi-thoai-hoa-4743645.html&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot; style=&quot;background-color: rgb(255, 255, 255); color: rgb(7, 109, 182);&quot;&gt;tho&aacute;i h&oacute;a khớp&lt;/a&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;, trầm trọng th&ecirc;m c&aacute;c vấn đề về ch&acirc;n như ng&oacute;n ch&acirc;n h&igrave;nh b&uacute;a, vi&ecirc;m sưng ng&oacute;n ch&acirc;n c&aacute;i. Nếu phải đi gi&agrave;y cao g&oacute;t, n&ecirc;n chọn loại g&oacute;t thấp dưới 4 cm v&agrave; đế cao su khi c&oacute; thể.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(34, 34, 34);&quot;&gt;Loại gi&agrave;y c&oacute; phần mũi chật cũng n&ecirc;n tr&aacute;nh. Ch&uacute;ng khiến b&agrave;n ch&acirc;n bị o &eacute;p v&agrave;o h&igrave;nh dạng kh&ocirc;ng tự nhi&ecirc;n, g&acirc;y đau, c&oacute; thể dẫn đến ng&oacute;n ch&acirc;n h&igrave;nh b&uacute;a v&agrave; c&aacute;c vấn đề kh&aacute;c.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', './uploads/img/newsThumbnail/news1.jpg', '2025-03-06 19:04:49', '2025-03-06 20:27:44', b'1', b'1'),
(1, 3, 10, 'Mẹo khử mùi hôi giày mà không phải giặt', 'meo-khu-mui-hoi-giay-ma-khong-phai-giat', 'Giày hôi ảnh hưởng đến sự tự tin của bạn và khiến người xung quanh cảm thấy khó chịu. Việc mang giày hôi cũng sẽ sinh nấm mốc ở chân gây tổn hại đến sức khỏe. ', '&lt;h1&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Mẹo khử m&ugrave;i h&ocirc;i gi&agrave;y m&agrave; kh&ocirc;ng phải giặt&lt;/strong&gt;&lt;/h1&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y h&ocirc;i ảnh hưởng đến sự tự tin của bạn v&agrave; khiến người xung quanh cảm thấy kh&oacute; chịu. Việc mang gi&agrave;y h&ocirc;i cũng sẽ sinh nấm mốc ở ch&acirc;n g&acirc;y tổn hại đến sức khỏe.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Dưới đ&acirc;y l&agrave; những mẹo khử m&ugrave;i h&ocirc;i gi&agrave;y hiệu quả m&agrave; kh&ocirc;ng phải giặt thường xuy&ecirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;D&ugrave;ng baking soda&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;D&ugrave;ng hai th&igrave;a c&agrave; ph&ecirc; banking soda đặt v&agrave;o khăn giấy mỏng, sau đ&oacute; gấp lại v&agrave; cố định bằng chun v&ograve;ng. Sau khi cởi gi&agrave;y, cho t&uacute;i khử m&ugrave;i banking v&agrave;o s&acirc;u b&ecirc;n trong gi&agrave;y. Mồ h&ocirc;i trong gi&agrave;y c&oacute; t&iacute;nh axit, c&ograve;n banking soda mang t&iacute;nh kiềm, c&oacute; t&aacute;c dụng tốt trong việc trung h&ograve;a axit. Hơn nữa khăn giấy v&agrave; banking soda đều kh&ocirc;, c&oacute; khả năng h&uacute;t nước tốt n&ecirc;n h&uacute;t được ẩm b&ecirc;n trong gi&agrave;y.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;N&ecirc;n để t&uacute;i khử m&ugrave;i n&agrave;y qua đ&ecirc;m, gi&agrave;y sẽ kh&ocirc; v&agrave; kh&ocirc;ng c&ograve;n m&ugrave;i kh&oacute; chịu v&agrave;o ng&agrave;y h&ocirc;m sau. Nếu muốn gi&agrave;y thơm hơn, c&oacute; thể th&ecirc;m v&agrave;i giọt tinh dầu v&agrave;o hỗn hợp tr&ecirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-giadinh.vnecdn.net/2023/10/06/hoi-giay-1-1-2207-1696581757.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=iQKqNjFTjR64lmOcX7olaQ&quot; alt=&quot;Ảnh minh họa: freepik.com&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Ảnh minh họa:&lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; freepik.com&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Xịt cồn v&agrave;o l&oacute;t gi&agrave;y&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Sau khi về nh&agrave;, lấy miếng l&oacute;t trong gi&agrave;y ra rồi xịt cồn trực tiếp v&agrave;o trong.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Cồn c&oacute; t&aacute;c dụng diệt khuẩn, khử tr&ugrave;ng v&agrave; c&oacute; thể loại bỏ một số vi khuẩn g&acirc;y m&ugrave;i kh&oacute; chịu. Hơn nữa cồn bay hơi rất nhanh, gi&agrave;y xịt xong n&ecirc;n phơi kh&ocirc; ngo&agrave;i kh&ocirc;ng kh&iacute; ở nơi tho&aacute;ng m&aacute;t. Cũng n&ecirc;n xịt cồn l&ecirc;n mặt trước v&agrave; mặt sau gi&agrave;y để diệt khuẩn v&agrave; l&agrave;m sạch m&ugrave;i h&ocirc;i b&aacute;m tr&ecirc;n đ&oacute;. Với c&aacute;ch l&agrave;m n&agrave;y c&oacute; thể khử m&ugrave;i h&ocirc;i trong gi&agrave;y m&agrave; kh&ocirc;ng phải giặt thường xuy&ecirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Sử dụng t&uacute;i tr&agrave; kh&ocirc;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;T&uacute;i tr&agrave; c&oacute; khả năng thấm h&uacute;t cao n&ecirc;n khi để trong gi&agrave;y, ch&uacute;ng sẽ h&uacute;t hơi ẩm ra khỏi vải. Tr&agrave; c&agrave;ng thơm th&igrave; độ khử m&ugrave;i c&agrave;ng hiệu quả.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Cho một nh&uacute;m tr&agrave; v&agrave;o khăn giấy rồi g&oacute;i lại bằng chun v&ograve;ng, bỏ trong gi&agrave;y để qua đ&ecirc;m. Qua 24 tiếng, gi&agrave;y sẽ thoang thoảng m&ugrave;i tr&agrave; v&agrave; m&ugrave;i h&ocirc;i ẩm ướt sẽ bay đi ho&agrave;n to&agrave;n. Cũng c&oacute; thể d&ugrave;ng b&atilde; tr&agrave; đ&atilde; uống, phơi nắng cho kh&ocirc; rồi t&aacute;i sử dụng.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Ngo&agrave;i c&aacute;ch tr&ecirc;n, c&oacute; thể sử dụng giấy b&aacute;o cũ để khử m&ugrave;i gi&agrave;y. Vo tr&ograve;n giấy b&aacute;o rồi nh&eacute;t s&acirc;u v&agrave;o gi&agrave;y. C&aacute;ch n&agrave;y kh&ocirc;ng những h&uacute;t ẩm tốt, định h&igrave;nh gi&agrave;y m&agrave; c&ograve;n khiến vi khuẩn kh&ocirc;ng c&ograve;n cơ hội sinh s&ocirc;i. Tương tự như baking soda hay t&uacute;i tr&agrave;, đặt giấy b&aacute;o v&agrave;o trong gi&agrave;y một ng&agrave;y v&agrave; lấy ra kiểm tra v&agrave;o h&ocirc;m sau.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Ngo&agrave;i những phương ph&aacute;p tr&ecirc;n, n&ecirc;n &aacute;p dụng th&ecirc;m một số c&aacute;ch khử m&ugrave;i gi&agrave;y dưới đ&acirc;y để kh&ocirc;ng phải giặt thường xuy&ecirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;- Thay miếng l&oacute;t gi&agrave;y ba th&aacute;ng một lần.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;- Nếu ch&acirc;n ra nhiều mồ h&ocirc;i, rắc một &iacute;t phấn r&ocirc;m v&agrave;o trong gi&agrave;y hoặc thoa l&ecirc;n b&agrave;n ch&acirc;n trước khi đi gi&agrave;y.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;- Khi gi&agrave;y bị ẩm ướt, phải sấy v&agrave; phơi nơi kh&ocirc; r&aacute;o, tr&aacute;nh mang gi&agrave;y ướt&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;- Thay tất thường xuy&ecirc;n cũng l&agrave; c&aacute;ch ngăn chặn m&ugrave;i h&ocirc;i hiệu quả.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-right&quot;&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Trang Vy &lt;/strong&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;(Theo &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;aboluowang&lt;/em&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;)&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', './uploads/img/newsThumbnail/hoigiay11-1696581053-5472-1696581757.jpg', '2025-03-06 20:29:02', NULL, b'1', b'1'),
(1, 5, 11, 'Nike - hãng giày ra đời từ bài luận trong trường đại học', 'nike-hang-giay-ra-doi-tu-bai-luan-trong-truong-dai-hoc', 'Phil Knight nảy ra ý tưởng về Nike nhờ tham gia đội tuyển điền kinh của trường và trải nghiệm trong các lớp học về kinh doanh. ', '&lt;h1&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Nike - h&atilde;ng gi&agrave;y ra đời từ b&agrave;i luận trong trường đại học&lt;/strong&gt;&lt;/h1&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Phil Knight nảy ra &yacute; tưởng về Nike nhờ tham gia đội tuyển điền kinh của trường v&agrave; trải nghiệm trong c&aacute;c lớp học về kinh doanh.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;H&agrave;nh tr&igrave;nh của Nike bắt đầu v&agrave;o năm 1962. Khi đ&oacute;, đồng s&aacute;ng lập Phil Knight vừa ho&agrave;n th&agrave;nh chương tr&igrave;nh MBA (thạc sĩ quản trị kinh doanh) tại Đại học Stanford. Trước đ&oacute;, &ocirc;ng đ&atilde; tốt nghiệp cử nh&acirc;n tại Đại học Oregon. Theo &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;The Street&lt;/em&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;, đ&acirc;y được coi l&agrave; hai trải nghiệm quan trọng định h&igrave;nh cho sự nghiệp của Knight sau n&agrave;y.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Ở trường Oregon, &ocirc;ng tham gia v&agrave;o đội tuyển điền kinh của huấn luyện vi&ecirc;n Bill Bowerman &ndash; đồng s&aacute;ng lập Nike sau n&agrave;y. Bowerman lu&ocirc;n quan t&acirc;m đến việc tối ưu h&oacute;a gi&agrave;y cho học tr&ograve;. &Ocirc;ng thường xuy&ecirc;n sửa gi&agrave;y cho họ sau khi học hỏi từ một thợ gi&agrave;y địa phương. Ch&iacute;nh điều n&agrave;y đ&atilde; khiến Knight ấn tượng.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Trong cuốn tự truyện &quot;Shoe Dog&quot; sau n&agrave;y, Phil Knight tiết lộ &ocirc;ng nảy ra &yacute; tưởng về Nike nhờ &quot;c&aacute;c đường chạy tại Oregon v&agrave; c&aacute;c lớp học ở Stanford&quot;. Tại Stanford, Knight c&ograve;n từng viết một b&agrave;i luận về l&yacute; do gi&agrave;y chạy n&ecirc;n dời địa điểm sản xuất truyền thống từ Đức sang Nhật Bản &ndash; nơi c&oacute; gi&aacute; nh&acirc;n c&ocirc;ng rẻ hơn. &Yacute; tưởng n&agrave;y được coi l&agrave; đi&ecirc;n rồ ở thời điểm đ&oacute;.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Nhưng sau khi tốt nghiệp, Knight đ&atilde; c&oacute; cơ hội thử nghiệm điều n&agrave;y. Lu&ocirc;n muốn l&agrave;m doanh nh&acirc;n, năm 1962, &ocirc;ng bay đến Nhật Bản, t&igrave;m một thương hiệu gi&agrave;y đủ tốt để hiện thực h&oacute;a ước mơ của m&igrave;nh. Tại Kobe, &ocirc;ng cuối c&ugrave;ng cũng t&igrave;m được h&atilde;ng gi&agrave;y Onitsuka (hiện l&agrave; Asics). Hai b&ecirc;n k&yacute; hợp đồng, v&agrave; Knight bắt đầu nhập khẩu gi&agrave;y Tiger của họ để b&aacute;n sang Mỹ với quy m&ocirc; nhỏ.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Bowerman ủng hộ việc kinh doanh của Knight v&agrave; g&oacute;p vốn 50% v&agrave;o c&ocirc;ng ty mới của cả hai - Blue Ribbon Sports (BRS). BRS th&agrave;nh lập năm 1964 với số vốn chỉ 1.000 USD. Knight thậm ch&iacute; đ&atilde; phải vay tiền từ cha m&igrave;nh.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-kinhdoanh.vnecdn.net/2023/02/25/Bill-Bowerman-and-Phil-Knight-9174-6445-1677339846.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=Cdy6_UTwzPsRcplWknB0bg&quot; alt=&quot;Bill Bowerman (tr&aacute;i) v&agrave; Phil Knight năm 1999. Ảnh: Nike&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Bill Bowerman (tr&aacute;i) v&agrave; Phil Knight năm 1999. Ảnh:&lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; Nike&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Ban đầu, Knight b&aacute;n gi&agrave;y tr&ecirc;n xe hơi với quy m&ocirc; nhỏ để thử nghiệm. Rất nhanh sau đ&oacute;, họ nhận ra người d&ugrave;ng c&oacute; nhu cầu mua gi&agrave;y rẻ hơn m&agrave; vẫn c&oacute; chất lượng cao, thay thế cho gi&agrave;y Adidas v&agrave; Puma vốn đang thống trị thị trường. Cả hai sau đ&oacute; li&ecirc;n tục tăng đặt h&agrave;ng, cho đến khi phải thu&ecirc; th&ecirc;m người để đ&aacute;p ứng nhu cầu ng&agrave;y c&agrave;ng lớn, &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;CNBC&lt;/em&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; cho biết.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Năm 1965, Bowerman đề xuất thiết kế gi&agrave;y mới cho Onitsuka, nhằm hỗ trợ người chạy tối đa. Thiết kế n&agrave;y nhanh ch&oacute;ng đem đến th&agrave;nh c&ocirc;ng, nhưng cũng l&agrave; nguồn cơn g&acirc;y rạn nứt mối quan hệ giữa BRS v&agrave; nh&agrave; cung cấp Nhật Bản. Mẫu gi&agrave;y n&agrave;y được đặt t&ecirc;n Tiger Cortez, ra mắt năm 1967 v&agrave; được ưa chuộng nhờ sự thoải m&aacute;i, thiết kế thời trang.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(130, 130, 130);&quot;&gt;Quảng c&aacute;o&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Tuy nhi&ecirc;n, việc n&agrave;y cũng khiến quan hệ hai b&ecirc;n đi xuống. Knight cho rằng c&ocirc;ng ty Nhật Bản đang t&igrave;m c&aacute;ch ph&aacute; bỏ hợp đồng độc quyền với BRS. B&ecirc;n cạnh đ&oacute;, việc giao h&agrave;ng kh&ocirc;ng phải l&uacute;c n&agrave;o cũng đ&uacute;ng hạn.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Knight c&ograve;n gặp nhiều rắc rối t&agrave;i ch&iacute;nh. D&ugrave; doanh thu li&ecirc;n tục tăng gấp đ&ocirc;i, c&aacute;c ng&acirc;n h&agrave;ng vẫn lưỡng lự khi cho &ocirc;ng vay.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Năm 1971, BRS v&agrave; Onitsuka Tiger chấm dứt hợp t&aacute;c. BRS gần như phải bắt đầu lại mọi thứ. Knight, Bowerman v&agrave; 45 nh&acirc;n vi&ecirc;n khi đ&oacute; phải t&igrave;m nh&agrave; m&aacute;y mới để sản xuất gi&agrave;y. Họ thậm ch&iacute; c&ograve;n phải t&igrave;m t&ecirc;n mới cho c&ocirc;ng ty.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Trong hồi k&yacute;, Knight cho biết ban đầu, &ocirc;ng định đặt t&ecirc;n c&ocirc;ng ty l&agrave; Dimension 6. Nhưng sau đ&oacute;, &quot;Khi Jeff Johnson nghĩ ra t&ecirc;n Nike, t&ocirc;i cũng kh&ocirc;ng biết m&igrave;nh c&oacute; th&iacute;ch kh&ocirc;ng nữa. Nhưng d&ugrave; sao n&oacute; cũng hay hơn c&aacute;c t&ecirc;n kh&aacute;c&quot;, &ocirc;ng nhớ lại. Johnson l&agrave; nh&acirc;n vi&ecirc;n đầu ti&ecirc;n của Nike. &Ocirc;ng nghĩ ra từ Nike sau khi nh&igrave;n thấy t&ecirc;n nữ thần chiến thắng trong thần thoại Hy Lạp.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Họ cũng phải thiết kế logo mới. V&igrave; thế, Knight đến gặp Carolyn Davis &ndash; sinh vi&ecirc;n thiết kế tại Trường đại học Portland gần đ&oacute;. Davis lấy gi&aacute; 35 USD cho h&igrave;nh swoosh &ndash; dấu phẩy hướng l&ecirc;n tr&ecirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Việc kinh doanh của Nike sau đ&oacute; kh&aacute; th&agrave;nh c&ocirc;ng, nhờ gi&agrave;y Cortez v&agrave; Waffle Trainer. Bowerman lấy &yacute; tưởng sản phẩm từ chiếc b&aacute;nh waffle (b&aacute;nh tổ ong) của vợ m&igrave;nh.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Nike sau đ&oacute; li&ecirc;n tục ph&aacute;t triển, một phần nhờ c&aacute;c chiến dịch quảng c&aacute;o th&ocirc;ng minh, nổi tiếng nhất l&agrave; Just Do It năm 1988. Việc hợp t&aacute;c với người nổi tiếng cũng g&oacute;p phần đ&aacute;ng kể v&agrave;o th&agrave;nh c&ocirc;ng của họ. Nike đ&atilde; k&yacute; hợp đồng với nhiều vận động vi&ecirc;n như Tiger Woods, Kobe Bryant v&agrave; Lebron James trong giai đoạn đầu sự nghiệp của họ.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Sự hợp t&aacute;c được đ&aacute;nh gi&aacute; th&agrave;nh c&ocirc;ng nhất l&agrave; với Michael Jordan. Nike k&yacute; hợp đồng trước cả khi Jordan trở th&agrave;nh ng&ocirc;i sao. D&ograve;ng sản phẩm hợp t&aacute;c mang t&ecirc;n Air Jordan cũng đem về 100 triệu USD doanh thu cho Nike cuối năm 1985. Đến nay, Air Jordan vẫn l&agrave; con g&agrave; đẻ trứng v&agrave;ng cho h&atilde;ng n&agrave;y.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Sự đồng h&agrave;nh của Knight v&agrave; Bowerman l&agrave; v&iacute; dụ kinh điển cho sự hợp t&aacute;c giữa tinh thần khởi nghiệp v&agrave; khả năng s&aacute;ng tạo. Bowerman nổi tiếng với những thiết kế gi&agrave;y mang t&iacute;nh đột ph&aacute;. C&ograve;n Knight c&oacute; những &yacute; tưởng marketing hiệu quả, như th&ocirc;ng b&aacute;o &quot;4 tr&ecirc;n 7 người về đ&iacute;ch đầu ti&ecirc;n&quot; trong m&ocirc;n marathon tại đợt tuyển chọn vận động vi&ecirc;n Olympic Mỹ 1972 l&agrave; đi gi&agrave;y Nike.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Trong một cuộc phỏng vấn năm 2017 tại Trường Kinh doanh Stanford, được đăng tải tr&ecirc;n website trường n&agrave;y, Knight kể lại rằng Bowerman kh&ocirc;ng chỉ dạy &ocirc;ng c&aacute;ch chạy, m&agrave; c&ograve;n tạo ra nền tảng gi&uacute;p &ocirc;ng biết c&aacute;ch đ&aacute;p trả sự cạnh tranh. &quot;&Ocirc;ng ấy muốn người trẻ biết rằng họ cần chuẩn bị cho sự cạnh tranh suốt đời, chứ kh&ocirc;ng chỉ l&agrave; 4 năm trong đội tuyển trường đại học&quot;, Knight nhớ lại.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Năm 1980, Nike l&agrave;m IPO. Knight lập tức trở th&agrave;nh triệu ph&uacute; với số cổ phiếu trị gi&aacute; 178 triệu USD. Hiện tại, Knight sở hữu 45,3 tỷ USD, theo&lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; Forbes,&lt;/em&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; v&agrave; l&agrave; người gi&agrave;u thứ 17 tại Mỹ. Năm 2016, &ocirc;ng rời Nike, nhường vị tr&iacute; chủ tịch cho Mark Parker sau 52 năm gắn b&oacute; với c&ocirc;ng ty. Bowerman th&igrave; đ&atilde; qua đời năm 1999 ở tuổi 88.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Nike hiện tại l&agrave; thương hiệu đồ thể thao h&agrave;ng đầu thế giới, c&ugrave;ng với Adidas v&agrave; Puma. Năm 2022, họ c&oacute; gần 80.000 nh&acirc;n vi&ecirc;n tr&ecirc;n to&agrave;n cầu. Doanh thu t&agrave;i kh&oacute;a 2022 đạt 46,7 tỷ USD, tăng 2 tỷ USD so với năm trước đ&oacute;.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Cũng trong cuộc phỏng vấn năm 2017 tại Stanford, Knight đ&atilde; đề cao gi&aacute; trị của việc học đại học. &quot;Bill Gates v&agrave; Steve Jobs bỏ học sau một năm v&agrave; khởi nghiệp rất th&agrave;nh c&ocirc;ng. Nhưng trường hợp của t&ocirc;i th&igrave; ngược lại. T&ocirc;i viết ra kế hoạch về c&ocirc;ng ty sau n&agrave;y trở th&agrave;nh Nike trong một lớp học ở Stanford&quot;, &ocirc;ng n&oacute;i.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;V&agrave; khi được hỏi lời khuy&ecirc;n cho doanh nh&acirc;n khởi nghiệp, Knight cho biết họ cần chuẩn bị đối mặt với nhiều kh&oacute; khăn v&agrave; những bước l&ugrave;i kh&ocirc;ng ngờ tới. &quot;Với c&aacute;c doanh nh&acirc;n, mỗi ng&agrave;y đều l&agrave; một cuộc khủng hoảng&quot;, &ocirc;ng kết luận.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-right&quot;&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;H&agrave; Thu&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', './uploads/img/newsThumbnail/nikeset-1677339785-8043-1677339846.jpg', '2025-03-06 20:30:25', NULL, b'1', b'1'),
(1, 5, 12, 'Giày đi bộ nhanh nhất thế giới', 'giay-di-bo-nhanh-nhat-the-gioi', 'Công ty khởi nghiệp Shift Robotics giới thiệu mẫu giày Moonwalker có thể giúp người đeo tăng 250% tốc độ đi bộ nhờ thuật toán AI.', '&lt;h1&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y đi bộ nhanh nhất thế giới&lt;/strong&gt;&lt;/h1&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;C&ocirc;ng ty khởi nghiệp Shift Robotics giới thiệu mẫu gi&agrave;y Moonwalker c&oacute; thể gi&uacute;p người đeo tăng 250% tốc độ đi bộ nhờ thuật to&aacute;n AI.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(255, 255, 255); background-color: rgba(0, 0, 0, 0.7);&quot;&gt;Video Player is loading.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: inherit; background-color: initial;&quot;&gt;Dừng&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(255, 255, 255); background-color: initial;&quot;&gt;Hiện tại 0:10&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(255, 255, 255); background-color: initial;&quot;&gt;/&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(255, 255, 255); background-color: initial;&quot;&gt;Thời lượng 0:31&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(255, 255, 255); background-color: rgba(200, 200, 200, 0.3);&quot;&gt;Đ&atilde; tải: 0%&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(255, 255, 255); background-color: rgb(159, 34, 78);&quot;&gt;Tiến tr&igrave;nh: 0%&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: inherit; background-color: initial;&quot;&gt;Bỏ tắt tiếng&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: inherit; background-color: initial;&quot;&gt;To&agrave;n m&agrave;n h&igrave;nh&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y đi bộ nhanh nhất thế giới Moonwalker. Video: &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Shift Robotics&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Được ph&aacute;t triển bởi một nh&oacute;m kỹ sư robot, những người từng l&agrave;m việc tại Đại học Carnegie Mellon của Mỹ trước khi th&agrave;nh lập c&ocirc;ng ty khởi nghiệp c&oacute; t&ecirc;n Shift Robotics, Moonwalker c&oacute; thể tr&ocirc;ng giống như những đ&ocirc;i gi&agrave;y trượt patin, nhưng được hỗ trợ bởi thuật to&aacute;n tr&iacute; tuệ nh&acirc;n tạo (AI) gi&uacute;p người mang đi lại b&igrave;nh thường m&agrave; kh&ocirc;ng cần bất kỳ điều khiển n&agrave;o.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;&quot;Moonwalker kh&ocirc;ng phải l&agrave; gi&agrave;y trượt. Bạn kh&ocirc;ng trượt tr&ecirc;n ch&uacute;ng m&agrave; sẽ đi bộ. Bạn cũng kh&ocirc;ng cần phải học c&aacute;ch sử dụng. Những đ&ocirc;i gi&agrave;y n&agrave;y học hỏi từ bạn&quot;, Xunjie Zang, nh&agrave; s&aacute;ng lập ki&ecirc;m Gi&aacute;m đốc điều h&agrave;nh Shift Robotics, nhấn mạnh.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Thiết kế c&oacute; d&acirc;y đeo cho ph&eacute;p Moonwalker được d&ugrave;ng kết hợp với hầu hết mọi đ&ocirc;i gi&agrave;y. N&oacute; c&oacute; 8 b&aacute;nh xe bằng polyurethane, giống như gi&agrave;y trượt. Tuy nhi&ecirc;n, những b&aacute;nh xe n&agrave;y nhỏ hơn nhiều v&agrave; kh&ocirc;ng nằm tr&ecirc;n một đường thẳng. Ch&uacute;ng được cấp năng lượng bởi một động cơ điện 300 watt.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Bằng c&aacute;ch sử dụng c&aacute;c cảm biến, AI gi&aacute;m s&aacute;t c&aacute;ch người đeo gi&agrave;y đi bộ v&agrave; thuật to&aacute;n tự động điều chỉnh c&ocirc;ng suất của động cơ để đồng bộ h&oacute;a với tốc độ, cho ph&eacute;p tăng v&agrave; giảm tốc độ khi người d&ugrave;ng đi bộ nhanh hơn hoặc chậm hơn.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Theo tuy&ecirc;n bố của Shift Robotics, Moonwalker l&agrave; gi&agrave;y đi bộ nhanh nhất thế giới, c&oacute; thể l&agrave;m tăng tốc độ đi bộ của người đeo l&ecirc;n 250% dựa tr&ecirc;n ph&acirc;n t&iacute;ch rằng tốc độ đi bộ trung b&igrave;nh của một người l&agrave; 4 - 6,4 km/h.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;N&oacute; cũng được thiết kế để leo cầu thang v&agrave; l&ecirc;n xuống dốc th&ocirc;ng qua cử động ch&acirc;n đặc biệt gi&uacute;p k&iacute;ch hoạt chế độ kh&oacute;a b&aacute;nh v&agrave; ngăn b&aacute;nh xe lăn tự do&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Với tầm hoạt động của pin đạt gần 10 km, Moonwalker c&oacute; thể l&agrave; một giải ph&aacute;p thay thế cho c&aacute;c phương tiện c&aacute; nh&acirc;n như &ocirc;t&ocirc; v&agrave; xe m&aacute;y trong những chặng đường ngắn. K&iacute;ch thước nhỏ gọn cho ph&eacute;p bạn dễ d&agrave;ng cất gọn ch&uacute;ng dưới b&agrave;n l&agrave;m việc hoặc thậm ch&iacute; l&agrave; trong ba l&ocirc;.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Shift Robotics đang cố gắng đưa mẫu gi&agrave;y th&ocirc;ng minh của m&igrave;nh đến với nhiều người ti&ecirc;u d&ugrave;ng th&ocirc;ng qua một chiến dịch huy động vốn cộng đồng tr&ecirc;n Kickstarter, với hy vọng nhận được 90.000 USD. C&ocirc;ng ty đ&atilde; bắt đầu mở b&aacute;n trước Moonwalker từ tuần n&agrave;y với gi&aacute; b&aacute;n lẻ 1.399 USD cho mỗi đ&ocirc;i v&agrave; dự kiến giao h&agrave;ng v&agrave;o th&aacute;ng 3/2023.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-right&quot;&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Đo&agrave;n Dương &lt;/strong&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;(Theo &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gizmodo/New York Post&lt;/em&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;)&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', './uploads/img/newsThumbnail/-9249-1667029938.jpg', '2025-03-06 21:22:43', NULL, b'1', b'1'),
(1, 5, 13, 'Trung Quốc phát triển giày phân hủy sinh học', 'trung-quoc-phat-trien-giay-phan-huy-sinh-hoc', 'Đại học Công nghệ Hóa học Bắc Kinh ra mắt lô giày sinh học đầu tiên có thể sử dụng hàng ngày và phân hủy trong điều kiện ủ phân. ', '&lt;h1&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Trung Quốc ph&aacute;t triển gi&agrave;y ph&acirc;n hủy sinh học&lt;/strong&gt;&lt;/h1&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Đại học C&ocirc;ng nghệ H&oacute;a học Bắc Kinh ra mắt l&ocirc; gi&agrave;y sinh học đầu ti&ecirc;n c&oacute; thể sử dụng h&agrave;ng ng&agrave;y v&agrave; ph&acirc;n hủy trong điều kiện ủ ph&acirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-vnexpress.vnecdn.net/2022/08/19/giay-phan-huy-sinh-hoc-9095-1660877687.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=Y07X5iBt_W7D57a86myqiw&quot; alt=&quot;L&ocirc; gi&agrave;y sinh học đầu ti&ecirc;n c&oacute; thể ph&acirc;n hủy ho&agrave;n to&agrave;n. Ảnh: BUCT&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;L&ocirc; gi&agrave;y sinh học đầu ti&ecirc;n c&oacute; thể ph&acirc;n hủy ho&agrave;n to&agrave;n. Ảnh: &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;BUCT&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Tổng cộng hơn 500 đ&ocirc;i gi&agrave;y đ&atilde; được Đại học C&ocirc;ng nghệ H&oacute;a học Bắc Kinh (BUCT) trao tặng cho c&aacute;c giảng vi&ecirc;n v&agrave; sinh vi&ecirc;n tại buổi lễ ph&aacute;t h&agrave;nh l&ocirc; gi&agrave;y ph&acirc;n hủy ho&agrave;n to&agrave;n dựa tr&ecirc;n sinh học đầu ti&ecirc;n v&agrave;o h&ocirc;m 16/8.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Theo &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Science Net&lt;/em&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;, phần đế gi&agrave;y sử dụng chất liệu cao su polyester c&oacute; nguồn gốc sinh học do BUCT ph&aacute;t triển độc lập, trong khi c&aacute;c bộ phận kh&aacute;c được l&agrave;m từ sợi gai dầu, sợi tre v&agrave; vật liệu mủ th&acirc;n c&acirc;y ng&ocirc;. Ch&uacute;ng đủ ổn định để sử dụng h&agrave;ng ng&agrave;y v&agrave; ph&acirc;n hủy nhanh ch&oacute;ng trong điều kiện ủ ph&acirc;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Nh&oacute;m nghi&ecirc;n cứu do Viện sĩ Zhang Liqun tại Học viện Kỹ thuật Trung Quốc v&agrave; Gi&aacute;o sư Wang Zhao tại BUCT dẫn đầu đ&atilde; ho&agrave;n th&agrave;nh sản xuất thử nghiệm quy m&ocirc; 1.000 tấn cao su polyester. Loại cao su n&agrave;y cũng c&oacute; thể d&ugrave;ng để sản xuất lốp xe, v&ograve;ng đệm chống dầu, axit polylactic v&agrave; chất lưu h&oacute;a dẻo nhiệt.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-vnexpress.vnecdn.net/2022/08/19/giay-phan-huy-8378-1660877687.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=8NuIiplu4eLuz5qgIHjAaw&quot; alt=&quot;Buổi lễ ph&aacute;t h&agrave;nh v&agrave; trao tặng gi&agrave;y sinh học tại Đại học C&ocirc;ng nghệ H&oacute;a học Bắc Kinh. Ảnh: BUCT&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Buổi lễ ph&aacute;t h&agrave;nh v&agrave; trao tặng gi&agrave;y sinh học tại Đại học C&ocirc;ng nghệ H&oacute;a học Bắc Kinh. Ảnh: &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;BUCT&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Theo Wang, việc thiếu vật liệu cao su ph&acirc;n hủy sinh học l&agrave; nguy&ecirc;n nh&acirc;n ch&iacute;nh hạn chế sự ph&aacute;t triển của gi&agrave;y ph&acirc;n hủy ở Trung Quốc. Mỗi năm, c&oacute; gần một tỷ đ&ocirc;i gi&agrave;y bị vứt bỏ v&agrave; nếu kh&ocirc;ng được xử l&yacute; hiệu quả, đ&oacute; sẽ l&agrave; một mối đe dọa đối với m&ocirc;i trường.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Sau khi ph&aacute;t h&agrave;nh l&ocirc; gi&agrave;y quy m&ocirc; nhỏ đầu ti&ecirc;n, nh&oacute;m nghi&ecirc;n cứu tại BUCT sẽ l&agrave;m việc với c&aacute;c doanh nghiệp để thực hiện sản xuất h&agrave;ng loạt.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-right&quot;&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Đo&agrave;n Dương &lt;/strong&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;(Theo &lt;/span&gt;&lt;em style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Xinhua&lt;/em&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;)&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', './uploads/img/newsThumbnail/giayphanhuysinhhccopy-16608771-6857-8152-1660877687.jpg', '2025-03-06 21:26:12', NULL, b'1', b'1');
INSERT INTO `news` (`userId`, `newsCatId`, `newsId`, `title`, `newsSlug`, `excerpt`, `content`, `thumbnail`, `createAt`, `lastUpdated`, `status`, `active`) VALUES
(1, 5, 14, 'Giày Pierre Cardin cho nam giảm đến nửa giá', 'giay-pierre-cardin-cho-nam-giam-den-nua-gia', 'Nhiều mẫu giày tây, giày lười Pierre Cardin cho nam giảm giá đến 50% trên Shop VnExpress, còn chưa đến 1,8 triệu đồng một đôi. ', '&lt;h1&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y Pierre Cardin cho nam giảm đến nửa gi&aacute;&lt;/strong&gt;&lt;/h1&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Nhiều mẫu gi&agrave;y t&acirc;y, gi&agrave;y lười Pierre Cardin cho nam giảm gi&aacute; đến 50% tr&ecirc;n Shop VnExpress, c&ograve;n chưa đến 1,8 triệu đồng một đ&ocirc;i.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y Pierre Cardin th&iacute;ch hợp nhất cho m&ocirc;i trường c&ocirc;ng sở v&agrave; những nơi đ&ograve;i hỏi sự chỉnh chu cao từ chất liệu, kiểu d&aacute;ng v&agrave; những chi tiết nhỏ được gia c&ocirc;ng tỉ mỉ... sẽ l&agrave; điểm nhấn cho n&eacute;t lịch thiệp của qu&yacute; &ocirc;ng.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Để sử dụng những đ&ocirc;i gi&agrave;y Pierre Cardin bền, đẹp theo thời gian, người d&ugrave;ng n&ecirc;n đặt gi&agrave;y nơi kh&ocirc; tho&aacute;ng, tr&aacute;nh &aacute;nh s&aacute;ng trực tiếp l&agrave;m kh&ocirc; v&agrave; cứng da. Sau khi sử dụng, cần lau sạch bụi bẩn, th&aacute;o v&agrave; bảo quản d&acirc;y gi&agrave;y ri&ecirc;ng. Hạn chế tiếp x&uacute;c gi&agrave;y da với nước. Ngo&agrave;i ra, người d&ugrave;ng cần sử dụng l&oacute;t gi&agrave;y khử m&ugrave;i hoặc t&uacute;i chống ẩm để lu&ocirc;n giữ được gi&agrave;y kh&ocirc; r&aacute;o v&agrave; tr&aacute;nh nấm mốc....&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Dưới đ&acirc;y l&agrave; những mẫu gi&agrave;y hiện c&oacute; gi&aacute; ưu đ&atilde;i s&acirc;u, giảm đến 50%, đang c&oacute; b&aacute;n từ 1,49 triệu đồng đến 1,79 triệu đồng tr&ecirc;n Shop VnExpress.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-giadinh.vnecdn.net/2021/03/29/603f3a97df390-z2359041866782-f-4570-9253-1616990109.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=k6Y17MsWaI3lHKxClx7LKA&quot; alt=&quot;Gi&agrave;y da Pierre Cardin Penny Loafer PCMFWLC089BLK m&agrave;u đen1.495.000đ(- 50 %)Chất liệu b&ecirc;n ngo&agrave;i: Da b&ograve;Chất liệu b&ecirc;n trong: Da b&ograve;Loại đế: Cao su TPRĐế giầy được l&agrave;m từ cao su tr&aacute;nh trơn trượt, thiết kế &ocirc;m ch&acirc;n tự tin khi cất bước. Gi&agrave;y da Pierre Cardin ph&ugrave; hợp với nơi c&ocirc;ng sở hay gặp mặt đối t&aacute;c, khẳng định vị thế qu&yacute; &ocirc;ng.&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y Pierre Cardin Penny Loafer &lt;/span&gt;&lt;u style=&quot;background-color: rgb(252, 250, 246); color: rgb(7, 109, 182);&quot;&gt;&lt;a href=&quot;https://shop.vnexpress.net/giay-da-pierre-cardin-penny-loafer-pcmfwlc089blk-mau-den-142443.html?utm_source=PR&amp;amp;utm_medium=VnExpress.net&amp;amp;utm_campaign=0404_GiayPierreCardin_Giam50_032021#c:1_%C4%90en%23s1:i10_39&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot;&gt;PCMFWLC089BLK&lt;/a&gt;&lt;/u&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; m&agrave;u đen giảm 50% c&ograve;n 1,495 triệu đồng; chất liệu b&ecirc;n ngo&agrave;i v&agrave; b&ecirc;n trong đều l&agrave; da b&ograve;; đế được l&agrave;m từ cao su tr&aacute;nh trơn trượt, thiết kế &ocirc;m ch&acirc;n tự tin khi cất bước. Loại gi&agrave;y n&agrave;y ph&ugrave; hợp ở nơi c&ocirc;ng sở hay gặp mặt đối t&aacute;c...&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-giadinh.vnecdn.net/2021/03/29/5fadfa5e081fd-thi-t-k-kh-ng-t-5678-4720-1616990109.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=IjMWFmzmoHUjrI6H_K4nTA&quot; alt=&quot;Gi&agrave;y da nam Pierre Cardin PCMFWLE704BLK m&agrave;u đen 1.490.000đ(- 50 %)Chất liệu b&ecirc;n ngo&agrave;i: Da b&ograve;- Loại đế: Cao su nhiệt dẻo TPR&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y nam Pierre Cardin &lt;/span&gt;&lt;u style=&quot;background-color: rgb(252, 250, 246); color: rgb(7, 109, 182);&quot;&gt;&lt;a href=&quot;https://shop.vnexpress.net/giay-da-nam-pierre-cardin-pcmfwle704blk-mau-den-174335.html?utm_source=PR&amp;amp;utm_medium=VnExpress.net&amp;amp;utm_campaign=0404_GiayPierreCardin_Giam50_032021#c:1_%C4%90en%23s1:i10_39&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot;&gt;PCMFWLE704BLK&lt;/a&gt;&lt;/u&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; m&agrave;u đen giảm 50% c&ograve;n 1,49 triệu đồng; chất liệu b&ecirc;n ngo&agrave;i l&agrave; da b&ograve;; đế cao su chống trơn trượt.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-giadinh.vnecdn.net/2021/03/29/5e0ad041a69a6-thi-t-k-kh-ng-t-3467-4230-1616990109.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=IAHF4StG-xHYWfK-xRa3wA&quot; alt=&quot;Gi&agrave;y nam Pierre Cardin PCMFWLD311BLK m&agrave;u đen 1.794.000đ(- 40 %)da b&ograve; cao cấp nhập khẩu mềm mịn, chống thấm nướcC&aacute;c chi tiết được kết nối với nhau bởi đường may chắc chắn v&agrave; nổi bậtPhần đế được l&agrave;m từ chất liệu cao su cao cấp chống trơn trượtTh&acirc;n trong l&agrave; lớp l&oacute;t Talon d&agrave;y dặn, giữ đ&ocirc;i ch&acirc;n lu&ocirc;n &ecirc;m &aacute;i v&agrave; kh&ocirc; tho&aacute;ng&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y nam Pierre Cardin &lt;/span&gt;&lt;u style=&quot;background-color: rgb(252, 250, 246); color: rgb(7, 109, 182);&quot;&gt;&lt;a href=&quot;https://shop.vnexpress.net/giay-nam-pierre-cardin-pcmfwld311blk-mau-den-146603.html?utm_source=PR&amp;amp;utm_medium=VnExpress.net&amp;amp;utm_campaign=0404_GiayPierreCardin_Giam50_032021#c:1_%C4%90en%23s1:i10_39&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot;&gt;PCMFWLD311BLK&lt;/a&gt;&lt;/u&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; m&agrave;u đen giảm 40% c&ograve;n 1,794 triệu đồng; l&agrave;m từ da b&ograve; mềm mịn, chống thấm nước; c&aacute;c chi tiết được kết nối với nhau bởi đường may chắc chắn. Phần đế l&agrave;m từ chất liệu cao su chống trơn trượt. Th&acirc;n trong l&agrave; lớp l&oacute;t talon d&agrave;y dặn, giữ đ&ocirc;i ch&acirc;n &ecirc;m &aacute;i v&agrave; kh&ocirc; tho&aacute;ng.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-giadinh.vnecdn.net/2021/03/29/603f187f38ec0-thi-t-k-kh-ng-t-5763-9393-1616990109.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=YTBHtEsCBCxMJDp9eBKMpA&quot; alt=&quot;Gi&agrave;y lười nam Pierre Cardin PCMFWLE 708BLK m&agrave;u đen 1.490.000đ(- 40 %)&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y lười nam Pierre Cardin &lt;/span&gt;&lt;u style=&quot;background-color: rgb(252, 250, 246); color: rgb(7, 109, 182);&quot;&gt;&lt;a href=&quot;https://shop.vnexpress.net/giay-luoi-nam-pierre-cardin-pcmfwle-708blk-mau-den-178520.html?utm_source=PR&amp;amp;utm_medium=VnExpress.net&amp;amp;utm_campaign=0404_GiayPierreCardin_Giam50_032021#c:1_%C4%90en%23s1:i10_39&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot;&gt;PCMFWLE 708BLK&lt;/a&gt;&lt;/u&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; m&agrave;u đen giảm 40% c&ograve;n 1,49 triệu đồng.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-giadinh.vnecdn.net/2021/03/29/5fc8b1c7f1f9c-thi-t-k-kh-ng-t-1434-7068-1616990110.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=X8HS6S4bqO0wgUkOdhRRww&quot; alt=&quot;Gi&agrave;y da nam Pierre Cardin PCMFWLE722BLK m&agrave;u đen1.490.000đ(- 40 %)Chất liệu :Da b&ograve;Loại đế: Cao su nhiệt dẻo TPR&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y nam Pierre Cardin &lt;/span&gt;&lt;u style=&quot;background-color: rgb(252, 250, 246); color: rgb(7, 109, 182);&quot;&gt;&lt;a href=&quot;https://shop.vnexpress.net/giay-da-nam-pierre-cardin-pcmfwle722blk-mau-den-175250.html?utm_source=PR&amp;amp;utm_medium=VnExpress.net&amp;amp;utm_campaign=0404_GiayPierreCardin_Giam50_032021#c:1_%C4%90en%23s1:i10_39&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot;&gt;PCMFWLE722BLK&lt;/a&gt;&lt;/u&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; m&agrave;u đen giảm 40% c&ograve;n 1,49 triệu đồng; chất liệu da b&ograve;; loại đế cao su chống trơn trượt.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); background-color: rgb(240, 238, 234);&quot;&gt;&lt;img src=&quot;https://i1-giadinh.vnecdn.net/2021/03/29/5fd1c5e34efa8-thi-t-k-kh-ng-t-1146-3529-1616990110.jpg?w=680&amp;amp;h=0&amp;amp;q=100&amp;amp;dpr=1&amp;amp;fit=crop&amp;amp;s=3KMqAAa7HLH9ATHA0Q_MOQ&quot; alt=&quot;Gi&agrave;y da nam Pierre Cardin PCMFWLE704BRW m&agrave;u n&acirc;u  1.794.000đ(- 40 %)Chất liệu b&ecirc;n ngo&agrave;i: Da b&ograve;- Loại đế: Cao su nhiệt dẻo TPR&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-center&quot;&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Gi&agrave;y da nam Pierre Cardin &lt;/span&gt;&lt;u style=&quot;background-color: rgb(252, 250, 246); color: rgb(7, 109, 182);&quot;&gt;&lt;a href=&quot;https://shop.vnexpress.net/giay-da-nam-pierre-cardin-pcmfwle704brw-mau-nau-174396.html?utm_source=PR&amp;amp;utm_medium=VnExpress.net&amp;amp;utm_campaign=0404_GiayPierreCardin_Giam50_032021#c:1_N%C3%A2u%23s1:i10_39&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot;&gt;PCMFWLE704BRW&lt;/a&gt;&lt;/u&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt; m&agrave;u n&acirc;u giảm 40% c&ograve;n 1,794 triệu đồng; chất liệu b&ecirc;n ngo&agrave;i l&agrave; da b&ograve;; loại đế cao su chống trơn trượt.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Ngo&agrave;i c&aacute;c mặt h&agrave;ng tr&ecirc;n, Shop VnExpress c&ograve;n nhiều mẫu gi&agrave;y t&acirc;y, gi&agrave;y lười Pierre Cardin cho nam đang b&aacute;n với gi&aacute; ưu đ&atilde;i. Xem th&ecirc;m th&ocirc;ng tin v&agrave; chọn mua &lt;/span&gt;&lt;a href=&quot;https://shop.vnexpress.net/retail/pierre-cardin-official-store/giay-tay-nam?utm_source=PR&amp;amp;utm_medium=VnExpress.net&amp;amp;utm_campaign=0404_GiayPierreCardin_Giam50_032021&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot; style=&quot;background-color: rgb(252, 250, 246); color: inherit;&quot;&gt;tại đ&acirc;y&lt;/a&gt;&lt;span style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-right&quot;&gt;&lt;strong style=&quot;background-color: rgb(252, 250, 246); color: rgb(34, 34, 34);&quot;&gt;Thư Kỳ&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', './uploads/img/newsThumbnail/5fd1c5e34efa8-thi-t-k-kh-ng-t-7470-2084-1616990110.jpg', '2025-03-06 21:27:28', NULL, b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE `news_category` (
  `userId` int NOT NULL,
  `newsCatId` int NOT NULL,
  `newsCatName` varchar(50) NOT NULL,
  `newsCatSlug` varchar(50) NOT NULL,
  `status` bit(1) DEFAULT b'1',
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdated` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`userId`, `newsCatId`, `newsCatName`, `newsCatSlug`, `status`, `createAt`, `lastUpdated`, `description`, `active`) VALUES
(1, 3, 'Vệ sinh giày', 've-sinh-giay', b'1', '2025-03-06 10:53:44', '2025-03-06 11:01:28', '', b'1'),
(1, 4, 'Sức Khỏe', 'suc-khoe', b'1', '2025-03-06 15:56:42', NULL, '', b'1'),
(1, 5, 'Hot', 'hot', b'1', '2025-03-06 20:29:30', NULL, '', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderCode` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userId` int NOT NULL,
  `proId` int NOT NULL,
  `varId` int NOT NULL,
  `unitPrice` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `totalOrder` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: in cart\r\n1: ordered\r\n2: in shipping time\r\n3: done\r\n4: cancel',
  `createAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `orderAt` datetime DEFAULT NULL,
  `startShip` datetime DEFAULT NULL,
  `completeAt` datetime DEFAULT NULL,
  `cancelAt` datetime DEFAULT NULL,
  `paymentForm` enum('cod','card') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'cod',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderCode`, `userId`, `proId`, `varId`, `unitPrice`, `quantity`, `totalOrder`, `status`, `createAt`, `orderAt`, `startShip`, `completeAt`, `cancelAt`, `paymentForm`, `note`) VALUES
('96', 16, 14, 18, 1350000, 4, 4090000, 1, '2025-03-05 01:54:41', '2025-03-05 01:54:53', NULL, NULL, NULL, 'cod', 'Khách vip'),
('97', 16, 28, 31, 3420000, 17, 6880000, 3, '2025-03-05 07:54:58', '2025-03-07 14:06:11', NULL, NULL, NULL, 'cod', 'null'),
('HDICXJTDVC', 3, 13, 14, NULL, 1, NULL, 0, '2025-03-07 19:59:39', NULL, NULL, NULL, NULL, 'cod', NULL),
('KII6Q20YW9', 16, 14, 18, NULL, 1, NULL, 0, '2025-03-09 15:06:56', NULL, NULL, NULL, NULL, 'cod', NULL),
('MIM7UOQSPM', 3, 29, 33, NULL, 2, NULL, 0, '2025-03-07 19:34:07', NULL, NULL, NULL, NULL, 'cod', NULL),
('N4SX1JMCW1', 16, 13, 40, 1936000, 1, 1976000, 4, '2025-03-07 14:05:44', '2025-03-07 14:05:44', NULL, NULL, NULL, 'cod', ''),
('P1K7G7WLPK', 16, 28, 31, 3420000, 5, 17140000, 1, '2025-03-09 13:04:51', '2025-03-09 15:06:31', NULL, NULL, NULL, 'cod', NULL),
('VIOU4FSFG9', 16, 13, 14, NULL, 1, NULL, 0, '2025-03-09 12:51:42', NULL, NULL, NULL, NULL, 'cod', NULL),
('W1SYZ26RVA', 3, 14, 18, NULL, 2, NULL, 0, '2025-03-07 19:56:05', NULL, NULL, NULL, NULL, 'cod', NULL),
('W9TPJ4EGF9', 16, 33, 42, 2940000, 1, 2980000, 2, '2025-03-11 10:03:47', '2025-03-11 10:03:47', NULL, NULL, NULL, 'cod', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `brandId` int NOT NULL,
  `supId` int NOT NULL,
  `proId` int NOT NULL,
  `proName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `proSlug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`brandId`, `supId`, `proId`, `proName`, `proSlug`, `description`, `active`) VALUES
(11, 1, 13, 'Giày Air Jordan 14 Retro', 'giay-air-jordan-14-retro', 'Lấy cảm hứng từ thiết kế của những chiếc xe thể thao sang trọng, Air Jordan 14 Retro mang đến vẻ ngoài mạnh mẽ và tốc độ.\nChất liệu da cao cấp kết hợp với các chi tiết kim loại tạo nên sự sang trọng và đẳng cấp.\nCông nghệ đệm khí Air-Sole giúp giảm chấn và mang lại sự thoải mái tối đa khi di chuyển.\nĐây là lựa chọn hoàn hảo cho những người yêu thích phong cách thể thao sang trọng và muốn thể hiện cá tính mạnh mẽ', b'1'),
(10, 1, 14, 'Giày Nike Air Max 90 Ocean', 'giay-nike-air-max-90-ocean', 'Phối màu xanh đại dương tươi mát mang đến cảm giác năng động và trẻ trung.\nThiết kế retro kinh điển với phần upper bằng da và vải lưới thoáng khí.\nĐệm Air Max ở gót chân giúp giảm chấn và mang lại sự êm ái khi di chuyển.\nPhù hợp với nhiều phong cách thời trang khác nhau, từ thể thao đến đường phố.', b'1'),
(11, 1, 24, 'Giày Air Jordan 2 Retro', 'giay-air-jordan-2-retro', 'Thiết kế cổ điển lấy cảm hứng từ những đôi giày bóng rổ thập niên 80.\nChất liệu da cao cấp được gia công tỉ mỉ, mang đến vẻ ngoài sang trọng và lịch lãm.\nCông nghệ đệm Air-Sole giúp giảm chấn và mang lại sự thoải mái khi di chuyển.\nĐây là lựa chọn lý tưởng cho những người yêu thích phong cách retro và muốn sở hữu một đôi giày đẳng cấp.', b'1'),
(12, 3, 25, 'Giày Puma Court Rider', 'giay-puma-court-rider', 'Thiết kế dành riêng cho bộ môn bóng rổ, mang đến sự hỗ trợ và hiệu suất tối đa.\nChất liệu vải lưới thoáng khí giúp giữ cho đôi chân luôn khô ráo và thoải mái.\nĐế ngoài bằng cao su có độ bám sân tốt, giúp bạn tự tin di chuyển trên mọi bề mặt.\nPhù hợp cho cả tập luyện và thi đấu bóng rổ.', b'1'),
(10, 1, 26, 'Giày Nike Air Max 97 SE', 'giay-nike-air-max-97-se', 'Thiết kế gợn sóng đặc trưng lấy cảm hứng từ những đoàn tàu cao tốc của Nhật Bản.\nChất liệu da và vải tổng hợp cao cấp, mang đến vẻ ngoài thời trang và hiện đại.\nĐệm Air Max toàn bàn chân giúp giảm chấn và mang lại sự êm ái tối đa.\nPhù hợp với những người yêu thích phong cách thời trang độc đáo và cá tính.', b'1'),
(12, 3, 27, 'Giày Neumel GRAYBROWN Snow', 'giay-neumel-graybrown-snow', 'Giày boot ấm áp với chất liệu da lộn cao cấp, mang đến vẻ ngoài thời trang và sang trọng.\nLớp lót lông cừu mềm mại giúp giữ ấm cho đôi chân trong mùa đông.\nĐế ngoài bằng cao su có độ bám tốt, giúp bạn tự tin di chuyển trên mọi địa hình.\nPhù hợp với những người yêu thích phong cách mùa đông ấm áp và thời trang.', b'1'),
(11, 2, 28, 'Giày Luka Doncic X Air Jordan', 'giay-luka-doncic-x-air-jordan', 'Thiết kế dành riêng cho ngôi sao bóng rổ Luka Doncic, mang đến hiệu suất và phong cách đỉnh cao.\nCông nghệ tiên tiến giúp tăng cường sự hỗ trợ và ổn định khi di chuyển.\nChất liệu cao cấp mang lại độ bền và sự thoải mái tối đa.\nĐây là lựa chọn hoàn hảo cho những người yêu thích bóng rổ và muốn sở hữu một đôi', b'1'),
(11, 1, 29, 'Giày Jordan Max Aura', 'giay-jordan-max-aura', 'Thiết kế lấy cảm hứng từ những đôi giày Jordan kinh điển, mang đến vẻ ngoài mạnh mẽ và cá tính.\nChất liệu da và vải tổng hợp cao cấp, mang lại độ bền và sự thoải mái.\nĐệm Air-Sole giúp giảm chấn và mang lại sự êm ái khi di chuyển.\nPhù hợp với những người yêu thích phong cách đường phố và muốn thể hiện cá tính mạnh mẽ.', b'1'),
(14, 1, 30, 'Giày Converse Run Star Motion', 'giay-converse-run-star-motion', 'Thiết kế đế platform độc đáo, mang đến vẻ ngoài cá tính và nổi bật.\nChất liệu vải canvas bền bỉ, mang lại sự thoải mái khi di chuyển.\nĐế ngoài bằng cao su có độ bám tốt, giúp bạn tự tin di chuyển trên mọi địa hình.\nPhù hợp với những người yêu thích phong cách thời trang độc đáo và cá tính.', b'1'),
(10, 1, 31, 'Giày Nike Air Max', 'giay-nike-air-max', 'Dòng giày kinh điển với công nghệ đệm Air Max êm ái, mang đến sự thoải mái tối đa khi di chuyển.\nĐa dạng mẫu mã và màu sắc, phù hợp với nhiều phong cách thời trang khác nhau.\nChất liệu cao cấp mang lại độ bền và sự thoải mái.\nĐây là lựa chọn hoàn hảo cho những người yêu thích sự thoải mái và phong cách thời trang đa dạng.', b'1'),
(11, 1, 32, 'Giày Air Jordan DMP 1 Retro', 'giay-air-jordan-dmp-1-retro', 'Bộ sưu tập \"Defining Moments Pack\" kỷ niệm những khoảnh khắc lịch sử của Michael Jordan.\nPhối màu đen vàng sang trọng, mang đến vẻ ngoài đẳng cấp và lịch lãm.\nChất liệu da cao cấp được gia công tỉ mỉ, mang lại độ bền và sự thoải mái.\nĐây là lựa chọn lý tưởng cho những người hâm mộ Michael Jordan và muốn sở hữu một đôi giày mang tính biểu tượng.', b'1'),
(11, 5, 33, 'Giày Air Jordan 1 Low SE Coconut Milk Black ', 'giay-air-jordan-1-low-se-coconut-milk-black', '', b'1'),
(16, 2, 35, 'Dép Adidas Yeezy Slide Flax', 'dep-adidas-yeezy-slide-flax', '', b'1'),
(19, 4, 36, 'Giày New Balance Pro Court Beige Navy', 'giay-new-balance-pro-court-beige-navy', '', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `userId` int NOT NULL,
  `catId` int NOT NULL,
  `catName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `catSlug` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `lastUpdated` datetime DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`userId`, `catId`, `catName`, `catSlug`, `status`, `description`, `active`, `lastUpdated`, `createAt`) VALUES
(1, 2, 'Giày tây', 'giay-tay', b'1', '', b'1', '2025-02-26 16:00:50', '2025-02-13 23:12:19'),
(1, 4, 'Giày thể thao', 'giay-the-thao', b'1', '', b'1', '2025-02-26 16:04:18', '2025-02-14 22:45:36'),
(1, 5, 'Giày da', 'giay-da', b'1', '', b'1', '2025-02-26 15:49:23', '2025-02-18 16:11:39'),
(1, 6, 'Giày vải', 'giay-vai', b'1', '', b'1', '2025-02-26 15:59:47', '2025-02-18 16:11:56'),
(1, 15, 'Chạy bộ', 'chay-bo', b'1', '', b'1', NULL, '2025-02-27 13:23:34'),
(1, 16, 'Leo núi', 'leo-nui', b'1', '', b'1', NULL, '2025-02-27 13:23:45'),
(1, 17, 'Quần vợt', 'quan-vot', b'1', '', b'1', '2025-03-06 10:22:40', '2025-02-27 13:23:49'),
(1, 18, 'Bóng rổ', 'bong-ro', b'1', '', b'1', NULL, '2025-02-27 13:24:26'),
(1, 19, 'Sản phẩm mới nhất', 'san-pham-moi-nhat', b'1', '', b'1', NULL, '2025-02-28 14:02:33'),
(1, 20, 'Sản phẩm nổi bật', 'san-pham-noi-bat', b'1', '', b'1', NULL, '2025-02-28 14:02:46'),
(1, 21, 'Giày chạy bộ bán nhiều nhất', 'giay-chay-bo-ban-nhieu-nhat', b'1', '', b'1', NULL, '2025-02-28 14:03:02'),
(1, 22, 'Sản phẩm bán chạy', 'san-pham-ban-chay', b'1', '', b'1', NULL, '2025-02-28 14:03:38'),
(1, 24, 'Dép quai ngang', 'dep-quai-ngang', b'1', '', b'1', NULL, '2025-03-11 09:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewId` int NOT NULL,
  `proId` int NOT NULL,
  `userId` int NOT NULL,
  `rating` int NOT NULL,
  `comment` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `dateTime` datetime NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supId` int NOT NULL,
  `supName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supId`, `supName`, `email`, `address`, `phoneNumber`, `country`, `description`) VALUES
(1, 'Nike Vietnam', 'contact@nikevn.com', '123 Lê Lợi, Quận 1, HCM', '84 28 1234 5678', 'Vietnam', ''),
(2, 'Adidas China', 'sales@adidas.cn', '456 Beijing Road, Beijing', '02108765 4321', 'China', ''),
(3, 'Puma USA', 'support@puma.com', '789 Fifth Ave, New York', '12125557890', 'USA', ''),
(4, 'Bitis Việt Nam', 'bitis@bitis.com.vn', '88 Hoàng Hoa Thám, HN', '02498765432', 'Vietnam', ''),
(5, 'ASICS Japan', 'info@asics.jp', '99 Tokyo St, Tokyo', '81312345678	', 'Japan', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `birthDate` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `provider` enum('google') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `providerId` varchar(200) DEFAULT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'customer',
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `fullName`, `gender`, `birthDate`, `email`, `password`, `provider`, `providerId`, `address`, `phoneNumber`, `role`, `createAt`, `description`, `active`) VALUES
(1, 'Samsonitu', 'male', '2005-05-03', 'ssntAdmin@ssntshop.top', '$2y$10$LdzPjxzT1VyQ0csIR4i7xu9rsLAUD94HsvzaB62fotOOdMmxmKew2', NULL, NULL, '124', '0942396698', 'admin', '2025-02-11 11:04:37', '', b'1'),
(3, 'Nguyễn Minh Thuyết', 'male', '2005-03-04', 'thuyetnmpi00180@gmail.com', '$2y$10$L6BBg.JeBJmfi2zipvDwV.UzKSPgYWMXPz3prMq/DVYyM5EAYqbWC', NULL, NULL, '123', '0942396698', 'customer', '2025-02-28 09:06:02', '', b'1'),
(12, 'samsonitu Phạm', 'male', '2005-05-03', 'huan.pham3505@gmail.com', '$2y$10$j2NL3mO4xOXPelXMXjShFuZ2i0..3B9yEs7KADvC9qdEy3hDfBDWK', NULL, NULL, '124a/4', '0332601835', 'customer', '2025-03-03 16:25:53', NULL, b'1'),
(16, 'Bùi Quang Hưng3', 'male', '2005-05-01', 'huanpham030505@gmail.com', NULL, 'google', '106964118280136084457', '113B/5 phường Hiệp Hòa, thành phố Biên Hòa, tỉnh Đồng Nai\r\n ', '0123456789', 'customer', '2025-03-03 20:26:15', '', b'1'),
(19, 'Phạm Minh Anh', 'male', '2008-01-01', 'samsonitu3505@gmail.com', '$2y$10$V2zUT/a6rKbi9/iPqKMbtee79ZI2Xn2aUs/MjCVu5yOnJjFmc2NSa', NULL, NULL, '124a/4', '0332601835', 'customer', '2025-03-07 14:48:12', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `proId` int NOT NULL,
  `varId` int NOT NULL,
  `colorCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `colorName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `size` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `discount` tinyint DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`proId`, `varId`, `colorCode`, `colorName`, `quantity`, `size`, `image`, `gender`, `price`, `discount`, `status`, `createAt`, `lastUpdated`, `description`, `active`) VALUES
(13, 14, '#ec343f', 'Đỏ', 0, 40, './uploads/img/product/air-jordan-14-retro-do.webp', 'male', 2200000, 11, b'1', '2025-02-25 14:25:44', '2025-03-04 08:22:13', '', b'1'),
(13, 17, '#e2a309', 'Vàng', 100, 38, './uploads/img/product/air-jordan-14-retro-vang.webp', 'unisex', 2200000, 11, b'1', '2025-02-25 17:23:24', '2025-02-28 09:37:00', '', b'1'),
(14, 18, '#02b7d2', 'Xanh dương', 200, 40, './uploads/img/product/nike-air-max-90-ocean-xanh-duong.webp', 'unisex', 1500000, 10, b'1', '2025-02-27 16:14:57', '2025-02-28 21:15:08', '', b'1'),
(14, 20, '#38cda8', 'Xanh lá cây', 230, 40, './uploads/img/product/nike-air-max-90-ocean-xanh-la-cay.webp', 'unisex', 1500000, 10, b'1', '2025-02-28 09:46:56', '2025-02-28 21:17:21', '', b'1'),
(24, 21, '#03254d', 'Xanh dương đậm', 300, 40, './uploads/img/product/air-jordan-2-retro-xanh-duong-dam.webp', 'male', 3200000, 10, b'1', '2025-02-28 09:50:26', '2025-02-28 09:50:26', '', b'1'),
(24, 22, '#025243', 'Xanh lá đậm', 320, 40, './uploads/img/product/air-jordan-2-retro-xanh-la-dam.webp', 'male', 3200000, 10, b'1', '2025-02-28 09:51:43', '2025-02-28 21:25:20', '', b'1'),
(25, 23, '#8baed4', 'Xanh dương', 400, 38, './uploads/img/product/puma-court-rider-xanh-duong.webp', 'unisex', 2300000, 10, b'1', '2025-02-28 09:53:50', '2025-02-28 09:53:50', '', b'1'),
(25, 24, '#cd8ac7', 'Tím', 330, 37, './uploads/img/product/puma-court-rider-tim.webp', 'female', 2300000, 10, b'1', '2025-02-28 09:55:26', '2025-02-28 21:25:51', '', b'1'),
(25, 25, '#69c287', 'Xanh lá', 410, 38, './uploads/img/product/puma-court-rider-xanh-la.webp', 'unisex', 2300000, 10, b'1', '2025-02-28 09:57:05', '2025-02-28 21:26:12', '', b'1'),
(26, 26, '#314962', 'Xanh dương đậm', 200, 40, './uploads/img/product/nike-air-max-97-se-xanh-duong-dam.webp', 'male', 2800000, 10, b'1', '2025-02-28 09:59:32', '2025-02-28 09:59:32', '', b'1'),
(26, 27, '#034016', 'Xanh lá đậm', 400, 40, './uploads/img/product/nike-air-max-97-se-xanh-la-dam.webp', 'male', 2800000, 10, b'1', '2025-02-28 10:01:14', '2025-02-28 21:30:40', '', b'1'),
(27, 28, '#0253a3', 'Xanh dương', 200, 40, './uploads/img/product/neumel-graybrown-snow-xanh-duong.webp', 'male', 1800000, 10, b'1', '2025-02-28 10:04:55', '2025-02-28 10:04:55', '', b'1'),
(27, 29, '#a52f30', 'Đỏ', 300, 40, './uploads/img/product/neumel-graybrown-snow-do.webp', 'male', 1800000, 10, b'1', '2025-02-28 10:05:53', '2025-02-28 21:31:09', '', b'1'),
(27, 30, '#bf8907', 'Vàng', 500, 40, './uploads/img/product/neumel-graybrown-snow-vang.webp', 'unisex', 1800000, 10, b'1', '2025-02-28 10:06:42', '2025-02-28 21:31:25', '', b'1'),
(28, 31, '#04a6d0', 'Xanh dương', 400, 40, './uploads/img/product/luka-doncic-x-air-jordan-xanh-duong.webp', 'male', 3800000, 10, b'1', '2025-02-28 10:09:10', '2025-02-28 10:09:10', '', b'1'),
(28, 32, '#02c37e', 'Xanh lá', 200, 38, './uploads/img/product/luka-doncic-x-air-jordan-xanh-la.webp', 'male', 3800000, 10, b'1', '2025-02-28 10:10:19', '2025-02-28 21:31:49', '', b'1'),
(29, 33, '#000000', 'Đen', 500, 38, './uploads/img/product/jordan-max-aura-den.webp', 'unisex', 3200000, 12, b'1', '2025-02-28 10:12:07', '2025-02-28 10:12:07', '', b'1'),
(30, 34, '#905f3d', 'Nâu', 200, 38, './uploads/img/product/converse-star-motion-nau.webp', 'male', 4200000, 12, b'1', '2025-02-28 10:14:11', '2025-02-28 10:14:11', '', b'1'),
(31, 35, '#c7e6f6', 'Xanh dương', 300, 38, './uploads/img/product/nike-air-max-xanh-duong.webp', 'female', 3200000, 12, b'1', '2025-02-28 10:16:09', '2025-02-28 10:16:09', '', b'1'),
(31, 36, '#bdf4b9', 'Xanh lá', 380, 38, './uploads/img/product/nike-air-max-xanh-la.webp', 'female', 3200000, 10, b'1', '2025-02-28 10:17:23', '2025-02-28 21:26:39', '', b'1'),
(31, 37, '#fed5ee', 'Hồng', 480, 38, './uploads/img/product/nike-air-max-hong.webp', 'female', 3200000, 12, b'1', '2025-02-28 10:19:04', '2025-02-28 21:26:56', '', b'1'),
(32, 38, '#5cbd7c', 'Xanh lá', 500, 40, './uploads/img/product/air-jordan-dmp-1-retro-xanh-la.webp', 'male', 2200000, 13, b'1', '2025-02-28 10:26:13', '2025-02-28 10:26:32', '', b'1'),
(32, 39, '#6a9cd6', 'Xanh dương', 480, 40, './uploads/img/product/air-jordan-dmp-1-retro-xanh-duong.webp', 'male', 2200000, 12, b'1', '2025-02-28 10:28:15', '2025-02-28 21:29:59', '', b'1'),
(13, 40, '#ec343f', 'Đỏ', 500, 38, './uploads/img/product/air-jordan-14-retro-do.webp', 'male', 2200000, 12, b'1', '2025-03-02 19:14:26', '2025-03-02 19:14:26', '', b'1'),
(33, 42, '#54251c', 'Pony Tối', 150, 40, './uploads/img/product/giay_air_jordan_1_low_se_dark_pony_hf3148-10210_1ae0133019624ab78abae45e461e0e09_grande.webp', 'male', 3500000, 16, b'1', '2025-03-11 09:44:46', '2025-03-11 09:44:46', '', b'1'),
(33, 43, '#cebc93', 'Nâu Sữa', 400, 40, './uploads/img/product/giay_air_jordan_1_low_se__coconut_milk_black__hq3437-10111.webp', 'male', 3500000, 16, b'1', '2025-03-11 09:46:30', '2025-03-11 09:46:30', '', b'1'),
(35, 45, '#7c5748', 'Nâu', 500, 38, './uploads/img/product/dep_adidas_yeezy_slide_flax_fz58967_b2d27f2edd2b4802bdea606a6988cb83_grande.webp', 'unisex', 450000, 8, b'1', '2025-03-11 09:57:13', '2025-03-11 09:58:17', '', b'1'),
(36, 46, '#d9cbbd', 'Da', 100, 38, './uploads/img/product/giay_new_balance_pro_court_beige_navy_proctccf__3__4c91e81dbd7a47c0b00501dd2ef8ea42_grande.webp', 'unisex', 2450000, 27, b'1', '2025-03-11 10:03:14', '2025-03-11 10:03:14', '', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `proId` int NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`id`, `userId`, `proId`, `createAt`) VALUES
(20, 16, 30, '2025-03-09 15:06:45'),
(21, 16, 28, '2025-03-09 15:06:49'),
(22, 16, 14, '2025-03-09 15:06:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapping_pro_cat`
--
ALTER TABLE `mapping_pro_cat`
  ADD PRIMARY KEY (`mpId`),
  ADD KEY `proID` (`proId`,`catId`),
  ADD KEY `catID` (`catId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`),
  ADD KEY `newsCatId` (`newsCatId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `news_category`
--
ALTER TABLE `news_category`
  ADD PRIMARY KEY (`newsCatId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderCode`),
  ADD KEY `proID` (`proId`),
  ADD KEY `custID` (`userId`),
  ADD KEY `varID` (`varId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`proId`),
  ADD KEY `brandID` (`brandId`),
  ADD KEY `supId` (`supId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`catId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `proID` (`proId`,`userId`),
  ADD KEY `custID` (`userId`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`varId`),
  ADD KEY `proID` (`proId`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proId` (`proId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mapping_pro_cat`
--
ALTER TABLE `mapping_pro_cat`
  MODIFY `mpId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news_category`
--
ALTER TABLE `news_category`
  MODIFY `newsCatId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `proId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `catId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `varId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mapping_pro_cat`
--
ALTER TABLE `mapping_pro_cat`
  ADD CONSTRAINT `mapping_pro_cat_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `product_category` (`catId`),
  ADD CONSTRAINT `mapping_pro_cat_ibfk_2` FOREIGN KEY (`proId`) REFERENCES `product` (`proId`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`newsCatId`) REFERENCES `news_category` (`newsCatId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `news_category`
--
ALTER TABLE `news_category`
  ADD CONSTRAINT `news_category_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`proId`) REFERENCES `product` (`proId`),
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`varId`) REFERENCES `variant` (`varId`),
  ADD CONSTRAINT `order_ibfk_5` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brand` (`brandId`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`supId`) REFERENCES `supplier` (`supId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`proId`) REFERENCES `product` (`proId`),
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `variant`
--
ALTER TABLE `variant`
  ADD CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`proId`) REFERENCES `product` (`proId`);

--
-- Constraints for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `wish_list_ibfk_1` FOREIGN KEY (`proId`) REFERENCES `product` (`proId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
