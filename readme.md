**Instruction pour réaliser notre Atelier N°6**

- Installer notre projet Symfony à l'aider de la commande: ````symfony new --full tp6````
- Configurer la Base de données dans le fichier *.env*: `````DATABASE_URL="mysql://USER_NAME:PASSWORD@127.0.0.1:PORT_MYSQL/NOM_BD?serverVersion=8&charset=utf8mb4"`````
- Par la suite on tape la commande `````php bin/console doctrine:database:create````` pour créer la base de données dans notre phpmyadmin
- Ajouter Bootstrap au projet
- Créer les entités suivantes à l'aide de la commande *symfony console make:entity Nomdelentite*:
`````Article, Category, Comment, Media, Option, Page, Menu`````
- Créer les contrôleurs suivants: ARTICLE, CATEGORY, COMMENT, PAGE à l'aide de la commande `````symfony console make:controller Nom_du_Controller`````

- On teste nos différentes routes
- Ensuite on installe EasyAdmin via la commande: ````composer require admin````
- ````symfony console make:admin:dashboard````: pour générer notre dashboard avec les valeurs par défaut
- Puis on va générer le CRUD pour chaque entité avec la commande ````symfony console make:admin:crud````