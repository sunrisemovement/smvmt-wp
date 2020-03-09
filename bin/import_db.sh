wp db import $LANDO_MOUNT/smvmt_db.sql --path=$LANDO_WEBROOT
rm -rf $LANDO_WEBROOT/wp-content/uploads
cp -R $LANDO_MOUNT/db/uploads $LANDO_WEBROOT/wp-content