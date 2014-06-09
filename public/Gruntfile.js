module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        // This line makes your node configurations available for use
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            js: {
                src: ['assets/javascripts/*.build.js']
            }
        },
        concat: {
            js: {
                options: {
                    separator: ';'
                },
                src: [
                    'assets/javascripts/jquery.js',
                    'assets/javascripts/bootstrap.min.js',
                    'assets/javascripts/main.js'
                ],
                dest: 'assets/javascripts/app.build.js'
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            js: {
                expand: true,
                cwd: 'assets/javascripts/',
                src: ['**/*.build.js'],
                dest: 'assets/javascripts/'
            }
        },
        compass: {
            dev: {
                options: {
                    basePath: 'assets/',
                    config: 'assets/config.rb'
                }
            },
            prod: {
                options: {
                    basePath: 'assets/',
                    config: 'assets/config.rb',
                    environment: 'production'
                }
            }
        },
        watch: {
            js: {
                files: [
                    'assets/javascripts/**/*.js',
                    '!assets/javascripts/**/*.build.js'
                ],
                tasks: ['buildjs'],
                options: {
                    livereload: true
                }
            },
            css: {
                files: ['assets/sass/**/*.scss', 'assets/sass/**/*.sass'],
                tasks: ['compass'],
                options: {
                    livereload: true
                }
            }
//            ,
//            images: {
//                files: ['assets/images/**/*.{gif,jpg,png}'],
//                tasks: ['imagemin'],
//                options: {
//                    event: ['added', 'changed']
//                }
//            }
        },
        imagemin: {
            png: {
                options: {
                    optimizationLevel: 7
                },
                files: [
                    {
                        expand: true,
                        cwd: 'assets/images/',
                        src: ['**/*.png'],
                        dest: 'assets/images/',
                        ext: '.png'
                    }
                ]
            },
            jpg: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'assets/images/',
                        src: ['**/*.jpg'],
                        dest: 'assets/images/',
                        ext: '.jpg'
                    }
                ]
            },
            gif: {
                options: {
                    interlaced: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'assets/images/',
                        src: ['**/*.gif'],
                        dest: 'assets/images/',
                        ext: '.gif'
                    }
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.registerTask('default', ['watch']);
    grunt.registerTask('buildjs', ['clean:js', 'concat:js', 'uglify:js']);
    grunt.registerTask('compile', ['buildjs', 'compass']);
};