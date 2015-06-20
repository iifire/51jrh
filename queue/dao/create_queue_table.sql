drop table if exists queue_info;
CREATE TABLE `queue_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(20) NOT NULL DEFAULT '',
  `queue_name` varchar(20) NOT NULL DEFAULT '',
  `queue_length` int(11) NOT NULL DEFAULT '0',
  `unread_count` int(11) NOT NULL DEFAULT '0',
  `push_count` int(11) NOT NULL DEFAULT '0',
  `pull_count` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`info_id`),
  UNIQUE KEY `info_idx` (`server_name`,`queue_name`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;