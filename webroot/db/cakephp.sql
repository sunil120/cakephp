-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2016 at 07:56 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
/*http://www.roundcubeforum.net/index.php?topic=3957.0*/
/*localhost/roundcubemail-1.2.5/index.php?_autologin=1*/

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cakephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `thumb_link` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `link`, `thumb_link`, `created`) VALUES
(2, 'with colorful flowers.', 'https://static.pexels.com/photos/909/flowers-garden-colorful-colourful.jpg', '', '2016-04-07 08:06:52'),
(3, 'with colorful flowers.', 'https://static.pexels.com/photos/909/flowers-garden-colorful-colourful.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQlHpK3ZKZC_fUpAE8j28U19WXRm1yeFPiZE5S6e_ZA7l5tR_bP2smtSnM', '2016-04-07 08:09:17'),
(4, 'Flower - Wikipedia, the free', 'https://upload.wikimedia.org/wikipedia/commons/a/a5/Flower_poster_2.jpg', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRGb_vIs7amfthit4Txp802rtdRy9q5OXIH_T_wNu5YXrLn0qgfjSfxwdw', '2016-04-07 08:09:17'),
(5, 'Two Dozen Rainbow Roses', 'http://cimages.prvd.com/is/image/ProvideCommerce/PF_14_R205_MINIMAL_VA0211_W1_SQ?$PFCProductImage$', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRjF-DlC1EgWPKU2HEWeqOPhfVQ0zJ9ZfaSWXS9qff2eaXsVwMT97clJQ1_Xw', '2016-04-07 08:09:17'),
(6, 'romantic, flowers, gift', 'https://static.pexels.com/photos/4825/red-love-romantic-flowers.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcS9dXDzPURAgaTpR_gAqFFoMhs9jp1GxvJQwBHrvvpr5mjobOfCspJo1PE', '2016-04-07 08:09:17'),
(7, 'Various flowers from different', 'https://upload.wikimedia.org/wikipedia/commons/7/75/Flowers-of-Israel-ver006.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcT45CPQ6h_LzoHsWvQo-60_tnBsPvU09kGeYLE9WRirpCLH6SKROMCp92In', '2016-04-07 08:09:17'),
(8, 'Photo Gallery of «Flowers»:', 'http://dreamatico.com/data_images/flowers/flowers-4.jpg', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQo2dLrYRWB70GK1her_LqWEo2uX5ame81oZyMR9pesARwyA5HVs2o7noU6', '2016-04-07 08:09:18'),
(9, 'photo of nature, flowers,', 'https://static.pexels.com/photos/33013/pexels-photo.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTGC4M1OkgO-CKPSUkZKE-G-ao9J3Yy26ZkAzwfiriAUgIcupjVV7PmzP8', '2016-04-07 08:09:18'),
(10, 'Annual Flower Seeds & Plants', 'http://demandware.edgesuite.net/abaq_prd/on/demandware.static/-/Sites-siteCatalog_Burpee_US/default/dw36abd958/Category%20Content%20Images/CLP%20Flowers/CATID-3840_Container-flowers.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEB9Kr9GwnWws9Jm6zDZNctmKXa7jGP26DKY8AkeGj7pV7rauKdBEWK4g', '2016-04-07 08:09:18'),
(11, 'Hawaiian flower: Pua Melia', 'https://s-media-cache-ak0.pinimg.com/736x/12/64/da/1264da4a3f18207dc22592102abae40d.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTwn6Y6puwGEpRGY_w2h9OPijdKgEIffT-8loSgq46uhnFjv7mIVOf4Oovx', '2016-04-07 08:09:18'),
(12, 'loveliness of flowers,', 'http://science-all.com/images/flowers/flowers-05.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRyanDf4ZWUGz9bSav9151src9FFVjck70Mbyc_RPboLEBIQnYSlOYQ98WU', '2016-04-07 08:09:18'),
(13, 'with colorful flowers.', 'https://static.pexels.com/photos/909/flowers-garden-colorful-colourful.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQlHpK3ZKZC_fUpAE8j28U19WXRm1yeFPiZE5S6e_ZA7l5tR_bP2smtSnM', '2016-04-07 08:10:18'),
(14, 'Flower - Wikipedia, the free', 'https://upload.wikimedia.org/wikipedia/commons/a/a5/Flower_poster_2.jpg', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRGb_vIs7amfthit4Txp802rtdRy9q5OXIH_T_wNu5YXrLn0qgfjSfxwdw', '2016-04-07 08:10:18'),
(15, 'Two Dozen Rainbow Roses', 'http://cimages.prvd.com/is/image/ProvideCommerce/PF_14_R205_MINIMAL_VA0211_W1_SQ?$PFCProductImage$', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRjF-DlC1EgWPKU2HEWeqOPhfVQ0zJ9ZfaSWXS9qff2eaXsVwMT97clJQ1_Xw', '2016-04-07 08:10:18'),
(16, 'romantic, flowers, gift', 'https://static.pexels.com/photos/4825/red-love-romantic-flowers.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcS9dXDzPURAgaTpR_gAqFFoMhs9jp1GxvJQwBHrvvpr5mjobOfCspJo1PE', '2016-04-07 08:10:18'),
(17, 'Various flowers from different', 'https://upload.wikimedia.org/wikipedia/commons/7/75/Flowers-of-Israel-ver006.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcT45CPQ6h_LzoHsWvQo-60_tnBsPvU09kGeYLE9WRirpCLH6SKROMCp92In', '2016-04-07 08:10:18'),
(18, 'Photo Gallery of «Flowers»:', 'http://dreamatico.com/data_images/flowers/flowers-4.jpg', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQo2dLrYRWB70GK1her_LqWEo2uX5ame81oZyMR9pesARwyA5HVs2o7noU6', '2016-04-07 08:10:18'),
(19, 'photo of nature, flowers,', 'https://static.pexels.com/photos/33013/pexels-photo.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTGC4M1OkgO-CKPSUkZKE-G-ao9J3Yy26ZkAzwfiriAUgIcupjVV7PmzP8', '2016-04-07 08:10:18'),
(20, 'Annual Flower Seeds & Plants', 'http://demandware.edgesuite.net/abaq_prd/on/demandware.static/-/Sites-siteCatalog_Burpee_US/default/dw36abd958/Category%20Content%20Images/CLP%20Flowers/CATID-3840_Container-flowers.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEB9Kr9GwnWws9Jm6zDZNctmKXa7jGP26DKY8AkeGj7pV7rauKdBEWK4g', '2016-04-07 08:10:18'),
(21, 'Hawaiian flower: Pua Melia', 'https://s-media-cache-ak0.pinimg.com/736x/12/64/da/1264da4a3f18207dc22592102abae40d.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTwn6Y6puwGEpRGY_w2h9OPijdKgEIffT-8loSgq46uhnFjv7mIVOf4Oovx', '2016-04-07 08:10:18'),
(22, 'loveliness of flowers,', 'http://science-all.com/images/flowers/flowers-05.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRyanDf4ZWUGz9bSav9151src9FFVjck70Mbyc_RPboLEBIQnYSlOYQ98WU', '2016-04-07 08:10:19'),
(23, '2016 10Best Cars', 'http://media.caranddriver.com/images/media/51/2016-10best-cars-lead-photo-664005-s-original.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVRFLh1WXbhB9CW1mcZRah3tvrh7In8Jib3oDWAwmmmHLV7gd-uP8Jz5q_', '2016-04-07 08:11:10'),
(24, 'Final Races to Cars Lightning', 'https://i.ytimg.com/vi/UReY2dMk1rs/maxresdefault.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOphKMtHnzZZVeeuAvgBcDyDHV6BDwuaMUyGP6cWFySaZmtvgnjtuu9NOC', '2016-04-07 08:11:10'),
(25, '2017 Ford GT', 'http://media.caranddriver.com/images/media/51/25-cars-worth-waiting-for-lp-ford-gt-photo-658253-s-original.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQf_kKvSclRQiW7MCKi6AjqYt-P0Pyed6LlxyRIbCooMNmKerovfpUFkgI', '2016-04-07 08:11:10'),
(26, '-cars-4-super-169.jpg">', 'http://i2.cdn.turner.com/cnnnext/dam/assets/150918170501-frankfurt-motor-show-concept-cars-4-super-169.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTMPNdoadjFOlvvQJcKRuBdQmaRXXaf6Oc_KgQrRxz2yi_rFkRFLoZ8sO4', '2016-04-07 08:11:10'),
(27, 'Lightning Mcqueen Cars Movie', 'http://wallpaperswide.com/download/lightning_mcqueen_cars_movie-wallpaper-1366x768.jpg', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQNn-pDRdZIbogVPiWRJKL-2w28VEVe_6w7T735genzJ2vXVRNQNN0RwabC', '2016-04-07 08:11:10'),
(28, 'Image Size: 2560x1600 px', 'http://e2ua.com/data/wallpapers/230/WDF_2664197.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJbxGQ5KeDbe6O6Kd84t2xTLvLUkFUOhIDZkCQwutklp6-G8cpTuCAuzon', '2016-04-07 08:11:10'),
(29, 'Cars Poster', 'http://ia.media-imdb.com/images/M/MV5BMTg5NzY0MzA2MV5BMl5BanBnXkFtZTYwNDc3NTc2._V1_SX640_SY720_.jpg', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSa8FNWgAT6O5wFHtT0gp76yB-WV0eRz9w3dsqlMXDrP8Mf1Q7Qu9VeAII', '2016-04-07 08:11:10'),
(30, '30 Playsets Disney Pixar Cars', 'https://i.ytimg.com/vi/0POl2fvoB0w/maxresdefault.jpg', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRKoWUFl2qXoVE3dXIAUI_fyL1M1g3v2MoZWytv1Sldk3A5f3rCeB8okeaL', '2016-04-07 08:11:10'),
(31, 'Cars - Lightning''s Off-Road', 'http://img.lum.dolimg.com/v1/images/open-uri20150422-7119-pd78ek_9a3932be.jpeg?region=0,0,450,338&width=320', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSFsBNZhHz1YVxRBrW8n49UQ-xkIKRIu0VuQhyczNIkH3DxEsOygRY-XYc', '2016-04-07 08:11:10'),
(32, 'Cars - United States', 'https://www.enterprise.com/content/dam/global-vehicle-images/cars/FORD_FOCU_2012-1.png', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRrZQa7YIHJbxbZYpDNv6cRBICOqucSV51g3gDHTB6e6CUn-SD8xN8mZik', '2016-04-07 08:11:10'),
(33, 'Management Lessons from Sachin', 'http://techstory.in/wp-content/uploads/2015/02/sachin-tendulkar-sifr-651867782.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXO4JnFnJQOO91nkm_GMJHSvNjXYnUQToZTLAup1fyk-acLzsclHq4lBym', '2016-04-07 11:40:44'),
(34, 'Sachin.Tendulkar.jpg', 'https://upload.wikimedia.org/wikipedia/commons/5/5a/Sachin.Tendulkar.jpg', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQy2yuIZsj3GNAk-AiPhJEGWRNBeQOby_d5fhY_n_niDigMfAsPBZV8rA', '2016-04-07 11:40:44'),
(35, 'sachin4.jpg', 'http://techstory.in/wp-content/uploads/2015/05/sachin4.jpg', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTWFPYY4Lg3A8lc7uawvuR0RPfyrv8yFaalM6PM69neQx_C277aTTGgsMSX', '2016-04-07 11:40:44'),
(36, 'Cover Image Source', 'http://9cric.com/wp-content/uploads/2014/01/Never-give-up-during-difficult-times-of-life-Sachin-Tendulkar-said-school-schoolkids.jpg', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTsJcL52pFSg-dAMMt-LW4pTpdfquNjVDjRxCd84MxBxIff4lIiu-3PvkE', '2016-04-07 11:40:44'),
(37, 'Sachin Tendulkar', 'http://media1.santabanta.com/full1/Cricket/Sachin%20Tendulkar/sachin-tendulkar-75v.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkClLzaxsezyCGDAcoK6tK-2_Af2SCUyTjQecCYlivVKANX1MjJVAUalMZ', '2016-04-07 11:40:44'),
(38, 'Sachin Tendulkar', 'http://media2.intoday.in/indiatoday/images/Photo_gallery/sachin-3_031812120617.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSeZ0360YX4ZVdmDjZrBUrmjKQdUbauV8hUaZhH0QbwNyls_VPr7SciL8IrHw', '2016-04-07 11:40:44'),
(39, 'Sachin Ramesh Tendulkar', 'http://static.cricinfo.com/db/PICTURES/CMS/128400/128483.1.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQ4fclYDzzWNckXYhk_gJ_J-xDRH9zZQXf396XY4zSrB2QA6IJs5s6LMg', '2016-04-07 11:40:44'),
(40, 'who Sachin Tendulkar is?', 'http://st3.cricketcountry.com/wp-content/uploads/2015/11/Sachin-Tendulkar-1.jpg', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcS4lkRhxyMYiZRqi93P9gLQb4xJuGPsbBpuypGfARKhrPM1rpShj5FjiCJr', '2016-04-07 11:40:44'),
(41, 'sachin tendulkar', 'https://pbs.twimg.com/profile_images/2504398687/344204969_400x400.jpg', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRGWwadB5r7UNGzNf_Snjph1iLrseFNIRMZ9TSVuMcRD0Qu5OT6GOyCvug', '2016-04-07 11:40:44'),
(42, 'He has scored over 1000 Test', 'http://drop.ndtv.com/albums/SPORTS/sachin38achiev/23.jpg', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTUll9xxTMSFoRotvMskn7PIrZ32Hp9KV8wni9lUGHS23vV4VImAnrZs5bt', '2016-04-07 11:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `status`) VALUES
(1, 'admin', '$2y$10$5IQX/uGxiX9bD3B.vUiTDeQLq7Y29uC2JwE.tNEP9PRgYwovX29/i', 'Sunil', 'Kumar', 1),
(2, 'skumar', '$2y$10$mK4iGXo/717dmIJViJJsReOLthnHAMjXZzL2FqPw3G8VfO.Mdn1wW', 'Sunil', 'Kumar', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
