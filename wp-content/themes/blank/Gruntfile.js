'use strict';
module.exports = function(grunt) {

  // load all grunt tasks matching the `grunt-*` pattern
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      styles: {
        files: ['**/*.less'],
        tasks: ['less', 'cssmin']
      },
      scripts: {
        files: ['**/*.js','!**/*min.js'],
        tasks: ['uglify']
      }
    },
    less: {
      development: {
        options: {
          paths: ['']
        },
        files: {
          'static/css/less/normalize.css': 'static/css/less/normalize.less',
          'static/css/less/style.css': 'static/css/less/style.less'
        }
      }
    },
    cssmin: {
      combine: {
        files: {
          'static/css/style.css': ['static/css/less/normalize.css','static/css/less/style.css']
        }
      }
    },
    uglify: {
        options: {
            banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
        },
        development: {
          files: {
            'static/js/modernizr.min.js': ['static/js/modernizr.js'],
            'static/js/functions.min.js': ['static/js/functions.js']
          }
        }
    }

  });
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('default', ['watch']);
};