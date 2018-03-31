var gulp = require('gulp'),
    Project = require("../settings");


gulp.task('printPaths', function(){
    console.log(Project.rootFolder)  ;
    console.log(Project.projectDir);
    console.log(Project.wpContent) ;
    console.log(Project.themeLocation) ;
    console.log(Project.urlToPreview) ;
    console.log(Project.cssLocation);
    console.log(Project.styleModules  );
    console.log(Project.baseStyles   );
    console.log(Project.images  );
    console.log(Project.icons );
    console.log(Project.finalStyleSheet);
});
