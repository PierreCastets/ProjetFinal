#!/bin/bash

chmod a+w -R /var/www/html/public/uploads/photos
composer update 
symfony server:start
