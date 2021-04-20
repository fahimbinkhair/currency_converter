# currency_converter
This is a small project developped using symfony 4.2 and JQuery to calculate destination amount providing source currency, desctination currency and source amount

# How to install (On Linux)
1) Composer install will install the packages
2) Create the virtual host config file (/etc/apache2/sites-available/sendmoney.zit.conf)
<code>
    <VirtualHost *:80>
        ServerName admin@sendmoney.zit
        ServerAlias sendmoney.zit

        DocumentRoot /project_dir/currency_converter/public
        DirectoryIndex /index.php

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined     

        <Directory /project_dir/currency_converter/public>
      Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Require all granted

            FallbackResource /index.php
        </Directory>

        # uncomment the following lines if you install assets as symlinks
        # or run into problems when compiling LESS/Sass/CoffeeScript assets
        # <Directory /var/www/project>
        #     Options FollowSymlinks
        # </Directory>

        # optionally disable the fallback resource for the asset directories
        # which will allow Apache to return a 404 error when files are
        # not found instead of passing the request to Symfony
        <Directory /project_dir/currency_converter/public/bundles>
            DirectoryIndex disabled
            FallbackResource disabled
        </Directory>
        ErrorLog /var/log/apache2/sendmoney_error.log
        CustomLog /var/log/apache2/sendmoney_access.log combined
    </VirtualHost>
</code>
3) cd into project /project_dir/
4) run bin/console doctrine:migrations:migrate
5) run bin/phpunit to run test
