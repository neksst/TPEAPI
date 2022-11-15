-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 06:30 AM
-- Server version: 10.9.4-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peliculas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `genero`
--

CREATE TABLE `genero` (
  `ID` int(11) NOT NULL,
  `Genero` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `genero`
--

INSERT INTO `genero` (`ID`, `Genero`) VALUES
(1, 'Drama'),
(2, 'Accion'),
(3, 'Terror');

-- --------------------------------------------------------

--
-- Table structure for table `pelicula`
--

CREATE TABLE `pelicula` (
  `ID` int(200) NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Fecha` int(4) NOT NULL,
  `Productor` varchar(50) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Calificacion` int(5) NOT NULL,
  `Img` varchar(50) DEFAULT NULL,
  `id_genero_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pelicula`
--

INSERT INTO `pelicula` (`ID`, `Titulo`, `Fecha`, `Productor`, `Descripcion`, `Calificacion`, `Img`, `id_genero_fk`) VALUES
(1, 'El padrino', 1972, 'Albert S. Ruddy', 'Don Vito Corleone es el respetado y temido jefe de una de las cinco familias de la mafia de Nueva York en los años 40. El hombre tiene cuatro hijos: Connie, Sonny, Fredo y Michael, que no quiere saber nada de los negocios sucios de su padre. Cuando otro capo, Sollozzo, intenta asesinar a Corleone, empieza una cruenta lucha entre los distintos clanes.', 5, 'static/img/634ce80d7aca7.jpg', 1),
(2, 'El padrino II', 1974, 'Francis Ford Coppola', 'Tras la muerte de Don Vito Corleone , su hijo Michael se convierte en el cabeza de familia. Al tener que negociar con la mafia judía, pierde el apoyo de uno de sus hombres, Frankie Pentageli. Tras esc', 5, NULL, 1),
(3, 'Buenos muchachos', 1990, 'Martin Scorsese', 'Henry, un niño de trece años de Brooklyn, vive fascinado con el mundo de los gánsters. Su sueño se hace realidad cuando entra en la familia Pauline.', 4, NULL, 1),
(4, 'Caracortada', 1984, 'Martin Bregman', 'Un inmigrante cubano de las cárceles de Fidel Castro provoca un camino de destrucción en su ascenso en el mundo de las drogas de Miami.', 4, NULL, 1),
(5, 'Donnie Brasco', 1997, 'Louis DiGiaimo', 'Un agente del FBI usa su amistad con un matón para infiltrarse en la mafia. Basada en una historia verdadera.', 4, NULL, 1),
(6, 'Casino', 1996, 'Martin Scorsese', 'En Las Vegas, en 1973, Sam Rothstein es un profesional de las apuestas y director de un importante casino que pertenece a unos mafiosos. Un día, el violento Nicky Santoro llega a la ciudad y con él vi', 3, NULL, 1),
(7, 'Taxi Driver', 1976, 'Martin Scorsese', 'Un veterano de Vietnam inicia una confrontación violenta con los proxenetas que trabajan en las calles de Nueva York.', 5, NULL, 1),
(8, 'Pulp Fiction', 1995, 'Quentin Tarantino', 'La vida de un boxeador, dos sicarios, la esposa de un gánster y dos bandidos se entrelaza en una historia de violencia y redención.', 5, NULL, 1),
(9, 'Natural Born Killers', 1994, 'Quentin Tarantino', 'A través de la frontera mexicana, la policía persigue a dos prófugos de una prisión estadounidense de alta seguridad.', 3, NULL, 1),
(10, 'American Psycho', 2000, 'Mary Harron', 'En la década de 1980, Patrick Bateman es un hombre exitoso y obsesionado por la competencia y por la perfección material.', 3, NULL, 1),
(22, 'Chucky: el muñeco diabólico', 1988, 'Tom Holland', 'El vudú y el terror se apoderan de un muñeco de aspecto inocente habitado por el alma de un asesino en serie. Cuando Andy Barclay, un niño de seis años de edad, asegura que “Chucky”, su nuevo muñeco, ha arrojado violentamente por la ventana a su niñera, nadie le cree. Pero una larga serie de horribles asesinatos conduce al detective que se ocupa del caso hasta el muñeco y, entonces, descubre que el auténtico terror no ha hecho más que empezar. El malvado muñeco pretende transferir su diabólico e', 3, NULL, 3),
(23, 'Viernes 13', 1980, 'Sean S. Cunningham', 'Varios jóvenes pasan sus vacaciones en un campamento de verano, reabierto recientemente, y en el que unos años antes murió un joven ahogado en el lago. En poco tiempo, algunos de ellos son encontrados sin vida. (', 5, NULL, 3),
(24, 'El hombre araña', 2002, 'Sam Raimi', 'Luego de sufrir la picadura de una araña genéticamente modificada, un estudiante de secundaria tímido y torpe adquiere increíbles capacidades como arácnido. Pronto comprenderá que su misión es utilizarlas para luchar contra el mal y defender a sus vecinos.', 5, NULL, 2),
(25, 'El Hombre Araña 2', 2004, 'Sam Raimi', 'Han pasado dos años desde que el tranquilo Peter Parker dejó a Mary Jane Watson, su gran amor, y decidió seguir asumiendo sus responsabilidades como Spider-Man. Peter debe afrontar nuevos desafíos mientras lucha contra el don y la maldición de sus poderes equilibrando sus dos identidades: el escurridizo superhéroe Spider-Man y el estudiante universitario. Las relaciones con las personas que más aprecia están ahora en peligro de ser descubiertas con la aparición del poderoso villano de múltiples ', 3, NULL, 2),
(26, 'El Hombre Araña 3', 2006, 'Sam Raimi', 'Tercera entrega de las aventuras del joven Peter Parker (Maguire). Parece que Parker ha conseguido por fin el equilibrio entre su devoción por Mary Jane y sus deberes como superhéroe. Pero, de repente, su traje se vuelve negro y adquiere nuevos poderes; también él se transforma, mostrando el lado más oscuro y vengativo de su personalidad. Bajo la influencia del nuevo traje, Peter se convierte en un ser egoísta que sólo se preocupa por sí mismo. Tiene, pues, que afrontar un dilema: disfrutar de s', 5, NULL, 2),
(27, 'La masacre de Texas', 1974, 'Tobe Hooper', 'Cinco adolescentes visitan la tumba, supuestamente profanada, del abuelo de uno de ellos. Cuando llegan al lugar, donde hay un siniestro matadero, toman una deliciosa carne en una gasolinera. A partir de ese momento, los jóvenes vivirán la peor pesadilla de toda su vida. ', 3, NULL, 3),
(32, 'eeeeeeeee', 2222, 'eeeeeeeeeeeeeee', 'weqweqweqweqweqwe', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `email`, `password`) VALUES
(2, 'admin@admin.com', '$2y$10$OH/hyGH1ISffKc8foBE.ZO0KAJrsIezBcprshh5zv.dcv8W/LqnlC'),
(3, 'agustin@admin.com', '$2y$10$S5BjnY8psDGZOxQeH6g0ruGNOaSVCCVZCjh0E0wrL8TNG7PKPP8dy'),
(4, 'email@email.com', '$2y$10$FwKO0wVS3Nvy0.PEXy6E1.wBOVDekmwxbRfz1bmb6D2tOrOvPr.jK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_genero_fk` (`id_genero_fk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `ID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `pelicula_ibfk_1` FOREIGN KEY (`id_genero_fk`) REFERENCES `genero` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
