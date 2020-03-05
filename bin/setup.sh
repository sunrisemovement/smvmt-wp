set -e

# Cleanup, because not all commands play well with already existing directories
rm -rf $LANDO_WEBROOT
rm -rf $WP_TESTS_DIR
echo Y | mysqladmin -u$DB_USER -p$DB_PASS -h$DB_HOST drop $DB_NAME
mysqladmin -u$DB_USER -p$DB_PASS -h$DB_HOST create $DB_NAME

# Install and configure WordPress
WP_VERSION=`curl -L http://api.wordpress.org/core/version-check/1.7/ | perl -ne '/"version":\s*"([\d\.]+)"/; print $1;'`
cd $LANDO_MOUNT
wp core download --path=$LANDO_WEBROOT --version=$WP_VERSION
wp config create \
	--path=$LANDO_WEBROOT \
	--dbname=$DB_NAME \
	--dbuser=$DB_USER \
	--dbpass=$DB_PASS \
	--dbhost=$DB_HOST
wp config set \
	--path=$LANDO_WEBROOT \
	--type=constant \
	--raw \
	WP_DEBUG true
wp core install \
	--path=$LANDO_WEBROOT \
	--url="http://smvmt.lndo.site" \
	--title="Sunrise Movement" \
	--admin_user="admin" \
	--admin_password="admin" \
	--admin_email="admin@smvmt.org" \
	--skip-email

# Link our plugin
ln -sF $LANDO_MOUNT/smvmt-plugin $LANDO_WEBROOT/wp-content/plugins/smvmt-plugin
wp plugin activate smvmt-plugin --path=$LANDO_WEBROOT

# Link our theme
ln -sF $LANDO_MOUNT/smvmt-theme $LANDO_WEBROOT/wp-content/themes/smvmt-theme
wp theme activate smvmt-theme --path=$LANDO_WEBROOT

wp plugin install advanced-custom-fields --activate --path=$LANDO_WEBROOT
wp plugin install kirki --activate --path=$LANDO_WEBROOT

wp db import $LANDO_MOUNT/smvmt_db.sql --path=$LANDO_WEBROOT
