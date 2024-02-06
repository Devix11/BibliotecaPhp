-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3351
-- Creato il: Gen 22, 2024 alle 07:48
-- Versione del server: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Versione PHP: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE `libri` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `autore` varchar(255) NOT NULL,
  `isbn` varchar(13) DEFAULT NULL,
  `annoPubblicazione` int(4) DEFAULT NULL,
  `genere` varchar(100) DEFAULT NULL,
  `quantita` int(11) DEFAULT 0,
  `descrizione` text DEFAULT NULL,
  `dataInserimento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`id`, `titolo`, `autore`, `isbn`, `annoPubblicazione`, `genere`, `quantita`, `descrizione`, `dataInserimento`) VALUES
(1, 'Cent\'anni di solitudine', 'Gabriel García Márquez', '9788845292613', 1967, 'Romanzo', 5, 'Un capolavoro della letteratura latinoamericana, che racconta la storia della famiglia Buendía nella città immaginaria di Macondo.', '2024-01-10 09:35:06'),
(2, '1984', 'George Orwell', '9780451524935', 1949, 'Distopia', 3, 'Un romanzo distopico che esplora le conseguenze di un governo totalitario e onnipresente.', '2024-01-10 09:35:06'),
(3, 'Il Signore degli Anelli', 'J.R.R. Tolkien', '9780261102385', 1954, 'Fantasy', 7, 'Un epico racconto di avventura ambientato nella Terra di Mezzo.', '2024-01-10 09:35:06'),
(4, 'Il Grande Gatsby', 'F. Scott Fitzgerald', '9780743273565', 1925, 'Romanzo', 6, 'Una storia di amore e decadenza ambientata negli anni \'20 in America.', '2024-01-10 09:35:06'),
(5, 'To Kill a Mockingbird', 'Harper Lee', '9780061120084', 1960, 'Romanzo', 4, 'Un potente romanzo che affronta temi di razzismo e ingiustizia nell\'America del Sud.', '2024-01-10 09:35:06'),
(6, 'L\'insostenibile leggerezza dell\'essere', 'Milan Kundera', '9780571135394', 1984, 'Romanzo', 5, 'Un romanzo filosofico che esplora la vita di quattro persone durante l\'invasione sovietica della Cecoslovacchia.', '2024-01-10 09:35:06'),
(7, 'Il Codice Da Vinci', 'Dan Brown', '9780307474278', 2003, 'Thriller', 8, 'Un thriller che mescola storia, arte e codici segreti.', '2024-01-10 09:35:06'),
(8, 'Il Piccolo Principe', 'Antoine de Saint-Exupéry', '9780156012195', 1943, 'Fiaba', 7, 'Una fiaba filosofica e una critica sociale raccontata attraverso gli occhi di un bambino.', '2024-01-10 09:35:06'),
(9, 'Moby Dick', 'Herman Melville', '9780142437247', 1951, 'Romanzo', 3, 'La famosa storia della caccia alla balena bianca da parte del capitano Ahab.', '2024-01-10 09:35:06'),
(10, 'Il processo', 'Franz Kafka', '9780805209990', 1925, 'Romanzo', 4, 'Un romanzo che esplora temi di alienazione e persecuzione attraverso il processo giudiziario di un bancario.', '2024-01-10 09:35:06'),
(11, 'Cento anni di solitudine', 'Gabriel García Márquez', '9785845392613', 1967, 'Romanzo', 5, 'Un capolavoro della letteratura latinoamericana, che racconta la storia della famiglia Buendía nella città immaginaria di Macondo.', '2024-01-10 09:35:06'),
(12, 'Anna Karenina', 'Lev Tolstoj', '9780679783305', 1941, 'Romanzo', 4, 'Un intenso romanzo che esplora temi di amore, famiglia e politica nella Russia del XIX secolo.', '2024-01-10 09:35:06'),
(13, 'Il giro del mondo in 80 giorni', 'Jules Verne', '9788853008083', 1873, 'Avventura', 6, 'La storia di un viaggio incredibile che sfida i limiti del possibile nell\'epoca vittoriana.', '2024-01-10 09:35:06'),
(14, 'Norwegian Wood', 'Haruki Murakami', '9788845268921', 1987, 'Romanzo', 7, 'Murakami intreccia abilmente la nostalgia e la ricerca del significato della vita in \"Norwegian Wood\", una storia toccante di amore e perdita ambientata nell\'atmosfera dei tumultuosi anni \'60.', '2024-01-10 10:46:37'),
(15, 'Cronache del ghiaccio e del fuoco: Il Trono di Spade', 'George R.R. Martin', '9788804535626', 1996, 'Fantasy', 9, 'La prima parte della saga epica di Martin, \"Il Trono di Spade\", offre un intricato intreccio di politica, intrighi e fantastici elementi soprannaturali in un mondo medieval-fantastico.', '2024-01-10 10:46:37'),
(16, 'Lo Hobbit', 'J.R.R. Tolkien', '9788845239436', 1937, 'Fantasy', 7, 'Un viaggio avventuroso di Bilbo Baggins che porta a scoperte sorprendenti e incontri con creature magiche, anticipando gli eventi de \"Il Signore degli Anelli\".', '2024-01-10 10:46:37'),
(17, 'Don Chisciotte', 'Miguel de Cervantes', '9788845221706', 1605, 'Romanzo picaresco', 6, 'Un\'opera classica che parodia le storie cavalleresche, seguendo le avventure di un nobile pazzo e del suo fedele scudiero.', '2024-01-10 10:46:37'),
(18, 'Orgoglio e pregiudizio', 'Jane Austen', '9788845298125', 1813, 'Romanzo', 9, 'Un classico della letteratura inglese che esplora con acume sociale e ironia l\'amore e le convenzioni della classe alta nel XIX secolo.', '2024-01-10 10:46:37'),
(19, 'L\'ombra del vento', 'Carlos Ruiz Zafón', '9788845252075', 2001, 'Romanzo gotico', 8, 'Un appassionante mistero ambientato nella Barcellona post-guerra civile spagnola, che mescola elementi di amore, perdita e libri maledetti.', '2024-01-10 10:46:37'),
(20, 'Dune', 'Frank Herbert', '9788804710365', 1965, 'Fantascienza', 9, 'Un\'epica di fantascienza che si svolge su un deserto alieno, \"Dune\" esplora politica, religione e ecologia in un futuro lontano.', '2024-01-10 10:46:37'),
(21, 'Piccole donne', 'Louisa May Alcott', '9788845235605', 1868, 'Romanzo', 7, 'Un affascinante ritratto della vita delle sorelle March durante la Guerra Civile Americana, che celebra l\'amicizia, l\'amore e l\'indipendenza femminile.', '2024-01-10 10:46:37'),
(22, 'Lo strano caso del dottor Jekyll e del signor Hyde', 'Robert Louis Stevenson', '9788804381096', 1886, 'Horror', 6, 'Un thriller psicologico che esplora i confini tra bene e male attraverso la trasformazione di un uomo rispettabile in un mostro.', '2024-01-10 10:46:37'),
(23, 'Cime tempestose', 'Emily Brontë', '9788845222536', 1847, 'Romanzo gotico', 8, 'Una storia appassionata e tormentata di amore e vendetta nelle lande desolate dell\'Inghilterra, che ha resistito alla prova del tempo.', '2024-01-10 10:46:37'),
(24, 'Neuromante', 'William Gibson', '9788845228842', 1984, 'Cyberpunk', 8, 'Il romanzo fondatore del genere cyberpunk, \"Neuromante\" immagina un futuro distopico in cui la tecnologia e la realtà virtuale si fondono in modi sorprendenti.', '2024-01-10 10:46:37'),
(25, 'Il giovane Holden', 'J.D. Salinger', '9788845237654', 1951, 'Romanzo', 7, 'Il racconto del giovane ribelle Holden Caulfield, che cerca un significato nella società adulta, è un\'icona della letteratura dell\'adolescenza.', '2024-01-10 10:46:37'),
(26, 'Cronache del mondo emerso: La setta degli assassini', 'Licia Troisi', '9788804568130', 2004, 'Fantasy', 6, 'In questo romanzo fantasy, Troisi espande il suo affascinante mondo emerso, seguendo le avventure di Nihal e la sua lotta contro la setta degli assassini.', '2024-01-10 10:46:37');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti_registrati`
--

CREATE TABLE `utenti_registrati` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dataRegistrazione` timestamp NOT NULL DEFAULT current_timestamp(),
  `adm` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indici per le tabelle `utenti_registrati`
--
ALTER TABLE `utenti_registrati`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `libri`
--
ALTER TABLE `libri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `utenti_registrati`
--
ALTER TABLE `utenti_registrati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;