use CineParaiso;
-- Disparador para despues de crear un usuario se creará su fila en estadistica

DELIMITER // 
CREATE TRIGGER añadir_estadistica
AFTER INSERT ON usuario
FOR each row
BEGIN
	DECLARE existe int;
	SELECT count(*) into existe FROM estadistica WHERE id_usuario = new.id; 
    if(existe=0) then
		INSERT into estadistica(id_usuario) values (new.id);
	END IF;
END // 
DELIMITER ;

-- Disparador para despues de insertar en siguen se sumara 1 a seguidores del usuario seguido y 1 en siguiendo del usuario que sigue tabla estadistica

DELIMITER // 
CREATE TRIGGER añadir_seguidor
AFTER INSERT ON siguen 
FOR EACH ROW
BEGIN
	Update estadistica set n_seguidores=n_seguidores +1 WHERE id_usuario = new.id_sigue;
    Update estadistica set n_siguiendo=n_siguiendo +1 WHERE id_usuario = new.id_usuario;
END //
DELIMITER ;

-- Disparador para despues de borrar siguen que se reste 1 al numero de seguidos y seguidores
DELIMITER // 
CREATE TRIGGER Borrar_seguidor
AFTER DELETE ON siguen 
FOR EACH ROW
BEGIN
	Update estadistica set n_seguidores=n_seguidores -1 WHERE id_usuario = old.id_sigue;
    Update estadistica set n_siguiendo=n_siguiendo -1 WHERE id_usuario = old.id_usuario;
END //
DELIMITER ;

-- Disparador para despues de insertar una review con el valor vermastarde 0 es decir el usuario ha visto esa pelicula se sume 1 al n_pelis_vistas de la tabla estadistica
DELIMITER // 
CREATE TRIGGER añadir_peli_vista
AFTER INSERT on review 
FOR EACH ROW 
BEGIN
	DECLARE visto int;
    SELECT vermastarde into visto from review where id_usuario = new.id_usuario and id_pelicula = new.id_pelicula;
    if(visto = 0) then
	UPDATE estadistica set n_pelis_vistas=n_pelis_vistas+1 WHERE id_usuario = new.id_usuario;
    end if;
END //
DELIMITER ;
-- Disparador para despues de borrar una review con el valor vermastarde 0 es decir el usuario ha visto esa pelicula se reste 1 al n_pelis_vistas de la tabla estadistica
DELIMITER // 
CREATE TRIGGER Borrar_peli_vista
BEFORE DELETE on review 
FOR EACH ROW 
BEGIN
	UPDATE estadistica set n_pelis_vistas=n_pelis_vistas-1 WHERE id_usuario = old.id_usuario;
END //
DELIMITER ;

-- Disparador para despues de borrar una pelicula vista para que disminuya el numero de peliculas vistas
DELIMITER // 
CREATE TRIGGER restar_peli_vista
AFTER UPDATE on review 
FOR EACH ROW 
BEGIN
    if(OLD.vermastarde = 0 AND NEW.vermastarde = 1) then
	UPDATE estadistica set n_pelis_vistas=n_pelis_vistas-1 WHERE id_usuario = new.id_usuario;
    end if;
END //
DELIMITER ;


-- Creamos Indices para las tablas 
CREATE FULLTEXT INDEX idx_film_fulltext ON pelicula (titulo);
CREATE INDEX idx_year ON pelicula (año);