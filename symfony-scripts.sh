#!/bin/bash

if [ "$APP_ENV" != "build" ]; then
    php bin/console cache:clear
    php bin/console assets:install %PUBLIC_DIR%
else
    echo "Skipping cache:clear and assets:install in build environment."
fi
