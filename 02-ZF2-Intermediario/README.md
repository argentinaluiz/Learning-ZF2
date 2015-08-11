# Estudos ZF2 Intermediário

:book: Estudos Zend framework

**Uso**

> - $ git clone https://github.com/candidosouza/Learning-ZF2.git

> - $ cd 02-ZF2-Intermediario

> - $ composer install

> - $ php public/index.php orm:schema-tool:create

> - $ php vendor/bin/doctrine-module data-fixture:import --purge-with-truncate

> - $ php -S 127.0.0.1:8080 -t public/

*RestFull*

> - Listar

GET: http://127.0.0.1:8080/api/user

GET: http://127.0.0.1:8080/api/user/7

> - Criar

POST - http://127.0.0.1:8080/api/user

key: name 	value: ****

key: email 	value: ****

Key: password	value: ****

> - Atualizar

PUT - http://127.0.0.1:8080/api/user/7

key: name 	value: ****

key: email 	value: ****

Key: password	value: ****

> - Deletar

DELETE - http://127.0.0.1:8080/api/user/7
