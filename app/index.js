'use strict';

var chalk = require('chalk');
var yeoman = require('yeoman-generator');

var MgoGenerator = module.exports = yeoman.generators.Base.extend({

  init: function() {

    this.pkg = require('../package.json');

    var yaya = chalk.yellow.bold([
        "       _----------_       ",
        "     /              \\     ",
        "    |                |    .----------------------------.",
        "    |     o    o     |    | Remember the running of us |",
        "    |     ______     |    |   under the setting sun,   |",
        "   /     |      |     \\   |    it\'s our lost youth    |",
        "  |__     \\    /     __|  \'____________________________\'",
        "    |      \\__/      |    ",
        "    |      ____      |    ",
        "    |    /      \\    |    ",
        "    '---'        '---'    ",
    ].join('\n'));

    this.log(yaya);

    // default
    this.params = {
       'name': ''
      ,'path': ''
      ,'desc': 'mogu module'
      ,'repo': 'http://gitlab.mogujie.org'
      ,'type': 'default'
      ,'author': 'mogu f2e'
      ,'version': '1.0.0'
      ,'sizetype': '1200&960'
    };

    //yo mgo name:$2 path:$3 desc:$4 repo:$5 type:$6 sizetype:$7 author:$8
    var args = Array.prototype.slice.call(arguments);

    for (var i = 0, len = args.length; i < len; i++) {

      var k = args[i].substr(0, args[i].indexOf(':'))
      var v = args[i].substr(args[i].indexOf(':') + 1)

      if (this.params[k] !== undefined) {
        this.params[k] = v;
      }
    }

    this.prefix = this.params['path'] ? this.params['path'] + '/' : '';

    this.on('end', function() {
      this.log('\nRunning ' + chalk.yellow.bold('npm install & bo install') + ' for you to install the required dependencies\n');

      process.chdir(this.prefix + this.name.replace(/\s/img, '_'));

      this.runInstall('npm');
      this.runInstall('bo');
    });
  },

  askFor: function() {
    var copyValue = function(that, props) {
      that.name = props.name;
      that.desc = props.desc;
      that.repo = props.repo;
      that.type = props.type;
      that.author = props.author;
      that.version = props.version;
      that.sizetype = props.sizetype;

      var today = new Date;
      that.time = [
        today.getFullYear(),
        today.getMonth() + 1 <= 9 ? '0' + (today.getMonth() + 1) : today.getDate(),
        today.getDate() + 1
      ].join('-');
    };

    if (!this.params.name) {
      var cb = this.async();

      var prompts = [{
        name: 'name',
        message: 'Enter the name of your cute module:',
        default: 'foo'
      }, {
        type: 'list',
        name: 'type',
        message: 'What\'s type do you want to choices:',
        choices: [
          'default',
          'ushop',
          'empty',
          'cps'
        ],
        default: this.params.type
      }, {
        type: 'list',
        name: 'sizetype',
        message: 'What\'s sizetype do you want to choices:',
        choices: [
          '1200&960',
          '1200',
          '960'
        ],
        default: this.params.sizetype
      }, {
        name: 'version',
        message: 'Enter the version of your cute module:',
        default: this.params.version
      }, {
        name: 'desc',
        message: 'Enter the description of your cute module:',
        default: this.params.desc
      }, {
        name: 'repo',
        message: 'Enter the repository of your cute module:',
        default: this.params.repo
      }, {
        name: 'author',
        message: 'Finally enter the your name ^ ^:',
        default: this.params.author
      }];

      this.prompt(prompts, function(props) {
        copyValue(this, props);
        cb();
      }.bind(this));
    } else {
      copyValue(this, this.params);
    }
  },

  app: function() {
    var mpath = this.prefix + this.name.replace(/\s/img, '_');

    this.mkdir(mpath);

    switch(this.type) {
      case 'ushop':
        this.template('tpl/ushop/index.php', mpath + '/index.php');
        break;

      case 'empty':
        this.template('tpl/empty/index.php', mpath + '/index.php');
        break;

      case 'cps':
        this.template('tpl/cps/index.php', mpath + '/index.php');
        break;

      default:
        this.template('tpl/default/index.php', mpath + '/index.php');
        break;
    }

    this.template('content.php', mpath + '/content.php');
    this.template('index.less', mpath + '/index.less');
    this.template('index.js', mpath + '/index.js');
    this.template('README.md', mpath + '/README.md');
    this.template('data.php', mpath + '/data.php');
  },

  projectfiles: function() {
    var mpath = this.prefix + this.name.replace(/\s/img, '_');

    this.template('_package.json', mpath + '/package.json');
    this.copy('_bo.json', mpath + '/bo.json');
    this.copy('_Gruntfile.js', mpath + '/Gruntfile.js');
    // this.copy('_.gitignore', mpath + '/.gitignore');
  }

});
