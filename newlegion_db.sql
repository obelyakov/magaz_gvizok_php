-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 22 2011 г., 01:11
-- Версия сервера: 5.1.41
-- Версия PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `newlegion_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `data_int`
--

CREATE TABLE IF NOT EXISTS `data_int` (
  `id_good` int(11) NOT NULL,
  `id_fieldtc` int(11) DEFAULT NULL COMMENT 'id поля',
  `value` int(11) DEFAULT NULL COMMENT 'значение',
  PRIMARY KEY (`id_good`),
  KEY `id_fieldtc` (`id_fieldtc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='хранилище строковых данных';

--
-- Дамп данных таблицы `data_int`
--


-- --------------------------------------------------------

--
-- Структура таблицы `data_string`
--

CREATE TABLE IF NOT EXISTS `data_string` (
  `id_good` int(11) NOT NULL,
  `id_fieldtc` int(11) DEFAULT NULL COMMENT 'id поля',
  `value` varchar(255) DEFAULT NULL COMMENT 'значение',
  PRIMARY KEY (`id_good`),
  KEY `id_fieldtc` (`id_fieldtc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='хранилище строковых данных';

--
-- Дамп данных таблицы `data_string`
--


-- --------------------------------------------------------

--
-- Структура таблицы `data_text`
--

CREATE TABLE IF NOT EXISTS `data_text` (
  `id_good` int(11) NOT NULL,
  `id_fieldtc` int(11) DEFAULT NULL COMMENT 'id поля',
  `value` text COMMENT 'значение',
  PRIMARY KEY (`id_good`),
  KEY `id_fieldtc` (`id_fieldtc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='хранилище строковых данных';

--
-- Дамп данных таблицы `data_text`
--


-- --------------------------------------------------------

--
-- Структура таблицы `ftypes_tb`
--

CREATE TABLE IF NOT EXISTS `ftypes_tb` (
  `ftype` char(15) NOT NULL COMMENT 'тип',
  `mysql_table` varchar(45) NOT NULL COMMENT 'таблица где нравятся данные этого поля',
  PRIMARY KEY (`ftype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='справочник полей и инфа по таблицам где хранятся  данные по ';

--
-- Дамп данных таблицы `ftypes_tb`
--

INSERT INTO `ftypes_tb` (`ftype`, `mysql_table`) VALUES
('string', 'data_string_tbtb'),
('int', 'data_int_tbtb'),
('text', 'text_data_tbtb');

-- --------------------------------------------------------

--
-- Структура таблицы `goods_tb`
--

CREATE TABLE IF NOT EXISTS `goods_tb` (
  `id_good` int(11) NOT NULL AUTO_INCREMENT,
  `id_seria` int(11) DEFAULT NULL COMMENT 'id серии',
  PRIMARY KEY (`id_good`),
  KEY `id_seria` (`id_seria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='товары ID и номер серии' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `goods_tb`
--

INSERT INTO `goods_tb` (`id_good`, `id_seria`) VALUES
(1, 4),
(2, 6),
(3, 88);

-- --------------------------------------------------------

--
-- Структура таблицы `seria_tb`
--

CREATE TABLE IF NOT EXISTS `seria_tb` (
  `id_seria` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `id_tovcat` int(11) DEFAULT NULL,
  `sname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_seria`),
  KEY `parent_id` (`parent_id`),
  KEY `id_tovcat` (`id_tovcat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='серии' AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `seria_tb`
--

INSERT INTO `seria_tb` (`id_seria`, `parent_id`, `id_tovcat`, `sname`) VALUES
(18, 14, 0, 'проточные водонагреватели'),
(28, 14, 0, 'уйцуй'),
(14, 0, 12, 'Водонагреватели'),
(21, 14, 0, 'накопительные водонагреватели123'),
(20, 14, 0, 'газовые водонагреватели'),
(31, 0, 0, 'Теплые полы'),
(22, 20, 555, 'aa1 ляля'),
(23, 20, NULL, 'aa1'),
(29, 0, 0, 'Увлажнители'),
(24, 18, 1235, 'AEG'),
(25, 18, 321, 'Electrolux'),
(30, 0, 14, 'Тепловые завесы'),
(32, 0, 0, 'Кондиционеры'),
(33, 31, 0, 'Ленты'),
(34, 31, 0, 'Квадраты'),
(35, 31, 0, 'Круги'),
(36, 29, 0, 'паровые'),
(37, 29, 0, 'ультразвуковые');

-- --------------------------------------------------------

--
-- Структура таблицы `tovcat_fields_tb`
--

CREATE TABLE IF NOT EXISTS `tovcat_fields_tb` (
  `id_filedtc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID поля',
  `id_tovcat` int(11) NOT NULL COMMENT 'ID товарной категории',
  `name` char(45) NOT NULL COMMENT 'название поля (для фронта)',
  `ftype` char(15) NOT NULL COMMENT 'тип поля',
  `size` int(11) NOT NULL COMMENT 'размер поля',
  `descr` varchar(150) NOT NULL COMMENT 'описание поля',
  PRIMARY KEY (`id_filedtc`),
  KEY `id_tovcat` (`id_tovcat`,`ftype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='поля товарных категорий' AUTO_INCREMENT=82 ;

--
-- Дамп данных таблицы `tovcat_fields_tb`
--

INSERT INTO `tovcat_fields_tb` (`id_filedtc`, `id_tovcat`, `name`, `ftype`, `size`, `descr`) VALUES
(79, 12, 'модель', 'string', 50, 'модогреи'),
(80, 12, 'вольтаж', 'int', 10, 'волтыыыыы'),
(81, 14, '', 'string', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tovcat_tb`
--

CREATE TABLE IF NOT EXISTS `tovcat_tb` (
  `id_tovcat` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'название категории (внутр)',
  `descr` varchar(255) NOT NULL COMMENT 'описание тк',
  PRIMARY KEY (`id_tovcat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='товарные категории' AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `tovcat_tb`
--

INSERT INTO `tovcat_tb` (`id_tovcat`, `name`, `descr`) VALUES
(12, 'Водонагреватели', 'электричсекие'),
(14, 'Тепловые завесы', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
