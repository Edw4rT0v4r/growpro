up:
	@docker-compose up -d webserver

start:
	@docker-compose start webserver

stop:
	@docker-compose stop

info:
	@docker system df

destroy:
	@docker system prune -a --volumes

into-container:
	@docker-compose exec webserver bash

install:
	@docker-compose exec -u application webserver bash -c  "cd growpro;composer cc"
	@docker-compose exec -u application webserver bash -c  "cd growpro;composer install"

composer:
	@docker-compose exec -u application webserver bash -c  "tput setaf 2; echo $(ACTION) package $(PACKAGE) && tput sgr0;"
	@docker-compose exec -u application webserver bash -c  "cd growpro;composer $(ACTION) $(PACKAGE)"

composer-autoload:
	@docker-compose exec -u application webserver bash -c  "cd growpro;composer dump-autoload"

test: CMD=./vendor/bin/phpunit

test:
	@docker-compose exec -u application webserver bash -c  "cd growpro;$(CMD)"
