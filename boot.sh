#!/bin/bash

chmod a+w /public/uploads/photos/
composer update 
symfony server:start
