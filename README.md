#Blank

>A blank WordPress theme

##Requirements
Node.js
Grunt

##Installation

###Step 1: Clone Blank Repository
git clone https://github.com/no5aj/blank.git <your-project-name>

###Step 2: Clone WordPress Repository
cd <your-project-name>
git submodule init
git submodule update

###Step 3: Checkout Required Version of WordPress
cd wordpress
git checkout 3.8.1
cd ..

###Step 4: Install Grunt Plugins
cd wp-content/themes/blank
npm install

##Reference
http://davidwinter.me/articles/2012/04/09/install-and-manage-wordpress-with-git/
http://mattbanks.me/grunt-wordpress-development-deployments/