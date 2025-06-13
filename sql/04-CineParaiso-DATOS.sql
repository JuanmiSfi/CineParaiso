use CineParaiso;

-- Insertamos datos en la tabla usuario
INSERT INTO usuario (nombre, apellidos, usuario,email, contraseña, bio, id_rol,verificado, fto_perfil) VALUES
(NULL,NULL,'admin','admin@email.com','$2y$10$KzFZNOYGOJfImuWEwqPaq./ztn4/uz4gdXOSUnY9t4zEmQBLI/6Ru',NULL, 2,1, '/Perfil_usuario/Usuarios.png'),
('      Juanmi', '   ', 'juanmi', '   juanmi@email.com', '$2y$10$T8UOowALpN2gldIBpCKJBOqiAx2.NVoTL4PQecJe1rbCgPtTE2hBq', 'Sinosuke es un niño muy bribón con la fuerza de un ciclón ', 1,1, '/Perfil_usuario/newpelo.png'),
(NULL, NULL, 'alberto', 'alberto@email.com', '$2y$10$3kaGx8rItbK.hwS1hxbxXu27KFmOFK.2TIXGLfxoe6Lvqv/o2VL2S', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Carlos', '', '$2y$10$d9xcyHydV1yZ2VvVNlVSkeEyK8/K2LUXyr2yW6X.QwKfJMNm1/YSG', NULL, 1,1, '/Perfil_usuario/patrick-bateman-played-by-christian-bale-2000-film-adaptation-american-psycho-movie.png'),
(NULL, NULL, 'Leo', '', '$2y$10$uwEEbCY7rjyfTvqZm9CAJOuvGSjeSQ2v8q7lEL9UIaz9hltE42EuK', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'YanZ', '', '$2y$10$u5Chye3N/yShTYgFpwQi0e7NX//RCo1FbdMixtRBGDNaEUdDfhiuG', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Nico', '', '$2y$10$OttZTGoPTo0QZIcKlk33xO03kW3oeHEOvWpj.dbn49tNF5TzTbsRC', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Juanvi', '', '$2y$10$Vmezer9Td0gq7zc5Gr4JMeocPsoVfFrf0jfTftZDtz0x6g7AezSAS', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'JuanMa', '', '$2y$10$CdiaFfrRR/qQtOvFmu.V4.qicvW.RkhR8ioxVuQiWxIO9IS2VBrqO', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Pakote', '', '$2y$10$8HcyQNSOjJsZdC08vyLxO.wMaedIm6AB/.S78EbLOBRZU1lH3uvDK', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Manu', '', '$2y$10$BYQ8Bwg5IbqQ51cjfvjX3uu4D8gfkm/es/rzEivTuO4u59nTKRLEu', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Enrique', '', '$2y$10$29557PpF2HVOKGt6swCreeYmtudATFtHFwciOsDvprts7B3bfRgJO', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'David', '', '$2y$10$q0c6USrEV.Ih0RP5.cWkEOxvzaLk0q72ws7u9kM72Ek6PmdEoxZPu', NULL, 1,1, '/Perfil_usuario/Usuarios.png');

-- Insertamos datos en la tabla peliculas
INSERT INTO pelicula (id,titulo, año, descripcion, popularidad, poster) VALUES
(89, 'Indiana Jones y la última cruzada', '1989-05-24', NULL, 10, '/5h45gK147AAJpLLC7Cicr597urz.jpg'),
(955, 'Misión imposible 2', '2000-05-24', NULL, 14, '/mskE3W88cjMRrnKQye8pjmJu3O1.jpg'),
(1359, 'American Psycho', '2000-04-13', NULL, 12, '/ySPCri7VfAjbLLkMKs7Zjn6Njco.jpg'),
(1374, 'Rocky IV', '1985-11-21', NULL, 14, '/2MHUit4H6OK5adcOjnCN6suCKOl.jpg'),
(9874, 'Cobra, el brazo fuerte de la ley', '1986-01-01', NULL, 5, '/zXW4cRRcnPGeSej9EBlKJxnxUUk.jpg'),
(11220, 'Fallen angels (Ángeles caídos)', '1995-09-06', NULL, 8, '/5EmbPJyDvuWYDrYDBgAsoYE0eCv.jpg'),
(353081, 'Misión: Imposible - Fallout', '2018-07-25', NULL, 47, '/6fSdqrkkhSHi2hD6WFTi2LF43Al.jpg'),
(541618, 'Misión: imposible contra el hampa', '1969-12-01', NULL, 1, '/fsjjQFfd4xMXBKYuwiojV5Ll9UD.jpg'),
(552524, 'Lilo y Stitch', '2025-05-17', NULL, 457, '/tUae3mefrDVTgm5mRzqWnZK6fOP.jpg'),
(757725, 'Shadow Force', '2025-05-01', NULL, 197, '/7IEW24vBiZerZrDlgLVSUU3oT1C.jpg'),
(760104, 'X', '2022-03-17', NULL, 10, '/4pCSBPHUPia93rppHF3UX4cLQ9M.jpg'),
(850165, 'El clan de hierro', '2023-12-21', NULL, 7, '/bsw7Bxhm2eYHzdEOTI0yHi7N3jl.jpg'),
(933260, 'La sustancia', '2024-09-07', NULL, 38, '/w1PiIqM89r4AM7CiMEP4VLCEFUn.jpg'),
(950387, 'Una película de Minecraft', '2025-03-31', NULL, 220, '/rZYYmjgyF5UP1AVsvhzzDOFLCwG.jpg'),
(1087192, 'Cómo entrenar a tu dragón', '2025-06-06', NULL, 205, '/fTpbUIwdsfyIldzYvzQi2K4Icws.jpg');


INSERT INTO siguen(id_follow, id_usuario, id_sigue) VALUES
(1, 2, 9),
(2, 2, 4),
(3, 4, 2),
(4, 9, 2);

INSERT INTO review (id, review, vermastarde, nota, fecha, id_usuario, id_pelicula) VALUES
(1, 'Peliculón me ha gustado mucho :)', 0, 5, '2025-06-13 20:02:34', 2, 353081),
(2, 'Quien va a pagar para ver esta pelicula? \r\nYo efectivamente.', 0, 1, '2025-06-13 20:08:43', 2, 950387),
(3, 'La mejor de todas de Rocky', 0, 5, '2025-06-13 20:09:05', 2, 1374),
(4, 'El final de esta pelicula pega más fuerte que Coto Matamoros', 0, 4, '2025-06-13 20:10:26', 2, 850165),
(5, 'Ojalá ser Indiana Jones', 0, 5, '2025-06-13 20:10:46', 2, 89),
(6, 'En el momento que ves que unos viejos con aspecto raro te van alquilar la casa sabes que no vas a disfrutar de tú estancia.\r\n\r\nRecuerda a los buenos Slashers de los 70/80s, con un buen toque de suspense, y ese toque final con un poco de comedia.\r\n\r\nSolo una cosa…No es buena idea ponerla en el salon a las 8 de la tarde con las ventanas abiertas (mis vecinos seguro piensan que estaba viendo otra cosa)\r\nSolo eso.', 0, 3, '2025-06-13 20:11:48', 2, 760104),
(7, 'Gracias a no querer saber nada de la saga durante años no sabia que esta película fue tan mala.\r\nCuando vi que el director era John Woo tenia ganas de verla, vaya chasco :/ \r\n\r\nLo único que merece la pena son los últimos 40 minutos, porque si algo sabe el hongkones es hacer tiroteos y planos que molen un huevo.', 0, 2, '2025-06-13 20:12:45', 2, 955),
(8, NULL, 1, NULL, NULL, 2, 1087192),
(9, NULL, 1, NULL, NULL, 2, 11220),
(10, NULL, 1, NULL, NULL, 2, 9874),
(11, 'Yo no se que fue ', 0, 3, '2025-06-13 20:37:41', 9, 757725),
(12, 'Fui y la vi.', 0, NULL, '2025-06-13 20:37:49', 9, 552524),
(13, 'Me flipa', 0, 5, '2025-06-13 20:40:15', 4, 1359),
(14, 'La mejor pelicula de terror del año.', 0, 1, '2025-06-13 20:40:45', 4, 933260);


INSERT INTO estadistica (id_usuario, n_pelis_vistas, n_seguidores, n_siguiendo, genero_mas_visto) VALUES
(2, 7, 2, 2, NULL),
(3, 0, 0, 0, NULL),
(4, 2, 1, 1, NULL),
(5, 0, 0, 0, NULL),
(6, 0, 0, 0, NULL),
(7, 0, 0, 0, NULL),
(8, 0, 0, 0, NULL),
(9, 2, 1, 1, NULL),
(10, 0, 0, 0, NULL),
(11, 0, 0, 0, NULL),
(12, 0, 0, 0, NULL),
(13, 0, 0, 0, NULL),
(14, 0, 0, 0, NULL);

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

INSERT INTO pertenece (id_pertenece, id_pelicula, id_genero) VALUES
(1, 541618, 28),
(2, 541618, 12),
(3, 353081, 28),
(4, 353081, 12),
(5, 950387, 10751),
(6, 950387, 35),
(7, 950387, 12),
(8, 950387, 14),
(9, 1374, 18),
(10, 850165, 36),
(11, 850165, 18),
(12, 89, 12),
(13, 89, 28),
(14, 760104, 27),
(15, 760104, 53),
(16, 955, 12),
(17, 955, 28),
(18, 955, 53),
(19, 1087192, 28),
(20, 1087192, 10751),
(21, 1087192, 14),
(22, 11220, 28),
(23, 11220, 10749),
(24, 11220, 80),
(25, 9874, 28),
(26, 9874, 80),
(27, 9874, 53),
(28, 757725, 28),
(29, 757725, 53),
(30, 757725, 18),
(31, 552524, 10751),
(32, 552524, 878),
(33, 552524, 35),
(34, 552524, 12),
(35, 1359, 53),
(36, 1359, 18),
(37, 1359, 80),
(38, 933260, 27),
(39, 933260, 878);


