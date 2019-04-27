# dbms-project
A project for the course Database Management Systems

# Project Title
a Database for Project Registrations

a department project being carried out under Dr. Mamtha H. R.

# Team
Section A

Tejvi M. - PES1201700119

Sparsha P. - PES1201700226

Thejas Bhat - PES1201701421

# Execution

clone the repository: ```$git clone https://github.com/tejvi-m/dbms-project.git```

creating and populating the database: ```$psql username < dbms-project/Phase-2/create.sql```

```$psql username < dbms-project/Phase-2/insert.sql```

accessing the UI: copy ```Phase-2/UI``` to the appropriate folder and navigate to ```localhost/UI/login.php``` once you set the the user and password parameters in ```Phase-2/UI/loginprocess.php```
or run ```$sudo cp -r dbms-project/Phase-2/UI /var/www/html/``` if ```/var/www/html/``` is the document root for apache.
