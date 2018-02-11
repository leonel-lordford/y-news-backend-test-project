## General considerations

- Database **MUST** be named "ynews" otherwise many queries **WILL FAIL** 
- Set correct params for connection in **database.php**
- Add initial user in **USERS** table, since this is only a test I haven't applied advanced security concepts, just set username and password in **PLAIN TEXT** and login with insecure data
- **Tested using Debian GNU/Linux**
- Ensure using **Apache 2.4.25**
- Ensure using **MariaDB-Server 10.1**
- Ensure using **PHP 7.0.27**
- Ensure using **php7.0.27-xml**
- Ensure using **php7.0.27-mysql**
- Ensure using **php7.0.27-json**
- Ensure **PHP supports session handling**
- **NOTICE** function ***Download as CSV*** uses *\*#\** as separator, since data **CAN** contain default CSV separator **, ** creating an unformatted CSV file


