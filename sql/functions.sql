DELIMITER $$
DROP FUNCTION IF EXISTS `humansize_size`$$
DETERMINISTIC: CREATE FUNCTION `humansize_size` (ibytes bigint) RETURNS text DETERMINISTIC
BEGIN
 if ibytes <= 1000 then
   return concat(ibytes, ' B');
 else
   if ibytes <= (1000* 1000) then
     return concat(ibytes / 1000, ' KB');
   else
     if ibytes < (1000* 1000 * 1000) then
       return concat(ibytes / (1000 * 1000), ' MB');
     else
       if ibytes < (1000* 1000 * 1000 * 1000) then
          return concat(ibytes / (1000 * 1000 * 1000), ' GB');
       else
          return concat(ibytes / (1000 * 1000 * 1000 * 1000), ' TB');
       end if;
     end if;
   end if;
 end if;
END$$
DELIMITER ;
