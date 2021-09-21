CONTAINER_NAME	:= cccat3_project_php_php_1

hello:
	echo "Hello";
composer-install:
	docker container exec -it $(CONTAINER_NAME) /usr/bin/composer install -o
test:
	docker container exec $(CONTAINER_NAME) vendor/bin/phpunit
clean-project:
	docker container exec $(CONTAINER_NAME) rm -Rf vendor && rm -f composer.lock
terminal:
	docker container exec -it $(CONTAINER_NAME) sh