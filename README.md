# Получение кадастровых данных

## Setup
```
git clone https://github.com/Nataliya48/yii2-rosreestr.git 
cd yii2-rosreestr
docker-compose up
docker-compose exec frontend composer install
docker-compose run --rm backend php /app/init
edit common/config/main-local.php
docker-compose exec frontend yii migrate
```

## Web:
```
http://127.0.0.1:20080/?r=rosreestr
```
![](https://i.imgur.com/jpyFfnY.png)

## Console:
```
docker-compose exec frontend yii rosreestr "69:27:0000022:1306, 69:27:0000022:1307"
```
![](https://i.imgur.com/DgfJkIb.png)

## REST:
```
POST http://127.0.0.1:20080/?r=rest
Content-Type: application/json
Accept: application/json

{
  "cadastral_numbers": [
    "69:27:0000022:1306",
    "69:27:0000022:1307"
  ]
}
```
![](https://i.imgur.com/uKsFYhe.png)
