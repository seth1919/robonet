# robonet
This is a website that allows users to create profiles with their username, age, gender, and location. Users can post messages to the global message board and view other users' profiles.

To view this site, you will need to host it on a server with a mySQL server. In my development I used xampp.
This code assumes that the mySQL server is accessible with the login information saved in connection.php.
This code assumes that the mySQL server has the following database already set up:<br />
database: robonetusers<br /><br />
table: loginifo<br />
 &nbsp;&nbsp;   column: userID, int(11), auto-increment<br />
 &nbsp;&nbsp;   column: username, varchar(50)<br />
 &nbsp;&nbsp;   column: password, varchar(50)<br />
 &nbsp;  table: messages<br />
 &nbsp;&nbsp;   column: messageID, int(11), auto-increment<br />
 &nbsp;&nbsp;   column: userID, int(11)<br />
 &nbsp;&nbsp;   column: message, varchar(500)<br />
 &nbsp;  table: userprofiles<br />
 &nbsp;&nbsp;   column: userID, int(11)<br />
 &nbsp;&nbsp;   column: age, int(11)<br />
 &nbsp;&nbsp;   column: gender, int(11)<br />
 &nbsp;&nbsp;   column: location, varchar(50)<br />
 &nbsp;&nbsp;   column: bio, varchar(500)<br />
