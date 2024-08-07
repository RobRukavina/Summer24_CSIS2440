-------------------------- copy and paste to your local mysql server -------------------------------
drop database if exists palindromes;
create database palindromes;
use palindromes;
create table palindrome (id int auto_increment primary key, phrase varchar(255));
insert into palindrome (phrase) values ('race car'), ('bob'), ('senile felines'), ('stack cats');
select * from palindrome;
----------------------------------------------------------------------------------------------------


---------------------------- copy and paste to your remote server ----------------------------------
create table palindrome (id int auto_increment primary key, phrase varchar(255));
insert into palindrome (phrase) values ('race car'), ('bob'), ('senile felines'), ('stack cats');
select * from palindrome;
----------------------------------------------------------------------------------------------------


-- My poll db
create database poll;
create table answers (id int auto_increment primary key, answer varchar(255), counter int);
INSERT INTO answers (answer) VALUES ("Yes", "No", "I Don't Know", "How could you ask me that?");
select * from answers;


-- My users db (insecure obviously)
create database users;
create table users (id int auto_increment primary key, username varchar(255), password varchar(255));
INSERT INTO users (username, password) VALUES ("chuck", "roast");
INSERT INTO users (username, password) VALUES ("dog", "house");
INSERT INTO users (username, password) VALUES ("car", "toons");
INSERT INTO users (username, password) VALUES ("bob", "ross");
select * from users;

