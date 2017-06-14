ALTER TABLE users ADD error_count tinyint(2) DEFAULT 0 COMMENT 'エラー回数' AFTER introduction;
ALTER TABLE users ADD error_time datetime DEFAULT null COMMENT 'エラー時間' AFTER error_count;
