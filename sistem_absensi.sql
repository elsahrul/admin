-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2021 at 10:41 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen_manual`
--

CREATE TABLE `absen_manual` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `status_absen` varchar(250) NOT NULL,
  `jam_masuk` varchar(250) NOT NULL,
  `jam_pulang` varchar(250) NOT NULL,
  `tanggal_absen` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen_manual`
--

INSERT INTO `absen_manual` (`id`, `id_pegawai`, `status_absen`, `jam_masuk`, `jam_pulang`, `tanggal_absen`) VALUES
(6, 26, '2', '-', '-', '2021-08-04'),
(7, 8, '2', '-', '-', '2021-08-04'),
(8, 21, '2', '-', '-', '2021-08-04'),
(10, 21, '3', '-', '-', '2021-08-18'),
(21, 35, '2', '-', '-', '2021-08-18'),
(24, 38, '3', '-', '-', '2021-08-15'),
(25, 39, '4', '-', '-', '2021-08-15'),
(26, 40, '3', '-', '-', '2021-08-15'),
(27, 41, '2', '-', '-', '2021-08-15'),
(48, 26, '3', '-', '-', '2021-08-18'),
(49, 27, '2', '-', '-', '2021-08-18'),
(50, 28, '3', '-', '-', '2021-08-18'),
(51, 29, '4', '-', '-', '2021-08-18'),
(52, 30, '1', '-', '-', '2021-08-18'),
(53, 31, '1', '-', '-', '2021-08-18'),
(54, 32, '1', '-', '-', '2021-08-18'),
(55, 33, '5', '-', '-', '2021-08-18'),
(56, 41, '3', '-', '-', '2021-08-18'),
(57, 34, '1', '-', '-', '2021-08-18'),
(58, 36, '3', '-', '-', '2021-08-18'),
(59, 37, '4', '-', '-', '2021-08-18'),
(60, 38, '2', '-', '-', '2021-08-18'),
(61, 39, '2', '-', '-', '2021-08-18'),
(62, 40, '4', '-', '-', '2021-08-18'),
(64, 8, '2', '-', '-', '2021-07-01'),
(66, 7, '2', '-', '-', '2021-07-01'),
(69, 26, '5', '-', '-', '2021-07-01'),
(70, 27, '6', '-', '-', '2021-07-01'),
(71, 28, '6', '-', '-', '2021-07-01'),
(72, 29, '6', '-', '-', '2021-07-01'),
(73, 30, '4', '-', '-', '2021-07-01'),
(74, 31, '3', '-', '-', '2021-07-01'),
(75, 32, '5', '-', '-', '2021-07-01'),
(76, 33, '2', '-', '-', '2021-07-01'),
(77, 34, '2', '-', '-', '2021-07-01'),
(78, 35, '2', '-', '-', '2021-07-01'),
(79, 36, '4', '-', '-', '2021-07-01'),
(80, 37, '5', '-', '-', '2021-07-01'),
(81, 38, '3', '-', '-', '2021-07-01'),
(82, 39, '4', '-', '-', '2021-07-01'),
(83, 40, '3', '-', '-', '2021-07-01'),
(84, 41, '2', '-', '-', '2021-07-01'),
(85, 7, '3', '-', '-', '2021-07-01'),
(86, 21, '2', '-', '-', '2021-07-01'),
(89, 26, '4', '-', '-', '2021-07-02'),
(90, 27, '4', '-', '-', '2021-07-02'),
(91, 28, '4', '-', '-', '2021-07-02'),
(92, 29, '4', '-', '-', '2021-07-02'),
(93, 25, '2', '-', '-', '2021-07-03'),
(94, 26, '2', '-', '-', '2021-07-03'),
(95, 27, '2', '-', '-', '2021-07-03'),
(96, 28, '2', '-', '-', '2021-07-03'),
(97, 29, '2', '-', '-', '2021-07-03'),
(99, 26, '3', '-', '-', '2021-07-04'),
(100, 27, '3', '-', '-', '2021-07-04'),
(101, 28, '3', '-', '-', '2021-07-04'),
(102, 29, '3', '-', '-', '2021-07-04'),
(103, 25, '4', '-', '-', '2021-07-05'),
(104, 26, '4', '-', '-', '2021-07-05'),
(105, 27, '4', '-', '-', '2021-07-05'),
(106, 28, '4', '-', '-', '2021-07-05'),
(107, 29, '4', '-', '-', '2021-07-05'),
(109, 26, '5', '-', '-', '2021-07-06'),
(110, 27, '5', '-', '-', '2021-07-06'),
(111, 28, '5', '-', '-', '2021-07-06'),
(112, 29, '5', '-', '-', '2021-07-06'),
(113, 25, '6', '-', '-', '2021-07-07'),
(114, 26, '6', '-', '-', '2021-07-07'),
(115, 27, '6', '-', '-', '2021-07-07'),
(116, 28, '6', '-', '-', '2021-07-07'),
(117, 29, '6', '-', '-', '2021-07-07'),
(119, 26, '2', '-', '-', '2021-07-08'),
(120, 27, '2', '-', '-', '2021-07-08'),
(121, 28, '2', '-', '-', '2021-07-08'),
(122, 29, '2', '-', '-', '2021-07-08'),
(124, 26, '4', '-', '-', '2021-07-09'),
(125, 27, '4', '-', '-', '2021-07-09'),
(126, 28, '4', '-', '-', '2021-07-09'),
(127, 29, '4', '-', '-', '2021-07-09'),
(128, 42, '2', '-', '-', '2021-08-23'),
(130, 21, '2', '-', '-', '2021-09-10'),
(131, 21, '2', '-', '-', '2021-09-28'),
(133, 26, '1', '04:50', '', '2021-10-03'),
(134, 26, '2', '', '', '2021-10-02'),
(136, 26, '2', '-', '-', '2021-10-04'),
(137, 42, '2', '-', '-', '2021-10-04'),
(138, 27, '2', '-', '-', '2021-10-04'),
(139, 29, '4', '-', '-', '2021-10-04'),
(140, 28, '6', '-', '-', '2021-10-05'),
(141, 29, '4', '-', '-', '2021-10-05'),
(142, 21, '2', '-', '-', '2021-10-05'),
(143, 46, '3', '-', '-', '2021-10-05'),
(144, 43, '2', '-', '-', '2021-10-05'),
(145, 28, '3', '-', '-', '2021-10-14'),
(146, 26, '1', '10:00', '', '2021-10-14'),
(147, 49, '3', '-', '-', '2021-10-14'),
(148, 49, '2', '-', '-', '2021-10-15'),
(149, 42, '2', '-', '-', '2021-10-15'),
(150, 26, '2', '-', '-', '2021-10-15'),
(151, 42, '1', '07.00', '05.00', '2021-07-01'),
(152, 42, '1', '07:00', '05:00', '2021-07-02'),
(153, 42, '1', '07:00', '17:00', '2021-07-03'),
(154, 42, '1', '07:00', '17:00', '2021-07-04'),
(155, 42, '2', '-', '-', '2021-07-05'),
(156, 42, '1', '07:00', '17:00', '2021-07-06'),
(157, 42, '1', '07:00\r\n', '17:00', '2021-07-07'),
(158, 42, '1', '07:00', '17:00', '2021-07-08'),
(159, 42, '1', '07:00', '17:00', '2021-07-09'),
(161, 42, '1', '07:00', '17:00', '2021-08-02'),
(162, 42, '1', '07:00\r\n', '17:00', '2021-08-03'),
(163, 42, '1', '07:00', '17:00', '2021-08-04'),
(164, 42, '1', '07:00', '17:00', '2021-08-05'),
(165, 42, '1', '07:00', '17:00', '2021-08-06'),
(168, 42, '1', '07:00', '17:00', '2021-08-09'),
(169, 42, '1', '07:00', '17:00', '2021-08-10'),
(170, 42, '1', '07:00\r\n', '17:00', '2021-08-12'),
(171, 42, '1', '07:00', '17:00', '2021-08-13'),
(174, 42, '1', '07:00', '17:00', '2021-08-16'),
(175, 42, '1', '07:00', '17:00', '2021-08-18'),
(176, 42, '1', '07:00', '17:00', '2021-08-19'),
(177, 42, '1', '07:00', '17:00', '2021-08-20'),
(180, 42, '3', '-', '-', '2021-08-24'),
(181, 42, '1', '07:00', '17:00', '2021-08-25'),
(182, 42, '1', '07:00', '17:00', '2021-08-26'),
(183, 42, '1', '07:00', '17:00\r\n', '2021-08-27'),
(184, 42, '6', '-', '-', '2021-08-30'),
(185, 42, '6', '-', '-', '2021-08-31'),
(186, 49, '1', '07:00', '17:00', '2021-08-02'),
(187, 49, '1', '07:00', '17:00', '2021-08-03'),
(188, 49, '1', '07:00', '17:00', '2021-08-04'),
(189, 49, '1', '07:00', '17:00', '2021-08-05'),
(190, 49, '1', '07:00', '17:00', '2021-08-06'),
(191, 49, '1', '07:00', '17:00', '2021-08-09'),
(192, 49, '1', '07:00', '17:00', '2021-08-10'),
(193, 49, '1', '07:00', '17:00', '2021-08-12'),
(194, 49, '1', '07:00', '17:00', '2021-08-13'),
(195, 49, '3', '-', '-', '2021-08-16'),
(196, 49, '1', '07:00', '17:00', '2021-08-18'),
(197, 49, '1', '07:00', '17:00', '2021-08-19'),
(198, 49, '3', '-', '-', '2021-08-20'),
(199, 49, '1', '07:00', '17:00', '2021-08-23'),
(200, 49, '1', '07:00', '17:00', '2021-08-24'),
(201, 49, '1', '07:00', '17:00', '2021-08-25'),
(202, 49, '1', '07:00', '17:00', '2021-08-26'),
(203, 49, '1', '07:00', '17:00', '2021-08-27'),
(204, 49, '1', '07:00', '17:00', '2021-08-30'),
(205, 49, '1', '07:00', '17:00', '2021-08-31'),
(206, 29, '1', '07:00', '17:00', '2021-08-02'),
(207, 29, '1', '07:00', '17:00', '2021-08-03'),
(208, 29, '1', '07:00', '17:00', '2021-08-04'),
(209, 29, '1', '07:00', '17:00', '2021-08-05'),
(210, 29, '1', '07:00', '17:00', '2021-08-06'),
(211, 29, '1', '07:00', '17:00', '2021-08-09'),
(212, 29, '1', '07:00', '17:00', '2021-08-10'),
(213, 29, '1', '07:00', '17:00', '2021-08-12'),
(214, 29, '1', '07:00', '17:00', '2021-08-13'),
(215, 29, '1', '07:00', '17:00', '2021-08-16'),
(216, 29, '1', '07:00', '17:00', '2021-08-19'),
(217, 29, '1', '07:00', '17:00', '2021-08-20'),
(218, 26, '1', '07:00', '17:00', '2021-08-23'),
(219, 29, '1', '07:00', '17:00', '2021-08-24'),
(220, 29, '1', '07:00', '17:00', '2021-08-25'),
(221, 29, '1', '07:00', '17:00', '2021-08-26'),
(222, 29, '1', '07:00', '17:00', '2021-08-27'),
(223, 29, '1', '07:00', '17:00', '2021-08-23'),
(224, 29, '1', '07:00', '17:00', '2021-08-30'),
(225, 29, '1', '07:00', '17:00', '2021-08-31'),
(226, 26, '1', '07:00', '17:00', '2021-08-02'),
(228, 26, '1', '07:00', '17:00', '2021-08-05'),
(229, 26, '1', '07:00', '17:00', '2021-08-06'),
(230, 26, '1', '07:00', '17:00', '2021-08-09'),
(232, 26, '1', '07:00', '17:00', '2021-08-03'),
(236, 26, '1', '07:00', '17:00', '2021-08-10'),
(237, 26, '1', '07:00', '17:00', '2021-08-12'),
(238, 26, '1', '07:00', '17:00', '2021-08-13'),
(239, 26, '1', '07:00', '17:00', '2021-08-16'),
(240, 26, '1', '07:00', '17:00', '2021-08-19'),
(241, 26, '1', '07:00', '17:00', '2021-08-20'),
(242, 26, '1', '07:00', '17:00', '2021-08-24'),
(243, 26, '1', '07:00', '17:00', '2021-08-25'),
(244, 26, '1', '07:00', '17:00', '2021-08-26'),
(245, 26, '1', '07:00', '17:00', '2021-08-27'),
(246, 26, '1', '07:00', '17:00', '2021-08-30'),
(247, 26, '1', '07:00', '17:00', '2021-08-31'),
(248, 27, '1', '07:00', '17:00', '2021-08-03'),
(249, 27, '1', '07:00', '17:00', '2021-08-02'),
(250, 27, '1', '07:00', '17:00', '2021-08-04'),
(251, 27, '1', '07:00', '17:00', '2021-08-05'),
(252, 27, '1', '07:00', '17:00', '2021-08-06'),
(253, 27, '2', '-', '-', '2021-08-09'),
(254, 27, '2', '-', '-', '2021-08-10'),
(255, 27, '1', '07:00', '17:00', '2021-08-12'),
(256, 27, '1', '07:00', '17:00', '2021-08-13'),
(257, 27, '1', '07:00', '17:00', '2021-08-16'),
(258, 27, '1', '07:00', '17:00', '2021-08-19'),
(259, 27, '1', '07:00', '17:00', '2021-08-20'),
(260, 27, '1', '07:00', '17:00', '2021-08-23'),
(261, 27, '1', '07:00', '17:00', '2021-08-24'),
(262, 27, '1', '07:00', '17:00', '2021-08-25'),
(263, 27, '1', '07:00', '17:00', '2021-08-27'),
(264, 27, '1', '07:00', '17:00', '2021-08-26'),
(265, 27, '1', '07:00', '17:00', '2021-08-30'),
(266, 27, '1', '07:00', '17:00', '2021-08-31'),
(267, 28, '1', '07:00', '17:00', '2021-08-02'),
(268, 28, '1', '07:00', '17:00', '2021-08-03'),
(269, 28, '1', '07:00', '17:00', '2021-08-04'),
(270, 28, '1', '07:00', '17:00', '2021-08-05'),
(271, 28, '1', '07:00', '17:00', '2021-08-06'),
(272, 28, '1', '07:00', '17:00', '2021-08-09'),
(273, 28, '1', '07:00', '17:00', '2021-08-10'),
(274, 28, '1', '07:00', '17:00', '2021-08-12'),
(275, 28, '1', '07:00', '17:00', '2021-08-13'),
(276, 28, '1', '07:00', '17:00', '2021-08-16'),
(277, 28, '1', '07:00', '17:00', '2021-08-19'),
(278, 28, '1', '07:00', '17:00', '2021-08-20'),
(279, 28, '1', '07:00', '17:00', '2021-08-23'),
(280, 28, '1', '07:00', '17:00', '2021-08-24'),
(281, 28, '1', '07:00', '17:00', '2021-08-25'),
(282, 28, '1', '07:00', '17:00', '2021-08-26'),
(283, 28, '1', '07:00', '17:00', '2021-08-27'),
(284, 28, '1', '07:00', '17:00', '2021-08-30'),
(285, 28, '1', '07:00', '17:00', '2021-08-31'),
(286, 35, '1', '07:00', '17:00', '2021-08-02'),
(287, 35, '1', '07:00', '17:00', '2021-08-03'),
(288, 35, '1', '07:00', '17:00', '2021-08-04'),
(289, 35, '1', '07:00', '17:00', '2021-08-05'),
(290, 35, '1', '07:00', '17:00', '2021-08-06'),
(291, 35, '1', '07:00', '17:00', '2021-08-09'),
(292, 35, '1', '07:00', '17:00', '2021-08-10'),
(293, 35, '1', '07:00', '17:00', '2021-08-12'),
(294, 35, '1', '07:00', '17:00', '2021-08-13'),
(295, 35, '1', '07:00', '17:00', '2021-08-16'),
(296, 35, '1', '07:00', '17:00', '2021-08-19'),
(297, 35, '1', '07:00', '17:00', '2021-08-20'),
(298, 35, '1', '07:00', '17:00', '2021-08-23'),
(299, 35, '1', '07:00', '17:00', '2021-08-24'),
(300, 35, '1', '07:00', '17:00', '2021-08-25'),
(301, 35, '1', '07:00', '17:00', '2021-08-26'),
(302, 35, '1', '07:00', '17:00', '2021-08-27'),
(303, 35, '1', '07:00', '17:00', '2021-08-30'),
(304, 35, '1', '07:00', '17:00', '2021-08-31'),
(305, 33, '1', '07:00', '17:00', '2021-08-02'),
(306, 33, '1', '07:00', '17:00', '2021-08-03'),
(307, 33, '1', '07:00', '17:00', '2021-08-04'),
(308, 33, '1', '07:00', '17:00', '2021-08-05'),
(309, 33, '1', '07:00', '17:00', '2021-08-06'),
(310, 33, '1', '07:00', '17:00', '2021-08-09'),
(311, 33, '1', '07:00', '17:00', '2021-08-10'),
(312, 33, '1', '07:00', '17:00', '2021-08-12'),
(313, 33, '1', '07:00', '17:00', '2021-08-13'),
(314, 33, '1', '07:00', '17:00', '2021-08-16'),
(315, 33, '1', '07:00', '17:00', '2021-08-19'),
(316, 33, '1', '07:00', '17:00', '2021-08-20'),
(317, 33, '1', '07:00', '17:00', '2021-08-23'),
(318, 33, '1', '07:00', '17:00', '2021-08-24'),
(319, 33, '1', '07:00', '17:00', '2021-08-25'),
(320, 33, '1', '07:00', '17:00', '2021-08-26'),
(321, 33, '1', '07:00', '17:00', '2021-08-27'),
(322, 33, '1', '07:00', '17:00', '2021-08-30'),
(323, 33, '1', '07:00', '17:00', '2021-08-31'),
(324, 32, '1', '07:00', '17:00', '2021-08-02'),
(325, 32, '1', '07:00', '17:00', '2021-08-03'),
(326, 32, '1', '07:00', '17:00', '2021-08-04'),
(327, 32, '1', '07:00', '17:00', '2021-08-05'),
(328, 32, '1', '07:00', '17:00', '2021-08-06'),
(329, 32, '1', '07:00\r\n', '17:00\r\n', '2021-08-09'),
(330, 32, '1', '07:00\r\n', '17:00\r\n', '2021-08-10'),
(331, 32, '1', '07:00\r\n', '17:00\r\n', '2021-08-12'),
(332, 32, '1', '07:00\r\n', '17:00\r\n', '2021-08-13'),
(333, 32, '1', '07:00\r\n', '17:00\r\n', '2021-08-16'),
(334, 32, '1', '07:00', '17:00', '2021-08-19'),
(335, 32, '1', '07:00', '17:00', '2021-08-20'),
(336, 32, '1', '07:00', '17:00', '2021-08-23'),
(337, 32, '1', '07:00', '17:00', '2021-08-24'),
(338, 32, '1', '07:00', '17:00', '2021-08-25'),
(339, 32, '1', '07:00', '17:00', '2021-08-26'),
(340, 32, '1', '07:00', '17:00', '2021-08-27'),
(341, 32, '1', '07:00', '17:00', '2021-08-30'),
(342, 32, '1', '07:00', '17:00', '2021-08-31'),
(343, 30, '1', '07:00', '17:00', '2021-08-02'),
(344, 30, '1', '07:00', '17:00', '2021-08-03'),
(345, 30, '1', '07:00', '17:00', '2021-08-04'),
(346, 30, '1', '07:00', '17:00', '2021-08-05'),
(347, 30, '1', '07:00', '17:00', '2021-08-06'),
(348, 30, '1', '07:00', '17:00', '2021-08-09'),
(349, 30, '1', '07:00', '17:00', '2021-08-10'),
(350, 30, '1', '07:00', '17:00', '2021-08-12'),
(351, 30, '1', '07:00', '17:00', '2021-08-13'),
(352, 30, '1', '07:00', '17:00', '2021-08-16'),
(353, 30, '1', '07:00', '17:00', '2021-08-19'),
(354, 30, '1', '07:00', '17:00', '2021-08-20'),
(355, 30, '1', '07:00', '17:00', '2021-08-23'),
(356, 30, '1', '07:00', '17:00', '2021-08-24'),
(357, 30, '1', '07:00', '17:00', '2021-08-25'),
(358, 30, '1', '07:00', '17:00', '2021-08-26'),
(359, 30, '1', '07:00', '17:00', '2021-08-27'),
(360, 30, '1', '07:00', '17:00', '2021-08-30'),
(361, 30, '1', '07:00', '17:00', '2021-08-31'),
(362, 31, '1', '07:00', '17:00', '2021-08-02'),
(363, 31, '1', '07:00', '17:00', '2021-08-03'),
(364, 31, '1', '07:00', '17:00', '2021-08-04'),
(365, 31, '1', '07:00', '17:00', '2021-08-05'),
(366, 31, '1', '07:00', '17:00', '2021-08-06'),
(367, 31, '1', '07:00', '17:00', '2021-08-09'),
(368, 31, '1', '07:00', '17:00', '2021-08-10'),
(369, 31, '1', '07:00', '17:00', '2021-08-12'),
(370, 31, '1', '07:00', '17:00', '2021-08-13'),
(371, 31, '1', '07:00', '17:00', '2021-08-16'),
(372, 31, '1', '07:00', '17:00', '2021-08-19'),
(373, 31, '1', '07:00', '17:00', '2021-08-20'),
(374, 31, '1', '07:00', '17:00', '2021-08-23'),
(375, 31, '1', '07:00', '17:00', '2021-08-24'),
(376, 31, '1', '07:00', '17:00', '2021-08-25'),
(377, 31, '1', '07:00', '17:00', '2021-08-26'),
(378, 31, '1', '07:00', '17:00', '2021-08-27'),
(379, 31, '1', '07:00', '17:00', '2021-08-30'),
(380, 31, '1', '07:00', '17:00', '2021-08-31'),
(381, 34, '1', '07:00', '17:00', '2021-08-02'),
(382, 34, '1', '07:00', '17:00', '2021-08-03'),
(383, 34, '1', '07:00', '17:00', '2021-08-04'),
(384, 34, '1', '07:00', '17:00', '2021-08-05'),
(385, 34, '1', '07:00', '17:00', '2021-08-06'),
(386, 34, '1', '07:00', '17:00', '2021-08-09'),
(387, 34, '1', '07:00', '17:00', '2021-08-10'),
(388, 34, '1', '07:00', '17:00', '2021-08-12'),
(389, 34, '1', '07:00', '17:00', '2021-08-13'),
(390, 34, '1', '07:00', '17:00', '2021-08-16'),
(391, 34, '1', '07:00', '17:00', '2021-08-19'),
(392, 34, '1', '07:00', '17:00', '2021-08-20'),
(393, 34, '1', '07:00', '17:00', '2021-08-23'),
(394, 34, '1', '07:00', '17:00', '2021-08-24'),
(395, 34, '1', '07:00', '17:00', '2021-08-25'),
(396, 34, '1', '07:00', '17:00', '2021-08-26'),
(397, 34, '1', '07:00', '17:00', '2021-08-27'),
(398, 34, '1', '07:00', '17:00', '2021-08-30'),
(399, 34, '1', '07:00', '17:00', '2021-08-31'),
(400, 42, '3', '-', '-', '2021-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `image`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '', '$2y$10$huQ3pypENLOVNzJ9/Ez7V.Zwk2kEA0wxWWktcLMGotAD4.aVnQvBm');

-- --------------------------------------------------------

--
-- Table structure for table `barcode`
--

CREATE TABLE `barcode` (
  `id` int(11) NOT NULL,
  `created_at` varchar(16) NOT NULL,
  `expired_at` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barcode`
--

INSERT INTO `barcode` (`id`, `created_at`, `expired_at`) VALUES
(1, '1635272967000', '1635277467000');

-- --------------------------------------------------------

--
-- Table structure for table `hari_libur`
--

CREATE TABLE `hari_libur` (
  `id` int(250) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hari_libur`
--

INSERT INTO `hari_libur` (`id`, `tanggal`, `keterangan`) VALUES
(16, '2021-08-11', 'Libur Tahun Baru Islam 1443 H'),
(18, '2021-08-17', 'Libur Hari Kemerdekaan RI'),
(19, '2021-10-19', 'Libur Umum (Maulid Nabi Muhammad SAW)');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(250) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status_nomor_induk` varchar(300) NOT NULL,
  `nomor_induk` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jabatan` varchar(300) NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `pendidikan_jurusan` varchar(100) NOT NULL,
  `penempatan_sebagai` varchar(300) NOT NULL,
  `status_kepegawaian` varchar(300) NOT NULL,
  `pangkat_gol` varchar(100) NOT NULL,
  `nomor_tgl_sk` varchar(100) NOT NULL,
  `pangkat_terakhir` varchar(100) NOT NULL,
  `tugas_disekolah` varchar(100) NOT NULL,
  `mengajar_mp` varchar(100) NOT NULL,
  `gambar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `status_nomor_induk`, `nomor_induk`, `email`, `password`, `jabatan`, `ttl`, `jenis_kelamin`, `pendidikan_jurusan`, `penempatan_sebagai`, `status_kepegawaian`, `pangkat_gol`, `nomor_tgl_sk`, `pangkat_terakhir`, `tugas_disekolah`, `mengajar_mp`, `gambar`) VALUES
(21, 'sahrul', 'NRPTK', '12121212', 'administrator@gmail.com', 'asasas', 'Guru', 'asasas', 'Laki-Laki', 'Pendidikan Bahasa Inggris', 'TU', 'PNS', 'asas', 'sdqsd', 'wefwef', 'qsdqs', 'dddd', 'test1.jpg'),
(26, 'Syufni Zahar, S.Pd', 'NIP', '19711019 200312 2 003', 'syufni@gmail.com', '12345', 'Guru', 'Sikapak Mudik, 19 Oktober 1971', 'Laki-Laki', 'Pendidikan Bahasa Indonesia', 'Guru', 'PNS', 'Penata Tk I /III d', '778 Tahun 2019', '17 September 2019', '30 Agustus 2010', 'Bahasa Inggris', '444812-pns-ganteng-1.jpg'),
(27, 'Shinta Soneta', 'NIP', '19790928 200312 2 007', 'shinta@gmail.com', '2wqerw', 'Guru', 'Tes', 'Perempuan', 'Pendidikan Akuntansi Ilmu Pengetahuan Sosial', 'Guru', 'PNS', 'Penata / III c', '823.5 - 111.D Tahun 2011', '30 September 2011', '8 Februari 2011', 'IPS', 'girl2.png'),
(28, 'Tri Wahyuningrum, S.Pd', 'NIP', '19671126 200502 2 001', 'tri@gmail.com', '2wqerw', 'Guru', 'Salatiga, 26 November 1967', 'Perempuan', 'Pendidikan Moral Pancasila', 'Guru', 'PNS', 'Penata Tk I /III d', '778 Tahun 2019', '01 Oktober 2019', '09 Februari 2009', 'PKN', 'girl3.png'),
(29, 'Reniwati, S.Pd', 'NIP', '19720307 200604 2 009', 'Reniwati@gmail.com', '2wqerw', 'Guru', 'Padang, 07 Maret 1972', 'Perempuan', 'Pendidikan Sejarah', 'Guru', 'PNS', 'Penata Tk I /III d', '778 Tahun 2019', '01 Oktober 2019', '01 Juli 2008', 'IPS', 'girl4.png'),
(30, 'Mahdalena, SST.Par(G.NA)', 'NRGT', '2008 01 0039', 'Mahdalena@gmail.com', '1234567', 'Guru', 'Tanjung Uban, 18 Oktober 1975', 'Perempuan', 'Perhotelan', 'Guru', 'PTK Non ASN', '-', '-', '-', '01 Juli 2008', 'Produktif Perhotelan', 'girl5.png'),
(31, 'Shabirin, S.Pi (G.NA)', 'NRGT', '2009 01 0069', 'Shabirin@gmail.com', '1234567', 'Guru', 'Kijang, 16 Februari 1970', 'Laki-Laki', 'Teknologi Hasil Perikanan', 'Guru', 'PTK Non ASN', '-', '-', '-', '01 Agustus 2008', 'Seni Budaya', '444812-pns-ganteng-3.jpg'),
(32, 'Haryono, S.Pdi(G.NA)', 'NRGT', '2009 01 0025', 'Haryono@gmail.com', '1234567', 'Guru', 'Tembeling, 03 Agustus 1979', 'Laki-Laki', 'Pendidikan Bahasa Inggris', 'Guru', 'PTK Non ASN', '-', '-', '-', '01 Agustus 2008', 'Bahasa Inggris', '444812-pns-ganteng-2.jpg'),
(33, 'Farida Juliana Lubis, S.Pd (G.NA)', 'NRGT', '2010 02 0128', 'Farida@gmail.com', '1234567', 'Guru', 'Haunatas, 25 Juli 1980', 'Perempuan', 'Pendidikan Tata Busana', 'Guru', 'PTK Non ASN', '-', '-', '-', '01 Februari 2010', 'produktif Tata Busana', 'girl11.png'),
(34, 'Syofranita, S.Pd (G.NA)', 'NRGT', '2010 02 0400', 'Syofranita@gmail.com', '1234567', 'Guru', 'Jakarta, 14 Desember 1980', 'Perempuan', 'Ekonomi Akuntansi', 'Guru', 'PTK Non ASN', '-', '-', '-', '02 Februari 2010', 'Akuntansi', 'girl21.png'),
(35, 'Nurbatias, S.Pd (G.HK)', 'NIP', '19711001 200502 1 001', 'Nurbatias@gmail.com', '1234567', 'Guru', 'Desa Sungai Geringging, 01 Oktober 1971', 'Perempuan', 'Pendidikan Seni Rupa dan Kerajinan', 'Guru', 'Honor Komite', 'Pembina - IV/a', '368 Tahun 2017', '31 Maret 2017', '01 Juli 2020', 'Seni Rupa', 'girl31.png'),
(36, 'Sri Suwartini (T.PNS)', 'NIP', '19640504 199203 2 008', 'Suwartini@gmail.com', '1234567', 'Pelaksana KTU', 'Kendal, 04 Mei 1964', 'Perempuan', 'SMEA', 'TU', 'PNS', 'Penata III/c', '823.5 - 59 Tahun 2015', '31 Maret 2015', '22 Maret 2013', 'Koordinator Tata Usaha', 'girl6.png'),
(37, 'Hafrizal, A.Md (T.HK)', 'NRGT', '2008 08 0054', 'Hafrizal@gmail.com', '1234567', 'PTK Non ASN', 'Tanjungpinang, 23 Desember 1975', 'Laki-Laki', 'Perhotelan', 'TU', 'Honor Komite', '-', '-', '-', '01 Agustus 2008', 'Produktif Perhotelan', '444812-pns-ganteng-4.jpg'),
(38, 'M. Vikry Karnadi, A.Md (Tu.HK)', 'NRGT', '2008 01 0071', 'Vikry@gmail.com', '1234567', 'PTK Non ASN', 'Tanjungpinang, 10 Agustus 1981', 'Laki-Laki', 'Manj. Inform dan Teknik Komp', 'TU', 'Honor Komite', '-', '-', '-', '01 Juli 2008', 'KKPI', '444812-pns-ganteng-5.jpg'),
(39, 'Guzparizal, A.Md (T.HK)', 'NRGT', '2017 07 1 0037', 'Guzparizal@gmail.com', '1234567', 'PTK Non ASN', 'Tanjungpinang, 27 Agustus 1992', 'Laki-Laki', 'Manajemen Informatika', 'TU', 'Honor Komite', '-', '-', '-', '13 Juli 2015', 'Komputer', '444812-pns-ganteng-6.jpg'),
(40, 'Muammad Siral Juddin, SE (T.HK)', 'NRPTK', '2017 07 1 0037', 'Siral@gmail.com', '1234567', 'PTK Non ASN', 'Resun, 22 Juni 1985', 'Laki-Laki', 'S1 Akuntansi', 'TU', 'Honor Komite', '-', '-', '-', '01 Juli 2008', 'Tata Usaha', '444812-pns-ganteng-7.jpg'),
(41, 'Noviyastuti, S.Sos (T.HM)', 'NRPTK', '2017 01 2 0371', 'Noviyastuti@gmail.com', '12345', 'PTK Non ASN', 'Tanjungpinang, 19 November 1986', 'Perempuan', 'S1 Ilmu Administrasi Negara', 'TU', 'Honor Komite', '-', '-', '-', '1 Agustus 2008', 'Tata Usaha', 'girl22.png'),
(42, 'Yayuk Sri Mulyani Rahayu, S.Pd, MM', 'NIP', '19770421 200502 2 011', 'yayuksri@gmail.com', 'yayuksri123', 'Kepala Sekolah', 'Blora 21 April 1977', 'Perempuan', 'Pendidikan Baasa Indonesia', 'Kepala Sekolah', 'PNS', 'Pembina IV/a', '1160 Tahun 2020', '01 Oktober 2020', '24 Januari 2018', '-', 'girl.png'),
(43, 'cobas', 'NRGT', '121212', 'yayuksri@gmail.com', 'sdsdsdsdsd', 'sdsd', 'sdsds', 'Perempuan', 'Pendidikan Baasa Indonesia', 'Guru', 'PTK Non ASN', 'asd', 'asdss', 'asd', 'asdjssas', 'asdas', 'user11.jpeg'),
(45, 'asasas', 'NRGT', '111', 'ibnu.isbullah@gmail.com', 'asasx', 'asxasx', 'asxax', 'Perempuan', 'asxasx', 'Guru', 'PTK Non ASN', 'asxasx', 'asx', 'asx', 'asx', 'asxa', 'test12.jpg'),
(46, 'coba', 'NIP', '12121qq2', 'tes@gmail.com', '12333', 'Guru', 'fsdfsdfs', 'Perempuan', 'sdsdsds', 'TU', 'PTK Non ASN', 'dad', 'dsd', 'sdsd', 'sdsdl', 'sdsdsd', '444812-pns-ganteng-.jpg'),
(48, 'qwsasasa', 'NIP', '1212121212', 'aing@gmail.com', '$2y$10$V9IAzimlkGIxgkrrmek9i.IcVCOqyn4F.wHElDdfViXqJtvoezV4u', 'qweqw', 'sdsd', 'Perempuan', 'asas', 'Guru', 'PNS', 'asas', 'asasas', 'asasas', 'asasas', 'asasas', 'avatar1.png'),
(49, 'Juniarti, M.Pd', 'NIP', '19820607 200903 2 003', 'jumiarti@gmail.com', '$2y$10$huQ3pypENLOVNzJ9/Ez7V.Zwk2kEA0wxWWktcLMGotAD4.aVnQvBm', 'Guru', 'Kijang, 07 Juni 1982', 'Perempuan', 'Matematika', 'Wakil Kepala Sekolah', 'PNS', 'Penata III/c', '1084 Tahun 2018', '28 September 2018', '01 Maret 2009', 'Matematika', 'girl1.png');

-- --------------------------------------------------------

--
-- Table structure for table `status_absen`
--

CREATE TABLE `status_absen` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_absen`
--

INSERT INTO `status_absen` (`id`, `keterangan`) VALUES
(1, 'Hadir'),
(2, 'Sakit'),
(3, 'Izin'),
(4, 'Alpha'),
(5, 'Cuti'),
(6, 'Dinas Luar');

-- --------------------------------------------------------

--
-- Table structure for table `waktu_absensi`
--

CREATE TABLE `waktu_absensi` (
  `id` int(11) NOT NULL,
  `masuk` varchar(250) NOT NULL,
  `pulang` varchar(250) NOT NULL,
  `toleransi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waktu_absensi`
--

INSERT INTO `waktu_absensi` (`id`, `masuk`, `pulang`, `toleransi`) VALUES
(1, '07:27', '08:27', '30'),
(2, '07:56', '09:57', '30'),
(3, '06:38', '11:37', '30'),
(4, '08:42', '10:44', '30'),
(5, '20:42', '22:41', '30'),
(6, '20:43', '20:43', '30'),
(7, '19:58', '20:56', '30'),
(8, '20:58', '20:58', '30'),
(9, '20:58', '20:58', '30'),
(10, '21:03', '22:03', '30'),
(11, '10:28', '00:28', '30'),
(12, '22:52', '14:50', '30'),
(13, '20:30', '17:00', '30'),
(14, '08:00', '17:00', '30'),
(15, '22:10', '13:10', '30'),
(16, '21:58', '17:00', '30'),
(17, '09:56', '17:56', '30'),
(18, '17:54', '13:59', '30'),
(19, '05:58', '17:54', '30'),
(20, '20:50', '19:50', '30'),
(21, '02:11', '05:11', '30'),
(22, '04:37', '07:37', '30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_manual`
--
ALTER TABLE `absen_manual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcode`
--
ALTER TABLE `barcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hari_libur`
--
ALTER TABLE `hari_libur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_absen`
--
ALTER TABLE `status_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waktu_absensi`
--
ALTER TABLE `waktu_absensi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen_manual`
--
ALTER TABLE `absen_manual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barcode`
--
ALTER TABLE `barcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hari_libur`
--
ALTER TABLE `hari_libur`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `status_absen`
--
ALTER TABLE `status_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `waktu_absensi`
--
ALTER TABLE `waktu_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;