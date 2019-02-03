var elixir = require('laravel-elixir');



 //npm cache clear --force
 //first install->  npm install -g gulp
 //npm link gulp
 //npm install laravel-elixir


 //to install pyton 
 //Start-Process powershell -Verb runAs
 //npm install --global --production windows-build-tools
 //if we are using xampp shell:
 //powershell -Command "Start-Process powershell \"-ExecutionPolicy Bypass -NoProfile -NoExit -Command `\"cd \`\"%scriptFolderPath%\`\"; & \`\".\%powershellScriptFileName%\`\"`\"\" -Verb RunAs"
 //npm install --global --production windows-build-tools

 // OR
 //first install->  npm install laravel-elixir --save-dev
 //first install->  npm i gulp-sass@latest --save-dev 


//if meeds:
//npm config set proxy null
//npm config set https-proxy null
//npm config set registry http://registry.npmjs.org/

//at the end we have to see "Scripts Merged!"

//ANY TIME WE CHANGE THIS FILE OR SOME OF THE ASSETS FILES WE SHOULD gulp AGAIN. the files should be in this order!!!


elixir(function(mix) {
    mix.sass('app.scss')
        .styles([
                'libs/blog-post.css',
                'libs/bootstrap.css',
                'libs/font-awesome.css',
                'libs/metisMenu.css',
                'libs/sb-admin-2.css'
            ], './public/css/libs.css')
            .scripts([
                'libs/jquery.js',
                'libs/bootstrap.js',
                'libs/metisMenu.js',
                'libs/sb-admin-2.js',
                'libs/scripts.js'
            ], './public/js/libs.js')
});