gen_grpc:
	protoc -I protocol/ --php_out=src/ --grpc_out=src/ --plugin=protoc-gen-grpc=bin/grpc_php_plugin protocol/users.proto

composer_install:
	composer install

composer_update_autoload:
	composer dump-autoload

app_create:
	php index.php create --host 127.0.0.1 --port 1234 Vladimir test@mail.ru 32

app_read:
	php index.php read --host 127.0.0.1 --port 1234 11

app_update:
	php index.php update --host 127.0.0.1 --port 1234 11 VladimirMod some@mail.ru 777