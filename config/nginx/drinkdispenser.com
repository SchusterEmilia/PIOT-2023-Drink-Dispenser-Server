server {
    listen 80;

    server_name drinkdispenser.com;

    root /code/public/;

    access_log /code/logs/nginx.access.log;
    error_log /code/logs/nginx.error.log notice;

    set $fastcgi_socket 'unix:/run/php8.2-fpm.sock';

    include /code/config/nginx/rewrite-rules.conf;
}