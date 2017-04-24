<?php
namespace Deployer;
require 'recipe/laravel.php';

// Server
server('ec2', 'ec2-54-193-39-243.us-west-1.compute.amazonaws.com')
    ->user('ec2-user')
    ->pemFile('AWSInstance.pem')
    ->set('deploy_path', '/var/www/html');



task('deploy:upload', function() {
    $appFiles = [
        'app',
        'bootstrap',
        'config',
        'database',
        'public',
        'resources',
        'routes',
        'storage',
        'tests',
        'vendor',
        '.env',
        'composer.json',
        'composer.lock',
        'artisan',
    ];
    $deployPath = get('deploy_path');
    //$releasePath = get('release_name');

    foreach ($appFiles as $file)
    {
        upload($file, $deployPath.'/release/'.$file);
    }
});


task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:upload',
    //'deploy:update_code',
    //'deploy:shared',
    //'deploy:vendors',
    //'deploy:writable',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:optimize',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);



after('deploy:failed', 'deploy:unlock');



