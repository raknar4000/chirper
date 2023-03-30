<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'hajusrakendused');
set('remote_user', 'virt106863'); //virt...
set('http_user', 'virt106863');
set('keep_releases', 2);

// Hosts
host('ta21lall.itmajakas.ee')
    ->setHostname('ta21lall.itmajakas.ee')
    ->set('http_user', 'virt106863')
    ->set('deploy_path', '~/domeenid/www.ta21lall.itmajakas.ee/hajusrakendused')
    ->set('branch', 'master');

// Tasks
set('repository', 'git@github.com:raknar4000/HAJUS.git');
//Restart opcache
task('opcache:clear', function () {
    run('killall php81-cgi || true');
})->desc('Clear opcache');

task('build:node', function () {
    cd('{{release_path}}');
    run('npm i');
    run('npx vite build');
    run('rm -rf node_modules');
});
task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'build:node',
    'deploy:publish',
    'opcache:clear',
    'artisan:cache:clear'
]);
after('deploy:failed', 'deploy:unlock');
