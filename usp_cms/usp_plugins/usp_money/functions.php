<?php 

    // To add a column to an existing table the syntax would be:
    // mysql_query("ALTER TABLE birthdays ADD street CHAR(30)");
    
    // You can also specify where you want to add the field.
    // mysql_query("ALTER TABLE birthdays ADD street CHAR(30) AFTER birthday");
    /*
    mysql_query("ALTER TABLE birthdays
ADD street CHAR(30) AFTER birthday,
Add city CHAR(30) AFTER street,
ADD state CHAR(4) AFTER city,
ADD zipcode CHAR(20) AFTER state,
ADD phone CHAR(20) AFTER zipcode");
*/

/*
Column definitions can be modified using the ALTER method. The following code would change the existing birthday column from 7 to 15 characters.

    mysql_query("ALTER TABLE birthdays CHANGE birthday birthday VARCHAR(15)");
*/

/*
Columns can be removed from an existing table. The next example of code would remove the lastname column.
mysql_query("ALTER TABLE birthdays DROP lastname");
*/