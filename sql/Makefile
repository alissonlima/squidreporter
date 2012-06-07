all:
	mysqldump -u root -p squid_log > squid_log.sql 

recover:
	mysql -u root -p -e 'drop database squid_log'
	mysql -u root -p -e 'create database squid_log'
	mysql -u root -p squid_log < squid_log.sql 
