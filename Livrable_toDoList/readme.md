
# ToDoList
ToDoList is an application to manage your daily tasks 

## Install the project in local

### Run application on local
You have to telecharge [Wamp]([http://www.wampserver.com/](http://www.wampserver.com/)) (for window) , [Xampp]([https://www.apachefriends.org/fr/index.html](https://www.apachefriends.org/fr/index.html)) (for linux) or [Mamp]([https://www.mamp.info/fr/](https://www.mamp.info/fr/)) (for Mac)
There are work environment for run your applciation on local.
### Clone
To install the project first clone file's project on your computer.

For download all the project first go to click on the **clone or download** button.
Then click on **Download ZIP**.

![enter image description here](https://lh3.googleusercontent.com/NZKmerEkMwhqAOceNQmJVCX3FbDVmfk4-GdiM06enYAnD6nEzWsXCJY6xQFFslrgJBadKWw7Pfs)

After that you have to unzip the project and put the project on your localhost.
See : 
[Install website on Windows](https://craym.eu/tutoriels/developpement/site_local_avec_wamp.html)
[Install website on Mac](https://capitainewp.io/formations/developper-theme-wordpress/serveur-local-mamp/)
[Install website on Linux](https://blog.lws-hosting.com/creation-de-sites-web/utiliser-xampp-pour-creer-son-serveur-web)
### initialize vendor
Now you have the project in yout localhost folder.
You have to install the vendor.
First open a command prompt in the **project's folder** 
Then enter this command :

	composer install
	  
Now your project is up to date.
### Database configuration
To run the application on your computer you have to configure a database.
Create a database on phpmyadmin : [Tutorial](http://webvaultwiki.com.au/Default.aspx?Page=Create-Mysql-Database-User-Phpmyadmin&NS=&AspxAutoDetectCookieSupport=1)


In the file /app/config/parameters :
Change db_password , db_user and db_name

	database_host:     YOUR_DATABASE_HOST
    database_port:     ~
    database_name:     YOUR_DATABASE_NAME
    database_user:     YOUR_DATABASE_USER ( ex : root )
    database_password: YOUR_DATABASE_PASSWORD

" db_user " and " db_password " is your database's username and password.
" db_name " is the name of the project.


Then you have to run command for update your database.

	- php bin/console doctrine:schema:update --force
Now your database is up to date.

## Test
### who to automaticly test
#### fixtures
Fixtures are data prewritten for start application's explore with content.
For load fixtures on your database enter : 

	 - php bin/console doctrine:fixtures:load

Now render on the application and enjoy it !

For more information about the application check the [technical documentation]()