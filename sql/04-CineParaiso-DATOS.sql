use CineParaiso;
-- Insertamos datos en la tabla peliculas

-- Insertamos datos en la tabla usuario
INSERT INTO usuario (id, nombre, apellidos, usuario,email, contraseña, bio, id_rol, fto_perfil) VALUES
(1, '      Juanmi', '   ', 'juanmi', '   juanmi@email.com', '$2y$10$Pcl6upJIjPi6k1aI83nAzOKbfbAzKRnRQN3XwXdGhcB7ol9F82Uqq', 'Sinosuke es un niño muy bribón con la fuerza de un ciclón ', 1, '/Perfil_usuario/newpelo.png'),
(2, NULL, NULL, 'alberto', 'alberto@email.com', '$2y$10$APpLCBHuISFUIfmO60Ee7OELKHi2DLexPRkS/E1jL4k8lcjEgRMNC', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(3, NULL, NULL, 'Carlos', '', '$2y$10$IprRKHeCIxmjEBWudq/Kxe4SvNe/USrz80Wv.pLFj3pTARrqC3wCO', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(4, NULL, NULL, 'Leo', '', '$2y$10$bFm6Vgge3u5/.YwIaD9AueswlvhnBsayp.xhmSBx9Nhbxxp57Nj7C', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(5, NULL, NULL, 'YanZ', '', '$2y$10$9ykILgIe0wxJQdd0SvEc7OROULle/MN1Occ4zVFRMbtBm68PaSvha', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(6, NULL, NULL, 'Nico', '', '$2y$10$DR029NbOkIDKm5pkKGT7heqGYYTy9/A8OnA08zoVR4nERgdFfksUG', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(7, NULL, NULL, 'Juanvi', '', '$2y$10$HWfTdcSqT4fICrbEURWL7OhZo1DLIgk8/DMIKaPoU1Zm9YMoBDEK.', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(8, NULL, NULL, 'JuanMa', '', '$2y$10$Gb5qPw7W.OcLMJaEDtoFyepv8nmsundl4LVYR2PDmVuIkr7.eRtG.', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(9, NULL, NULL, 'Pakote', '', '$2y$10$xPVs4Tl2i8iMZdMccXKm5OvJvicGrcxOB9dGCyRljvTiyJCeWBPvS', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(10, NULL, NULL, 'Manu', '', '$2y$10$HYJtMOi6fmhzlt06cWL23ui3K.a9WIJ/eBIfQGTyUsnAsxiCgMVB2', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(11, NULL, NULL, 'Enrique', '', '$2y$10$Yy/kxXUvlORJJ9/jC10AkOp75bVWCp/5srMt8Q0IhC9UeOCac/MFi', NULL, 1, '/Perfil_usuario/Usuarios.png'),
(12, NULL, NULL, 'David', '', '$2y$10$kWccVQ3GQAxugeE9rF5eo.jF08Sn8W.UOMMHsmxAvscb1sYE0nV9u', NULL, 1, '/Perfil_usuario/Usuarios.png');


-- Insertamos datos en la tabla

INSERT INTO actor (id_actor, genero, nombre, fto, bio, nacimiento, fallecimiento, lugar_de_nacimiento) VALUES
(325, 2, 'Eminem', '/bRrrk9r1cYG6KVnYzjwYGT0g1Qi.jpg', '', '1972-10-17', NULL, 'St. Joseph, Missouri, USA'),
(3223, 2, 'Robert Downey Jr.', '/5qHNjhtjMD4YWH3UP0rm4tKwxCL.jpg', 'Robert John Downey Jr. (4 de abril de 1965) es un actor, productor y cantante estadounidense, ganador de dos Globos de Oro y un BAFTA. Con cuatro décadas en el mundo del espectáculo, ha rodado más de 80 películas. Ha sido nominado dos veces a los Óscar: la primera en 1993 por su papel en Chaplin y la segunda en 2009 por Tropic Thunder.\n\nHa participado en películas tales como: Golpe al sueño americano (1987), Natural Born Killers (1994), Wonder Boys (2000), Kiss Kiss Bang Bang (2005), Fur: An Imaginary Portrait of Diane Arbus (2006), Zodiac (2007), Iron Man (2008),The Incredible Hulk(2008), Sherlock Holmes (2009), Iron Man 2 (2010), Sherlock Holmes: juego de sombras (2011), The Avengers (2012), Iron Man 3 (2013), The Judge (2014), Avengers: Age of Ultron (2015), Capitán América: Civil War (2016) Spider-Man: Homecoming (2017), Avengers: Infinity War (2018) y Avengers: Endgame (2019).  Downey ha protagonizado 6 películas que recaudaron más de 500 millones de dólares cada una en todo el mundo. Tres de esas películas; The Avengers, Iron Man 3 y Avengers: Age of Ultron, obtuvieron más de mil millones de dólares cada una. Ha encabezado la lista de Forbes de los actores mejor pagados de Hollywood con unos ingresos de aproximadamente 75 millones de dólares entre junio de 2012 y junio de 20131​ y junio 2015 a 2016.', '1965-04-04', NULL, 'New York City, New York, USA'),
(3894, 2, 'Christian Bale', '/7Pxez9J8fuPd2Mn9kex13YALrCQ.jpg', 'Christian Charles Philip Bale (Haverfordwest, Gales, 30 de enero de 1974), más conocido como Christian Bale, es un actor británico, ganador de un Globo de Oro, un premio SAG y un Oscar.\n\nEntre su filmografía más aclamada destacanː American Psycho (2000); El maquinista (2004); y la trilogía del director Christopher Nolan dedicadas al superhéroe Batmanː Batman Begins (2005), El caballero oscuro (2008), El caballero oscuro: La leyenda renace (2012); The Fighter (2010); La gran estafa americana (2013); y La gran apuesta (2015).\n\nOtros carteles destacados de Bale son: El imperio del sol (1987), Equilibrium (2002), El truco final (El prestigio) (2006), El tren de las 3:10 (2007), Enemigos públicos (2009), Terminator Salvation (2009).', '1974-01-30', NULL, 'Haverfordwest, Pembrokeshire, Wales, UK'),
(3896, 2, 'Liam Neeson', '/sRLev3wJioBgun3ZoeAUFpkLy0D.jpg', 'Liam Neeson nació el 7 de junio de 1952 en Ballymena, Irlanda del Norte, de Katherine (Brown), una cocinera, y Bernard Neeson, un cuidador de la escuela. Fue criado en una casa católica. Durante sus primeros años, Liam trabajó como operador de montacargas para Guinness, un camionero, un arquitecto asistente y un boxeador aficionado. Originalmente había buscado una carrera como maestro asistiendo a St. Mary\s Teaching College, Newcastle. Sin embargo, en 1976, Neeson se unió al Belfast Lyric Players \Theatre e hizo su debut como actor profesional en la obra \"The Risen People\". Después de dos años, Neeson se mudó al Teatro Abbey de Dublín, donde interpretó los clásicos. Fue aquí donde fue visto por el director John Boorman y fue elegido para la película Excalibur (1981) como Sir Gawain, su primer papel cinematográfico de alto perfil.\n\nDurante la década de 1980, Neeson apareció en un puñado de películas y series de televisión británicas, incluyendo Motín a bordo (1984), Toda una mujer (1984), La misión (1986) y Ansias de vivir (1986), pero no fue hasta que él se mudó a Hollywood para buscar papeles más grandes que comenzó a hacerse notar.  Protagonizó la muy esperada Star Wars: Episodio I - La amenaza fantasma (1999) como Qui-Gon Jinn, recibió una nominación al Globo de Oro por Kinsey (2004), interpretó la misteriosa Ducard en Batman Begins de Christopher Nolan (2005), y proporcionó la voz de Aslan en Las crónicas de Narnia: El león, la bruja y el armario (2005).\n\nNeeson encontró una segunda carrera sorpresa como protagonista de la acción con el lanzamiento de Venganza (2008) a principios de 2009, un éxito inesperado de taquilla sobre un agente retirado de la CIA que intentaba rescatar a su hija de ser vendida a la prostitución. Sin embargo, menos de dos meses después del lanzamiento de la película, ocurrió una tragedia cuando su esposa, Natasha Richardson, sufrió una herida mortal en la cabeza mientras esquiaba y falleció días después. Neeson volvió a papeles de alto perfil en 2010 con dos películas consecutivas de gran presupuesto, Furia de titanes (2010) y El equipo A (2010), y regresó al género de acción con Sin identidad (2011), Infierno blanco (2011), Battleship (2012) y Venganza: Conexión Estambul (2012), así como la secuela Ira de titanes (2012).\n\nNeeson fue galardonado con el Oficial de la Orden del Imperio Británico en la Lista de Honores de Año Nuevo de la Reina de 1999 por sus servicios al drama. Tiene dos hijos de su matrimonio con Richardson: Micheal Richard Antonio Neeson (nacido el 22 de junio de 1995) y Daniel Jack Neeson (nacido el 27 de agosto de 1996).', '1952-06-07', NULL, 'Ballymena, County Antrim, Northern Ireland, UK'),
(5469, 2, 'Ralph Fiennes', '/u29BOqiV5GCQ8k8WUJM50i9xlBf.jpg', '', '1962-12-22', NULL, 'Ipswich, Suffolk, England, UK'),
(6968, 2, 'Hugh Jackman', '/4Xujtewxqt6aU0Y81tsS9gkjizk.jpg', 'Hugh Michael Jackman (12 de octubre de 1968) es un actor, cantante y productor de cine australiano.\n\nSu papel más reconocido es Wolverine en la serie de películas de X-Men, así como por sus papeles principales; en la romántica comedia Kate & Leopold (2001), la película de acción-terror Van Helsing (2004), el drama mágico-temático El truco final (El prestigio) (2006), el drama romántico Australia (2008), el drama de ciencia ficción Acero puro (2011), la versión cinematográfica de Los Miserables (2012), el thriller Prisioneros (2013) y El gran showman (2017).\n\nSu trabajo en Los Miserables le valió su primera nominación al premio de la Academia en la calidad de Mejor Actor y su primer Globo de Oro al Mejor actor de Comedia o Musical, en 2013. En teatro, ganó un premio Tony por su papel en The Boy From Oz.Estuvo nominado al Globo de Oro a Mejor actor de comedia o musical por la película El gran showman.\n\nHa sido el presentador de los Premios Tony en cuatro ocasiones, obteniendo un premio Emmy por dicha función, así como dirigió la gala de los Premios Oscar en 2009, mismo año desde que goza de una estrella en el Paseo de la Fama de Hollywood.​ En 2013 recibió el Premio Donostia por su trayectoria cinematográfica en la 61 edición del Festival de San Sebastián.', '1968-10-12', NULL, 'Sydney, New South Wales, Australia'),
(70851, 2, 'Jack Black', '/rtCx0fiYxJVhzXXdwZE2XRTfIKE.jpg', 'Thomas Jacob Black (Santa Mónica, California, 28 de agosto de 1969), más conocido como Jack Black, es un actor, músico, comediante y productor estadounidense.  Entre su extensa filmografía, Black ha protagonizado películas tales como Amor ciego, King Kong, Nacho Libre, Tropic Thunder, The Holiday, Goosebumps, Bernie o Kung Fu Panda. También es considerado un miembro del grupo de actores cómicos llamado Frat Pack, que desde muy temprana edad han aparecido juntos en varias películas de Hollywood.  Black fue nominado a dos Premios Globo de Oro. Además, es vocalista de la banda de rock Tenacious D, que formó en 1994, junto con su amigo Kyle Gass.', '1969-08-28', NULL, 'Santa Monica, California, USA'),
(90633, 1, 'Gal Gadot', '/qCJB1ACi5VjtY4ypXuv3hjAvbSu.jpg', 'Gal Gadot Varsano (30 de abril de 1985) es una actriz, productora y modelo Israelí. Nació en Rosh Ha\ayin, Israel, en una familia judía Ashkenazi.  Sirvió en las Fuerzas de Defensa Israeli como Instructora de Combate durante dos años; comenzó a estudiar derecho y relaciones internacionales en la universidad IDC Herzliya mientras desarrollaba su carrera de modelo y actuación; ganó el título de Miss Israel en 2004 a 18 años de edad.\n\nSu carrera de modelo comenzó cerca del 2000 e hizo su debut cinematográfico en la cuarta película de la franquicia \"Fast and Furious\"; Fast & Furious - Rápidos y Furiosos 4 (2009), como Gisele Yashar, quien era una asociada del villano principal de la película. Fue en esa película donde su popularidad subió mucho.\n\nSu papel se expandió en las secuelas Fast & Furious 5 (2011) y Fast & Furious 6 (2013), en las que su personaje estaba vinculado románticamente con Han Seoul-Oh. En estas películas, Gal realizó sus propias acrobacias.  También apareció en las películas de 2010 Noche Loca (2010), y Noche y Día (2010).  A principios de diciembre de 2013, fue elegida como Wonder Woman en el DC Extended Universe.\n\nGal es una entusiasta de las motocicletas y posee un Ducati Monster-S2R negro 2006. Está casada con Yaron Varsano desde el 28 de septiembre de 2008. Tienen dos hijos.', '1985-04-30', NULL, 'Petah Tikva, Israel'),
(117642, 2, 'Jason Momoa', '/3troAR6QbSb6nUFMDu61YCCWLKa.jpg', 'Joseph Jason Namakaeha Momoa (1 de agosto de 1979) es un actor, escritor, productor, director y modelo estadounidense.\n\nEs conocido por interpretar a Aquaman en el Universo extendido de DC Comics, comenzando con la película de superhéroes Batman v Superman: Dawn of Justice en 2016, y en el conjunto de Liga de la Justicia en 2017 y su película individual Aquaman en 2018.​ También es conocido por sus papeles televisivos como Ronon Dex en la serie de televisión de ciencia ficción militar Stargate Atlantis (2004-2009), como Khal Drogo en la serie de televisión de fantasía de HBO Game of Thrones (2011-2012) y como Declan Harp en la serie de Netflix Frontier (2016-presente).', '1979-08-01', NULL, 'Honolulu, Hawaii, USA'),
(135651, 2, 'Michael B. Jordan', '/hz9AOUWZ2zzS0dpPJ1yQv2grA35.jpg', 'Michael Bakari Jordan (9 de febrero de 1987), popularmente conocido como Michael B. Jordan, es un actor y productor estadounidense. Es afamado por interpretar al personaje de Erik Killmonger, el primo y enemigo de T\Challa, en Black Panther (2018), y a Adonis Creed, hijo del boxeador ficticio Apollo Creed, en Creed (2015).\n\nDentro de sus primeros trabajos se encuentran las series de televisión The Wire y Friday Night Lights. En el cine, coprotagonizó películas como Chronicle (2012), Fruitvale Station (2013), Las novias de mis amigos (2014) y Fantastic Four (2015). También fue el abogado Bryan Stevenson en Just Mercy (2019).', '1987-02-09', NULL, 'Santa Ana, California, USA');


INSERT INTO genero (id_genero, nombre) VALUES
(28, 'Acción'),
(12, 'Aventura'),
(16, 'Animación'),
(35, 'Comedia'),
(80, 'Crimen'),
(99, 'Documental'),
(18, 'Drama'),
(10751, 'Familia'),
(14, 'Fantasía'),
(36, 'Historia'),
(27, 'Terror'),
(10402, 'Música'),
(9648, 'Misterio'),
(10749, 'Romance'),
(878, 'Ciencia ficción'),
(10770, 'Película de TV'),
(53, 'Suspense'),
(10752, 'Bélica'),
(37, 'Western');

-- Insert RedesSociales
INSERT INTO redessociales (id_actor,wikidata,facebook,instagram,tiktok,twitter,youtube) VALUES
(325, 'Q5608', 'eminem', 'eminem', NULL, 'Eminem', NULL),
(3223, 'Q165219', 'robertdowneyjr', 'robertdowneyjr', NULL, 'RobertDowneyJr', NULL),
(3894, 'Q45772', NULL, NULL, NULL, NULL, NULL),
(3896, 'Q58444', NULL, NULL, NULL, NULL, NULL),
(5469, 'Q28493', NULL, NULL, NULL, '@mrralphfiennes', NULL);


-- Insert en siguen
INSERT INTO siguen (id_follow, id_usuario, id_sigue) VALUES
(13, 3, 1),
(16, 1, 3),
(21, 1, 12);

