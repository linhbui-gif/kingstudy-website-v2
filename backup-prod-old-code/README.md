# king-study Setup Step

1, Cài đặt laragon

2, Sử dụng php 7.4.33

3, Composer install

# Cài đặt jwt auth token
1, composer require tymon/jwt-auth:"dev-develop"

2, Chạy composer dump-autoload để load được trait class define

3, php artisan jwt:secret

# Update database 
# 15/05/2024
1, ALTER TABLE `majors` ADD `icon_name` VARCHAR(255) NULL DEFAULT NULL COMMENT 'tên icon ' AFTER `name`; 
2, php artisan migrate --path=/database/migrations/2024_07_04_164530_add_video_url_to_school_table.php
3, php artisan migrate --path=/database/migrations/2024_07_22_171637_add_price_to_school_table.php

# Update sync CRM 
1, Allow login by phone | create crm lead after create user successfully : https://gitlab.com/linhbq68/king-study/-/commit/a608f1065318898772b730bde13b132552449d34
