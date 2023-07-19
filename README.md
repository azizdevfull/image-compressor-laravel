## Setting 

1. Open the php.ini configuration file.
2. Search for the line that looks like ``;extension=gd`` or ``;extension=gd2``.
3. Remove the leading semicolon ``;`` to uncomment the line, so it becomes ``extension=gd`` or ``extension=gd2``.
4. Save the changes and restart your web server (e.g., Apache or Nginx) and PHP service.