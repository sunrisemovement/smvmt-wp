## smvmt-wp project

This project aims to build a robust set of WordPress tools for Sunrise National and Hubs across the country.

## smvmt-theme

The smvmt-theme is a fork of the Astra theme project (https://github.com/brainstormforce/astra), slightly slimmed down to fit our exact needs. Overtime, this theme should only become more lean, as we determine what customizeability is actually necessary for Sunrise.

## smvmt-plugin

The smvmt-plugin is a blank slate, generated using the wppb.me generator. Currently, it is only used to provide Advanced Custom Fields and Ultimate Addons for Gutenberg in a controlled way. Ultimately, this plugin should be used for providing support for custom post types like events, calls, etc. Similar to smvmt-theme, this plugin should be made more lean over time as we know exactly which blocks Hubs will use, and which they won't.

One reason for including UAG, is that we could start building out a template library like the Gutenberg Hub template library (https://templates.gutenberghub.com/) but have access to more rich design options than vanilla gutenberg. Hubs could then visit the central template library and copy/paste fully designed blocks they like directly onto their site. 

## Development

First, setup a local install of WordPress. One easy solution for this is Local (https://localwp.com/). If you are using Local, you can find the path of your WP install in the `Local Sites` directory.

Clone this repo (smvmt-wp) to a known directory (ex: a GitHub project folder).

We're gonna use symbolic links to 'add' our plugin and theme to our local WP install. If you're curious to learn more about symbolic links (or symlinks) see this Wikipedia page: https://en.wikipedia.org/wiki/Symbolic_link .

Use `ln -sF [**your smvmt-wp repo path**]/smvmt-theme [**your wp install path**]/wp-content/themes` to link the theme directory in your smvmt-wp directory to your local WP install's theme directory.

Then, from within your smvmt-wp directory, use `cd smvmt-theme` to enter the theme directory. Run `npm install` to install dependencies. Once installed, run `npm install -g grunt-cli` to install Grunt cli globally. Finally, run various Grunt tasks found toward the bottom of the Gruntfile to build styles, js, language files, etc (ex: `grunt style`).

To get started with the smvmt-plugin, use `ln -sF [**your smvmt-wp repo path**]/smvmt-plugin [**your wp install path**]/wp-content/plugins` to link the plugin directory in your smvmt-wp directory to your local WP install's plugin directory. At this time, the plugin has no build steps.

Once both are installed and ready for development, activate the `smvmt` theme and `smvmt-plugin` plugin in your WordPress admin dashboard.

## coming soon!!

After facing troubles with Lando on my local machine, I will be rebuilding the landofile and updating this readme to include information on installing/running Lando locally for development.

I will also be creating a step by step video on setting up Local for WP, and getting this project running that way.

-Henry
