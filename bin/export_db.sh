wp db export $LANDO_MOUNT/smvmt_db.sql --path=$LANDO_WEBROOT
cp -R $LANDO_WEBROOT/wp-content/uploads $LANDO_MOUNT/db