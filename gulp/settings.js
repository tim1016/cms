var path = require('path');
var projectName = 'cms',
    docRoot = path.resolve(__dirname, '..');

var Project = {
      rootFolder   :   path.resolve(__dirname, '..'),
      projectDir   :   `${docRoot}/${projectName}`,
      wpContent    :   `${docRoot}/${projectName}/wp-content`,
      themeLocation:   `${docRoot}/${projectName}/wp-content/themes/resonance_theme`,
      urlToPreview :   'http://localhost/cms/'
}

Project.cssLocation = `${docRoot}/css`;
Project.scripts = `${docRoot}/js`;
Project.images = `${docRoot}/images`;



module.exports = Project;

