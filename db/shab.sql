-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 14 2016 г., 02:09
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `shab`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usr` int(10) unsigned NOT NULL,
  `id_ordr` int(10) unsigned NOT NULL,
  `id_ord_owner` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`,`id_usr`,`id_ordr`),
  KEY `id_user_idx` (`id_usr`),
  KEY `id_order_idx` (`id_ordr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `bid`
--

INSERT INTO `bid` (`id`, `id_usr`, `id_ordr`, `id_ord_owner`, `date`) VALUES
(1, 4, 1, 18, '2015-11-22'),
(2, 2, 2, 18, '2015-11-22'),
(3, 28, 1, 18, '2016-01-09'),
(4, 21, 26, 22, '2016-01-13'),
(5, 21, 25, 22, '2016-01-13'),
(6, 23, 25, 22, '2016-01-13'),
(8, 30, 24, 22, '2016-01-13'),
(9, 22, 7, 18, '2016-01-13'),
(11, 31, 13, 1, '2016-01-13'),
(12, 32, 11, 18, '2016-01-13');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(90) NOT NULL,
  `picture` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `picture`) VALUES
(1, 'Сантехнические работы', 'cat1.jpg'),
(2, 'Электромонтажные работы', 'cat2.jpg'),
(3, 'Ремонт бытовой техники', 'cat3.jpg'),
(4, 'Плотницкие работы', 'cat4.jpg'),
(5, 'Отделочные работы', 'cat5.jpg'),
(6, 'Уборка помещений, территорий', 'cat6.jpg'),
(7, 'Уход и присмотр', 'cat7.jpg'),
(8, 'Кухонные работы', 'cat8.jpg'),
(9, 'Разное', 'cat9.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_order_idx` (`order_id`),
  KEY `id_user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `order_id`, `date`, `text`, `user_id`) VALUES
(1, 1, '2015-11-20 00:00:00', 'Сделаю одной левой! За 1000$', 21),
(2, 1, '2015-11-15 00:00:00', 'Приду, сделаю за 500$\r\n', 23),
(3, 3, '2015-11-02 00:00:00', 'Помогу чем смогу!', 3),
(14, 4, '2016-01-10 02:44:56', '1 комментарий', 18),
(15, 4, '2016-01-10 02:45:53', '2-ой комментарий', 18),
(16, 1, '2016-01-10 13:33:05', 'Дорого! плачу только 5р', 18),
(17, 1, '2016-01-10 13:34:46', 'А я и за 1 коп сделаю', 22),
(18, 1, '2016-01-10 13:36:23', 'Ребяты я бесплатно работаю вообще!', 23),
(19, 12, '2016-01-11 13:19:39', 'Всех с новым годом!', 1),
(20, 25, '2016-01-12 03:24:45', 'Не ужели никто не хочет подработать?', 22),
(21, 26, '2016-01-13 04:02:00', 'Мож борща!?', 21),
(22, 13, '2016-01-13 13:06:34', 'Здравствуйте, хочу выполнить ваш заказ', 31),
(23, 28, '2016-01-13 13:12:46', 'sdfghjkl', 31),
(24, 28, '2016-01-13 13:13:13', 'sdfsdf', 31),
(25, 30, '2016-01-13 13:23:41', 'плачу в долларах США!', 1),
(26, 11, '2016-01-13 15:41:34', 'хочу работать!', 32);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) DEFAULT NULL,
  `id_customer` int(10) unsigned NOT NULL,
  `text` mediumtext,
  `id_category` int(10) unsigned DEFAULT NULL,
  `title` varchar(90) NOT NULL,
  `price` int(11) DEFAULT '0',
  `id_worker` int(10) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_customer_idx` (`id_customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `status`, `id_customer`, `text`, `id_category`, `title`, `price`, `id_worker`, `date`) VALUES
(1, 0, 18, 'Вода хлестает. Пыщ-пыщ. Плачу 2к. Контакты в профиле', 1, 'Вода... кругом вода', 2000, 4, '2015-11-15 13:22:45'),
(2, 1, 18, 'Всем приветик. У МЕНЯ БЕДАА!!  Включила утюг - свет погас. Пишу с калькулятора. Срочно нужно починить. Цена договорная.', 2, 'Нет света HELP!!!', 15, 2, '2015-11-14 13:22:45'),
(3, 0, 18, 'Полная раковина посуды. Кто избавит за 500р?', 3, 'Посудка', 500, NULL, '2015-11-14 12:40:45'),
(4, 0, 1, 'Необходимо заменить 4 эл. розетки', 2, 'Замена розетки', 500, 4, '2015-11-11 13:22:45'),
(7, 0, 18, 'Убить Билла', NULL, 'advert_1', 5000, NULL, '2016-01-11 00:00:00'),
(8, 0, 18, 'Необходимо установить счетчики в ванной комнате. Плачу бакинскими долларами ', NULL, 'advert_2', 1, NULL, '2016-01-11 00:00:00'),
(9, 0, 18, 'Сломался Тэлэфон НОКИЯ. ПОчаните пжс...', NULL, 'Сломался НОКИЯ', 123, NULL, '2016-01-11 00:00:00'),
(10, 0, 18, 'Не могу смотреть футбол - телик не показывает. Он определенно не показывает только футбол. Как быть?', NULL, 'Сломался  ТЭЛЕВИЗОР', 500, NULL, '2016-01-11 00:00:00'),
(11, 1, 18, 'Нужен равшан и джумшут для выравнивания стен. С уважением, нашайника', NULL, 'advert_3', 666, 32, '2016-01-11 00:00:00'),
(12, 0, 1, 'нужно посчитать сколько будет стоит ремонт в комнате. Нужен сметчик с опытом', NULL, 'цена ремонта', 1000, NULL, '2016-01-11 00:00:00'),
(13, 1, 1, 'Сделайте мне натяжной паталок пжс', NULL, 'Хочу натяжной потолок', 10000, 31, '2016-01-11 00:00:00'),
(14, 0, 1, 'есть комната. Старая. Очень старая. Старая настолько, что одна стена просто отпала. Хочу чтобы в комнате был евроремонт. Кто умеет? ', NULL, 'ремонт в комнате под ключ', 40000, NULL, '2016-01-11 00:00:00'),
(15, 0, 19, 'ldflksjdf;aklsdf', NULL, 'advert-15', 19, NULL, '2016-01-11 00:00:00'),
(16, 0, 19, 'advert-16 and subcat 19 cat 5', NULL, 'advert-16', 19, NULL, '2016-01-11 00:00:00'),
(17, 0, 19, 'advert 17 cat 5 subcat 19', NULL, 'advert-17', 19, NULL, '2016-01-11 00:00:00'),
(18, 0, 19, 'advert 17 cat 5 subcat 19', NULL, 'advert-17', 19, NULL, '2016-01-11 00:00:00'),
(19, 0, 19, 'advert-18 subcat 19 cat 5', NULL, 'advert-18', 19, NULL, '2016-01-11 00:00:00'),
(20, 0, 19, 'advert-19 subcat 19 cat 5', NULL, 'advert-19', 19, NULL, '2016-01-11 00:00:00'),
(21, 0, 19, 'sdlkjsladkfj;sladkfjsd', NULL, 'advert-20', 19, NULL, '2016-01-11 00:00:00'),
(22, 0, 1, 'lldfjkldfj;salkdfj;asldkfja;slkdfjoweirupowedfsmnf', NULL, 'advert-21', 19, NULL, '2016-01-11 00:00:00'),
(23, 0, 1, 'qwertyuiop'';lkjhgfdsazxcvbnm,./', NULL, 'advert-22', 19, NULL, '2016-01-11 00:00:00'),
(24, 0, 22, 'Руки не доходят сделать дверь. Нужен человек умеющий это делать. Цена договорная', NULL, 'Поставьте дверь', 1000, 30, '2016-01-12 03:17:51'),
(25, 0, 22, 'Дома есть собака. Не кусается, но постоянно просится на улицу. Кто хочет получить 100р за один выгул?!', NULL, 'Собака хочет гулять)', 100, 21, '2016-01-12 03:20:01'),
(26, 1, 22, 'Мне лень готовить. А есть охота. ', NULL, 'Хочется кушать :(', 500, 21, '2016-01-12 03:22:53'),
(27, 0, 29, 'нужно положить 25 квадратов ламината. Пол ровный, покрыт фанерными листами. ', NULL, 'положить ламинат', 8000, NULL, '2016-01-12 03:39:57'),
(28, 0, 22, 'запнулся об трубу - сломал её на 2 части. Залило весь дом. Почините...', NULL, 'Сломалась труба пополам', 1000, NULL, '2016-01-13 12:17:53'),
(30, 0, 1, 'цывапролдюбьтимсыфвкерол', NULL, 'Сделать уборку в доме', 1, NULL, '2016-01-13 13:23:24');

-- --------------------------------------------------------

--
-- Структура таблицы `order_cat`
--

CREATE TABLE IF NOT EXISTS `order_cat` (
  `id_catg` int(10) unsigned NOT NULL,
  `id_subctg` int(10) unsigned NOT NULL,
  `id_order` int(10) unsigned NOT NULL,
  KEY `id_order_idx` (`id_order`),
  KEY `id_subcategory_idx` (`id_subctg`),
  KEY `id_catg` (`id_catg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_cat`
--

INSERT INTO `order_cat` (`id_catg`, `id_subctg`, `id_order`) VALUES
(2, 7, 4),
(2, 3, 3),
(1, 3, 1),
(2, 8, 1),
(2, 7, 2),
(2, 8, 2),
(2, 9, 2),
(6, 22, 7),
(6, 23, 7),
(6, 24, 7),
(1, 4, 8),
(3, 13, 9),
(3, 11, 10),
(5, 20, 11),
(5, 21, 11),
(5, 18, 12),
(5, 19, 13),
(5, 21, 14),
(5, 19, 15),
(5, 19, 16),
(5, 19, 18),
(5, 19, 19),
(5, 19, 20),
(5, 19, 21),
(5, 19, 22),
(5, 19, 23),
(4, 14, 24),
(7, 25, 25),
(8, 28, 26),
(4, 15, 27),
(1, 1, 28),
(6, 22, 30),
(6, 23, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(10) unsigned NOT NULL,
  `id_cat` int(10) unsigned NOT NULL,
  `name` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat_idx` (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subcategory`
--

INSERT INTO `subcategory` (`id`, `id_cat`, `name`) VALUES
(1, 1, 'замена труб водопровода/канализации'),
(2, 1, 'замена стояков, батарей и радиаторов'),
(3, 1, 'ремонт и установка сантехники'),
(4, 1, 'установка счетчиков'),
(5, 1, 'устранение засоров, прочистка канализаций'),
(6, 2, 'замена электропроводки'),
(7, 2, 'подключение электроприборов'),
(8, 2, 'подключение люстр, бра и т.д'),
(9, 2, 'экстренные выезды «нет света»'),
(10, 2, 'частичная замена проводки, перенос розеток и выключателей'),
(11, 3, 'ремонт домашних бытовых приборов (телевизор, пылесос, холодильник и т.п.)'),
(12, 3, 'ремонт компьютеров и переферийных устройств'),
(13, 3, 'ремонт телефонов'),
(14, 4, 'установка дверей'),
(15, 4, 'монтаж полов, паркета, ламината'),
(16, 4, 'установка и ремонт окон'),
(17, 4, 'установка/сборка мебели'),
(18, 5, 'составление смет'),
(19, 5, 'натяжные потолки'),
(20, 5, 'штукатурные работы'),
(21, 5, 'евроотделка'),
(22, 6, 'уборка квартир'),
(23, 6, 'уборка офисов'),
(24, 6, 'уборка территорий'),
(25, 7, 'уход за домашними животными'),
(26, 7, 'работа няни'),
(27, 7, 'присмотр за пристарелыми'),
(28, 8, 'приготовление пищи'),
(29, 8, 'поставка продуктов'),
(30, 8, 'мытье посуды'),
(31, 9, 'разное');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Login` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Surname` varchar(45) DEFAULT NULL,
  `Skype` varchar(45) DEFAULT NULL,
  `icq` int(10) unsigned DEFAULT NULL,
  `phone` decimal(11,0) unsigned DEFAULT NULL,
  `photo` varchar(40) DEFAULT NULL,
  `user_category` tinyint(3) unsigned NOT NULL,
  `text` text,
  `rating` int(11) DEFAULT '0',
  `orders_complete` int(10) unsigned DEFAULT NULL,
  `agr_rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`Login`),
  UNIQUE KEY `Login_UNIQUE` (`Login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `Login`, `Password`, `Name`, `Surname`, `Skype`, `icq`, `phone`, `photo`, `user_category`, `text`, `rating`, `orders_complete`, `agr_rating`) VALUES
(1, 'qwerty', 'qwerty123', 'Yasa', 'Yasilek', '12345', 345678, '23456789', NULL, 0, NULL, NULL, NULL, 10),
(2, 'ded12', 'ded123', 'Дед', 'Dedusik', NULL, NULL, '89265878544', NULL, 1, 'Могу копать. Могу не копать!', 1, 2, 10),
(3, 'mashunya@mail.ru', 'spam', 'Маша', 'Ромашкина', 'romashka', 2333, '1234567', '3.jpg', 1, 'Все могу если захочу! Платите больше буду хотеть!', 1, 2, 10),
(4, 'Profy@yandex.ru', 'profy', 'Mr.Proper', 'Утюгов', '567890', 678, '34567890', NULL, 1, 'Делаю быстро и качественно', 1, 2, 10),
(18, 'antoshka@yandex.ru', 'maestro', 'Batman', 'Егоров', 'batmanForever', 123456, '88888888', NULL, 0, NULL, NULL, NULL, 10),
(19, 'mypost@gmail.com', '21', 'Roman', 'Boggie123', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 10),
(21, 'ranger@gmail.com', '123', 'Сигизмунд', 'Петрович', NULL, NULL, NULL, NULL, 1, NULL, 1, 2, 10),
(22, 'rodster@gmail.com', '123', 'Илья', 'Кантор', NULL, NULL, NULL, NULL, 2, NULL, 1, 2, 10),
(23, 'misterX@gmail.com', '123', 'Данил', 'Морковкин', NULL, NULL, NULL, NULL, 1, NULL, 1, 2, 10),
(28, 'bumer@yahoo.com', '123', 'Михаил', 'Токорев', 'mishan-tok12', 2222222, '123555', NULL, 1, 'Зенит чемпион!!', 1, 2, 10),
(29, 'morkovka@mail.ru', '123', 'Барин', 'Ларин', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 10),
(30, 'opris@gmail.com', '123', 'opris-name', 'opris-surname', NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL),
(31, 'terkin@mail.ru', '123', 'Василий', 'Теркин', 'terkin', 123123123, '89091010101', NULL, 1, 'Нет ребята я не гордый ...', 1, 1, 5),
(32, 'tret@mail.ru', '123', 'aaa', 'rrrr', 'skype_123', 123123123, '89091010101', NULL, 1, 'sddfjasl;dkfjals;dkf', 1, 1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `user_cat`
--

CREATE TABLE IF NOT EXISTS `user_cat` (
  `id_category` int(10) unsigned NOT NULL,
  `id_subcategory` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_category`,`id_subcategory`,`id_user`),
  KEY `id_user_idx` (`id_user`),
  KEY `id_category_idx` (`id_category`),
  KEY `id_subcategory_idx` (`id_subcategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_cat`
--

INSERT INTO `user_cat` (`id_category`, `id_subcategory`, `id_user`) VALUES
(1, 4, 2),
(1, 5, 2),
(1, 12, 2),
(2, 9, 2),
(1, 1, 3),
(1, 2, 3),
(2, 6, 3),
(2, 8, 3),
(5, 20, 3),
(8, 29, 3),
(8, 30, 3),
(2, 9, 4),
(5, 19, 4),
(5, 21, 4),
(6, 22, 4),
(1, 1, 28),
(1, 3, 28),
(1, 4, 28),
(3, 13, 31),
(5, 21, 31),
(4, 14, 32),
(5, 19, 32),
(5, 20, 32),
(5, 21, 32);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `id_ordr` FOREIGN KEY (`id_ordr`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usr` FOREIGN KEY (`id_usr`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `id_customer` FOREIGN KEY (`id_customer`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_cat`
--
ALTER TABLE `order_cat`
  ADD CONSTRAINT `id_catg` FOREIGN KEY (`id_catg`) REFERENCES `subcategory` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_subctg` FOREIGN KEY (`id_subctg`) REFERENCES `subcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `id_cat` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `user_cat`
--
ALTER TABLE `user_cat`
  ADD CONSTRAINT `id_category` FOREIGN KEY (`id_category`) REFERENCES `subcategory` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_subcategory` FOREIGN KEY (`id_subcategory`) REFERENCES `subcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
