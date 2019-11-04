@REM 
@REM 
@REM #	This file is part of WX4AKQ Offline Tools
@REM #	
@REM #	Copyright (c) 2015-19, Steve Crow, Reid Barden
@REM #	Licensed under the BSD 2-clause “Simplified” License
@REM #	
@REM #	For license information, see the LICENSE.md file or visit
@REM #	http://wx4akq.org/software
@REM 
@REM 
@echo off
chdir "%~dp0"
chdir ..

vagrant ssh -c "php -f /var/www/utils/sync_api_auth.php"
pause