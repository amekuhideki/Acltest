ALTER TABLE users ADD git_id varchar(256) DEFAULT null COMMENT 'gitのアカウントID' AFTER gmail;
ALTER TABLE users ADD git_url varchar(256) DEFAULT null COMMENT 'gitのURL' AFTER git_id;