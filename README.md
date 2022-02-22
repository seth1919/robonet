# robonet
This is a website that allows users to create profiles with their username, age, gender, and location. Users can post messages to the global message board and view other users' profiles.

To view this site, you will need to host it on a server with a mySQL server. In my development I used xampp.
This code assumes that the mySQL server is accessible with the login information saved in connection.php.
This code assumes that the mySQL server has the following database already set up:<br />
database: robonetusers<br /><br />
  table: loginifo<br />
    column: userID, int(11), auto-increment<br />
    column: username, varchar(50)<br />
    column: password, varchar(50)<br />
   table: messages<br />
    column: messageID, int(11), auto-increment<br />
    column: userID, int(11)<br />
    column: message, varchar(500)<br />
   table: userprofiles<br />
    column: userID, int(11)<br />
    column: age, int(11)<br />
    column: gender, int(11)<br />
    column: location, varchar(50)<br />
    column: bio, varchar(500)<br />
