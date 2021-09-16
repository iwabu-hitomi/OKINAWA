-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 9 月 16 日 13:43
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `okinawa`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `areas`
--

INSERT INTO `areas` (`id`, `name`) VALUES
(1, '沖縄本島'),
(2, '慶良間諸島'),
(3, '宮古島'),
(4, '久米島'),
(5, '石垣島'),
(6, '西表島'),
(7, '離島'),
(8, 'その他');

-- --------------------------------------------------------

--
-- テーブルの構造 `seas`
--

CREATE TABLE `seas` (
  `id` int(11) NOT NULL COMMENT 'オートインクリメント',
  `area_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `point` varchar(50) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL COMMENT '水温',
  `transparency` int(11) DEFAULT NULL COMMENT '透明度',
  `image` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '新規登録時間',
  `del_flg` tinyint(1) DEFAULT '0' COMMENT '論理名:権限(0:表示1:非表示)',
  `user_id` int(11) DEFAULT NULL,
  `latitude` varchar(100) NOT NULL COMMENT '緯度',
  `longitude` varchar(100) NOT NULL COMMENT '経度'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `seas`
--

INSERT INTO `seas` (`id`, `area_id`, `date`, `point`, `temperature`, `transparency`, `image`, `comment`, `create_at`, `del_flg`, `user_id`, `latitude`, `longitude`) VALUES
(5, 5, '2020-12-28', '伊原間', 22, 35, './images/1354928006612a6917285e88.29365505.JPG', 'マンタ一枚ゲット！\r\n綺麗！', '2021-08-18 21:49:35', 0, 7, '24.507287271334533', '124.2846703242835'),
(8, 3, '2020-01-02', '魔王の宮殿', 20, 30, './images/1439484574611d045730a328.19638613.JPG', '水深が深く、海がめちゃくちゃ青い！', '2021-08-18 22:00:07', 0, 9, '24.871086729102263', '125.44367298602269'),
(10, 2, '2019-10-17', '渡嘉敷', 21, 35, './images/1109143493611d0f211b1cd3.86409401.JPG', '亀ちゃん', '2021-08-18 22:46:09', 0, 9, '26.18323093340148', '127.37130735506913'),
(27, 3, '2019-10-17', '魔王の宮殿', 15, 1, './images/11163523306120fd25b93001.89805998.JPG', '水深も深く、洞窟の中から外を見るとすごく青くて神秘的で、癒されます！', '2021-08-21 22:18:29', 0, 9, '24.770140535230517', '125.41272712130514'),
(28, 5, '2019-10-17', '伊原間', 20, 30, './images/20972946726121026b0789b1.52140604.JPG', 'ウミウシ祭りでした！', '2021-08-21 22:34:24', 0, 7, '24.494982408638894', '124.28565636793083'),
(30, 7, '2020-01-03', '波照間', 19, 30, './images/1201629666612bb7dbd49b23.36786069.JPG', '波照間の海最高！\r\n海の中から空を見上げて雲の形が出るくらい綺麗です！', '2021-08-23 00:08:49', 0, 7, '24.075882404860558', '123.77017024496965'),
(31, 2, '2019-07-30', '座間味', 19, 18, './images/12819592156122697e1d0eb8.74830471.JPG', '座間味島最高！\r\nニモものびのびと過ごしてました〜', '2021-08-23 00:13:02', 0, 7, '26.21898803870566', '127.32424339712348'),
(32, 2, '2019-10-17', '黒島', 15, 1, './images/52093405612bb21f47d333.61272932.JPG', 'ウツボゲット！\r\nかわいい〜\r\nこの後警戒したのか引っ込んでしまいました！', '2021-08-30 01:13:19', 0, 7, '26.23166842916504', '127.36617549878909'),
(38, 7, '2019-07-30', '波照間', 23, 20, './images/110872456613215ac939d87.75244871.JPG', '波照間島の海は、透明度が非常に高く、海も砂地が多くて真っ白でどこみても何にもなく、すごく綺麗でした。\r\n魚を楽しむのもそうですが、まっさらな砂地で地形を楽しむのも良いです！', '2021-09-03 21:31:40', 0, 7, '24.053453245382933', '123.81476099875643'),
(39, 4, '2019-07-30', '黒島', 21, 20, './images/188881642561371c728adad1.23357901.JPG', '亀を見た！', '2021-09-07 17:01:54', 0, 9, '26.45191785886394', '127.69929783403472');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'オートインクリメント',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL COMMENT 'パスワードはハッシュ 化 or 暗号化を行う',
  `role` int(11) DEFAULT '0' COMMENT '管理者は0',
  `passreset` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `passreset`) VALUES
(7, '山田花子', 'test@test.com', '$2y$10$2TwbL6vcLbsdgOOQy1bns.4fayfEWLB9toy3pVQDkhUwR5eRQ7syW', 0, '0'),
(9, '田中太郎', 'hitomiiiin3@gmail.com', '$2y$10$N6vStHbcjg1U6U/95la0r.itE2rT/wPQNiAR.tYq2kqGozGj2lwsy', 1, '842');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `seas`
--
ALTER TABLE `seas`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `seas`
--
ALTER TABLE `seas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'オートインクリメント', AUTO_INCREMENT=40;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'オートインクリメント', AUTO_INCREMENT=10;
