@REM 
@REM 
@REM #	This file is part of WX4AKQ Offline Tools
@REM #	
@REM #	Copyright (c) 2015-18, Steve Crow, Reid Barden
@REM #	Licensed under the BSD 2-clause “Simplified” License
@REM #	
@REM #	For license information, see the LICENSE.md file or visit
@REM #	http://wx4akq.org/software
@REM 
@REM 
@echo off

chdir "%~dp0"

if not exist "c:\rms express\global folders\templates" goto errormsg
copy /y forms\*.txt "c:\rms express\global folders\templates"
copy /y forms\*.html "c:\rms express\global folders\templates"
goto end

:errormsg
echo RMS Express not installed or installed to non-standard folder.
echo Please see the README.md file for manual installation instructions.
pause

:end

