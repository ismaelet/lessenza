-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2024 at 10:35 AM
-- Server version: 5.6.43-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e23kpxmv_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_categories`
--

CREATE TABLE `admin_categories` (
  `id` int(3) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `slug` varchar(15) DEFAULT NULL,
  `manager` tinyint(1) DEFAULT '0',
  `sort` int(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_categories`
--

INSERT INTO `admin_categories` (`id`, `name`, `slug`, `manager`, `sort`) VALUES
(1, 'Impostazioni', 'settings', 1, 0),
(2, 'Prodotti', 'products', 0, 0),
(3, 'Blog', 'blog', 0, 1),
(4, 'Recensioni', 'reviews', 0, 1),
(5, 'Ordini', 'orders', 0, 0),
(6, 'Clienti', 'users', 0, 2),
(7, 'Newsletter', 'newsletter', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `admin_sections`
--

CREATE TABLE `admin_sections` (
  `id` int(4) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(30) DEFAULT NULL,
  `category` varchar(15) DEFAULT NULL,
  `template` varchar(10) DEFAULT 'admin',
  `hidden` tinyint(1) DEFAULT '0',
  `url` varchar(30) DEFAULT '',
  `sort` int(3) DEFAULT '0',
  `manager` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_sections`
--

INSERT INTO `admin_sections` (`id`, `name`, `slug`, `category`, `template`, `hidden`, `url`, `sort`, `manager`) VALUES
(1, 'Generali', 'general', 'settings', 'admin', 0, '', 0, 1),
(2, 'Menu - Categorie', 'categories/list', 'settings', 'list', 0, '', 0, 1),
(3, 'Aggiungi a Menu - Categorie', 'categories/add', 'settings', 'form', 1, '', 0, 1),
(4, 'Menu - Sezioni', 'sections/list', 'settings', 'list', 0, '', 0, 1),
(5, 'Aggiungi a Menu - Sezioni', 'sections/add', 'settings', 'form', 1, '', 0, 1),
(6, 'Variabili di sistema', 'variables/list', 'settings', 'list', 0, '', 0, 1),
(7, 'Aggiungi una variabile', 'variables/add', 'settings', 'form', 1, '', 0, 1),
(8, 'Aggiungi una recensione', 'add', 'reviews', 'form', 0, '', 0, 0),
(9, 'Lista delle recensioni', 'list', 'reviews', 'list', 0, '', 0, 0),
(10, 'Lista dei prodotti', 'list', 'products', 'list', 0, '', 0, 0),
(11, 'Aggiungi un prodotto', 'add', 'products', 'advanced', 0, '', 0, 0),
(12, 'Aggiungi un post', 'add', 'blog', 'form', 0, '', 0, 0),
(13, 'Lista dei post', 'list', 'blog', 'list', 0, '', 0, 0),
(14, 'Lista degli ordini', 'list', 'orders', 'list', 0, '', 0, 0),
(15, 'Modifica un ordine', 'add', 'orders', 'advanced', 1, '', 0, 0),
(16, 'Aggiungi un cliente', 'add', 'users', 'form', 0, '', 0, 0),
(17, 'Lista dei clienti', 'list', 'users', 'list', 0, '', 0, 0),
(18, 'Invia una newsletter', 'send', 'newsletter', 'admin', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(12) DEFAULT NULL,
  `validator` varchar(64) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `selector`, `validator`, `userID`, `expiration`) VALUES
(22, '3d4d94cd6d5d', 'deeb935ca233e444a4602eba518cbbb66566338ab7868e36f0f13669f5848afe', 1, '2023-12-09 05:18:13'),
(23, '5a911fec32b9', '01ccb3486fce72cf52d09dd1628de797d966006c3a2b2b85815f231f82725e5f', 1, '2023-12-10 03:07:47'),
(24, '837403b06526', 'a53ef133734180057f5ff6f718711cf8951528c89f3ecf8b612ba6877cea168b', 1, '2023-12-10 03:07:48'),
(25, 'dfa84d87077d', '719d9abd9a7473db1f75e735c12facba10fa0681654473cb4c7454732479060e', 1, '2023-12-13 17:27:13'),
(26, '591d3fac37b0', 'c6de1771b2ac87d013f1377bdb924dd4eea16f0de1a90108ff22dcfccfc86cf4', 1, '2023-12-13 18:33:25'),
(27, '88a90b0fb089', 'cf4843073d7312f0280b19dcaea022884211dbcf21aab5e7b5efc2f84e4c034f', 1, '2023-12-16 17:51:35'),
(28, '0ef4ef508a1c', '6123b38d23f64ef8daec3418f2d8cddfdbb183d85d10fc9a6cc7f9e0c144cfe8', 1, '2023-12-16 20:34:20'),
(30, 'b9b50b857c92', '8acf723cd694a6412e439d36defb6f6650ea83afe3ea0a081554cd4f18c227fc', 1, '2023-12-16 22:02:36'),
(31, '3f9b64c73643', '1395000b12541b2c1ffd16e63dc9fe7c1219b63847bdb5c0cef09a7ebfeb258b', 1, '2023-12-19 08:49:08'),
(32, 'd0f6e3cc84a0', '7b6c02a340fe5747e2231c53845bf0f39efd369b6a0c57b08d019b28c650b508', 1, '2023-12-19 08:49:09'),
(34, '50b5c6a3a488', 'c1dfc8eba91d8e1577fd626803b8d54c58901fa513c43ed8fbcb6051c8f019d1', 1, '2023-12-20 18:17:45'),
(35, '5555cd7d4edd', 'b8cd94c8b530503b6b37cba82ae93140057bcd97d61e6e36a5d298f544e72f02', 1, '2023-12-21 03:06:42'),
(37, 'a89ab106854e', 'd064942a745d40bbc9c21e6a4833fa13adf11e82e6318e1daca0b1bce14c482c', 1, '2023-12-21 18:06:27'),
(40, '0b08ac95d3e6', '017ac0badf5e57c7ac2d8be944a4b8c840a55d68161d49d58aeb4d1255893da3', 1, '2024-01-03 00:24:06'),
(41, '1417a7e6e3a0', '288c154180cbe256c775314ca4bb5823eaf096a0426c765414ff03bfe5cbe738', 4, '2024-03-18 08:53:36'),
(42, '97951135b4ea', '75eb468202fbcf8f51e03aef2dedaaf29f128c6b69a5a7cceb134643caf60517', 5, '2024-04-26 17:50:51'),
(43, '600bbc461743', '008d4691755d1c38caa23c9b306eb7183835d8ee3e6303c0fda0f1834ee49525', 5, '2024-04-27 09:50:33'),
(44, '177cf50c9f29', '28c586c15c010084bb603a8ac1eb3bdf9477f448522c5e4966a897c5f39d0569', 2, '2024-06-10 12:16:10'),
(45, '392af7911fa2', 'b4fd079fe03baf266c7d995c8e743c8e9fc3c61ad33efafee16f79ee407e05c3', 2, '2024-06-14 08:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens_admin`
--

CREATE TABLE `auth_tokens_admin` (
  `id` int(11) NOT NULL,
  `selector` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validator` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `text` varchar(2000) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `text`, `time`) VALUES
(1, 'COME UTILIZZARE LE POMPE DOSATRICI AROMA', 'Le pompe dosatrici pescano il prodotto dalla tanica di essenze ed introducono la fragranza all\'interno del Bagno Turco, delle Saune Romane o delle Docce emozionali.\r\nLe impostazioni consigliate sono di:\r\n- 4-6 impulsi ogni 4 minuti per il Bagno Turco (e Sauna Romana) con il dosaggio della pompa impostata tra il 70 e l\'80%.\r\n- 1 impulso ogni 3-4 secondi per le Docce Emozionali con il dosaggio della pompa impostata tra il 30 e il 40%.', '2023-06-18 06:35:57'),
(2, 'PRODOTTI A BASSO COSTO? NO GRAZIE!', 'PRODOTTO A BASSO COSTO?\r\n\r\nL’aromatizzazione delle cabine Wellness viene a volte considerata un costo da parte dell’albergatore che molte volte si orienta verso soluzioni “Fai da te” utilizzando essenze concentrate che si trovano sul WEB facendo poi una diluizione con acqua. Il risparmio ovviamente è garantito fino a quando non iniziano i problemi alle Pompe dosatrici degli aromi… Questo tipo di soluzione infatti porta inevitabilmente a danneggiamenti degli impianti soprattutto se si acquistano essenze molto viscose e oleose. Il risparmio di qualche centinaio di Euro subito porta però a migliaia di Euro spesi in interventi di manutenzione o sostituzione delle pompe dosatrici e dei tubicini che collegano le pompe dosatrici aroma al bagno turco/sauna romano/docce emozionali. \r\nSe sei un albergatore intelligente evita quindi le soluzioni “fai da te” o utilizzo di prodotti a basso costo. \r\nAcquista le nostre essenze prive di olii, emulsioni, non viscose, che non producono schiuma! \r\nEviterai inutili spese di manutenzione…', '2023-06-18 06:35:57'),
(3, 'LA BIODEGRADABILITA\' QUANTO E\' IMPORTANTE', 'Un altro aspetto da considerare quando si acquista un prodotto in generale è quella di chiedere al produttore una certificazione dei biodegradabilità. Molti prodotti contengono Alcohol, tensioattivi, prodotti per la conservazione che NON sono biodegradabili o danneggiano il nostro ecosistema. \r\nSe sei un albergatore responsabile, controlla l’etichetta o la scheda tecnica, se troverai delle sigle poco chiare sull’INCI chiedi subito info al prodottore o evita di acquistare direttamente il prodotto.\r\nFai una scelta ETICA acquistando prodotti SOLO BIODEGRADABILI come le nostre Essenze.', '2023-06-18 06:36:29'),
(4, 'L’ALCOHOL nelle essenze per Bagno Turco perché viene utilizzato?', 'La maggior parte delle aziende produce o importa essenze con Alcohol. \r\nL’alcohol è usato in primis per la conservazione del prodotto ma anche per aumentare e potenziare la RESA della “profumazione” all’interno del Bagno Turco.\r\nCon poche essenze naturali e una percentuale elevata di Alcohol si riducono i costi (e quindi crescono i margini per le aziende) e si aumenta la persistenza della fragranza ai danni però degli utenti utilizzatori delle cabine Bagno Turco, Sauna e Bagno Romano che ne respirano direttamente le esalazioni.\r\nLa nostra scelta di non usare Alcohol va contro tendenza rispetto al mercato ma a beneficio dell’utente finale. \r\nSe sei un albergatore fatti inviare subito le schede tecniche o controlla le etichette sulle taniche, se vedi la presenza di alcohol ai primi posti dell’INCI evita di acquistare il prodotto. \r\nFai una scelta ETICA acquistando prodotti Alcohol Free!', '2023-06-19 06:36:29'),
(5, 'L\'importanza del territorio: Il Trentino Alto Adige', 'Il Trentino Alto Adige è la patria del wellness! \r\nAlcune delle nostre fragranze sono state concepite guardando il territorio e la natura che ci circonda. \r\nFiori ed alberi situati nelle nostre bellissime Valli di Fiemme e Fassa sono state di ispirazioni per la scelta degli olii essenziali che compongono le nostre fragranze: \r\n- Il pino Cimbro che nasce in alta quota sopra i 1800 mt con il suo pfrofumo intenso\r\n- la Lavanda con il suo aroma selvatico \r\n- Le Erbe di Montagna di cui sono colmi i nostri prati\r\n- Il Fieno che sprigiona un intenso profumo dopo il taglio\r\n- la Camomilla selvatica che nasce nei nostri campi.\r\nQueste sono alcune delle fragranze principali che ci contraddistinguono facendo di noi un\'azienda territoriale. \r\nScegliere un prodotto locale è fondamentale non solo per l\'economia del territorio ma anche per dare qualità al prodotto e un ricordo dei nostri ambienti che volgiamo far sentire anche nei migliori centri benessere. \r\nPortare il Trentino Alto Adige nelle SPA è un\'esperienza che non si può fare mancare ai clienti degli Hotel.', '2024-05-10 12:44:16'),
(6, 'COME PROFUMARE IL BAGNO TURCO', 'Il Bagno Turco è una cabina umida e con temperature inferiori (ca. 45°C) rispetto alla sauna finlandese (90-100°C) pertanto più soggetta alla proliferazione di batterie, muffe e conseguentemente di potenziali spiacevoli odori. \r\nPrima di \"profumare\" il bagno turco con qualsiasi prodotto consigliamo una pulizia costante e giornaliera, provvedere ad arieggiare la cabina tenendo aperta la porta alla fine dell\'utilizzo. Negli hotel prevedere un impianto di areazione per espellere l\'aria viziata mantenendo accesa la ventola per trenta minuti dopo la chiusura del centro. \r\nE ora arriviamo ai \"profumi\" o meglio alle nostre \"fragranze naturali\"! \r\nE\' possibile infatti dotare la cabina di un impianto aroma installando un pannello tecnico con pompa dosatrice automatica collegata direttamente al generatore, il quale procederà in autonomia a gestire gli impulsi (generalmente 4 ogni 4 minuti) ed iniettare la fragranza (in soluzione da 1 o 5 lt), all\'interno del bagno turco tramite il condotto di immissione del vapore. \r\nA questo punto potrete sentire un piacevole profumo e goderVi a pieno e rilassati il Vs. Bagno turco o Hammam.', '2024-05-14 09:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(3) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `value` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'public', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_addresses`
--

CREATE TABLE `ecommerce_addresses` (
  `id` int(3) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `fullName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecommerce_addresses`
--

INSERT INTO `ecommerce_addresses` (`id`, `customerId`, `fullName`, `address`, `number`, `city`, `zip`, `region`, `email`, `phone`, `notes`, `time`) VALUES
(1, 2, 'Ismaele Tuffanelli', 'via Bedovina', '4', 'Predazzo', '38037', 'TN', 'ismaele.tuffanelli@gmail.com', '393663490998', '', '2023-07-16 07:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_carts`
--

CREATE TABLE `ecommerce_carts` (
  `id` int(3) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `addressId` int(11) DEFAULT '0',
  `shippingMethodId` int(3) DEFAULT '1',
  `paymentMethodId` int(3) DEFAULT '1',
  `staticFullShippingPrice` float DEFAULT '0',
  `staticShippingDiscount` float DEFAULT '0',
  `couponId` int(11) DEFAULT '0',
  `step` int(1) DEFAULT '1',
  `statusId` int(1) DEFAULT '0',
  `gift` tinyint(1) DEFAULT '0',
  `trackingCode` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecommerce_carts`
--

INSERT INTO `ecommerce_carts` (`id`, `customerId`, `addressId`, `shippingMethodId`, `paymentMethodId`, `staticFullShippingPrice`, `staticShippingDiscount`, `couponId`, `step`, `statusId`, `gift`, `trackingCode`, `time`) VALUES
(2, 2, 1, 1, 1, 0, 0, 0, 2, -1, 0, NULL, '2023-07-16 07:36:10'),
(3, 3, 0, 1, 1, 0, 0, 0, 1, 0, 0, NULL, '2024-02-18 08:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_carts_comments`
--

CREATE TABLE `ecommerce_carts_comments` (
  `id` int(11) NOT NULL,
  `cartId` int(11) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_coupons`
--

CREATE TABLE `ecommerce_coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(11) DEFAULT NULL,
  `percentage` int(3) DEFAULT '0',
  `percentage2` int(3) DEFAULT '0',
  `percentageMore` int(3) DEFAULT '0',
  `flat` float DEFAULT '0',
  `flat2` float DEFAULT '0',
  `flatMore` float DEFAULT '0',
  `minPrice` float DEFAULT '0',
  `types` varchar(100) DEFAULT '',
  `reusable` tinyint(1) DEFAULT '0',
  `onePerUser` tinyint(1) DEFAULT '0',
  `freeShipping` tinyint(1) DEFAULT '0',
  `timeStart` date DEFAULT NULL,
  `timeEnd` date DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_customers`
--

CREATE TABLE `ecommerce_customers` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT '0',
  `groupId` int(11) DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecommerce_customers`
--

INSERT INTO `ecommerce_customers` (`id`, `userId`, `groupId`, `time`) VALUES
(2, 1, 0, '2023-07-16 07:36:00'),
(3, 4, 0, '2024-02-18 08:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_orders`
--

CREATE TABLE `ecommerce_orders` (
  `id` int(3) NOT NULL,
  `cartId` int(11) DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `staticFullPrice` float DEFAULT '0',
  `staticDiscount` float DEFAULT '0',
  `quantity` int(3) DEFAULT '1',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecommerce_orders`
--

INSERT INTO `ecommerce_orders` (`id`, `cartId`, `customerId`, `productId`, `staticFullPrice`, `staticDiscount`, `quantity`, `time`) VALUES
(2, 2, 2, 7, 0, 0, 6, '2023-07-16 07:36:00'),
(3, 3, 3, 10, 0, 0, 1, '2024-02-18 08:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_payments`
--

CREATE TABLE `ecommerce_payments` (
  `id` int(3) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(30) DEFAULT NULL,
  `info` varchar(500) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_products`
--

CREATE TABLE `ecommerce_products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `ingredients` varchar(200) NOT NULL DEFAULT '',
  `typeId` int(3) DEFAULT '1',
  `resellerPrice` float NOT NULL DEFAULT '0',
  `inStock` tinyint(1) DEFAULT '1',
  `highlighted` tinyint(1) DEFAULT '0',
  `sales` int(11) DEFAULT '0',
  `recentSales` int(11) DEFAULT '0',
  `statusId` int(1) DEFAULT '1',
  `processed` int(1) DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecommerce_products`
--

INSERT INTO `ecommerce_products` (`id`, `name`, `slug`, `description`, `ingredients`, `typeId`, `resellerPrice`, `inStock`, `highlighted`, `sales`, `recentSales`, `statusId`, `processed`, `time`) VALUES
(1, 'Limone', 'limone', 'Una Fragranza immancabile per l’estate.', 'Acqua, Citrus Lemon Oil', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(2, 'Lavanda', 'lavanda', 'Fragranza che non può mancare per chi vuole dare agli ospiti un effetto Relax.', 'Acqua, Lavandula Augustifolia Oil', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(3, 'Eucalipto', 'eucalipto', 'La fragranza più classica e più utilizzata con effetto balsamico.', 'Acqua, Eucalyptus Globulus Oil', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(4, 'Arancia', 'arancia', 'Fragranza che richiama i profumi delle terre Siciliane tanto care a Stefania.', 'Citrus Sinensis Dulcis', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(5, 'Rosmarino', 'rosmarino', 'Fragranza particolare, fuori dal comune ma molto apprezzata dai gestori che vogliono 	       avere un aroma particolare.', 'Acqua, Salvia Rosmarino Oil', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(6, 'Camomilla', 'camomilla', 'La fragranza calmante per eccellenza usata principalmente negli Aromarium.', 'Acqua, Matriconia Chamomilla Oil', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(7, 'Pino Cembro', 'pino-cembro', 'Fragranza Alpina con un profumo intenso che richiama i nostri boschi.', 'Acqua, Pinus Cimbra Oil', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(8, 'Pino Silvestre', 'pino-silvestre', 'Profumazione intensa per il gestore che vuole un alternativa all’Eucalipto classico.', 'Acqua, Pinus Sylvestris Oil', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(9, 'Menta e Eucalipto', 'menta-e-eucalipto', 'Fragranza consigliata per il gestore che vuole dare una nota di freschezza in più        		     al bagno turco.', 'Acqua, Eucalyptus Globulus Oil, Menta Arvensis Oil', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(10, 'Fieno delle Alpi', 'fieno-delle-alpi', 'Fragranza che richiama il profumo dei prati appena tagliati.', '', 1, 40, 1, 0, 0, 0, 1, 0, '2023-05-30 06:51:12'),
(11, 'Erbe di Montagna', 'erbe-di-montagna', 'Un Mix di profumi selezionati di Erbe delle nostre Montagne.', '', 1, 40, 1, 0, 0, 0, 1, 0, '2023-06-08 09:18:50'),
(12, 'Maracuja', 'maracuja', 'Aroma Classico ed ideale per la “Doccia Tropicale”.', '', 2, 40, 1, 0, 0, 0, 1, 0, '2023-06-08 09:22:13'),
(13, 'Mango', 'mango', 'Aroma Fresco ed esotico, pensato in alternativa alla classica Maracuja.', '', 2, 40, 1, 0, 0, 0, 1, 0, '2023-06-08 09:22:13'),
(14, 'Passion Fruit', 'passion-fruit', 'La Nuova Fragranza derivante dalla spremitura del frutto della passione. Ideale per 		           la doccia calda tropicale.', '', 2, 40, 1, 0, 0, 0, 1, 0, '2023-06-08 09:22:13'),
(15, 'Neve di Menta', 'neve-di-menta', 'Essenza classica per la doccia “Nebbia Fredda”.', '', 3, 40, 1, 0, 0, 0, 1, 0, '2023-06-08 09:22:13'),
(16, 'Papaja', 'papaja', 'Fragranza esotica per eccellenza da usare con la doccia Calda.', '', 2, 40, 1, 0, 0, 0, 1, 0, '2023-06-08 09:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_product_categories`
--

CREATE TABLE `ecommerce_product_categories` (
  `id` int(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `names` varchar(50) DEFAULT '',
  `status` int(1) DEFAULT '1',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecommerce_product_categories`
--

INSERT INTO `ecommerce_product_categories` (`id`, `name`, `names`, `status`, `time`) VALUES
(1, 'Bagno Turco', '', 1, '2023-06-08 09:17:56'),
(2, 'Doccce Emozionali', '', 1, '2023-06-08 09:17:56'),
(3, 'Calde', '', 1, '2023-06-08 09:17:56'),
(4, 'Fredde', '', 1, '2023-06-08 09:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_product_images`
--

CREATE TABLE `ecommerce_product_images` (
  `id` int(11) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `sort` int(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_product_likes`
--

CREATE TABLE `ecommerce_product_likes` (
  `id` int(3) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_product_types`
--

CREATE TABLE `ecommerce_product_types` (
  `id` int(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `names` varchar(50) DEFAULT '',
  `category` int(3) DEFAULT '1',
  `status` int(1) DEFAULT '1',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecommerce_product_types`
--

INSERT INTO `ecommerce_product_types` (`id`, `name`, `names`, `category`, `status`, `time`) VALUES
(1, 'Bagno Turco', '', 1, 1, '2023-06-08 09:52:52'),
(2, 'Doccce Emozionali Calde', '', 1, 1, '2023-06-08 09:52:52'),
(3, 'Doccce Emozionali Fredde', '', 1, 1, '2023-06-08 09:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_promotions`
--

CREATE TABLE `ecommerce_promotions` (
  `id` int(11) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_reviews`
--

CREATE TABLE `ecommerce_reviews` (
  `id` int(11) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `score` int(2) DEFAULT '0',
  `text` varchar(500) DEFAULT '',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_shipping_methods`
--

CREATE TABLE `ecommerce_shipping_methods` (
  `id` int(3) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `minimumPrice` float DEFAULT '0',
  `additionalPrice` float DEFAULT '0',
  `maximumPrice` float DEFAULT '0',
  `freeShippingAbove` float NOT NULL DEFAULT '0',
  `processingDays` int(2) NOT NULL DEFAULT '1',
  `minimumDeliveryDays` int(11) DEFAULT '1',
  `maximumDeliveryDays` int(11) DEFAULT '2',
  `api` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecommerce_shipping_methods`
--

INSERT INTO `ecommerce_shipping_methods` (`id`, `name`, `description`, `minimumPrice`, `additionalPrice`, `maximumPrice`, `freeShippingAbove`, `processingDays`, `minimumDeliveryDays`, `maximumDeliveryDays`, `api`) VALUES
(1, 'Spedizione tramite corriere', 'Le spese di trasporto vengono calcolate in base alla località e alla zona di spedizione e possono variare tra 0,30 e 0,50 €/kg', 0, 0, 0, 0, 1, 3, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `global_reviews`
--

CREATE TABLE `global_reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(100) NOT NULL DEFAULT '',
  `text` varchar(2000) DEFAULT NULL,
  `rating` int(2) DEFAULT '0',
  `contactUrl` varchar(200) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `global_reviews`
--

INSERT INTO `global_reviews` (`id`, `name`, `location`, `text`, `rating`, `contactUrl`, `time`) VALUES
(1, 'Hotel ★★★S Crepes de Sela', 'Campitello di Fassa', 'È da diversi anni che per il bagno turco del nostro Hotel utilizziamo i prodotti \"L\'Essenza\", sono di ottima qualità, li abbiamo provati tutti.', 0, 'https://crepesdesela.it/', '2023-06-20 04:46:00'),
(2, 'Hotel ★★★★ Jolanda Sport', 'Gressoney-Saint-Jean', 'Noi ci troviamo molto bene con le essenze che abbiamo provato, sono persistenti ma non invadenti.', 0, 'https://hoteljolandasport.com/', '2023-06-20 04:49:40'),
(3, 'Hotel ★★★S Luna Bianca', 'Folgaria', 'Le fragranze per bagno turco e docce emozionali emanano le fragranze in maniera equilibrata e con la giusta intensità. I prodotti sono di ottima qualità ed ottimo è il rapporto qualità/prezzo per questo siamo clienti da anni.', 0, 'https://www.lunabiancahotel.it/', '2023-06-20 04:46:00'),
(4, 'Hotel Shandrany ★★★★', 'Tesero', 'Servizio attento e puntuale. Ottimo.', 0, 'https://www.shandrani.com/', '2023-06-20 13:00:51'),
(5, 'Design Oberosler Hotel ★★★★', 'Madonna di Campiglio', 'Siamo Clienti dell\'Azienda Essenza Predazzo  da alcuni anni.\r\nAvendo  un centro benessere con varie tipologie di saune, water  paradise, abbiamo necessità di  reperire  prodotti \r\ndi alta gamma,  prodotti  naturali, con essenze  persistenti e che  non svaniscono subito, e anche vasta scelta  di  profumazione.\r\nLa Ditta Essenza di Predazzo rispecchia tutti questi  requisiti, e  ne\' siamo  molto contenti,  per questo che  ci forniamo solo da  loro\r\nin fiducia. Gli ordini vengono evasi rapidamente  o su richiesta del cliente.\r\nI  nostri Ospiti  tra l\'altro  hanno anche esternato complimenti  per  la  profumazione  differenziata  nelle varie cabine , inspirando\r\nappieno, ed avere  cosi\'  un  maggiore senso di  appagamento e serenità.\r\nAnche  le Essenze aggiunte ai servizi  di spa, hanno  un rilievo importante.\r\nChe bello entrare  nelle cabine  e sentire  un  profumo particolare che  subito  arriva all\'anima, calmando ansie, dissapori, e trasmette solo benessere!', 0, 'https://www.hoteloberosler.it/', '2023-06-20 05:50:27'),
(6, 'Hotel Maria ★★★★', 'Carano', 'Non esito a definire OTTIMO il nostro pluriennale rapporto con la ditta L\'Essenza e con la signora Stefania. L\'essenze per bagno turco, docce emozionali e saune riscuotono sempre il miglior successo presso i nostri ospiti e la disponibilità nell\'assecondare ogni nostra esigenza in tema di Wellness e la puntualità di ogni fornitura ci fanno annoverare L\'Essenza tra i nostri fornitori preferiti.', 0, 'https://www.hotelmariasas.it/', '2023-06-21 03:46:38'),
(7, 'The Ziba Hotel & Musa Spa ★★★★', 'Peschiera del Garda', 'È già due volte che ordino le essenze per il bagno turco, docce emozionali, ecc. da questa azienda, devo dire che mi sono trovata molto bene. Stefania, la titolare, è molto disponibile e soprattutto veloce con la spedizione. Cosa molto importante è che se nel caso hai qualche problema in un batter d\'occhio viene risolto da Stefania. Consiglio veramente questa azienda.', 0, 'https://thezibahotel.it/', '2023-06-23 06:12:32'),
(8, 'Camping al Sole ★★★★', 'Ledro', 'Ottima qualità prezzo, vasta scelta di fragranze, velocità tra ordine e ricezione del prodotto.', 0, 'https://www.campingalsole.it/', '2023-07-05 05:45:37'),
(9, 'Hotel Ciampedie ★★★★★', 'Vigo di Fassa', 'L\'azienda L\'Essenza ci ha fornito dei prodotti VALIDI  con tempi di consegna rapidi, si sono dimostrati seri e professionali. Caludio Peretti Hotel Ciampedie', 0, 'https://www.hotelciampedie.com/', '2023-08-23 15:34:16'),
(10, 'Hotel Montana ★★★★', 'Monte Bondone Trento', 'Il nostro centro benessere profuma di Trentino, ottima gamma di scelta, veloci nelle spedizioni, una piacevole scoperta.\r\n\r\nBy Hotel Montana**** - Monte Bondone', 0, 'https://www.hotelmontana.it/', '2023-09-04 19:42:22'),
(11, 'Life Planet By Sport City', 'Ravenna', 'Consumiamo ca. 8/900 litri di essenze all\'anno e siamo clienti della ditta L\'Essenza S.r.l.s. da oltre 5 anni. Con certezza possiamo affermare che il rapporto qualità prezzo è imbattibile! Inoltre il servizio E la disponibilità dell\'azienda di andare incontro alle nostre esigenze è SUPER! Andrea Dradi', 0, 'https://www.sportcitypalestra.it/', '2023-10-19 12:30:08'),
(16, 'Hotel Les Alpes★★★★', 'San Vigilio di Marebbe (BZ)', 'Lavoro con questa azienda da ormai più di un anno. Grande professionalità e competenza in grado di consigliare i clienti al meglio, OTTIMA qualità dei prodotti.\r\nLuciano Filippi', 0, 'https://www.hotel-lesalpes.com/en/', '2023-11-21 18:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `fullName` varchar(200) DEFAULT '',
  `firstName` varchar(200) DEFAULT '',
  `lastName` varchar(200) DEFAULT '',
  `email` varchar(200) DEFAULT '',
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `fullName`, `firstName`, `lastName`, `email`, `sent`, `time`) VALUES
(1, 'Ismaele Tuffanelli', 'Ismaele', 'Tuffanelli', 'ismaele.tuffanelli@gmail.com', 0, '2023-11-13 18:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers_old`
--

CREATE TABLE `newsletter_subscribers_old` (
  `id` int(11) NOT NULL,
  `fullName` varchar(200) DEFAULT '',
  `firstName` varchar(200) DEFAULT '',
  `lastName` varchar(200) DEFAULT '',
  `email` varchar(200) DEFAULT '',
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter_subscribers_old`
--

INSERT INTO `newsletter_subscribers_old` (`id`, `fullName`, `firstName`, `lastName`, `email`, `sent`, `time`) VALUES
(1, '', '', '', 'Info@hotelgardenia.com', 0, '2023-11-13 17:27:36'),
(2, '', '', '', 'info@sportinghotelravelli.it', 0, '2023-11-13 17:27:36'),
(3, '', '', '', 'info@olympicspahotel.it', 0, '2023-11-13 17:27:36'),
(4, '', '', '', 'info@alpinoalcavalletto.it', 0, '2023-11-13 17:27:36'),
(5, '', '', '', 'info@titapiaz.it', 0, '2023-11-13 17:27:36'),
(6, '', '', '', 'camoscio@marmolada.com', 0, '2023-11-13 17:27:36'),
(7, '', '', '', 'info@hotelcarlone.it', 0, '2023-11-13 17:27:36'),
(8, '', '', '', 'info@dimarohotel.it', 0, '2023-11-13 17:27:36'),
(9, '', '', '', 'info@garnienrosadira.it', 0, '2023-11-13 17:27:36'),
(10, '', '', '', 'hotel@lacacciatora.it', 0, '2023-11-13 17:27:36'),
(11, '', '', '', 'info@activehotelrosat.it', 0, '2023-11-13 17:27:36'),
(12, '', '', '', 'info@hoteloberosler.it', 0, '2023-11-13 17:27:36'),
(13, '', '', '', 'info@lunabiancahotel.it', 0, '2023-11-13 17:27:36'),
(14, '', '', '', 'info@alpenhotelcorona.com', 0, '2023-11-13 17:27:36'),
(15, '', '', '', 'centrobenessere@biafora.it', 0, '2023-11-13 17:27:36'),
(16, '', '', '', 'roberta.viviani@bormioterme.it', 0, '2023-11-13 17:27:36'),
(17, '', '', '', 'info@hotelsavoia.com', 0, '2023-11-13 17:27:36'),
(18, '', '', '', 'info@campingvidor.it', 0, '2023-11-13 17:27:36'),
(19, '', '', '', 'info@hotelcerana.com', 0, '2023-11-13 17:27:36'),
(20, '', '', '', 'desalpes@trentinoresidences.it', 0, '2023-11-13 17:27:36'),
(21, '', '', '', 'info@agriturismopolisena.it', 0, '2023-11-13 17:27:36'),
(22, '', '', '', 'info@ancora.it', 0, '2023-11-13 17:27:36'),
(23, '', '', '', 'info@hotel-cristallo.com', 0, '2023-11-13 17:27:36'),
(24, '', '', '', 'info@hotelresidencedahu.it', 0, '2023-11-13 17:27:36'),
(25, '', '', '', 'info@appartamentieltabia.it', 0, '2023-11-13 17:27:36'),
(26, '', '', '', 'info@hotellaperla.net', 0, '2023-11-13 17:27:36'),
(27, '', '', '', 'info@hoteldiana.net', 0, '2023-11-13 17:27:36'),
(28, '', '', '', 'info@albergoirma.it', 0, '2023-11-13 17:27:36'),
(29, '', '', '', 'info@residencesalvan.com', 0, '2023-11-13 17:27:36'),
(30, '', '', '', 'info@sporthotel.it', 0, '2023-11-13 17:27:36'),
(31, '', '', '', 'info@wellnessfassa.it', 0, '2023-11-13 17:27:36'),
(32, '', '', '', 'info@garnierica.it', 0, '2023-11-13 17:27:36'),
(33, '', '', '', 'info@garnilavigna.it', 0, '2023-11-13 17:27:36'),
(34, '', '', '', 'info@garnimonica.it', 0, '2023-11-13 17:27:36'),
(35, '', '', '', 'garniserena@libero.it', 0, '2023-11-13 17:27:36'),
(36, '', '', '', 'info@hotelmontebondone.it', 0, '2023-11-13 17:27:36'),
(37, '', '', '', 'info@alpholiday.it', 0, '2023-11-13 17:27:36'),
(38, '', '', '', 'info@hotelalpinovarena.it', 0, '2023-11-13 17:27:36'),
(39, '', '', '', 'info@hotelandes.com', 0, '2023-11-13 17:27:36'),
(40, '', '', '', 'info@hotelangelo.com', 0, '2023-11-13 17:27:36'),
(41, '', '', '', 'info@arnika.it', 0, '2023-11-13 17:27:36'),
(42, '', '', '', 'info@hotel-astoria.net', 0, '2023-11-13 17:27:36'),
(43, '', '', '', 'info@hotelbellaria.com', 0, '2023-11-13 17:27:36'),
(44, '', '', '', 'hotel@berlvedere.it', 0, '2023-11-13 17:27:36'),
(45, '', '', '', 'lena.nest@familiamus.com', 0, '2023-11-13 17:27:36'),
(46, '', '', '', 'info@crepesdesela.it', 0, '2023-11-13 17:27:36'),
(47, '', '', '', 'info@orsinghersanmartino.com', 0, '2023-11-13 17:27:36'),
(48, '', '', '', 'info@hotelcristallo.net', 0, '2023-11-13 17:27:36'),
(49, '', '', '', 'info@hotelcrozzon.com', 0, '2023-11-13 17:27:36'),
(50, '', '', '', 'info@hoteldolcecasa.it', 0, '2023-11-13 17:27:36'),
(51, '', '', '', 'info@garnilaurino.it', 0, '2023-11-13 17:27:36'),
(52, '', '', '', 'info@hotel-marilena.it', 0, '2023-11-13 17:27:36'),
(53, '', '', '', 'info@jobhotel.it', 0, '2023-11-13 17:27:36'),
(54, '', '', '', 'info@hoteljolanda.com', 0, '2023-11-13 17:27:36'),
(55, '', '', '', 'info@hoteljolandasport.com', 0, '2023-11-13 17:27:36'),
(56, '', '', '', 'hotel@gioiosa.it', 0, '2023-11-13 17:27:36'),
(57, '', '', '', 'info@hotelladinia.it', 0, '2023-11-13 17:27:36'),
(58, '', '', '', 'info@hotelmalita.it', 0, '2023-11-13 17:27:36'),
(59, '', '', '', 'info@hotelmariasas.it', 0, '2023-11-13 17:27:36'),
(60, '', '', '', 'direttore@hotelmeditteraneealassio.it', 0, '2023-11-13 17:27:36'),
(61, '', '', '', 'info@berghotelmiramonti.it', 0, '2023-11-13 17:27:36'),
(62, '', '', '', 'info@hotel-miramonti.com', 0, '2023-11-13 17:27:36'),
(63, '', '', '', 'info@hotelpaganella.com', 0, '2023-11-13 17:27:36'),
(64, '', '', '', 'info@hotelrenato.it', 0, '2023-11-13 17:27:36'),
(65, '', '', '', 'info@scoiattolo.it', 0, '2023-11-13 17:27:36'),
(66, '', '', '', 'info@hselect.it', 0, '2023-11-13 17:27:36'),
(67, '', '', '', 'info@sharndrani.com', 0, '2023-11-13 17:27:36'),
(68, '', '', '', 'info@trilago.it', 0, '2023-11-13 17:27:36'),
(69, '', '', '', 'info@villajolanda.info', 0, '2023-11-13 17:27:36'),
(70, '', '', '', 'info@hotelmirabello.it', 0, '2023-11-13 17:27:36'),
(71, '', '', '', 'info@hsole.it', 0, '2023-11-13 17:27:36'),
(72, '', '', '', 'info@ciarnadoi.it', 0, '2023-11-13 17:27:36'),
(73, '', '', '', 'info@larocciaandalo.it', 0, '2023-11-13 17:27:36'),
(74, '', '', '', 'centrobenesserechivasom@gmail.com', 0, '2023-11-13 17:27:36'),
(75, '', '', '', 'info@hotelmontana.it', 0, '2023-11-13 17:27:36'),
(76, '', '', '', 'info@hotelmonteginer.com', 0, '2023-11-13 17:27:36'),
(77, '', '', '', 'info@residencetaufer.it', 0, '2023-11-13 17:27:36'),
(78, '', '', '', 'info@nonsolobaite.it', 0, '2023-11-13 17:27:36'),
(79, '', '', '', 'info@novalunaestellis.com', 0, '2023-11-13 17:27:36'),
(80, '', '', '', 'palestradepoeti@gmail.com', 0, '2023-11-13 17:27:36'),
(81, '', '', '', 'hotel@materdaihp.com', 0, '2023-11-13 17:27:36'),
(82, '', '', '', 'info@residencelaste.it', 0, '2023-11-13 17:27:36'),
(83, '', '', '', 'info@hotel-lagorai.com', 0, '2023-11-13 17:27:36'),
(84, '', '', '', 'info@alpiccolohotel.it', 0, '2023-11-13 17:27:36'),
(85, '', '', '', 'info@miralagotrentino.com', 0, '2023-11-13 17:27:36'),
(86, '', '', '', 'info@montebel.it', 0, '2023-11-13 17:27:36'),
(87, '', '', '', 'giulia.tabiadon@canazei.org', 0, '2023-11-13 17:27:36'),
(88, '', '', '', 'info@solehammam.it', 0, '2023-11-13 17:27:36'),
(89, '', '', '', 'a.dradi@sportcitypalestra.it', 0, '2023-11-13 17:27:36'),
(90, '', '', '', 'ale@sportetempolibero.it', 0, '2023-11-13 17:27:36'),
(91, '', '', '', 'info@hotelmajare.com', 0, '2023-11-13 17:27:36'),
(92, '', '', '', 'info@touringpredazzo.com', 0, '2023-11-13 17:27:36'),
(93, '', '', '', 'g.peroni@isolacluab.com', 0, '2023-11-13 17:27:36'),
(94, '', '', '', 'info@hotelalparco.net', 0, '2023-11-13 17:27:36'),
(95, '', '', '', 'info@garnierna.it', 0, '2023-11-13 17:27:36'),
(96, '', '', '', 'info@hotelalpen.it', 0, '2023-11-13 17:27:36'),
(97, '', '', '', 'info@portavescovo.it', 0, '2023-11-13 17:27:36'),
(98, '', '', '', 'info@alpenhotelplaza.it', 0, '2023-11-13 17:27:36'),
(99, '', '', '', 'info@viaverdelessinia.com', 0, '2023-11-13 17:27:36'),
(100, '', '', '', 'info@fanes.net', 0, '2023-11-13 17:27:36'),
(101, '', '', '', 'alberto@belvedereonline.com', 0, '2023-11-13 17:27:36'),
(102, '', '', '', 'info@garniserena.it', 0, '2023-11-13 17:27:36'),
(103, '', '', '', 'info@genziana.it', 0, '2023-11-13 17:27:36'),
(104, '', '', '', 'direttore@hotelmediterraneealassio.it', 0, '2023-11-13 17:27:36'),
(105, '', '', '', 'a.pampana@gvngroup.it', 0, '2023-11-13 17:27:36'),
(106, '', '', '', 'info@hotel-ambassador.it', 0, '2023-11-13 17:27:36'),
(107, '', '', '', 'info@hotelambrosini.it', 0, '2023-11-13 17:27:36'),
(108, '', '', '', 'info@hotelcanadabellamonte.it', 0, '2023-11-13 17:27:36'),
(109, '', '', '', 'info@hotelilma.it', 0, '2023-11-13 17:27:36'),
(110, '', '', '', 'info@hotelladinia.com', 0, '2023-11-13 17:27:36'),
(111, '', '', '', 'hotel@hbelvedere.it', 0, '2023-11-13 17:27:36'),
(112, '', '', '', 'sonja@hotelcastelpietra.it', 0, '2023-11-13 17:27:36'),
(113, '', '', '', 'info@cesa-padon.it', 0, '2023-11-13 17:27:36'),
(114, '', '', '', 'info@hotelnele.com', 0, '2023-11-13 17:27:36'),
(115, '', '', '', 'info@hotelladina.it', 0, '2023-11-13 17:27:36'),
(116, '', '', '', 'info@shandrani.com', 0, '2023-11-13 17:27:36'),
(117, '', '', '', 'info@hotelzirmesmoena.it', 0, '2023-11-13 17:27:36'),
(118, '', '', '', 'costanzi.flavio69@gmail.com', 0, '2023-11-13 17:27:36'),
(119, '', '', '', 'amministrazione@hotellacartiera.it', 0, '2023-11-13 17:27:36'),
(120, '', '', '', 'lagruba@gmail.com', 0, '2023-11-13 17:27:36'),
(121, '', '', '', 'info@hotel-lesalpes.com', 0, '2023-11-13 17:27:36'),
(122, '', '', '', 'claudiadegia@yahoo.it', 0, '2023-11-13 17:27:36'),
(123, '', '', '', 'economato@sunshinehotel.it', 0, '2023-11-13 17:27:36'),
(124, '', '', '', 'info@grandhotelrabbi.it', 0, '2023-11-13 17:27:36'),
(125, '', '', '', 'direzione@hotelfloracomano.it', 0, '2023-11-13 17:27:36'),
(126, '', '', '', 'sonia.trulyitaly@gmail.com', 0, '2023-11-13 17:27:36'),
(127, 'Ismaele Tuffanelli', 'Ismaele', 'Tuffanelli', 'ismaele.tuffanelli@gmail.com', 0, '2023-11-13 17:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT '',
  `password` varchar(128) DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `groupId` int(11) DEFAULT '0',
  `admin` tinyint(1) DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstName`, `lastName`, `groupId`, `admin`, `time`) VALUES
(1, 'ismaele.t', '$2y$10$RByjaN2izwNcJ7yXwB83w.JNXKkrwo3myIuXRSGKBPk4kA7yv7wRq', 'ismaele.tuffanelli@gmail.com', 'Ismaele', 'Tuffanelli', 1, 2, '2023-06-30 15:03:04'),
(2, 'lucio.m', '$2y$10$TQ477w4eRNFCe5hYYeESr.Zw.nsSFvM3RVgXxHnl/msbqtazj8JgO', 'lucio.monsorno@gmail.com', 'Lucio', 'Monsorno', 0, 1, '2023-06-30 15:03:04'),
(4, '', '$2y$10$7b0.u2TgIJ0jFeriNMLcOe1N.LOJ8L9MViGf6lCIEjg9eReJDyL9K', 'perlativania@gmail.com', 'Vania', 'perlativania@gmail.com', 0, 0, '2024-02-18 08:53:36'),
(5, '', '$2y$10$Ul3wCFlUd95y8Ux63tTGauQkY6bFDRQyCRM6p.kCewKwYbab8xJbe', 'consulting.grg@gmail.com', 'Giorgio', 'anglese', 0, 0, '2024-03-26 18:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`) VALUES
(1, 'Struttura'),
(2, 'Rivenditore');

-- --------------------------------------------------------

--
-- Table structure for table `user_resets`
--

CREATE TABLE `user_resets` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `security` varchar(10) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_categories`
--
ALTER TABLE `admin_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_sections`
--
ALTER TABLE `admin_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens_admin`
--
ALTER TABLE `auth_tokens_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_addresses`
--
ALTER TABLE `ecommerce_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_carts`
--
ALTER TABLE `ecommerce_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_carts_comments`
--
ALTER TABLE `ecommerce_carts_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_coupons`
--
ALTER TABLE `ecommerce_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_customers`
--
ALTER TABLE `ecommerce_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_orders`
--
ALTER TABLE `ecommerce_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_payments`
--
ALTER TABLE `ecommerce_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_products`
--
ALTER TABLE `ecommerce_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_product_categories`
--
ALTER TABLE `ecommerce_product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_product_images`
--
ALTER TABLE `ecommerce_product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_product_likes`
--
ALTER TABLE `ecommerce_product_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_product_types`
--
ALTER TABLE `ecommerce_product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_promotions`
--
ALTER TABLE `ecommerce_promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_reviews`
--
ALTER TABLE `ecommerce_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_shipping_methods`
--
ALTER TABLE `ecommerce_shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_reviews`
--
ALTER TABLE `global_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers_old`
--
ALTER TABLE `newsletter_subscribers_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_resets`
--
ALTER TABLE `user_resets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_categories`
--
ALTER TABLE `admin_categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_sections`
--
ALTER TABLE `admin_sections`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `auth_tokens_admin`
--
ALTER TABLE `auth_tokens_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecommerce_addresses`
--
ALTER TABLE `ecommerce_addresses`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecommerce_carts`
--
ALTER TABLE `ecommerce_carts`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ecommerce_carts_comments`
--
ALTER TABLE `ecommerce_carts_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecommerce_coupons`
--
ALTER TABLE `ecommerce_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecommerce_customers`
--
ALTER TABLE `ecommerce_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ecommerce_orders`
--
ALTER TABLE `ecommerce_orders`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ecommerce_payments`
--
ALTER TABLE `ecommerce_payments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecommerce_products`
--
ALTER TABLE `ecommerce_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ecommerce_product_categories`
--
ALTER TABLE `ecommerce_product_categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ecommerce_product_images`
--
ALTER TABLE `ecommerce_product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecommerce_product_likes`
--
ALTER TABLE `ecommerce_product_likes`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecommerce_product_types`
--
ALTER TABLE `ecommerce_product_types`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ecommerce_promotions`
--
ALTER TABLE `ecommerce_promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecommerce_reviews`
--
ALTER TABLE `ecommerce_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecommerce_shipping_methods`
--
ALTER TABLE `ecommerce_shipping_methods`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `global_reviews`
--
ALTER TABLE `global_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter_subscribers_old`
--
ALTER TABLE `newsletter_subscribers_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_resets`
--
ALTER TABLE `user_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
