-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 sep. 2018 à 14:59
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet5`
--

-- --------------------------------------------------------

--
-- Structure de la table `projet5_comments`
--

DROP TABLE IF EXISTS `projet5_comments`;
CREATE TABLE IF NOT EXISTS `projet5_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `reporting` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_comments`
--

INSERT INTO `projet5_comments` (`id`, `userId`, `articleId`, `groupId`, `content`, `creationDate`, `reporting`) VALUES
(31, 14, 35, 99, 'Ardore pendentem quodam plebem haec ergo eventu eventu ad nihil textum Romae cum curulium mirum.', '2018-09-04 16:45:07', 0),
(32, 15, 37, 100, 'Tuas dicto et contumaciter in nulla quod nec nec iubebo et ambage nulla et ambage.', '2018-09-04 16:49:26', 0),
(33, 14, 37, 100, 'Porrecta equestrium robur casu retroque iuventutis victu sunt digressi iuventutis equestrium in omne digressi et.', '2018-09-04 16:53:56', 0),
(34, 16, 37, 100, 'Prandiis ignobiles nomenclatores et inutiles subditicios et quoque adsueti et ignobiles haec talia ut quosdam.', '2018-09-04 16:55:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `projet5_groups`
--

DROP TABLE IF EXISTS `projet5_groups`;
CREATE TABLE IF NOT EXISTS `projet5_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(240) NOT NULL,
  `public` int(11) NOT NULL,
  `description` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `lastUpdate` datetime NOT NULL,
  `nbPost` int(11) NOT NULL,
  `nbMember` int(11) NOT NULL,
  `linkCouvPicture` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_groups`
--

INSERT INTO `projet5_groups` (`id`, `title`, `public`, `description`, `creationDate`, `lastUpdate`, `nbPost`, `nbMember`, `linkCouvPicture`) VALUES
(101, 'Haec formidine recalcitrantes tenus haec.', 1, '&lt;p&gt;Post haec Gallus Hierapolim profecturus ut expeditioni specie tenus adesset, Antiochensi plebi suppliciter obsecranti ut inediae dispelleret metum, quae per multas difficilisque causas adfore iam sperabatur, non ut mos est principibus, quorum diffusa potestas localibus subinde medetur aerumnis, disponi quicquam statuit vel ex provinciis alimenta transferri conterminis, sed consularem Syriae Theophilum prope adstantem ultima metuenti multitudini dedit id adsidue replicando quod invito rectore nullus egere poterit victu.&lt;/p&gt;\r\n&lt;p&gt;Harum trium sententiarum nulli prorsus assentior. Nec enim illa prima vera est, ut, quem ad modum in se quisque sit, sic in amicum sit animatus. Quam multa enim, quae nostra causa numquam faceremus, facimus causa amicorum! precari ab indigno, supplicare, tum acerbius in aliquem invehi insectarique vehementius, quae in nostris rebus non satis honeste, in amicorum fiunt honestissime; multaeque res sunt in quibus de suis commodis viri boni multa detrahunt detrahique patiuntur, ut iis amici potius quam ipsi fruantur.&lt;/p&gt;', '2018-09-04 16:52:06', '2018-09-04 16:53:03', 0, 2, 1),
(100, 'Amice quod tantum Paulum tribui.', 1, '&lt;p&gt;Montius nos tumore inusitato quodam et novo ut rebellis et maiestati recalcitrantes Augustae per haec quae strepit incusat iratus nimirum quod contumacem praefectum, quid rerum ordo postulat ignorare dissimulantem formidine tenus iusserim custodiri.&lt;/p&gt;\r\n&lt;p&gt;Vita est illis semper in fuga uxoresque mercenariae conductae ad tempus ex pacto atque, ut sit species matrimonii, dotis nomine futura coniunx hastam et tabernaculum offert marito, post statum diem si id elegerit discessura, et incredibile est quo ardore apud eos in venerem uterque solvitur sexus.&lt;/p&gt;\r\n&lt;p&gt;Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?&lt;/p&gt;', '2018-09-04 16:47:28', '2018-09-04 16:47:28', 1, 3, 1),
(99, 'Dilato turbulentos consenuit Eusebius genere.', 0, '&lt;p&gt;Cum saepe multa, tum memini domi in hemicyclio sedentem, ut solebat, cum et ego essem una et pauci admodum familiares, in eum sermonem illum incidere qui tum forte multis erat in ore. Meministi enim profecto, Attice, et eo magis, quod P. Sulpicio utebare multum, cum is tribunus plebis capitali odio a Q. Pompeio, qui tum erat consul, dissideret, quocum coniunctissime et amantissime vixerat, quanta esset hominum vel admiratio vel querella.&lt;/p&gt;\r\n&lt;p&gt;Et quia Montius inter dilancinantium manus spiritum efflaturus Epigonum et Eusebium nec professionem nec dignitatem ostendens aliquotiens increpabat, qui sint hi magna quaerebatur industria, et nequid intepesceret, Epigonus e Lycia philosophus ducitur et Eusebius ab Emissa Pittacas cognomento, concitatus orator, cum quaestor non hos sed tribunos fabricarum insimulasset promittentes armorum si novas res agitari conperissent.&lt;/p&gt;\r\n&lt;p&gt;Post hoc impie perpetratum quod in aliis quoque iam timebatur, tamquam licentia crudelitati indulta per suspicionum nebulas aestimati quidam noxii damnabantur. quorum pars necati, alii puniti bonorum multatione actique laribus suis extorres nullo sibi relicto praeter querelas et lacrimas, stipe conlaticia victitabant, et civili iustoque imperio ad voluntatem converso cruentam, claudebantur opulentae domus et clarae.&lt;/p&gt;', '2018-09-04 16:44:01', '2018-09-04 16:44:01', 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `projet5_linkfriend`
--

DROP TABLE IF EXISTS `projet5_linkfriend`;
CREATE TABLE IF NOT EXISTS `projet5_linkfriend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId1` int(11) NOT NULL,
  `userId2` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `linkDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_linkfriend`
--

INSERT INTO `projet5_linkfriend` (`id`, `userId1`, `userId2`, `link`, `linkDate`) VALUES
(86, 14, 15, 1, '2018-09-02 19:40:54'),
(85, 15, 14, 1, '2018-09-02 19:40:54'),
(84, 15, 16, 1, '2018-09-02 19:40:24'),
(83, 16, 15, 1, '2018-09-02 19:40:24'),
(87, 14, 16, 1, '2018-09-03 12:47:47'),
(88, 16, 14, 0, '2018-09-03 12:47:47');

-- --------------------------------------------------------

--
-- Structure de la table `projet5_linkgroupuser`
--

DROP TABLE IF EXISTS `projet5_linkgroupuser`;
CREATE TABLE IF NOT EXISTS `projet5_linkgroupuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `linkDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_linkgroupuser`
--

INSERT INTO `projet5_linkgroupuser` (`id`, `groupId`, `userId`, `status`, `linkDate`) VALUES
(207, 100, 16, 2, '2018-09-04 16:47:28'),
(206, 100, 14, 1, '2018-09-04 16:47:28'),
(205, 99, 14, 1, '2018-09-04 16:44:01'),
(204, 99, 15, 2, '2018-09-04 16:44:01'),
(210, 101, 14, 1, '2018-09-04 16:52:06'),
(209, 101, 15, 2, '2018-09-04 16:52:06'),
(208, 100, 15, 1, '2018-09-04 16:47:28');

-- --------------------------------------------------------

--
-- Structure de la table `projet5_linkreporting`
--

DROP TABLE IF EXISTS `projet5_linkreporting`;
CREATE TABLE IF NOT EXISTS `projet5_linkreporting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  `reportingDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet5_posts`
--

DROP TABLE IF EXISTS `projet5_posts`;
CREATE TABLE IF NOT EXISTS `projet5_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `title` varchar(240) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `nbComment` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_posts`
--

INSERT INTO `projet5_posts` (`id`, `userId`, `groupId`, `title`, `content`, `creationDate`, `updateDate`, `nbComment`) VALUES
(35, 14, 99, 'Quem introiit nec morbosque praestrictis.', '<p>Illud tamen clausos vehementer angebat quod captis navigiis, quae frumenta vehebant per flumen, Isauri quidem alimentorum copiis adfluebant, ipsi vero solitarum rerum cibos iam consumendo inediae propinquantis aerumnas exitialis horrebant.</p>\r\n<p>Nam sole orto magnitudine angusti gurgitis sed profundi a transitu arcebantur et dum piscatorios quaerunt lenunculos vel innare temere contextis cratibus parant, effusae legiones, quae hiemabant tunc apud Siden, isdem impetu occurrere veloci. et signis prope ripam locatis ad manus comminus conserendas denseta scutorum conpage semet scientissime praestruebant, ausos quoque aliquos fiducia nandi vel cavatis arborum truncis amnem permeare latenter facillime trucidarunt.</p>\r\n<p>Quam ob rem cave Catoni anteponas ne istum quidem ipsum, quem Apollo, ut ais, sapientissimum iudicavit; huius enim facta, illius dicta laudantur. De me autem, ut iam cum utroque vestrum loquar, sic habetote.</p>', '2018-09-04 16:44:45', '2018-09-04 16:44:45', 1),
(36, 15, 99, 'Efferatus praefectus adrogantis quoddam quibus.', '<p>Qui cum venisset ob haec festinatis itineribus Antiochiam, praestrictis palatii ianuis, contempto Caesare, quem videri decuerat, ad praetorium cum pompa sollemni perrexit morbosque diu causatus nec regiam introiit nec processit in publicum, sed abditus multa in eius moliebatur exitium addens quaedam relationibus supervacua, quas subinde dimittebat ad principem.</p>\r\n<p>Sed cautela nimia in peiores haeserat plagas, ut narrabimus postea, aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in hoc causarum titulo dissimilem sui.</p>\r\n<p>Nihil morati post haec militares avidi saepe turbarum adorti sunt Montium primum, qui divertebat in proximo, levi corpore senem atque morbosum, et hirsutis resticulis cruribus eius innexis divaricaturn sine spiramento ullo ad usque praetorium traxere praefecti.</p>\r\n<p>Intellectum est enim mihi quidem in multis, et maxime in me ipso, sed paulo ante in omnibus, cum M. Marcellum senatui reique publicae concessisti, commemoratis praesertim offensionibus, te auctoritatem huius ordinis dignitatemque rei publicae tuis vel doloribus vel suspicionibus anteferre. Ille quidem fructum omnis ante actae vitae hodierno die maximum cepit, cum summo consensu senatus, tum iudicio tuo gravissimo et maximo. Ex quo profecto intellegis quanta in dato beneficio sit laus, cum in accepto sit tanta gloria.</p>\r\n<p>Auxerunt haec vulgi sordidioris audaciam, quod cum ingravesceret penuria commeatuum, famis et furoris inpulsu Eubuli cuiusdam inter suos clari domum ambitiosam ignibus subditis inflammavit rectoremque ut sibi iudicio imperiali addictum calcibus incessens et pugnis conculcans seminecem laniatu miserando discerpsit. post cuius lacrimosum interitum in unius exitio quisque imaginem periculi sui considerans documento recenti similia formidabat.</p>', '2018-09-04 16:46:18', '2018-09-04 16:46:18', 0),
(37, 15, 100, 'Ac ratio quidem solvantur iste.', '<p>Dumque ibi diu moratur commeatus opperiens, quorum translationem ex Aquitania verni imbres solito crebriores prohibebant auctique torrentes, Herculanus advenit protector domesticus, Hermogenis ex magistro equitum filius, apud Constantinopolim, ut supra rettulimus, populari quondam turbela discerpti. quo verissime referente quae Gallus egerat, damnis super praeteritis maerens et futurorum timore suspensus angorem animi quam diu potuit emendabat.</p>\r\n<p>Et quia Mesopotamiae tractus omnes crebro inquietari sueti praetenturis et stationibus servabantur agrariis, laevorsum flexo itinere Osdroenae subsederat extimas partes, novum parumque aliquando temptatum commentum adgressus. quod si impetrasset, fulminis modo cuncta vastarat. erat autem quod cogitabat huius modi.</p>', '2018-09-04 16:49:07', '2018-09-04 16:49:07', 3);

-- --------------------------------------------------------

--
-- Structure de la table `projet5_users`
--

DROP TABLE IF EXISTS `projet5_users`;
CREATE TABLE IF NOT EXISTS `projet5_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `creationProfil` datetime NOT NULL,
  `nbGroup` int(11) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `nbPublication` int(11) NOT NULL,
  `nbComment` int(11) NOT NULL,
  `actif` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_users`
--

INSERT INTO `projet5_users` (`id`, `pseudo`, `mdp`, `creationProfil`, `nbGroup`, `lastLogin`, `nbPublication`, `nbComment`, `actif`, `admin`) VALUES
(15, 'Elise Duval', '$2y$10$VbZrSm49q/qSVaEzTwqtt.CTev0FVQruaGQKdooQ93WiXCoReh/IG', '2018-09-02 19:40:11', 13, '2018-09-02 19:40:11', 2, 1, 1, 0),
(14, 'Antoine Libert', '$2y$10$df5Dt2y0TqUKjE96iNqo9OrU12wMVFtDMVsMzYlyEnAMbCtD80oE2', '2018-09-02 19:39:56', 21, '2018-09-02 19:39:56', 2, 2, 1, 0),
(16, 'Jean Forteroche', '$2y$10$n.XdkZlQlR.G4RhmmSXogOCvIAEZGFVx1nfXiNkW299HuF3SvCMTu', '2018-09-02 19:40:20', 18, '2018-09-02 19:40:20', 0, 1, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
