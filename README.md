# smvmt-wp
 sunrise movment WordPress theme + plugin

### 👷 Setting up a development environment with Lando

We’re experimenting with a system to make setting up all software needed for development easier. Lando is Docker-based, but should make things a bit easier than most Docker setups.

* Install [Lando](https://docs.devwithlando.io/). We've tested it up to RC7.
* Clone this repository locally. If you are using Windows, make sure you've set `git` to use UNIX line endings.
* In a terminal go to the directory of the local repository clone.
* Run `lando start`.
* Wait for a few minutes for everything to begin loading. Subsequent starts will be much faster but you’ll need to give it time for the very first start.
* You should see a `BOOMSHAKALAKA!!!` line 🎉
* In the `APPSERVER URLS` section of the output note the third URL (it should start with `http://smvmt.lndo.site` and maybe have a port).
* Logs are accessible via the [lando logs](https://docs.devwithlando.io/cli/logs.html) command. If you mostly care about PHP error log, a useful command is: `lando logs -s appserver -t -f`.
* If needed, you can SSH into the local appserver by running the command `lando ssh` while the server is running.

### File Structure

This monorepo project effectively houses two different codebases. The `smvmt-plugin` directory is home to the a custom plugin, building out the site's core functionality. The theme lives in the `smvmt-theme` directory. Each of these folders have their own npm setups, their own webpack configuations, and can really be thought of as two seperate projects, living in the same repo. 

Once you have run `lando start` a new `wp` directory is built out, where the WordPress core files live. This directory is included in the gitignore, and shouldn't be changed.

The `smvmt_db.sql` file represents a default sql database, which is imported on first install of the site. This is useful in making sure that all developers start from the same place in terms of default content.

### WP Credentials

The sql file that comes with the repo sets up one admin account out of the box. You can login at `smvmt.lndo.site/wp-admin`. Username: `admin`, password: `admin`. This is for development purposes ONLY, and a produciton site will employ more rigorous security standards.
