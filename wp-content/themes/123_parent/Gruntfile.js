// get the grunt class
const grunt = require('grunt');
// get the node sass implementation (cuz the ruby one is SLOW AF)
const sass = require('node-sass');
// auto-load all the grunt tasks passed into the initConfig func
require('load-grunt-tasks')(grunt);

// pass settings into grunt
grunt.initConfig({
    sass: {
        options: {
            implementation: sass,
            sourceMap: true,
        },
        main: {
            files: {
                '__build/_css/main.css': '__pre/_sass/main.scss',
            },
        },
        admin: {
            files: {
                '__build/_css/_conditional/admin.css': '__pre/_sass/_conditional/admin.scss',
            },
        },
        login: {
            files: {
                '__build/_css/_conditional/login.css': '__pre/_sass/_conditional/login.scss',
            },
        }
    },
    autoprefixer: {
        options: {
            browsers: [
                "> 1%",
            ],
        },
        main: {
            src: '__build/_css/main.css',
            dest: '__build/_css/main.css',
        },
        admin: {
            src: '__build/_css/_conditional/admin.css',
            dest: '__build/_css/_conditional/admin.css',
        },
        login: {
            src: '__build/_css/_conditional/login.css',
            dest: '__build/_css/_conditional/login.css',
        },
    },
    watch: {
        sass: {
            files: ['__pre/_sass/**/*.scss'],
            tasks: ['sass'],
            options: {
                livereload: 35729
            },
        },
        js: {
            files: ['__pre/_js/**/*.js'],
            tasks: ['browserify'],
            options: {
                livereload: 35729
            },
        },
        php: {
            files: ['**/*.php'],
            options: {
                livereload: 35729
            },
        },
        options: {
            style: 'expanded',
            compass: true,
        },
    },
    browserify: {
        main: {
            files: {
                '__build/_js/main.js': ['__pre/_js/main.js']
            },
            options: {
                transform: [
                    [
                        "babelify", {
                            presets: ["@babel/env"]
                        }
                    ]
                ],
                browserifyOptions: {
                    // Embed source map for tests
                    debug: true
                },
                sourceMaps: true
            }
        },
        login: {
            files: {
                '__build/_js/_conditional/login.js': ['__pre/_js/_conditional/login.js']
            },
            options: {
                transform: [
                    [
                        "babelify", {
                            presets: ["@babel/env"]
                        }
                    ]
                ],
                browserifyOptions: {
                    // Embed source map for tests
                    debug: true
                },
                sourceMaps: true
            }
        },
        admin: {
            files: {
                '__build/_js/_conditional/admin.js': ['__pre/_js/_conditional/admin.js']
            },
            options: {
                transform: [
                    [
                        "babelify", {
                            presets: ["@babel/env"]
                        }
                    ]
                ],
                browserifyOptions: {
                    // Embed source map for tests
                    debug: true
                },
                sourceMaps: true
            }
        }  
    },
    exorcise: {
        bundle: {
            options: {},
            files: {
                '__build/_js/main.js.map': ['__build/_js/main.js'],
            }
        },
        admin: {
            options: {},
            files: {
                '__build/_js/_conditional/admin.js.map': ['__build/_js/_conditional/admin.js'],
            }
        },
        login: {
            options: {},
            files: {
                '__build/_js/_conditional/login.js.map': ['__build/_js/_conditional/login.js'],
            }
        },
    }
});
// register the default task
grunt.registerTask('default', ['sass', 'autoprefixer', 'browserify', 'exorcise', 'watch']);