#!/bin/bash

chmod a+w /var/www/html/public/uploads/photos
composer update 
symfony server:start
