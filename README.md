## Getting started
Copy all the files into the htdocs/ directory inside the Xampp. (You have installed [xampp](https://www.apachefriends.org/download.html), right?)

Afterward, start the Apache server and MySql inside the Xampp control panel,
go to phpmyadmin in the browser via clicking the `admin` button beside the MySql,
and create a database name `preschool_system`. While selecting that database,
go to `import` tab and select the preschool_system.sql from this repo.
Remember to disable the foreign key checks while importing the file.

At last, go to `localhost/index.html` with browser of your choice.

## Model
There are 4 table inside the database:
* admin
* contact
* course
* user

For user, there are 2 roles:
* 1 - student
* 2 - teacher

...and 2 statue:
* 1 - active
* 2 - inactive
