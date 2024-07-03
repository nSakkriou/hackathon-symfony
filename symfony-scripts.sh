if [ "$APP_ENV" != "build" ]; then
    symfony-cmd cache:clear
    symfony-cmd assets:install %PUBLIC_DIR%
fi