module.exports = function(grunt) {
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        files: {
          'build/css/build.css' : 'sass/main.scss',
        },
      },
      login: {
        files: {
          'build/css/login.css' : 'sass/login.scss',
        },
      },
      admin: {
        files: {
          'build/css/admin.css' : 'sass/admin.scss',
        },
      },
    },
    concat: {
      options: {
        separator: ';\n',
      },
      buildjs: {
        src: [
          'js_vendor/jquery-1.12.4.min.js', 
          'js_vendor/geoxml3.js',
          'js_vendor/*.js',
          'js/main.js'
        ],
        dest: 'build/js/build.js',
      },
      execjs :{
        src: ['js/exec.js'],
        dest: 'build/js/exec.js',
      },
      adminjs: {
        src: ['js/admin.js'],
        dest: 'build/js/admin.js'
      },
      css: {
        src: ['node_modules/font-awesome/css/font-awesome.css', 'build/css/build.css'],
        dest: 'build/css/build.css'
      },
    },
    copy : {
      main: {
        files: [{
          expand: true,
          src: ['node_modules/font-awesome/fonts/*'],
          dest: 'build/fonts',
          flatten: true,
        }],
      },
    },
    uglify : {
      build : {
        files: {
          'build/js/build.js' : ['build/js/build.js'],
          'build/js/admin.js' : ['build/js/admin.js'],
          'build/js/exec.js' : ['build/js/exec.js']
        }
      }
    },
    cssmin : {
      build: {
        files: [{
          expand: true,
          cwd: 'build/css',
          src: ['*.css', '!*.min.css'],
          dest: 'build/css',
          ext: '.css'
        }]
      }
    },
    watch: {
      sass: {
        files: ['sass/**/*.scss'],
        tasks: ['sass', 'concat:css'],
        options: {
          livereload : 35729
        },
      },
      js: {
        files: ['js/**/*.js'],
        tasks: ['concat:buildjs', 'concat:adminjs', 'concat:execjs'],
        options: {
          livereload : 35729
        },
      },
      php: {
        files: ['**/*.php'],
        options: {
          livereload : 35729
        },
      },
      options: {
        style: 'expanded',
        compass: true,
      },
    },
  });

  
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('default', ['sass', 'concat', 'copy', 'watch']);
  grunt.registerTask('slim', ['sass', 'concat', 'copy', 'cssmin', 'uglify']);

};