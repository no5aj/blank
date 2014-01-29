'use strict';
module.exports = function(grunt) {

  // load all grunt tasks matching the `grunt-*` pattern
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({

    watch: {
      styles: {
        files: ['**/*.less'],
        tasks: ['less']
      }
    },

    less: {
      production: {
        options: {
          paths: ['']
        },
        files: {
          'static/css/normalize.css': 'static/css/less/normalize.less'
        }
      }
    }

  });
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('default', ['watch']);
};