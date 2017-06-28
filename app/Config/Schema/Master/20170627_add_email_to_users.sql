ALTER TABLE users CHANGE username username varchar(256) not null AFTER id;
ALTER TABLE users ADD email varchar(127) not null AFTER username;
ALTER TABLE users ADD unique (email);
