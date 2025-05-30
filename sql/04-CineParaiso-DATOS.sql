use CineParaiso;
-- Insertamos datos en la tabla peliculas

-- Insertamos datos en la tabla usuario
INSERT INTO usuario (nombre, apellidos, usuario,email, contraseña, bio, id_rol,verificado, fto_perfil) VALUES
(NULL,NULL,'admin','admin@email.com','$2y$10$Pcl6upJIjPi6k1aI83nAzOKbfbAzKRnRQN3XwXdGhcB7ol9F82Uqq',NULL, 2,1, '/Perfil_usuario/Usuarios.png'),
('      Juanmi', '   ', 'juanmi', '   juanmi@email.com', '$2y$10$Pcl6upJIjPi6k1aI83nAzOKbfbAzKRnRQN3XwXdGhcB7ol9F82Uqq', 'Sinosuke es un niño muy bribón con la fuerza de un ciclón ', 1,1, '/Perfil_usuario/newpelo.png'),
(NULL, NULL, 'alberto', 'alberto@email.com', '$2y$10$APpLCBHuISFUIfmO60Ee7OELKHi2DLexPRkS/E1jL4k8lcjEgRMNC', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Carlos', '', '$2y$10$IprRKHeCIxmjEBWudq/Kxe4SvNe/USrz80Wv.pLFj3pTARrqC3wCO', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Leo', '', '$2y$10$bFm6Vgge3u5/.YwIaD9AueswlvhnBsayp.xhmSBx9Nhbxxp57Nj7C', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'YanZ', '', '$2y$10$9ykILgIe0wxJQdd0SvEc7OROULle/MN1Occ4zVFRMbtBm68PaSvha', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Nico', '', '$2y$10$DR029NbOkIDKm5pkKGT7heqGYYTy9/A8OnA08zoVR4nERgdFfksUG', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Juanvi', '', '$2y$10$HWfTdcSqT4fICrbEURWL7OhZo1DLIgk8/DMIKaPoU1Zm9YMoBDEK.', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'JuanMa', '', '$2y$10$Gb5qPw7W.OcLMJaEDtoFyepv8nmsundl4LVYR2PDmVuIkr7.eRtG.', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Pakote', '', '$2y$10$xPVs4Tl2i8iMZdMccXKm5OvJvicGrcxOB9dGCyRljvTiyJCeWBPvS', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Manu', '', '$2y$10$HYJtMOi6fmhzlt06cWL23ui3K.a9WIJ/eBIfQGTyUsnAsxiCgMVB2', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'Enrique', '', '$2y$10$Yy/kxXUvlORJJ9/jC10AkOp75bVWCp/5srMt8Q0IhC9UeOCac/MFi', NULL, 1,1, '/Perfil_usuario/Usuarios.png'),
(NULL, NULL, 'David', '', '$2y$10$kWccVQ3GQAxugeE9rF5eo.jF08Sn8W.UOMMHsmxAvscb1sYE0nV9u', NULL, 1,1, '/Perfil_usuario/Usuarios.png');



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
