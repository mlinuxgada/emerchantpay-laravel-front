.DEFAULT_GOAL := start

.PHONY: start
start:
	@echo "Running emerchantpay rss frontend web ..."
	@docker-compose up -d

.PHONY: migrate
migrate:
	@echo "Running migrations ..."
	@docker-compose exec main php ./artisan migrate

.PHONY: stop
stop:
	@echo "Stopping server.."
	@docker-compose stop

.PHONY: restart
restart: stop start
