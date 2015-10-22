#Blank

>A blank WordPress theme

##Requirements
Node.js  

##Installation

###Step 1: Clone blank repository
git clone https://github.com/no5aj/blank.git `<your-project-name>`

###Step 2: Clone WordPress repository
cd `<your-project-name>`  
git submodule init  
git submodule update

###Step 3: Checkout required version of WordPress
cd wordpress  
git checkout 3.8.1  
cd ..

###Step 4: Install Node packages
cd wp-content/themes/blank  
npm install

##Reference
[http://davidwinter.me/articles/2012/04/09/install-and-manage-wordpress-with-git/](http://davidwinter.me/articles/2012/04/09/install-and-manage-wordpress-with-git/)  