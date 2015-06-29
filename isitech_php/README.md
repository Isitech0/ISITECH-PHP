isitech_php
===========

A Symfony project created on June 29, 2015, 7:32 pm.

## Step 1 :
Generate a [Sample Bundle](http://symfony.com/doc/current/cookbook/bundles/best_practices.html)
```sh
php app/console generate:bundle
```

## Step 2 :
Create an Entity 'Utilisateur' for SampleAdminBundle [Entity Name : SampleAdminBundle:Utilisateur]
```sh
php app/console doctrine:generate:entity
```

## Step 3 :
Add Attributes
```php
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $password;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;
```

## Step 4 :
Generate Getters/Setters
```sh
php app/console doctrine:generate:entities SampleAdminBundle:Utilisateur
```

## Step 5:
INSERT INTO
```php
    /**
     * Example Create Users
     * @Route("/postUser")
     * @return Response
     */
    public function createUser()
    {
        $newuser = new Utilisateur();
        $newuser->setName('Alexis');
        $newuser->setPassword(hash('sha256', 'azertyuiop'));
		$newuser->setDescription('TEST ');
		 
        // Récupération de l'instance ORM
        $em = $this->getDoctrine()->getManager();

        // Enregistrement de l'utilisateur
        $em->persist($newuser);
        $em->flush();

        return new Response('Id du utilisateur créé : '.$newuser->getId());
    }
```
SELECT
```php

```
UPDATE
```php

```

## Step 6 :
Init database and schema
```sh
php app/console doctrine:database:drop --force
php app/console doctrine:database:create
"Created database `isitechphpbdd` for connection named default"
php app/console doctrine:schema:update --force
"Updating database schema...
Database schema updated successfully! "1" queries were executed"
```


## Default URL :
* http://localhost/ISITECH-PHP/isitech_php/web/app_dev.php/hello/{NAME_VARIABLE}
* http://localhost/ISITECH-PHP/isitech_php/web/app_dev.php/postUser
* http://localhost/ISITECH-PHP/isitech_php/web/app_dev.php/getUser