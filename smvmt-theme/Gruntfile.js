module.exports = function (grunt) {
    'use strict';
    // Project configuration
    var autoprefixer = require('autoprefixer');
    var flexibility = require('postcss-flexibility');
    var smvmt_theme_Addons = ['background', 'border', 'customizer-link', 'description', 'divider', 'heading', 'hidden', 'link', 'radio-image', 'responsive', 'responsive-color', 'responsive-slider', 'responsive-spacing', 'select', 'settings-group', 'slider', 'sortable', 'typography'];

    const sass = require('node-sass');

    var sass_dist_files = [];
    var rtlcss_dist_files = [];

	var pkgInfo = grunt.file.readJSON('package.json');

    // smvmt addons.
    for (var i = 0; i < smvmt_theme_Addons.length; i++) {

        sass_dist_files.push({
            expand: true,
            cwd: "inc/customizer/custom-controls/" + smvmt_theme_Addons[i],
            src: ["*.scss"],
            dest: "inc/customizer/custom-controls/assets/css/unminified",
            ext: ".css",
        });
    }

    sass_dist_files.push({
        expand: true,
        cwd: "inc/customizer/custom-controls/",
        src: ["*.scss"],
        dest: "inc/customizer/custom-controls/assets/css/unminified",
        ext: ".css",
    });

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        rtlcss: {
            options: {
                // rtlcss options
                config: {
                    preserveComments: true,
                    greedy: true
                },
                // generate source maps
                map: false
            },
            dist: {
                files: [
                    {
                        expand: true,
                        cwd: 'assets/css/unminified/',
                        src: [
                            '*.css',
                            '!*-rtl.css',
                            '!font-awesome.css',
                            '!smvmt-fonts.css',
                        ],
                        dest: 'assets/css/unminified',
                        ext: '-rtl.css'

                    },
                    {
                        expand: true,
                        cwd: 'assets/css/unminified/compatibility',
                        src: [
                            '*.css',
                            '!*-rtl.css',
                            '!font-awesome.css',
                            '!smvmt-fonts.css',
                        ],
                        dest: 'assets/css/unminified/compatibility',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'assets/css/unminified/compatibility/woocommerce',
                        src: [
                            '*.css',
                            '!*-rtl.css',
                            '!font-awesome.css',
                            '!smvmt-fonts.css',
                        ],
                        dest: 'assets/css/unminified/compatibility/woocommerce',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'inc/assets/css',
                        src: [
                            '*.css',
                            '!*-rtl.css',
                        ],
                        dest: 'inc/assets/css',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'inc/customizer/custom-controls/assets/css/unminified',
                        src: [
                            '*.css',
                            '!*-rtl.css',
                        ],
                        dest: 'inc/customizer/custom-controls/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                ]
            }
        },

        sass: {
            options: {
                implementation: sass,
                sourcemap: 'none',
                outputStyle: 'expanded',
                linefeed: 'lf',
            },
            dist: {
                files: [

                    /*{
                    'style.css': 'sass/style.scss'
                    },*/

                    /* Link Pointer Style */
                    {
                        'assets/css/unminified/menu-animation.css': 'sass/site/navigation/menu-animation.scss',
                    },

                    /* Editor Style */
                    {
                        'assets/css/unminified/editor-style.css': 'sass/editor-style.scss',
                        // 'inc/customizer/custom-controls/assets/unminified/custom-controls.css': 'inc/customizer/custom-controls/custom-controls.scss',
                        'inc/assets/css/block-editor-styles.css': 'sass/admin/block-editor-styles.scss',
                    },

                    /* Common Style */
                    {
                        expand: true,
                        cwd: 'sass/',
                        src: ['style.scss'],
                        dest: 'assets/css/unminified',
                        ext: '.css'
                    },
                    /* Compatibility */
                    {
                        expand: true,
                        cwd: 'sass/site/compatibility/',
                        src: ['**.scss'],
                        dest: 'assets/css/unminified/compatibility',
                        ext: '.css'
                    },
                    {
                        expand: true,
                        cwd: 'sass/site/compatibility/woocommerce',
                        src: ['**.scss'],
                        dest: 'assets/css/unminified/compatibility/woocommerce',
                        ext: '.css'
                    },
                    sass_dist_files,
                ]
            }
        },

        postcss: {
            options: {
                map: false,
                processors: [
                    flexibility,
                    autoprefixer({
                        cascade: false
                    })
                ]
            },
            style: {
                expand: true,
                src: [
                    'assets/css/unminified/style.css',
                    'assets/css/unminified/*.css',
                    'assets/css/unminified/compatibility/*.css'
                ]
            }
        },

        uglify: {
            js: {
                files: [
                    { // all .js to min.js
                        expand: true,
                        src: [
                            '**.js',
                        ],
                        dest: 'assets/js/minified',
                        cwd: 'assets/js/unminified',
                        ext: '.min.js'
                    },
                    {
                        src: [
                            'assets/js/minified/navigation.min.js',
                            'assets/js/minified/custom-events-polyfill.js'
                        ],
                        dest: 'assets/js/minified/style.min.js',
                    },
                    {
                        src: [
                            'inc/addons/heading-colors/assets/js/unminified/*.js',
                        ],
                        dest: 'inc/addons/heading-colors/assets/js/minified/customizer-preview.min.js',
                    },
                    {
                        src: [
                            'inc/addons/breadcrumbs/assets/js/unminified/*.js',
                        ],
                        dest: 'inc/addons/breadcrumbs/assets/js/minified/customizer-preview.min.js',
                    },
                    {
                        src: [
                            'inc/addons/transparent-header/assets/js/unminified/*.js',
                        ],
                        dest: 'inc/addons/transparent-header/assets/js/minified/customizer-preview.min.js',
                    },
                    {
                        src: [
                            'inc/customizer/custom-controls/assets/js/unminified/custom-controls.js',
                        ],
                        dest: 'inc/customizer/custom-controls/assets/js/minified/custom-controls.min.js',
                    }
                ]
            }
        },

        cssmin: {
            options: {
                keepSpecialComments: 0
            },
            css: {
                files: [

                    // Generated '.min.css' files from '.css' files.
                    // NOTE: Avoided '-rtl.css' files.
                    {
                        expand: true,
                        src: [
                            '**/*.css',
                            '!**/*-rtl.css',
                        ],
                        dest: 'assets/css/minified',
                        cwd: 'assets/css/unminified',
                        ext: '.min.css'
                    },

                    // Generating RTL files from '/unminified/' into '/minified/'
                    // NOTE: Not possible to generate bulk .min-rtl.css files from '.min.css'
                    {
                        src: 'assets/css/unminified/editor-style-rtl.css',
                        dest: 'assets/css/minified/editor-style.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/style-rtl.css',
                        dest: 'assets/css/minified/style.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/extend-customizer-rtl.css',
                        dest: 'assets/css/minified/extend-customizer.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/customizer-controls-rtl.css',
                        dest: 'assets/css/minified/customizer-controls.min-rtl.css',
                    },
                    {
                        src:[
                            'inc/customizer/custom-controls/assets/css/unminified/*.css',
                            '!inc/customizer/custom-controls/assets/css/unminified/*-rtl.css',
                        ],
                        dest: 'inc/customizer/custom-controls/assets/css/minified/custom-controls.min.css',
                    },

                    {
                        src: 'inc/customizer/custom-controls/assets/css/unminified/*-rtl.css',
                        dest: 'inc/customizer/custom-controls/assets/css/minified/custom-controls.min-rtl.css',
                    },

                    // Generating RTL files from '/unminified/compatibility/' into '/minified/compatibility/'
                    // NOTE: Not possible to generate bulk .min-rtl.css files from '.min.css'
                    {
                        src: 'assets/css/unminified/compatibility/bne-flyout-rtl.css',
                        dest: 'assets/css/minified/compatibility/bne-flyout.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/contact-form-7-rtl.css',
                        dest: 'assets/css/minified/compatibility/contact-form-7.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/gravity-forms-rtl.css',
                        dest: 'assets/css/minified/compatibility/gravity-forms.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/lifterlms-rtl.css',
                        dest: 'assets/css/minified/compatibility/lifterlms.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/learndash-rtl.css',
                        dest: 'assets/css/minified/compatibility/learndash.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/site-origin-rtl.css',
                        dest: 'assets/css/minified/compatibility/site-origin.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/woocommerce/woocommerce-rtl.css',
                        dest: 'assets/css/minified/compatibility/woocommerce/woocommerce.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/woocommerce/woocommerce-layout-rtl.css',
                        dest: 'assets/css/minified/compatibility/woocommerce/woocommerce-layout.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/woocommerce/woocommerce-smallscreen-rtl.css',
                        dest: 'assets/css/minified/compatibility/woocommerce/woocommerce-smallscreen.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/divi-builder-rtl.css',
                        dest: 'assets/css/minified/compatibility/divi-builder.min-rtl.css',
                    },
                    {
                        src: 'assets/css/unminified/compatibility/edd-rtl.css',
                        dest: 'assets/css/minified/compatibility/edd.min-rtl.css',
                    },
                ]
            }
        },

        copy: {
            main: {
                options: {
                    mode: true
                },
                src: [
                    '**',
                    '!node_modules/**',
                    '!build/**',
                    '!css/sourcemap/**',
                    '!.git/**',
                    '!bin/**',
                    '!.gitlab-ci.yml',
                    '!bin/**',
                    '!tests/**',
                    '!phpunit.xml.dist',
                    '!*.sh',
                    '!*.map',
                    '!Gruntfile.js',
                    '!package.json',
                    '!.gitignore',
                    '!phpunit.xml',
                    '!README.md',
                    '!sass/**',
                    '!codesniffer.ruleset.xml',
                    '!vendor/**',
                    '!composer.json',
                    '!composer.lock',
                    '!package-lock.json',
                    '!phpcs.xml.dist',
                ],
                dest: 'smvmt/'
            }
        },

        compress: {
            main: {
                options: {
                    archive: 'smvmt-' + pkgInfo.version + '.zip',
                    mode: 'zip'
                },
                files: [
                    {
                        src: [
                            './smvmt/**'
                        ]

                    }
                ]
            }
        },

        clean: {
            main: ["smvmt"],
            zip: ["*.zip"]

        },

        makepot: {
            target: {
                options: {
                    domainPath: '/',
                    potFilename: 'languages/smvmt.pot',
                    potHeaders: {
                        poedit: true,
                        'x-poedit-keywordslist': true
                    },
                    type: 'wp-theme',
                    updateTimestamp: true
                }
            }
        },

        addtextdomain: {
            options: {
                textdomain: 'smvmt',
            },
            target: {
                files: {
                    src: [
                        '*.php',
                        '**/*.php',
                        '!node_modules/**',
                        '!php-tests/**',
                        '!bin/**',
                        '!admin/bsf-core/**'
                    ]
                }
            }
        },

        concat: {
            options: {
                separator: '\n'
            },
            dist: {
                files: [
                    {
                        src: [
                            'assets/js/unminified/navigation.js',
                        ],
                        dest: 'assets/js/unminified/style.js',
                    },
                    {
                        src: [
                            'inc/customizer/custom-controls/assets/css/unminified/*.css',
                            '!inc/customizer/custom-controls/assets/css/unminified/*-rtl.css',
                            '!inc/customizer/custom-controls/assets/css/unminified/custom-controls.css',
                        ],
                        dest: 'inc/customizer/custom-controls/assets/css/unminified/custom-controls.css',
                    },
                    {
                        src: [
                            'inc/customizer/custom-controls/background/background.js',
                            'inc/customizer/custom-controls/border/border.js',
                            'inc/customizer/custom-controls/color/color.js',
                            'inc/customizer/custom-controls/link/link.js',
                            'inc/customizer/custom-controls/customizer-link/customizer-link.js',
                            'inc/customizer/custom-controls/radio-image/radio-image.js',
                            'inc/customizer/custom-controls/responsive/responsive.js',
                            'inc/customizer/custom-controls/responsive-color/responsive-color.js',
                            'inc/customizer/custom-controls/responsive-slider/responsive-slider.js',
                            'inc/customizer/custom-controls/responsive-spacing/responsive-spacing.js',
                            'inc/customizer/custom-controls/settings-group/settings-group.js',
                            'inc/customizer/custom-controls/slider/slider.js',
                            'inc/customizer/custom-controls/sortable/sortable.js',
                            'inc/customizer/custom-controls/typography/typography.js'

                        ],
                        dest: 'inc/customizer/custom-controls/assets/js/unminified/custom-controls.js',
                    },
                    {
                        src: [
                            'inc/customizer/custom-controls/assets/css/unminified/*-rtl.css',
                        ],
                        dest: 'inc/customizer/custom-controls/assets/css/unminified/custom-controls-rtl.css',
                    },
                ]
            }
        },

        bumpup: {
            options: {
                updateProps: {
                    pkg: 'package.json'
                }
            },
            file: 'package.json'
        },

        replace: {
            theme_main: {
                src: ['style.css'],
                overwrite: true,
                replacements: [
                    {
                        from: /Version: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
                        to: 'Version: <%= pkg.version %>'
                    }
                ]
            },

            theme_const: {
                src: ['functions.php'],
                overwrite: true,
                replacements: [
                    {
                        from: /SMVMT_THEME_VERSION', '.*?'/g,
                        to: 'SMVMT_THEME_VERSION\', \'<%= pkg.version %>\''
                    }
                ]
            },

            theme_function_comment: {
                src: [
                    '*.php',
                    '**/*.php',
                    '!node_modules/**',
                    '!php-tests/**',
                    '!bin/**',
                    '!admin/bsf-core/**'
                ],
                overwrite: true,
                replacements: [
                    {
                        from: 'x.x.x',
                        to: '<%=pkg.version %>'
                    }
                ]
            }
        },

        wp_readme_to_markdown: {
			your_target: {
				files: {
					'README.md': 'readme.txt'
				}
			},
		},
    }
    );

    // Load grunt tasks
    grunt.loadNpmTasks('grunt-rtlcss');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-wp-i18n');
    grunt.loadNpmTasks('grunt-bumpup');
    grunt.loadNpmTasks('grunt-text-replace');
    grunt.loadNpmTasks("grunt-wp-readme-to-markdown")

    // rtlcss, you will still need to install ruby and sass on your system manually to run this
    grunt.registerTask('rtl', ['rtlcss']);

    // SASS compile
    grunt.registerTask('scss', ['sass']);

    // Style
    grunt.registerTask('style', ['scss', 'postcss:style', 'rtl']);

    // min all
    grunt.registerTask('minify', ['style', 'concat', 'uglify:js', 'cssmin:css']);

    // Update google Fonts
    grunt.registerTask('google-fonts', function () {
        var done = this.async();
        var request = require('request');
        var fs = require('fs');

        request('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDu1nDK2o4FpxhrIlNXyPNckVW5YP9HRu8', function (error, response, body) {

            if (response && response.statusCode == 200) {

                var fonts = JSON.parse(body).items.map(function (font) {
                    return {
                        [font.family]: {
                            'variants': font.variants,
                            'category': font.category
                        }
                    };
                })

                fs.writeFile('assets/fonts/google-fonts.json', JSON.stringify(fonts, undefined, 4), function (err) {
                    if (!err) {
                        console.log("Google Fonts Updated!");
                    }
                });
            }
        });
    });

    // Grunt release - Create installable package of the local files
    grunt.registerTask('release', ['clean:zip', 'copy:main', 'compress:main', 'clean:main']);

    // Bump Version - `grunt version-bump --ver=<version-number>`
    grunt.registerTask('version-bump', function (ver) {

        var newVersion = grunt.option('ver');

        if (newVersion) {
            newVersion = newVersion ? newVersion : 'patch';

            grunt.task.run('bumpup:' + newVersion);
            grunt.task.run('replace');
        }
    });

    // Generate Read me file
    grunt.registerTask( 'readme', ['wp_readme_to_markdown'] );

    // i18n
    grunt.registerTask('i18n', ['addtextdomain', 'makepot']);

    grunt.util.linefeed = '\n';
};
