#!/bin/sh
role=${CONTAINER_ROLE:-app}
echo "Container role: $role"
if [ "$role" = "queue" ]
then
    crond -f &
    while true
    do
      php artisan queue:work --verbose --tries=3 --timeout=90
    done
elif [ "$role" = "app" ]
then
   echo "Could not match the container app...."
else
    echo "Could not match the container role...."
    exit 1
fi