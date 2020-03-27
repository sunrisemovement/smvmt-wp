## smvmt-wp project

This project aims to build a robust set of WordPress tools for Sunrise National and Hubs across the country.

## smvmt-theme

The smvmt-theme is a fork of the Astra theme, slightly slimmed down to fit our exact needs. Overtime, this theme should only become more lean, as we determine what customizeability is actually necessary for Sunrise.

## smvmt-plugin

The smvmt-plugin is a blank slate, generated using the wppb.me generator. Currently, it is only used to provide Advanced Custom Fields and Ultimate Addons for Gutenberg in a controlled way. Ultimately, this plugin should be used for providing support for custom post types like events, calls, etc. Similar to smvmt-theme, this plugin should be made more lean over time as we know exactly which blocks Hubs will use, and which they won't.

## Development

Clone smvmt-theme into the themes directory of your local WP install. Then, run `npm install` to install dependencies. Once installed, run `npm install -g grunt-cli` to install Grunt cli globally. Finally, run various Grunt tasks found toward the bottom of the Gruntfile to build styles, js, language files, etc.

To get started with the smvmt-plugin, simply clone that directory into the plugins directory of local WP install. At this time, the plugin has no build steps.

Once both are installed and ready for development, activate the `smvmt` theme and `smvmt-plugin` plugin in your WordPress admin dashboard.

## coming soon!!

After facing troubles with Lando on my local machine, I will be rebuilding the landofile and updating this readme to include information on installing/running Lando locally for development.

I will also be creating a step by step video on setting up Local for WP, and getting this project running that way.

-Henry