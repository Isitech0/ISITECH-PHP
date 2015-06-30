
ECHO "Start project init"
cd isitech_php/

ECHO "Composer update"
cmd /c composer update

ECHO "Clear cache"
php app/console cache:clear

ECHO "Create BDD"
php app/console doctrine:database:drop --force
php app/console doctrine:database:create

ECHO "Update Schema"
php app/console doctrine:schema:update --force