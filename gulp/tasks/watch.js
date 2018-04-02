var gulp = require('gulp'),
    watch = require('gulp-watch'),
    browserSync = require('browser-sync').create(),
    settings = require('../settings');
    
gulp.task('watch', function() {
   
   browserSync.init({
//      server: {
 //     baseDir: "cms"
  //    },
      proxy: "localhost/cms"


   });

  watch(['*.php', '*/*.php', '*/*/*.php'], function() {
    browserSync.reload();
  });

}); 
