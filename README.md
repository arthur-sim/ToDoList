# ToDoList
ToDoList is an application to manage your daily tasks
## Installation

### Install the project on your computer:

	- Clone this project on your computer
	- Open a command prompt ( cmd in the project's folder )
	- paste this command " composer install"
	  
### Database configuration
In the file ".env" :

	- DATABASE_URL=mysql://'db_user':'db_password'@127.0.0.1:3306/db_name

"db_user" and "db_password" is your database's username and password.
"db_name" is the name of the project.

### Basic data
This application have fixtures (basic data for tests) if you want to test it run :

	- Database create
	- Doctrine fixtures load
Now test it !