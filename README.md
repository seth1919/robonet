# robonet
This is a website that allows users to create profiles with their username, age, gender, and location. Users can post messages to the global message board and view other users' profiles.

To view this site, you will need to host it on a server with a mySQL server. In my development I used xampp.
This code assumes that the mySQL server is accessible with the login information saved in connection.php.
This code assumes that the mySQL server has the following database already set up:
database: robonetusers
  table: loginifo
    column: userID, int(11), auto-increment
    column: username, varchar(50)
    column: password, varchar(50)
   table: messages
    column: messageID, int(11), auto-increment
    column: userID, int(11)
    column: message, varchar(500)
   table: userprofiles
    column: userID, int(11)
    column: age, int(11)
    column: gender, int(11)
    column: location, varchar(50)
    column: bio, varchar(500)
