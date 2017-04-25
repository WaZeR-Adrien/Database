# Database
**CLASS**

This class allow you to manage your querys easier

### Config this class :
* Clone this git
* Open config-example.php
* Config your own web server
* Save and replace config-example.php by config.php

### Use this class :

**_Query :_**

>$query = Database::query('SELECT * FROM table', '\Table');

\Table -> class of the table.

**_Exec :_**

>Database::exec('INSERT INTO table(fields) VALUES(values)');

**_Insert :_**

>Database::insert('table','fields','values');

**_Update :_**

>Database::update('table','fields','values','byField','key');

**_Delete :_**

>Database::delete('table','byField','key');


**By Adrien Martineau (WaZeR)**