# Installation

1. Run:
```
git clone <repository_url>
composer install --no-dev --optimize-autoloader
```

2. Run (MySQL CLI or via phpMyAdmin):
```
CREATE DATABASE video_platform_db;
CREATE USER 'video_platform_app'@'localhost' IDENTIFIED BY 'gn9dQp8fJykQELC8Q';
GRANT ALL PRIVILEGES ON * . * TO 'video_platform_app'@'localhost';
```

3. Run:
```
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console cache:clear
```


# Usage

## API Description

Go to:
```
http://localhost/api
```
## Creating categories
```
curl -X POST "http://localhost/api/categories" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"name\":\"Sport\"}"
curl -X POST "http://localhost/api/categories" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"name\":\"Technology\"}"
curl -X POST "http://localhost/api/categories" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"name\":\"Business\"}"
```
## Creating videos
```
curl -X POST "http://localhost/api/videos" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"title\":\"UEFA Champions League Semifinal\",\"description\":\"Semifinal match\"}"
curl -X POST "http://localhost/api/videos" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"title\":\"UEFA Champions League Final\",\"description\":\"Final match\"}"
curl -X POST "http://localhost/api/videos" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"title\":\"21. Mazurska noc kabaretowa\",\"description\":\"Śmiechom nie było końca\"}"
curl -X POST "http://localhost/api/videos" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"title\":\"Bogowie\",\"description\":\"Polski film biograficzny z 2014 roku w reżyserii Łukasza Palkowskiego, zrealizowany na podstawie scenariusza Krzysztofa Raka. Bohaterem filmu jest Zbigniew Religa, który przeprowadził w 1985 roku pierwszą udaną w Polsce transplantację serca. Film śledzi dokonania Religi w latach 80.\"}"
curl -X POST "http://localhost/api/videos" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"title\":\"Plus minus\",\"description\":\"Magazyn ekonomiczny\"}"
```
## Assigning videos to categories
```
curl -X PATCH "http://localhost/api/videos/1" -H "accept: application/json" -H "Content-Type: application/merge-patch+json" -d "{\"categories\":[\"/api/categories/1\"]}"
curl -X PATCH "http://localhost/api/videos/2" -H "accept: application/json" -H "Content-Type: application/merge-patch+json" -d "{\"categories\":[\"/api/categories/1\"]}"
curl -X PATCH "http://localhost/api/videos/5" -H "accept: application/json" -H "Content-Type: application/merge-patch+json" -d "{\"categories\":[\"/api/categories/3\"]}"
```
## Creating subscription plans (with assigned videos)
```
curl -X POST "http://localhost/api/subscription_plans" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"name\":\"Gold Subscription Plan\",\"durationPeriod\":\"P0Y1M0DT0H0M0S\",\"videos\":[\"/api/videos/1\",\"/api/videos/2\",\"/api/videos/3\",\"/api/videos/4\",\"/api/videos/5\"]}"
curl -X POST "http://localhost/api/subscription_plans" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"name\":\"Cinema Subscription Plan\",\"durationPeriod\":\"P0Y3M0DT0H0M0S\",\"videos\":[\"/api/videos/4\"]}"
```
## Creating users
```
curl -X POST "http://localhost/api/users" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"login\":\"firstUser\",\"email\":\"firstUser@mail.com\"}"
curl -X POST "http://localhost/api/users" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"login\":\"secondUser\",\"email\":\"secondUser@mail.com\"}"
```
## Granting entitlement to a resource
```
curl -X POST "http://localhost/api/user_subscription_plans" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"activeFrom\":\"2020-07-27T15:39:16.981Z\",\"user\":\"/api/users/1\",\"subscriptionPlan\":\"/api/subscription_plans/2\"}"
```

## Checking if a viewer is entitled to watch a video
```
curl -X GET "http://localhost/api/check_entitlement/1/4" -H "accept: application/json"
```