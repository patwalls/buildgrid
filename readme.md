# BuildGrid

## Setup

### Prerequisites

#### node and npm

Make sure you are using these minimum required versions:
* node v4.2.4
* npm v3.5.3

You can install and use the package "n" (doesn't work on windows) to quickly install the required versions as follows:

```
$ sudo install -g n
$ sudo n 4.2.4
$ sudo npm install -g npm@3.5.3
```
#### Composer

Get it from [https://getcomposer.org/](https://getcomposer.org/)

#### Redis
We are using redis as a queue manager and for allow workers to do processing tasks in the background.

Check [redis.io](redis.io) for instructions on how to install it.

### Composer modules used in this project

#### Required

* "php": ">=5.5.9",
* "laravel/framework": "v5.2.12",
* "laravel/socialite": "v2.0.14", *Social account integration*
* "anahkiasen/underscore-php": "2.0.0", *Utilities to manipulate arrays, collections and objects*
* "cviebrock/eloquent-sluggable": "3.1.3", *Allows to asign a slug to refer an entity*
* "graham-campbell/exceptions": "v8.3.1", *Better display of exceptions in Laravel*
* "graham-campbell/flysystem": "v3.3.0", *File systems abstraction*
* "guzzlehttp/guzzle": "6.1.1", *HTTP Client*
* "intervention/image": "2.3.5", *Image manipulation library*
* "ipunkt/laravel-analytics": "1.1.4", *Google Analytics Integration*
* "jenssegers/rollbar": "v1.4.6", *Rollbar logging capabilites*
* "jenssegers/date": "v3.1.0", *Date manipulation library*
* "laracasts/presenter": "0.2.1", *Presenter helper to prepare data for views*
* "laravelbook/ardent": "v3.3.0", *Self validating Laravel models*
* "league/flysystem-aws-s3-v3": "1.0.9", *Flysystem AWS s3 adaptor*
* "league/flysystem-dropbox": "1.0.1", *Flysytem Dropbox adaptor*
* "slynova/laravel-commentable": "v2.0.0", *Nested sets threaded comments provider*
* "spatie/laravel-glide": "2.2.8", *On demand image manipulation*
* "mathiasgrimm/laravel-dot-env-gen": "dev-master"	 *.env file checker*

#### Required only during development
* "barryvdh/laravel-ide-helper": "v2.1.2", *Generates a file that is readed by IDE to assist in code intelligence and autocompletion*
* "barryvdh/laravel-debugbar": "v2.1.1", *Laravel debug bar integration*
* "filp/whoops": "2.0.0", *Error display page for use in exceptions*
* "flynsarmy/csv-seeder": "v1.0.6", *Allows seeders to use a csv file*
* "fzaninotto/faker": "v1.5.0", *Fakes models (entities) used by seeders mostly*
* "hamcrest/hamcrest-php": "v1.2.2", *Assertions library*
* "laracasts/generators": "1.1.3", *Easy generation of model, controllers, migrations, seeders and pivot tables*
* "mockery/mockery": "0.9.4", *Mocks objects during testing*
* "phpunit/phpunit": "4.8.21", *The Php unit test framework*
* "phpspec/phpspec": "2.4.1", *The Php Specification Driven Development tool *
* "sensiolabs/security-checker": "^3.0", *Tool to check application packages for known vulnerabilities*
* "symfony/css-selector": "v3.0.1", *Provides an alternative to using Xpath to select elements while parsing HTML/MXL files. Used for testing*
* "symfony/dom-crawler": "v3.0.1" *The DomCrawler component eases DOM navigation for HTML and XML documents. Used for testing.*

### Node (npm) modules used in this project

We are using npm as the only package manager in this project as most used and battle-tested CSS frameworks and JS libraries have a package in the npmjs.org repos.

#### Dev Dependencies
*"gulp": "^3.8.8"  *Js build system*
#### Dependencies
"bootstrap-sass": "^3.0.0", *Twitter Bootstrap CSS framework SASS version*
"bourbon": "^4.2.6", *Toughtbot SASS framework*
"bourbon-neat": "^1.7.2", *Toughtbot SASS grid framework*
"colors": "^1.1.2", *Provides colored output in terminal for Js scripts*
"dropzone": "^4.2.0", *Js plugin to allow file drag and drop uploads*
"jquery": "^2.2.0", *The jQuery Js client side framework*
"jquery-modal": "^0.6.1", *A jQuery basic and very customizable modal plugin*
"jquery-router-plugin": "^1.0.0", *a jQuery basic router*
"jscroll": "^2.3.2", *Js infinite scroll plugin*
"laravel-elixir": "^4.0.0", *The Laravel elixir toolbelt to ease the use of gulp tasks*
"toastr": "^2.1.2" *A toast notifications plugin (growl like)*
"cropit": "~0.5.1" *A "customizable crop and zoom" jQuery plugin*

### Configuring the development environment

 1. Clone the repository
 2. npm install
 3. composer install
 4. populate .env file with the required values
 5. run gulp to compile SASS and JS files
 6. test the site

#### Basic .env file

```
APP_DEBUG=true
APP_ENV=local
APP_KEY=(Use php artisan key:generate to generate a valid key)
APP_LOG=daily

CACHE_DRIVER=file

DB_DATABASE=
DB_HOST=
DB_PASSWORD=
DB_PORT=
DB_USERNAME=

MAIL_DRIVER=
MAIL_ENCRYPTION=
MAIL_HOST=
MAIL_PASSWORD=
MAIL_PORT=
MAIL_USERNAME=

QUEUE_DRIVER=sync

REDIS_HOST=localhost
REDIS_PASSWORD=null
REDIS_PORT=6379

SESSION_DRIVER=file

DROPBOX_TOKEN=
DROPBOX_SECRET=


LINKEDIN_CLIENT_ID=
LINKEDIN_SECRET=
LINKEDIN_URL_CALLBACK=

GOOGLE_CLIENT_ID=
GOOGLE_SECRET=
GOOGLE_URL_CALLBACK=

DOCUMENTS_STORAGE=local
PICTURES_PROFILE_STORAGE=local

```
You can also use the command `php artisan env:gen` to check your current .env values against the ones used in the code, this command also generates a template which you can copy to a new .env file. If you do this be careful as not every value is needed *hint: most of the values that have a default are the required ones*

## Development

### Assets folder structure

While working with Javascript or SASS files be sure to only work on the following directories:

`resources/assets/js` and `resources/assets/sass`

#### SASS

The main file is `app.scss` which includes the `_index.scss` file of each of the following folders:
```
base/         ->   Basic definitions and overrides
components/   ->   Buttons, typography, icons
layout/       ->   Containers, columns, sections, navigation, etc...
partials/     ->   Site section especific styles
```

#### Javascript

The main file is `app.js` which includes the `config.js` and the `router.js` file and its used for an entry point for [browserify](http://browserify.org/) compilation.

You can add sitewide functionality by calling a module directly in app.js or add a route in the router.js file and trigger your methods only when the url is matched. This allows for better code separation, reuse and modularization as the team gets used to modularization, callbacks, browserify, and transitions to a more robust framework (ie. AngularJS, VueJS) and sets its standards and workflow.

All of the new modules must live within the `modules/` folder and be required as needed by `app.js` or preferably in the router. You can leverage that we are using Browserify and require other modules in yours.

When creating a new module wrap you code as follows:
```
module.exports = () => {

    console.log("Code goes here");
    
}
```
and you can trigger your module's function on load with:

`require("./modules/mymodule")()`

or if you want to package several functions in one module
```
module.exports = {

	myFunction: () => {
		console.log('This is a test');
	}

	anotherFunction: () => {
		console.log('This is another function');
	}
	
}
```
and use the functions contained on it with:

```
var modx = require("./modules/toolbelt");

toolbelt.batarangThrow('joker');  // batarangThrow is a function in the toolbelt module.

```
*You may notice that we are using arrow `=>` functions, more on that on the next section.*

The `config.js` file contains global variables for the sitewide used modules and plugins. Also contains some options definitions and overrides for the plugins that accept those.


### ES6

With elixir.browserify we call also babel wich allows us to use ES6 features on the current generation of browsers. Some of the features we can leverage are:

* Arrow functions: Provide a more concise syntax for expressing anonymous functions. They implicitly return their value and inherit this from the parent scope.
* Looping with for and of (and iterators)
* Template strings: Provide straightforward support for string interpolation. Anywhere inside of a template string, you can include an arbitrary JavaScript expression inside of a ${} wrapper. The runtime will evaluate the expressions and include their output within the string at the designated position. 
* And lots of nice things. Read more about it on [babeljs.io](https://babeljs.io/)

### The jquery-router-plugin

This little jQuery plugin is useful defining route based behavior and allow for better code plannin, reusing and modularization of code.

If you need certain code to be triggered, for example, when a user visits the `/about` page you can easily add a route and add the necessary code and/or modules to provide the required functionality:
```
$.router.add("/about", () => {

    toastr.success('Hello, this is our about page!');

} );
```
*Note: On this example we are using the toastr plugin module that has been loaded into a global variable in the config.js file and thus we are not explicitly requiring it.*

The router also accepts route paremeters as follows:
```
// Adds a route for /items/:item and calls the callback when matched

$.router.add(/items/:item", (data) => {

    console.log(data.item);
    
});
```

### gulp and elixir


### Using `gulp watch`

Invoking `gulp watch` on the command line on the project folder will monitor file changes and recompile files as necessary without having to run gulp every time you made changes to the code.

Once you feel confortable with this you can even consider start using [BrowserSync](https://www.browsersync.io/) with elixir to automatically refresh the browser on file changes. 

### Including new JS plugins

Browse an search the npmjs.org site to locate the plugin and add it to the package.json file with the following command.

```
npm install my-plugin --save
```

If you also want it to be globally available add it to a global variable in the config.js file if you do not do this you will need to require the plugin's module on yours.


### Adding images required by plugins or stylesheets

Most plugins or stylesheets will look for images in one of the following folders:

* images/
* img/
* imgs/

Just add the required images and folder under the `public/` folder so they are found and dispatched by the webserver as needed.

### Useful artisan commands

`php artisan env:gen`
Generates a template .env.gen file with keys expected to be in the .env file
