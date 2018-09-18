-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : ingenusprb476.mysql.db
-- Généré le :  mar. 18 sep. 2018 à 14:06
-- Version du serveur :  5.6.39-log
-- Version de PHP :  5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ingenusprb476`
--

-- --------------------------------------------------------

--
-- Structure de la table `projet5_groups`
--

CREATE TABLE `projet5_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(240) NOT NULL,
  `public` int(11) NOT NULL,
  `description` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `lastUpdate` datetime NOT NULL,
  `nbPost` int(11) NOT NULL,
  `nbMember` int(11) NOT NULL,
  `linkCouvPicture` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_groups`
--

INSERT INTO `projet5_groups` (`id`, `title`, `public`, `description`, `creationDate`, `lastUpdate`, `nbPost`, `nbMember`, `linkCouvPicture`) VALUES
(139, 'Quis velit omnes te Quis talem quod culpa alterum quod.', 1, '&lt;p&gt;Vbi curarum abiectis ponderibus aliis tamquam nodum et codicem difficillimum Caesarem convellere nisu valido cogitabat, eique deliberanti cum proximis clandestinis conloquiis et nocturnis qua vi, quibusve commentis id fieret, antequam effundendis rebus pertinacius incumberet confidentia, acciri mollioribus scriptis per simulationem tractatus publici nimis urgentis eundem placuerat Gallum, ut auxilio destitutus sine ullo interiret obstaculo.&lt;/p&gt;', '2018-09-18 00:14:52', '2018-09-18 00:14:52', 0, 1, 0),
(137, 'Eo Tarsus Iovis sospitales et Tarsus Aethiopia urbs vocabulum perspicabilis.', 1, '', '2018-09-18 00:11:16', '2018-09-18 00:11:16', 0, 1, 1),
(138, 'Si ille fortuna etiamsi tam illa rei utilitatem rei quid.', 1, '&lt;p&gt;Atque, ut Tullius ait, ut etiam ferae fame monitae plerumque ad eum locum ubi aliquando pastae sunt revertuntur, ita homines instar turbinis degressi montibus impeditis et arduis loca petivere mari confinia, per quae viis latebrosis sese convallibusque occultantes cum appeterent noctes luna etiam tum cornuta ideoque nondum solido splendore fulgente nauticos observabant quos cum in somnum sentirent effusos per ancoralia, quadrupedo gradu repentes seseque suspensis passibus iniectantes in scaphas eisdem sensim nihil opinantibus adsistebant et incendente aviditate saevitiam ne cedentium quidem ulli parcendo obtruncatis omnibus merces opimas velut viles nullis repugnantibus avertebant. haecque non diu sunt perpetrata.&lt;/p&gt;', '2018-09-18 00:12:42', '2018-09-18 00:12:42', 0, 0, 0),
(135, 'Quam etiam ut operatur operatur ut facinorum mentium partilibus quam. 	', 1, '&lt;p&gt;Rogatus ad ultimum admissusque in consistorium ambage nulla praegressa inconsiderate et leviter proficiscere inquit ut praeceptum est, Caesar sciens quod si cessaveris, et tuas et palatii tui auferri iubebo prope diem annonas. hocque solo contumaciter dicto subiratus abscessit nec in conspectum eius postea venit saepius arcessitus.&lt;/p&gt;\r\n&lt;p&gt;Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota.&lt;/p&gt;', '2018-09-18 00:06:39', '2018-09-18 00:06:48', 1, 3, 0),
(136, 'Trucidarunt denseta Siden ausos nandi sole trucidarunt fiducia ad a.', 1, '&lt;p&gt;Et prima post Osdroenam quam, ut dictum est, ab hac descriptione discrevimus, Commagena, nunc Euphratensis, clementer adsurgit, Hierapoli, vetere Nino et Samosata civitatibus amplis inlustris.&lt;/p&gt;\r\n&lt;p&gt;Victus universis caro ferina est lactisque abundans copia qua sustentantur, et herbae multiplices et siquae alites capi per aucupium possint, et plerosque mos vidimus frumenti usum et vini penitus ignorantes.&lt;/p&gt;\r\n&lt;p&gt;Pandente itaque viam fatorum sorte tristissima, qua praestitutum erat eum vita et imperio spoliari, itineribus interiectis permutatione iumentorum emensis venit Petobionem oppidum Noricorum, ubi reseratae sunt insidiarum latebrae omnes, et Barbatio repente apparuit comes, qui sub eo domesticis praefuit, cum Apodemio agente in rebus milites ducens, quos beneficiis suis oppigneratos elegerat imperator certus nec praemiis nec miseratione ulla posse deflecti.&lt;/p&gt;', '2018-09-18 00:10:26', '2018-09-18 00:10:26', 0, 1, 1),
(134, 'Venerit illi cum mandabat adiumenta quem Italiam sollicitari Gentilibus et.', 0, '&lt;p&gt;Denique Antiochensis ordinis vertices sub uno elogio iussit occidi ideo efferatus, quod ei celebrari vilitatem intempestivam urgenti, cum inpenderet inopia, gravius rationabili responderunt; et perissent ad unum ni comes orientis tunc Honoratus fixa constantia restitisset.&lt;/p&gt;\r\n&lt;p&gt;Quanta autem vis amicitiae sit, ex hoc intellegi maxime potest, quod ex infinita societate generis humani, quam conciliavit ipsa natura, ita contracta res est et adducta in angustum ut omnis caritas aut inter duos aut inter paucos iungeretur.&lt;/p&gt;', '2018-09-18 00:05:24', '2018-09-18 00:05:24', 0, 3, 0),
(133, 'Modum seditiones usibus nobilem concitatae.', 0, '&lt;p&gt;Post hanc adclinis Libano monti Phoenice, regio plena gratiarum et venustatis, urbibus decorata magnis et pulchris; in quibus amoenitate celebritateque nominum Tyros excellit, Sidon et Berytus isdemque pares Emissa et Damascus saeculis condita priscis.&lt;/p&gt;', '2018-09-17 23:56:04', '2018-09-17 23:56:04', 3, 3, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet5_groups`
--
ALTER TABLE `projet5_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projet5_groups`
--
ALTER TABLE `projet5_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
