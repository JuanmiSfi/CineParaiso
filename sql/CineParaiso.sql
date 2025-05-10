-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-05-2025 a las 12:12:56
-- Versión del servidor: 10.6.21-MariaDB-0ubuntu0.22.04.2
-- Versión de PHP: 8.1.2-1ubuntu2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS CineParaiso;
USE CineParaiso;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `CineParaiso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE `estadistica` (
  `id_usuario` int(11) NOT NULL,
  `n_pelis_vistas` int(11) DEFAULT 0,
  `n_seguidores` int(120) DEFAULT 0,
  `n_siguiendo` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadistica`
--

INSERT INTO `estadistica` (`id_usuario`, `n_pelis_vistas`, `n_seguidores`, `n_siguiendo`) VALUES
(1, 4, 1, 0),
(4, 0, 0, 0),
(5, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `genero` varchar(120) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `poster` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `titulo`, `año`, `genero`, `descripcion`, `poster`) VALUES
(120, 'El señor de los anillos: La comunidad del anillo', 1971, NULL, 'En la Tierra Media, el Señor Oscuro Saurón creó los Grandes Anillos de Poder, forjados por los herreros Elfos. Tres para los reyes Elfos, siete para los Señores Enanos, y nueve para los Hombres Mortales. Secretamente, Saurón también forjó un anillo maestro, el Anillo Único, que contiene en sí el poder para esclavizar a toda la Tierra Media. Con la ayuda de un grupo de amigos y de valientes aliados, Frodo emprende un peligroso viaje con la misión de destruir el Anillo Único. Pero el Señor Oscuro Sauron, quien creara el Anillo, envía a sus servidores para perseguir al grupo. Si Sauron lograra recuperar el Anillo, sería el final de la Tierra Media.', '/9xtH1RmAzQ0rrMBNUMXstb2s3er.jpg'),
(348, 'Alien, el octavo pasajero', 1949, NULL, 'De regreso a la Tierra, la nave de carga Nostromo interrumpe su viaje y despierta a sus siete tripulantes. El ordenador central, MADRE, ha detectado la misteriosa transmisión de una forma de vida desconocida, procedente de un planeta cercano aparentemente deshabitado. La nave se dirige entonces al extraño planeta para investigar el origen de la comunicación.', '/pZ9cAe5FxexJjpCaeiETbXzz3Fs.jpg'),
(584, '2 Fast 2 Furious: A todo gas 2', 1992, NULL, 'Brian O\'Connor, un policía caído en desgracia, fue un adicto a la velocidad y ahora está pagando un precio por ello. Tal y como lo ven sus antiguos jefes y los altos mandos del FBI, este agente de incógnito les echó a perder una de las investigaciones más importantes que habían emprendido.', '/fZtSG5a6i5Ca39WQylLVmvWI5b.jpg'),
(744, 'Top Gun: Ídolos del aire', 1965, NULL, 'La Marina de los Estados Unidos ha creado una escuela de élite para pilotos con el fin de sacar una promoción de expertos en técnicas de combate. En la academia, más conocida como Top Gun, a los mejores se les entrena para ser intrépidos y fríos al mismo tiempo, capaces de no perder los nervios en situaciones extremas y de no inmutarse al romper la barrera del sonido a los mandos de un F-14. A la escuela llega el joven Maverick, famoso por su temeraria aunque brillante forma de pilotar.', '/W8QUPhiBOCdj2urJDzc2D9xdQb.jpg'),
(769, 'Uno de los nuestros', 1969, NULL, 'Henry, un niño de trece años de Brooklyn, vive fascinado con el mundo de los gángsters. Su sueño se hace realidad cuando entra a formar parte de la familia Pauline, dueña absoluta de la zona, que lo educan como un miembro más de la banda convirtiéndole en un destacado mafioso.', '/ii4bYbHN6HtVGK700AlphS56hD2.jpg'),
(954, 'Misión imposible', 1969, NULL, 'Ethan Hunt es un superespía capaz de resolver cualquier arriesgada situación con la máxima elegancia. Forma parte de un competente equipo dirigido por el agente Jim Phelps, que ha vuelto a reunir a sus hombres para participar en una dificilísima misión: evitar la venta de un disco robado que contiene información secreta de vital importancia.', '/xCpmxw3UUjv4PGzbIPOHeoKAV0l.jpg'),
(1366, 'Rocky', 1945, NULL, 'Rocky Balboa es un desconocido boxeador a quien se le ofrece la posibilidad de pelear por el título mundial de los pesos pesados. Con mucha fuerza de voluntad, Rocky se preparará concienzudamente para este combate, y también para los cambios que producirá en su vida.', '/dXuitc2AOkzc20AsmPEkGtmyDeN.jpg'),
(2293, 'Mallrats', 1965, NULL, 'A Brodie y T.S. los acaban de dejar sus respectivas novias. Para evadirse deciden visitar un centro comercial. Una vez allí, y con la ayuda de varios amigos, intentan reconquistarlas y de paso sabotear el concurso que prepara allí el padre de una de las chicas.', '/6K0cH551dIrBcD33kZtyugqmdJU.jpg'),
(10634, 'Todo en un viernes (Friday)', 1965, NULL, 'A Craig (Ice Cube) lo han echado del trabajo por un presunto robo, de modo que su único plan para el viernes es pasarse las horas muertas en el porche de su casa con su amigo Smokey (Chris Tucker), que no hace más que fumarse la marihuana que ha de vender. (FILMAFFINITY)', '/2wsoNhgOrKgPNhPqLi8YEg72CvB.jpg'),
(37135, 'Tarzán', 1975, NULL, 'Cuando Kala, una gorila hembra, encuentra un niño huérfano en la jungla, decide adoptarlo como su propio hijo a pesar de la oposición de Kerchak, el jefe de la manada. Junto a Terk, un gracioso mono, y Tantor, un elefante algo neurótico, Tazán crecerá en la jungla desarrollando los instintos de los animales y aprendiendo a deslizarse entre los árboles a velocidad de vértigo. Pero cuando una expedición se adentra en la jungla y Tarzán conoce a Jane, descubrirá quién es realmente y cuál es el mundo al que pertenece...', '/1Gk8iihu4Q4BGh2n1IwNLB3zM8E.jpg'),
(49051, 'El hobbit: Un viaje inesperado', 1988, NULL, 'Precuela de la trilogía \"El Señor de los Anillos\", obra de J.R.R. Tolkien. En compañía del mago Gandalf y de trece enanos, el hobbit Bilbo Bolsón emprende un viaje a través del país de los elfos y los bosques de los trolls, desde las mazmorras de los orcos hasta la Montaña Solitaria, donde el dragón Smaug esconde el tesoro de los Enanos. Finalmente, en las profundidades de la Tierra, encuentra el Anillo Único, hipnótico objeto que será posteriormente causa de tantas sangrientas batallas en la Tierra Media.', '/3dJELUqdpGEkXVrMj7V3BiOjrtf.jpg'),
(102899, 'Ant-Man', 1994, NULL, 'Armado con la asombrosa capacidad de reducir su tamaño a la dimensiones de un insecto, el estafador Scott Lang debe sacar a relucir al héroe que lleva dentro y ayudar a su mentor, el doctor Hank Pym, a proteger de una nueva generación de amenazas el secreto que se esconde tras el traje de Ant-Man, con un casco que le permite comunicarse con las hormigas. A pesar de los obstáculos aparentemente insuperables que les acechan, Pym y Lang deben planear y llevar a cabo un atraco para intentar salvar al mundo.', '/zwuE28gSXlLFLgueqMe9b7xKy1f.jpg'),
(177677, 'Misión imposible: Nación secreta', 1985, NULL, 'Con la FMI disuelta y Ethan Hunt abandonado a su suerte, el equipo tiene que enfrentarse contra el Sindicato, una red de agentes especiales altamente preparados y entrenados. Estos grupos están empeñados en crear un nuevo orden mundial mediante una serie de ataques terroristas cada vez más graves. Ethan reúne a su equipo y une sus fuerzas con la agente británica renegada Ilsa Faust, quien puede que sea o no miembro de esta nación secreta, mientras el grupo se va enfrentando a su misión más imposible hasta la fecha…', '/ww0IX7Xla6tHgrwYSupfXcksV3n.jpg'),
(299537, 'Capitana Marvel', 2010, NULL, '', '/5SPa7dZ85p54xa7E9tHRmfKq5ce.jpg'),
(313369, 'La ciudad de las estrellas (La La Land)', 2003, NULL, 'Mia, una joven aspirante a actriz que compagina los castings con su trabajo de camarera, y Sebastian, un pianista de jazz que se gana la vida tocando en sórdidos tugurios, se enamoran. Pero la gran ambición por llegar a la cima en sus carreras artísticas amenaza con separarlos.', '/7pFsAaJmiOppVHcldBzg8JKBHwe.jpg'),
(315635, 'Spider-Man: Homecoming', 2005, NULL, 'Peter Parker comienza a experimentar su recién descubierta identidad como el superhéroe Spider-Man. Después de la experiencia vivida con los Vengadores, Peter regresa a casa, donde vive con su tía. Bajo la atenta mirada de su mentor Tony Stark, Peter intenta mantener una vida normal como cualquier joven de su edad, pero interrumpe en su rutina diaria el nuevo villano Vulture y, con él, lo más importante de la vida de Peter comenzará a verse amenazado.', '/81qIJbnS2L0rUAAB55G8CZODpS5.jpg'),
(324544, 'Tierras perdidas', 1996, NULL, 'Basada en el relato de George R. R. Martin. Una reina (Amara Okereke), desesperada por encontrar la felicidad en el amor, envía a la poderosa bruja Gray Alys (Milla Jovovich) a las Tierras Perdidas, en busca de un poder mágico que permite a una persona transformarse en un hombre lobo. Con el misterioso cazador Boyce (Dave Bautista), que la apoya en la lucha contra criaturas oscuras y despiadadas, Gray deambula por un mundo inquietante y peligroso. Pero solo ella sabe que, cada deseo que se concede, tiene consecuencias inimaginables.', '/sLDxndoqFWwJEq7iEdYQBzPjUDQ.jpg'),
(335984, 'Blade Runner 2049', 2003, NULL, 'Han pasado 30 años desde los acontecimientos ocurridos en Blade Runner (1982). El oficial K, un blade runner caza-replicantes del Departamento de Policía de Los Ángeles, descubre un secreto que ha estado enterrado durante mucho tiempo y que tiene el potencial de llevar a la sociedad al caos. Su investigación le conducirá a la búsqueda del legendario Rick Deckard, un antiguo blade runner en paradero desconocido, que lleva desaparecido 30 años.', '/cOt8SQwrxpoTv9Bc3kyce3etkZX.jpg'),
(374720, 'Dunkerque', 1991, NULL, 'II Guerra Mundial. Cientos de miles de británicos y tropas aliadas están rodeados por las fuerzas enemigas. Atrapados en la playa con el mar a sus espaldas se enfrentan a una situación imposible mientras el enemigo se acerca. La película relata la Operación Dinamo, también conocida como el milagro de Dunkerque. Se trató de una operación de evacuación de las tropas aliadas en territorio francés, que tuvo lugar a finales de mayo de 1940. La operación permitió el rescate de más de 200.000 soldados británicos y más de 100.000 franceses y belgas.', '/3lc06ptVbouEaZyjdHfCzmIm6v7.jpg'),
(497698, 'Viuda negra', 2007, NULL, 'Natasha Romanoff, alias Viuda Negra, se enfrenta a las partes más oscuras de su historia cuando surge una peligrosa conspiración con vínculos con su pasado. Perseguida por una fuerza que no se detendrá ante nada para acabar con ella, Natasha debe enfrentarse a su historia como espía y a las relaciones rotas que dejó a su paso mucho antes de convertirse en una Vengadora.', '/iKntUTTLxUgizTe3jFcGLuHc84c.jpg'),
(533535, 'Deadpool y Lobezno', 1993, NULL, 'Un apático Wade Wilson se afana en la vida civil tras dejar atrás sus días como Deadpool, un mercenario moralmente flexible. Pero cuando su mundo natal se enfrenta a una amenaza existencial, Wade debe volver a vestirse a regañadientes con un Lobezno aún más reacio a ayudar.', '/9TFSqghEHrlBMRR63yTx80Orxva.jpg'),
(668489, 'Estragos', 1997, NULL, 'Después de que un robo de drogas tenga consecuencias fatales, un policía lucha contra el submundo criminal de una ciudad corrupta para salvar al hijo de un político.', '/weCzRfUhHPJpQ0uEYAdeommg0gM.jpg'),
(822119, 'Capitán América: Brave New World', 2011, NULL, 'Tras reunirse con el recién elegido presidente de los EE. UU., Thaddeus Ross, Sam se encuentra en medio de un incidente internacional. Debe descubrir el motivo que se esconde tras un perverso complot global, antes de que su verdadero artífice enfurezca al mundo entero.', '/pVMSRyAiye7gZ8NtuCt1qgbspY9.jpg'),
(950387, 'Una película de Minecraft', 1991, NULL, 'Cuatro inadaptados se encuentran luchando con problemas ordinarios cuando de repente se ven arrastrados a través de un misterioso portal al Mundo Exterior: un extraño país de las maravillas cúbico que se nutre de la imaginación. Para volver a casa, tendrán que dominar este mundo mientras se embarcan en una búsqueda mágica con un inesperado experto artesano, Steve.', '/mFjtmmh4RtK9tLv1aPnUsl6st3m.jpg'),
(974573, 'Otro pequeño favor', 2015, NULL, 'Stephanie Smothers y Emily Nelson se reúnen en la hermosa isla de Capri, Italia, para la extravagante boda de Emily con un rico hombre de negocios italiano. Junto con los glamurosos invitados, cabe esperar asesinatos y traiciones en una boda con más giros y vueltas que el camino desde el puerto a la plaza del centro de Capri.', '/pZr2QCUbsekpiLnZ7788twcLpSn.jpg'),
(986056, 'Thunderbolts*', 1991, NULL, 'Un grupo de supervillanos y antihéroes van en misiones para el gobierno. Basado en la serie de cómics del mismo nombre.', '/zLbhKNJGDSfBCXFNtypM7ZuPTaW.jpg'),
(1045938, 'G20', 2012, NULL, 'Cuando la cumbre del G20 sufre un ataque, la presidenta de EE. UU. Danielle Sutton se convierte en el objetivo número uno. Tras evitar ser capturada por los atacantes, debe derrotar al enemigo para proteger a su familia, defender a su país y poner a salvo a los líderes del mundo en esta trepidante película cargada de acción.', '/xihssRPgRDZ7xwIjx3xuPTnqPfU.jpg'),
(1092899, 'El Asedio', 2010, NULL, 'El asesino internacional Walker se ve comprometido durante una misión y enviado a un centro de reasignación para una nueva identidad. Durante su estadía en las instalaciones, un equipo de asalto despiadado irrumpe en el recinto en busca de alguien que su jefe ha perdido. Walker se enamora a regañadientes de la hábil sicario Elda y su misteriosa pupila Juliet para sobrevivir a la noche.', '/d9jrfsJx7wkDnouIqwnXQ7xayIm.jpg'),
(1124620, 'El Mono', 2009, NULL, 'Cuando dos hermanos gemelos encuentran un misterioso mono de cuerda, una serie de muertes atroces separan a su familia. Veinticinco años después, el mono comienza una nueva matanza que obliga a los hermanos a enfrentarse al juguete maldito.', '/z15wy8YqFG8aCAkDQJKR63nxSmd.jpg'),
(1153714, 'Death of a Unicorn', 1995, NULL, '', '/lXR32JepFwD1UHkplWqtBP1K79z.jpg'),
(1154598, 'LEGO Marvel Avengers: Código rojo', 1987, NULL, 'En un multiverso amenazado por el enigmático Fantasma Rojo, los LEGO Vengadores se unen a sus homólogos para detener el caos de la realidad.', '/4ba3Kw9isyWvu6cupzUagm8ejw2.jpg'),
(1180906, 'Alba del desierto', 2005, NULL, 'Un sheriff recién nombrado de un pequeño pueblo y su reticente ayudante se ven envueltos en una red de mentiras y corrupción que involucra a empresarios turbios y a un cartel, mientras investigan el asesinato de una mujer misteriosa.', '/vJxo8xxVnSaPAf9EdkjAfKwmoQK.jpg'),
(1197306, 'A Working Man', 1996, NULL, 'Levon Cade dejó atrás una condecorada carrera militar en las operaciones encubiertas para vivir una vida sencilla trabajando en la construcción. Pero cuando la hija de su jefe, que para él es como de la familia, es secuestrada por traficantes de personas, su búsqueda para traerla a casa descubre un mundo de corrupción mucho mayor de lo que jamás podría haber imaginado.', '/oCsn3MV3QOJWnGVCb8B8VWrX5Qp.jpg'),
(1233069, 'Extraterritorial', 1992, NULL, 'Cuando su hijo desaparece en un consulado de EE. UU., una exsoldado de las fuerzas especiales hará lo imposible por encontrarlo... y destapará una oscura conspiración.', '/bTYbNWz4kI1P3GzEVvWZwyZT7Uv.jpg'),
(1233413, 'Los pecadores', 2005, NULL, 'Tratando de dejar atrás sus problemáticas vidas, dos hermanos gemelos regresan a su pueblo natal para empezar de nuevo, solo para descubrir que un mal aún mayor les espera para darles la bienvenida.', '/zdClwqpYQXBSCGGDMdtvsuggwec.jpg'),
(1241436, 'Warfare. Tiempo de guerra', 2012, NULL, 'Basada en las experiencias reales del ex marine Ray Mendoza (codirector y coguionista de la película) durante la guerra de Irak. Introduce al espectador en la experiencia de un pelotón de Navy SEALs estadounidenses. Concretamente en una misión de vigilancia que se tuerce en territorio insurgente. Una historia visceral y a pie de campo sobre la guerra moderna y la hermandad, contada como nunca antes: en tiempo real y basada en los recuerdos de quienes la vivieron.', '/9Ci3Rl0eXN8lJCuxIApZrjds6cg.jpg'),
(1249213, 'La cita', 2011, NULL, 'Violet, una joven madre viuda que lleva años sin salir con nadie, al llegar al restaurante de lujo donde ha quedado con Henry, se siente aliviada al descubrir que este es mucho más encantador y apuesto de lo que esperaba. Pero la química se resquebraja cuando Violet empieza a mostrarse irritable al recibir una serie de mensajes anónimos en su móvil que acaban por aterrorizarla.', '/gc83Ao5AP59gQVjnxAps2oFy2ag.jpg'),
(1297763, 'Batman Ninja vs. Yakuza League', 2005, NULL, 'Sólo un día después de regresar del pasado, Batman y sus aliados descubren que el mundo no es exactamente el mismo que dejaron. Toda la isla de Japón ya no existe y los héroes de la Liga de la Justicia tampoco. Pero antes de que puedan comprender lo que está pasando, los yakuza empiezan a llover literalmente del cielo. Secuela de la película anime 3D \"Batman Ninja\".', '/3hVjnB5FE4gBrR5rqk42qiBFgGe.jpg'),
(1356236, 'Saint Catherine', 2010, NULL, 'Una niña huérfana es rescatada de un ritual satánico y llevada al Instituto Saint Catherine para jóvenes sin hogar. Allí aprenderá nuevas habilidades mientras se enfrenta a los demonios que la acechan.', '/hBJdzKPeDaC96AzlrtMWBomYSZV.jpg'),
(1403735, 'లైలా', 2009, NULL, '', '/l4gsNxFPGpzbq0D6QK1a8vO1lBz.jpg'),
(1414048, 'Day of Reckoning', 1994, NULL, '', '/cVSjSQryFUERYSdOmdgJ2m0eBte.jpg'),
(1471014, 'Van Gogh by Vincent', 1996, NULL, '', '/z73X4WKZghBh5fri31o8P6vBEB2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `vermastarde` tinyint(1) NOT NULL DEFAULT 0,
  `nota` tinyint(5) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_pelicula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `review`
--

INSERT INTO `review` (`id`, `review`, `vermastarde`, `nota`, `fecha`, `id_usuario`, `id_pelicula`) VALUES
(42, 'Damn Harrison Ford!', 0, 1, '2025-05-07 12:10:25', 5, 822119),
(43, 'Esta película te enseña que la depresión se cura con Florence Pugh', 0, 5, '2025-05-08 17:28:50', 1, 986056),
(44, 'HOSTIA TIO QUE NO LO HE ENCHUFAO!!!', 0, 5, '2025-05-08 08:23:48', 5, 986056),
(45, NULL, 1, NULL, NULL, 1, 1233069),
(46, 'Hola\r\n', 0, 5, '2025-05-08 11:04:44', 1, 37135),
(47, 'ME cago en la puta que peliculon!!', 0, 5, '2025-05-08 11:07:44', 1, 1241436),
(48, 'No me gusta la guerra', 0, 1, '2025-05-08 11:08:36', 5, 1241436),
(49, 'Esto que es?', 0, NULL, '2025-05-08 11:27:32', 4, 1241436),
(50, 'Ice cube?', 0, NULL, '2025-05-08 18:08:22', 1, 10634);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `tipo`) VALUES
(1, 'usuario'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `siguen`
--

CREATE TABLE `siguen` (
  `id_follow` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_seguidor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `usuario` varchar(25) NOT NULL,
  `email` varchar(110) DEFAULT NULL,
  `contraseña` varchar(100) NOT NULL,
  `bio` varchar(200) DEFAULT NULL,
  `fto_perfil` varchar(1000) NOT NULL DEFAULT '/Perfil_usuario/Usuarios.png',
  `id_rol` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `usuario`, `email`, `contraseña`, `bio`, `fto_perfil`, `id_rol`) VALUES
(1, '        Juanmi      ', '       Sánchez', 'Juanmi', '       juanmi@email.com', '$2y$10$.PHgxnQHX6tumvUzxjoEaeGBT9zqr3137cj3p3oYQiq3oCtz34666', 'Sinosuke es un niño muy bribon con la fuerza de un Ciclon', '/Perfil_usuario/newpelo.png', 1),
(4, NULL, NULL, 'PepePaco', 'PepePaco', '$2y$10$NIhFCd6yvlTU.d6fnhQ3mupxOxV7g8XXEf43hqA5crUIrDXPUk2eO', NULL, '/Perfil_usuario/Usuarios.png', 1),
(5, '  ', ' ', 'Alberto', ' Alberto', '$2y$10$gXk8D4hygVxisTY28tktF.2cOQev4Fkgha/p6zZRKUJOqqgsBMD/6', '', '/Perfil_usuario/Usuarios.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_pelicula` (`id_pelicula`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `siguen`
--
ALTER TABLE `siguen`
  ADD PRIMARY KEY (`id_follow`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_usuario2` (`id_seguidor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1471015;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `siguen`
--
ALTER TABLE `siguen`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD CONSTRAINT `estadistica_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_pelicula`) REFERENCES `pelicula` (`id`);

--
-- Filtros para la tabla `siguen`
--
ALTER TABLE `siguen`
  ADD CONSTRAINT `siguen_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `siguen_ibfk_2` FOREIGN KEY (`id_seguidor`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
