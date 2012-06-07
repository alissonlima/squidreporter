CREATE FUNCTION domain_of_url (url varchar(255))
RETURNS varchar(255)
RETURN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(TRIM(LEADING
"https://" FROM TRIM(LEADING "http://" FROM TRIM(url))), "/", 1), ":",
1), ".", IF(url LIKE "%.org.__%" OR url LIKE "%.net.__%" OR url LIKE
"%.com.__%" OR url LIKE "%.__.us%" OR url LIKE "%.co.__%" OR url LIKE
"%.__.uk%", -3, -2) );
