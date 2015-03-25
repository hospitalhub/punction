'use strict';
module.exports = function(grunt) {
  grunt.loadNpmTasks('grunt-npm-install');
  require('load-grunt-tasks')(grunt);
  require('time-grunt')(grunt);

  var jsFileList = [
    './src/js/punction*.js'
  ];

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    jshint: {
      all: [
        './src/js/punction*.js'
      ]
    },
    less: {
      dev: {
        files: {
          'assets/css/main.css': [
            'assets/less/main.less'
          ]
        },
        options: {
          compress: false,
          sourceMap: true,
          sourceMapFilename: 'assets/css/main.css.map',
          sourceMapRootpath: '/app/themes/roots/'
        }
      },
      build: {
        files: {
          'assets/css/main.min.css': [
            'assets/less/main.less'
          ]
        },
        options: {
          compress: true
        }
      }
    },
    concat: {
      options: {
        separator: ';',
      },
      dist: {
        src: [jsFileList],
        dest: './js/scripts.js',
      },
    },
    uglify: {
      dist: {
        files: {
          './js/punction.min.js': [jsFileList]
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
      },
      dev: {
        options: {
          map: 'assets/css/'
        },
        src: 'assets/css/main.css'
      },
      build: {
        src: 'assets/css/main.min.css'
      }
    },
    version: {
      default: {
        options: {
          format: true,
          length: 32,
          manifest: 'assets/manifest.json',
          querystring: {
            style: 'roots_css',
            script: 'roots_js'
          }
        },
        files: {
          'lib/scripts.php': 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      }
    },
    watch: {
      less: {
        files: [
          'assets/less/*.less',
          'assets/less/**/*.less'
        ],
        tasks: ['less:dev', 'autoprefixer:dev']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'concat']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: false
        },
        files: [
          'src/css/**/*.css',
          'src/js/*.js',
          'php/*.php',
          '*.php'
        ]
      }
    }
  });
  
  // Register tasks
  grunt.registerTask('default', [
    'build'
  ]);
  grunt.registerTask('dev', [
    'curl',
    'jshint',
    'less:build',
    'autoprefixer:build',
  ]),
  grunt.registerTask('build', [
    'uglify'
  ]);
  

};
