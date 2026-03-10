-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 17 fév. 2026 à 15:12
-- Version du serveur : 10.6.22-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `evaluation_mve`
--

-- --------------------------------------------------------

--
-- Structure de la table `evaluateur_users`
--

CREATE TABLE `evaluateur_users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` enum('evaluateur_insp','evaluateur_sgi') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evaluations_insp`
--

CREATE TABLE `evaluations_insp` (
  `id` int(11) NOT NULL,
  `recommandations_principales` text DEFAULT NULL,
  `bonnes_pratiques` text DEFAULT NULL,
  `difficultes` text DEFAULT NULL,
  `observations_generales` text DEFAULT NULL,
  `evaluateur_nom` varchar(100) DEFAULT NULL,
  `evaluateur_fonction` varchar(100) DEFAULT NULL,
  `date_evaluation` date NOT NULL,
  `commentaires` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `partenaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluations_insp`
--

INSERT INTO `evaluations_insp` (`id`, `recommandations_principales`, `bonnes_pratiques`, `difficultes`, `observations_generales`, `evaluateur_nom`, `evaluateur_fonction`, `date_evaluation`, `commentaires`, `created_at`, `partenaire_id`) VALUES
(1, 'RRR', 'TTTT', 'FFFF', 'FFFFF', 'Don', 'Manager', '2025-11-16', 'RRRR', '2025-11-16 20:24:29', 10),
(2, 'RRRR', 'TTTTT', 'TTTTTT', 'YYYYYYYY', 'Mukenyi', 'DGA', '2025-09-16', 'RARAR', '2025-11-16 20:32:25', 9),
(3, 'RRRRRR', 'TTTTTT', 'HHHHHHHH', 'JJJJJJJJ', 'Mukenyi BADIBANGA', 'DGA', '2026-02-13', 'RRRRRRRRRR', '2026-02-13 11:27:17', 12);

-- --------------------------------------------------------

--
-- Structure de la table `evaluations_intrants`
--

CREATE TABLE `evaluations_intrants` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `intrant_type` varchar(255) DEFAULT NULL,
  `intrant_quantite` int(11) DEFAULT NULL,
  `intrant_unite` varchar(100) DEFAULT NULL,
  `intrant_site` varchar(255) DEFAULT NULL,
  `intrant_observation` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluations_intrants`
--

INSERT INTO `evaluations_intrants` (`id`, `evaluation_id`, `intrant_type`, `intrant_quantite`, `intrant_unite`, `intrant_site`, `intrant_observation`, `created_at`) VALUES
(5, 10, 'UGIGIG1IGIYG', 10, 'Cartons', 'Bulape', 'TATTA', '2025-11-16 21:20:25'),
(6, 10, 'UGIGIG1IGIYG', 23, 'uigiuo', 'OHOOIHOH', 'huiohoiu', '2025-11-16 21:20:25'),
(7, 9, 'Vaccin', 16, 'Pqauets', 'OHOOIHOH', 'AUcune', '2025-11-16 21:29:52'),
(8, 11, 'afazfa', 5, 'azfazfa', 'fazfazf', 'fazfaz', '2025-11-18 15:14:46'),
(9, 2, 'Aspirine', 12, 'Boites', 'Bulape', 'BUU', '2025-11-18 15:53:10'),
(10, 12, 'Seringue', 10, 'pièces', 'Hôpital de Bulape', 'RRRR', '2026-02-13 11:15:18');

-- --------------------------------------------------------

--
-- Structure de la table `evaluations_partenaire`
--

CREATE TABLE `evaluations_partenaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `type_org` varchar(100) DEFAULT NULL,
  `type_org_precision` varchar(255) DEFAULT NULL,
  `contact_principal` varchar(255) DEFAULT NULL,
  `fonction_contact` varchar(255) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `zone_autre` varchar(255) DEFAULT NULL,
  `site_intervention` varchar(255) DEFAULT NULL,
  `site_autre` varchar(255) DEFAULT NULL,
  `domaine` text DEFAULT NULL,
  `autre_domaine_precision` varchar(255) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `activites` text DEFAULT NULL,
  `resultats` text DEFAULT NULL,
  `defis` text DEFAULT NULL,
  `solutions` text DEFAULT NULL,
  `commentaires` text DEFAULT NULL,
  `recommandations` text DEFAULT NULL,
  `accred_duree_ecoulee` enum('Oui','Non') DEFAULT NULL,
  `accred_motivation` text DEFAULT NULL,
  `accred_objectif` text DEFAULT NULL,
  `accred_lien_plan` text DEFAULT NULL,
  `accred_resultats` text DEFAULT NULL,
  `rep_nom` varchar(255) DEFAULT NULL,
  `rep_fonction` varchar(255) DEFAULT NULL,
  `rep_date_eval` date DEFAULT NULL,
  `date_evaluation` date DEFAULT NULL,
  `statut` enum('brouillon','soumis') DEFAULT 'brouillon',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluations_partenaire`
--

INSERT INTO `evaluations_partenaire` (`id`, `nom`, `type_org`, `type_org_precision`, `contact_principal`, `fonction_contact`, `telephone`, `email`, `zone`, `zone_autre`, `site_intervention`, `site_autre`, `domaine`, `autre_domaine_precision`, `date_debut`, `date_fin`, `activites`, `resultats`, `defis`, `solutions`, `commentaires`, `recommandations`, `accred_duree_ecoulee`, `accred_motivation`, `accred_objectif`, `accred_lien_plan`, `accred_resultats`, `rep_nom`, `rep_fonction`, `rep_date_eval`, `date_evaluation`, `statut`, `created_at`, `updated_at`, `user_id`) VALUES
(2, 'uihif', 'ONG Nationale', '', 'Kabuya', 'Manager Général', '+243828050018', 'dkabuya@congoparkingservice.com', 'Bulape', '', 'Communautés', '', 'Domaines : Coordination, Surveillance épidémiologique, Surveillance environnementale, Laboratoire', '', '2025-09-01', '2025-09-30', 'ZZZZZ', 'EEEE', 'HHHHH', 'HHHHH', 'JJJJJJJ', 'TTTTT', 'Non', '', '', '', '', 'Seraphin Kanyind', 'Coordonnateur National', '2025-11-18', '2025-11-16', 'soumis', '2025-11-16 20:53:53', '2025-11-18 15:53:10', 2),
(6, 'ejobfoz', '', '', '', '', '', '', '', '', '', '', 'Domaines : ', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '2025-11-16', 'brouillon', '2025-11-16 20:56:13', '2025-11-16 21:04:50', 6),
(7, 'ibhbkb', '', '', '', '', '', '', '', '', '', '', 'Domaines : ', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '2025-11-16', 'brouillon', '2025-11-16 20:56:24', '2025-11-16 21:04:50', 7),
(8, 'fbzbe', 'ONG Nationale', '', '', '', '', '', '', '', '', '', 'Domaines : ', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '2025-11-16', 'brouillon', '2025-11-16 21:04:54', '2026-02-13 11:01:14', 2),
(9, 'jbkbk', 'Agence ONU', '', 'Diego', 'IT', '+243818897032', 'Winnerluyeye1@gmail.com', 'Bulape', '', 'Hôpitaux', '', 'Domaines : Laboratoire, PCI/WASH', '', '2025-09-01', '2025-09-30', 'RARAA', 'TATTAAAA', 'YAYAYAAYAYA', 'HAAHAHHAAH', 'HGAAHAAHAHHAHA', 'AAAAAAAAA', 'Oui', 'RRR', 'RRRRR', 'RRRRR', 'RTRRRRRRR', 'Dr. Jean', 'Coordonnateur', '2025-11-16', '2025-11-16', 'soumis', '2025-11-16 21:05:06', '2025-11-16 21:29:52', 2),
(10, 'Kabuya', 'ONG Nationale', '', 'ghgkhg', 'ghkgkhg', '+243818897032', 'Winnerluyeye1@gmail.com', 'Mweka', '', 'Centre de Santé', '', 'Domaines : Coordination, Surveillance épidémiologique', '', '2025-09-12', '2025-09-30', 'YYYYYY', 'HHHHH', 'JJJJJJ', 'JJJJ', 'JJJJJJJJJ', 'FFFFFF', 'Non', '', '', '', '', 'Winner Luyeye Muingulu', 'ouhuiohiuo', '2025-10-16', '2025-11-16', 'soumis', '2025-11-16 21:15:12', '2025-11-16 21:20:25', 2),
(11, 'efaeeefa', 'Gouvernement', '', 'afaf', 'azfazf', '+243818897032', 'Winnerluyeye1@gmail.com', 'Yalibongo', '', 'Centre de Santé', '', 'Domaines : Coordination, Surveillance épidémiologique', '', '2025-11-01', '2025-11-04', 'fzafazfa', 'afzfazfazf', 'afazfa', 'fazfazfaz', 'zefafaf', 'azfazf', 'Non', '', '', '', '', 'fzafazf', 'fazfa', '2000-02-22', '2025-11-18', 'soumis', '2025-11-18 15:14:46', '2025-11-18 15:14:46', 2),
(12, 'Maintelia', 'ONG Internationale', '', 'Kabe', 'IT Manager', '+243828050018', 'insp.rdc243@gmail.com', 'Bulape', '', 'Hôpitaux', '', 'Domaines : Coordination, Surveillance épidémiologique, Autre', '', '2025-09-12', '2025-09-27', 'RRRRRRRR', 'RRRRRRR', 'RRRRRRRRRR', 'RRRRRRR', 'RRRRRZZZZZ', 'KKKKKKKKKK', 'Non', '', '', '', '', 'Bibi BAZEBISALA', 'Manager Général', '2025-09-28', '2025-11-18', 'soumis', '2025-11-18 15:16:22', '2026-02-13 11:15:18', 2),
(13, 'OMS', '', '', '', '', '', '', '', '', '', '', 'Domaines : ', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '2025-11-18', 'brouillon', '2025-11-18 15:27:20', '2025-11-18 15:27:20', 2),
(14, 'ONG', '', '', '', '', '', '', '', '', '', '', 'Domaines : ', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '2025-11-18', 'brouillon', '2025-11-18 17:19:33', '2025-11-18 17:19:33', 2),
(15, '', '', '', '', '', '', '', '', '', '', '', 'Domaines : ', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '2025-11-19', 'brouillon', '2025-11-19 11:04:30', '2025-11-19 11:04:30', 2);

-- --------------------------------------------------------

--
-- Structure de la table `evaluations_pilier`
--

CREATE TABLE `evaluations_pilier` (
  `id` int(11) NOT NULL,
  `pilier` varchar(100) NOT NULL,
  `pertinence_appui` enum('Très satisfaisant','Satisfaisant','À améliorer','Non satisfaisant') DEFAULT NULL,
  `pertinence_commentaire` text DEFAULT NULL,
  `disponibilite` enum('Très satisfaisant','Satisfaisant','À améliorer','Non satisfaisant') DEFAULT NULL,
  `disponibilite_commentaire` text DEFAULT NULL,
  `contribution` enum('Très satisfaisant','Satisfaisant','À améliorer','Non satisfaisant') DEFAULT NULL,
  `contribution_commentaire` text DEFAULT NULL,
  `coordination` enum('Très satisfaisant','Satisfaisant','À améliorer','Non satisfaisant') DEFAULT NULL,
  `coordination_commentaire` text DEFAULT NULL,
  `transmission` enum('Très satisfaisant','Satisfaisant','À améliorer','Non satisfaisant') DEFAULT NULL,
  `transmission_commentaire` text DEFAULT NULL,
  `evaluateur_nom` varchar(100) DEFAULT NULL,
  `evaluateur_fonction` varchar(100) DEFAULT NULL,
  `date_evaluation` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluations_pilier`
--

INSERT INTO `evaluations_pilier` (`id`, `pilier`, `pertinence_appui`, `pertinence_commentaire`, `disponibilite`, `disponibilite_commentaire`, `contribution`, `contribution_commentaire`, `coordination`, `coordination_commentaire`, `transmission`, `transmission_commentaire`, `evaluateur_nom`, `evaluateur_fonction`, `date_evaluation`, `created_at`, `updated_at`) VALUES
(9, 'Coordination, Planification, CREC (Communication et Engagement Communautaire)', 'Très satisfaisant', 'zhghgzlhz', 'Satisfaisant', 'ihzgozhg', 'À améliorer', 'éjgtuoég', 'Non satisfaisant', 'kléhtoihét\'', 'Très satisfaisant', 'tnélnhértlo', 'lkhkl', 'Luyeye', '2000-02-22', '2025-11-15 22:59:32', '2025-11-15 23:19:00'),
(10, 'Coordination, Opérations, Planification', 'Très satisfaisant', 'RRRRR', 'Satisfaisant', 'RARRAR', 'Satisfaisant', 'RARAAARA', 'Satisfaisant', 'TTATTAATA', 'Très satisfaisant', 'GAGGAAG', 'Kanku Benjamin', 'IM', '2025-11-16', '2025-11-16 20:34:28', NULL),
(11, 'Opérations, Surveillance, PEC (Prise en Charge), Logistique', 'Très satisfaisant', 'JJJJJ', 'Très satisfaisant', 'HHHHH', 'Très satisfaisant', 'BBBBB', 'Très satisfaisant', 'HHHHH', 'Très satisfaisant', 'JJJJJJ', 'Dr. Gaella MITONGA', 'IM CREC', '2025-11-16', '2025-11-16 20:36:02', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `evaluations_rh`
--

CREATE TABLE `evaluations_rh` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `rh_nom` varchar(255) DEFAULT NULL,
  `rh_fonction` varchar(255) DEFAULT NULL,
  `rh_statut` enum('National','Expatrié') DEFAULT NULL,
  `rh_nationalite` varchar(100) DEFAULT NULL,
  `rh_date_debut` date DEFAULT NULL,
  `rh_date_fin` date DEFAULT NULL,
  `rh_duree` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluations_rh`
--

INSERT INTO `evaluations_rh` (`id`, `evaluation_id`, `rh_nom`, `rh_fonction`, `rh_statut`, `rh_nationalite`, `rh_date_debut`, `rh_date_fin`, `rh_duree`, `created_at`) VALUES
(5, 10, 'Winner Luyeye Muingulu', 'LKNLKNLKN', 'National', '', '2025-09-12', '2025-09-19', 7, '2025-11-16 21:20:25'),
(6, 10, 'Winner Luyeye Muingulu', 'LKNLKNLKN', 'National', '', '2025-09-12', '2025-09-27', 11, '2025-11-16 21:20:25'),
(7, 9, 'Winner Luyeye Muingulu', 'LKNLKNLKN', 'National', '', '2025-09-01', '2025-09-30', 30, '2025-11-16 21:29:52'),
(8, 11, 'Winner Luyeye Muingulu', 'zfafaf', 'National', '', '2025-11-06', '2025-10-12', 5, '2025-11-18 15:14:46'),
(10, 2, 'Dieudonné Kabuya', 'IT', 'Expatrié', 'Malien', '2025-09-01', '2025-09-12', 12, '2025-11-18 15:53:10'),
(11, 15, 'Mukuna', '', 'Expatrié', '', '0000-00-00', '0000-00-00', 0, '2025-11-19 11:04:30'),
(12, 12, 'Dieudonné Kabuya', 'Expert', 'National', '', '2025-09-10', '2025-09-21', 11, '2026-02-13 11:15:18');

-- --------------------------------------------------------

--
-- Structure de la table `intrants_fournis`
--

CREATE TABLE `intrants_fournis` (
  `id` int(11) NOT NULL,
  `partenaire_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `unite` varchar(50) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `observation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

CREATE TABLE `partenaires` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `domaine` varchar(150) DEFAULT NULL,
  `zone` varchar(150) DEFAULT NULL,
  `resume_appui` text DEFAULT NULL,
  `date_soumission` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partenaires_details`
--

CREATE TABLE `partenaires_details` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `type_org` varchar(100) DEFAULT NULL,
  `domaine` text DEFAULT NULL,
  `zone` text DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `resume_appui` text DEFAULT NULL,
  `ressources_humaines` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ressources_humaines`)),
  `logistique` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`logistique`)),
  `financement` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`financement`)),
  `recommandations` text DEFAULT NULL,
  `date_soumission` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `renouvellement_accreditation`
--

CREATE TABLE `renouvellement_accreditation` (
  `id` int(11) NOT NULL,
  `partenaire_id` int(11) NOT NULL,
  `duree_ecoulee` varchar(10) DEFAULT NULL,
  `motivation` text DEFAULT NULL,
  `objectif` text DEFAULT NULL,
  `lien_plan` text DEFAULT NULL,
  `resultats` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `representant_partenaire`
--

CREATE TABLE `representant_partenaire` (
  `id` int(11) NOT NULL,
  `partenaire_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `fonction` varchar(255) DEFAULT NULL,
  `date_evaluation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ressources_humaines`
--

CREATE TABLE `ressources_humaines` (
  `id` int(11) NOT NULL,
  `partenaire_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `fonction` varchar(255) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `nationalite` varchar(100) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `jours_restants` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_financier`
--

CREATE TABLE `suivi_financier` (
  `id` int(11) NOT NULL,
  `partenaire_id` int(11) NOT NULL,
  `montant_engage` decimal(15,2) DEFAULT NULL,
  `montant_depense` decimal(15,2) DEFAULT NULL,
  `modalites` text DEFAULT NULL,
  `justificatifs` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` serial,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `organisation` varchar(255) DEFAULT NULL,
  `fonction` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('partenaire','insp','sgi','pilier') NOT NULL,
  `statut` enum('actif','inactif') DEFAULT 'actif',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `organisation`, `password`, `role`, `statut`, `created_at`, `reset_token`, `reset_expires`) VALUES
(0, 'Kabuya', 'Dieudonné', 'nathanaeldon495@gmail.com', 'Maintelia', '$2y$10$dUQDX.FbMkmiMNmU9jkz4.Y7i3OgLi6EY2oQaDFspo6RWsT387vx6', 'partenaire', 'actif', '2025-11-18 15:17:41', NULL, NULL),
(1, 'Mukenyi', 'Badibanga', 'mukenyi.badibanga@insp.cd', NULL, '$2y$10$pmKM3ouVticqiFVXu8xo4.OcZ62RzH8SIEYLfuSOR6O1akgqA4l/i', 'insp', 'actif', '2025-11-07 14:32:18', NULL, NULL),
(2, 'Mukendi', 'Dieudonné', 'don.kabuya@insp.cd', 'ICAP', '$2y$10$.mCPEIG41hNvC2aZZwxWSOcc2Jnm8WnAdk/50Dc9K3H/5Jnpq.L4W', 'partenaire', 'actif', '2025-11-07 14:42:19', NULL, NULL),
(3, 'Kanku', 'Benjamin', 'ben.kanku@insp.cd', NULL, '$2y$10$ijCfJS25LN3v5Tk3XZ6SzOEqSz4PvWKvpHKM9eLwhXcJwFOYx878m', 'sgi', 'actif', '2025-11-07 14:54:55', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evaluateur_users`
--
ALTER TABLE `evaluateur_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `evaluations_insp`
--
ALTER TABLE `evaluations_insp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inps_partenaire` (`partenaire_id`);

--
-- Index pour la table `evaluations_intrants`
--
ALTER TABLE `evaluations_intrants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_id` (`evaluation_id`);

--
-- Index pour la table `evaluations_partenaire`
--
ALTER TABLE `evaluations_partenaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evaluations_pilier`
--
ALTER TABLE `evaluations_pilier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evaluations_rh`
--
ALTER TABLE `evaluations_rh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_id` (`evaluation_id`);

--
-- Index pour la table `intrants_fournis`
--
ALTER TABLE `intrants_fournis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partenaire_id` (`partenaire_id`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Index pour la table `partenaires_details`
--
ALTER TABLE `partenaires_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `renouvellement_accreditation`
--
ALTER TABLE `renouvellement_accreditation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partenaire_id` (`partenaire_id`);

--
-- Index pour la table `representant_partenaire`
--
ALTER TABLE `representant_partenaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partenaire_id` (`partenaire_id`);

--
-- Index pour la table `ressources_humaines`
--
ALTER TABLE `ressources_humaines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partenaire_id` (`partenaire_id`);

--
-- Index pour la table `suivi_financier`
--
ALTER TABLE `suivi_financier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partenaire_id` (`partenaire_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evaluations_insp`
--
ALTER TABLE `evaluations_insp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `evaluations_intrants`
--
ALTER TABLE `evaluations_intrants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `evaluations_partenaire`
--
ALTER TABLE `evaluations_partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `evaluations_pilier`
--
ALTER TABLE `evaluations_pilier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `evaluations_rh`
--
ALTER TABLE `evaluations_rh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evaluations_insp`
--
ALTER TABLE `evaluations_insp`
  ADD CONSTRAINT `fk_inps_partenaire` FOREIGN KEY (`partenaire_id`) REFERENCES `evaluations_partenaire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `evaluations_intrants`
--
ALTER TABLE `evaluations_intrants`
  ADD CONSTRAINT `evaluations_intrants_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations_partenaire` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `evaluations_rh`
--
ALTER TABLE `evaluations_rh`
  ADD CONSTRAINT `evaluations_rh_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations_partenaire` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
