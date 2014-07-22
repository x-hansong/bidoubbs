DROP TABLE IF EXISTS articles;
CREATE TABLE articles (
  id mediumint(8) unsigned NOT NULL auto_increment,
  cid smallint(6) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  ruid mediumint(8) unsigned NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  content mediumtext NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  edittime int(10) unsigned NOT NULL default '0',
  views int(10) unsigned NOT NULL default '1',
  comments mediumint(8) unsigned NOT NULL default '0',
  closecomment tinyint(1) NOT NULL default '0',
  favorites int(10) unsigned NOT NULL default '0',
  visible tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (id),
  KEY cid (cid),
  KEY edittime (edittime),
  KEY uid (uid)
) ENGINE=MyISAM ;

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  id smallint(6) unsigned NOT NULL auto_increment,
  name char(50) NOT NULL,
  articles mediumint(8) unsigned NOT NULL default '0',
  about text NOT NULL,
  PRIMARY KEY  (id),
  KEY articles (articles)
) ENGINE=MyISAM ;

INSERT INTO categories VALUES(1, '默认分类', 0, '');


CREATE TABLE comments (
  id int(10) unsigned NOT NULL auto_increment,
  articleid mediumint(8) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  addtime int(10) unsigned NOT NULL default '0',
  content mediumtext NOT NULL,
  PRIMARY KEY  (id),
  KEY articleid (articleid)
) ENGINE=MyISAM ;

DROP TABLE IF EXISTS links;
CREATE TABLE links (
  id smallint(6) unsigned NOT NULL auto_increment,
  name varchar(100) NOT NULL default '',
  url varchar(200) NOT NULL default '',
  PRIMARY KEY  (id)
) ENGINE=MyISAM ;



DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id mediumint(8) unsigned NOT NULL auto_increment,
  name varchar(20) NOT NULL default '',
  flag tinyint(2) NOT NULL default '0',
  avatar mediumint(8) unsigned NOT NULL default '0',
  password char(32) NOT NULL,
  email varchar(40) NOT NULL,
  url varchar(75) NOT NULL,
  articles int(10) unsigned NOT NULL default '0',
  replies int(10) unsigned NOT NULL default '0',
  regtime int(10) unsigned NOT NULL default '0',
  lastposttime int(10) unsigned NOT NULL default '0',
  lastreplytime int(10) unsigned NOT NULL default '0',
  about text NOT NULL,
  notic text NOT NULL,
  PRIMARY KEY  (id),
  KEY name (name)
) ENGINE=MyISAM ;

DROP TABLE IF EXISTS favorites;
CREATE TABLE favorites (
  id mediumint(8) unsigned NOT NULL auto_increment,
  uid mediumint(8) unsigned NOT NULL default '0',
  articles mediumint(8) unsigned NOT NULL default '0',
  content mediumtext NOT NULL default '',
  PRIMARY KEY (id),
  KEY uid (uid)
) ENGINE=MyISAM ;


CREATE TABLE weixin (
  id mediumint(8) unsigned NOT NULL auto_increment,
  uid mediumint(8) unsigned NOT NULL default '0',
  name varchar(20) NOT NULL default '',
  openid char(32) NOT NULL,
  PRIMARY KEY (id),
  KEY uid (uid),
  KEY openid (openid)
) ENGINE=MyISAM ;

CREATE TABLE settings (
  title varchar(50) NOT NULL default '',
  value text NOT NULL,
  PRIMARY KEY  (title)
) ENGINE=MyISAM ;


INSERT INTO settings VALUES('name', 'bidoubbs');
INSERT INTO settings VALUES('site_des', '比逗社区');
INSERT INTO settings VALUES('site_create', '0');
INSERT INTO settings VALUES('icp', '');
INSERT INTO settings VALUES('admin_email', '');
INSERT INTO settings VALUES('home_shownum', '20');
INSERT INTO settings VALUES('list_shownum', '20');
INSERT INTO settings VALUES('newest_node_num', '20');
INSERT INTO settings VALUES('hot_node_num', '20');
INSERT INTO settings VALUES('bot_node_num', '100');
INSERT INTO settings VALUES('article_title_max_len', '60');
INSERT INTO settings VALUES('article_content_max_len', '3000');
INSERT INTO settings VALUES('article_post_space', '60');
INSERT INTO settings VALUES('reg_ip_space', '3600');
INSERT INTO settings VALUES('comment_min_len', '4');
INSERT INTO settings VALUES('comment_max_len', '1200');
INSERT INTO settings VALUES('commentlist_num', '32');
INSERT INTO settings VALUES('comment_post_space', '20');
INSERT INTO settings VALUES('close', '0');
INSERT INTO settings VALUES('close_note', '数据调整中');
INSERT INTO settings VALUES('authorized', '0');
INSERT INTO settings VALUES('register_review', '0');
INSERT INTO settings VALUES('close_register', '0');
INSERT INTO settings VALUES('close_upload', '0');
INSERT INTO settings VALUES('ext_list', '');
INSERT INTO settings VALUES('img_shuiyin', '0');
INSERT INTO settings VALUES('show_debug', '0');
INSERT INTO settings VALUES('jquery_lib', '/static/js/jquery-1.6.4.js');
INSERT INTO settings VALUES('head_meta', '');
INSERT INTO settings VALUES('analytics_code', '');
INSERT INTO settings VALUES('safe_imgdomain', '');
INSERT INTO settings VALUES('ad_post_top', '');
INSERT INTO settings VALUES('ad_post_bot', '');
INSERT INTO settings VALUES('ad_sider_top', '');
INSERT INTO settings VALUES('ad_web_bot', '');
INSERT INTO settings VALUES('main_nodes', '');
INSERT INTO settings VALUES('spam_words', '');
