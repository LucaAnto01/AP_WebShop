/*Seleziono il database al fine di potervi operare*/
USE AeP_webshop;

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin_admin';

create user 'mariorossi' IDENTIFIED by 'cliente_mariorossi';

create user 'ferrari' IDENTIFIED by 'fornitore_ferrari';

/*SET PASSWORD FOR 'admin'@'localhost' = PASSWORD('LaPassword!'); per settare la password*/
/*FLUSH PRIVILEGES; per aggiornare i privilegi*/