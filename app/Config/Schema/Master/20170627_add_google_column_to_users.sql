ALTER TABLE users ADD g_id varchar(256) DEFAULT null COMMENT 'googleID' AFTER fb_id;
ALTER TABLE users ADD gmail varchar(256) DEFAULT null COMMENT 'gmail' AFTER g_id;