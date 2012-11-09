Symfony Fighting Slumlords Edition
==================================

This is a good place to store some important information regarding how the project is structured. Feel free to update it if you spot any mistakes.

The best place for up-to-date information is definitely the [Symfony 2 book](http://symfony.com/doc/current/book/index.html). Reading through it will definitely clear things up. Also, [here's](http://symfony.com/doc/2.0/glossary.html) a page of the terminology being used.

In order to access the site, use [http://slumlords.chickenkiller.com/app_dev.php/](http://slumlords.chickenkiller.com/app_dev.php/) during development. It won't cache any assets at that URL.

1) Style Guide
--------------
The primary style guide being used is [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md). Just glancing over the overview should tell you enough. The most important thing to note would likely be the use of 4 spaces for indenting, and not hard tabs.

2) Bundles
----------
As of right now Twitter's Bootstrap and FOSUserBundle are being used. Bootstrap for the CSS theming, FOSUserBundle for our users table.

3) Commands
-----------
From the root project directory, /Symfony, use the following command:
    php app/console help list
        - This will give you a list of commands to use. The most frequently used commands so far:
    php app/console doctrine:schema:update --force
        - This makes any schema updates to our database and entities. 
    php app/console doctrine:mapping:info
        - This will show all the database mapping information.

4) Locations
------------
We'll most likely be working primarily in the Symfony/src/Slumlords/Bundle directory. That contains controllers, database entities, bundle configs, and our HTML views. I'll run through where everything should be located (all paths are relative to Symfony/src/Slumlords/Bundle):

-- /Controller
Most of the time routes will be mapped to controllers. The controller processes information from the request to perform actions and return a Response object (usually the return is a rendered template/view). The default one is called DefaultController.php.

-- /Entity 
This folder contains our database entities. It uses something called Doctrine for accessing, and manipulating database objects. The particulars (i.e., VARCHAR, AUTO_INCREMENT) of the table and fields (as well as relationships) aren't stored here. I'm not sure what _Repository.php does as of yet. 

-- /Resources
This contains local configs, docs, and views.

-- /Resources/config
    - routing.yml 
      This contains all the routing information. Right now any matches on pattern / will send it to our 
      DefaultController from earlier.

-- /Resources/config/doctrine
    This is where all the database schema and relations are stored. See the Symfony book for more information.

-- /Resources/doc
    I suppose this is where our documentation would be stored. v0v

-- /Resources/views
    This folder contains all the HTML files. It'll be cleaned up and separated into multiple parts later. The stylesheets filter=... command is for including [Twitter's Bootstrap](http://twitter.github.com/bootstrap/)  which is used for theming help.

That's all for now. I'll keep adding onto this document later. Feel free to e-mail me any questions you have, or we can use our group's chat on Moodle. - mjhale 


 





