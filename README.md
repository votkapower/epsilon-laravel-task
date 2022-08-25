# Epsilon Php / Laravel task

Using the public API documentation http://demo.infiny.cloud/api-documentation connect to the Infiny API and display a list of “CloudLX” services in an account. It should be possible to navigate through to a new page/view showing the details of the service, to include service name, port name, service status and any other details returned by the API that you think are useful.


## Usage

```php
# after clone, first step is to install composer requirements
composer install

# install NPM requirements
npm install

# Insert client keys in .env at the end 
 #...
 #EPSILON CUSTOM DATA
 EPSILON_CLIENT_ID=lyxosnnGuIpU5wxH6ukIcPuaCOM8WnAcBIL7Ph3g
 EPSILON_CLIENT_SECRET=8wCOsfBvr35qTMcx3dZ9Xz3WCroVWkKMT7lx3oK7
 EPSILON_API_ENDPOINT="https://demo.infiny.cloud"
 EPSILON_DATA_POLL_INTERVAL=60


#create mysql database
CREATE TABLE `epsilon_task`

# migrate database
php artisan migrate

# run seeders
php artisan db:seed

# build js assests (in separate console tab)
npm run dev

# run the laravel server (in separate console tab)
php artisan serv

# login as the only seeded user
email: hello@dimitarpapazov.com
pass: 123123


# After login, Go to the home page
If you dont see any services, click on the button to begin manualy syncing. 
After page refresh there should be your account services.
```

## Changed files
 - `/routes/web.php`
 - `/routes/console.php`
 - `/app/Console/Kernel.php`
 - `/app/config/epsilon.php`
 - `/app/Models/EpsilonAccountService.php`
 - `/app/Models/User.php`
 - `/resources/views/epsilon_credentials.blade.php`
 - `/resources/views/service.blade.php`
 - `/resources/views/dashboard.blade.php`
 - `/resources/views/components/account-service-card.blade.php`

If you have any questions or issues email me at: `hello@dimitarpapazov.com` for support.