# This is only meant for development purposes.

## Usage:
Before you start-up the docker container instance, it's recommended that you install the composer packages:
```bash
composer install --ignore-platform-reqs
```

To start the docker container navigate to /docker folder and run:
```bash
docker-compose up -d
```

To execute commands on the docker instance:
```bash
docker exec docker-php-1 composer test          # Run tests

docker exec docker-php-1 composer test-coverage # Test coverage

docker exec docker-php-1 composer phpstan       # Static analysis

docker exec docker-php-1 composer lint          # Code formatting warnings

docker exec docker-php-1 composer fix-style     # Code formatting automatic fix
```