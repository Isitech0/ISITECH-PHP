
ECHO "Start project init"

ECHO "Clear cache"
php app/console cache:clear

ECHO "Create BDD""
php app/console doctrine:database:drop --force
php app/console doctrine:database:create