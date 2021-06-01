# api-car
 cartrack exam
https://documenter.getpostman.com/view/15713926/TzXzCwiD


***Software Used:***
### [Link](https://www.apachefriends.org/download.html) xampp-windows-x64-7.4.12-0-VC15-installer.exe ###

### [Link](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads) postgresql-13.3-2-windows-x64.exe    ###

### [Link](https://www.postman.com/downloads/) postman 64bit    ###

# INSTALLATION #
```
git clone https://github.com/markperdon/api-car.git
```
or copy to C:\xampp\htdocs

### Enable extension pgsql ###
![S1](/assets/img/ss1.png)
![S2](/assets/img/ss2.png)


## CAR API DOCUMENTATION ##

POST CREATE
```javascript
localhost/api-car/api/cars/create
```
BODY raw
```javascript
{
    "car_name": "Lamborghini",
    "car_type": "sports car",
    "car_model": "huracan"
}
```
![S3](/assets/img/ss3.PNG)
GET READ
```javascript
localhost/api-car/api/cars/read
```
![S4](/assets/img/ss4.PNG)

GET READ SINGLE
```javascript
localhost/api-car/api/cars/read-single?id=7
```
PARAMS
id 7
![S4](/assets/img/ss4_1.PNG)


PUT UPDATE
```javascript
localhost/api-car/api/cars/update?id=8
```
HEADERS
Content-Type
application/json
```
PARAMS
id 7
```
BODY raw
```javascript
{
    "car_name":"lamborghini",
    "car_type" : "sports car",
    "car_model" : "aventador",
    "car_id" : "1"
}
```
![S5](/assets/img/ss5.PNG)

DEL DELETE
```javascript
localhost/api-car/api/cars/delete?car_id=8
```
```HEADERS
Content-Type
application/json
```
```PARAMS
car_id 8
```
BODY raw
```javascript
{
    "car_id" : "8"
}   
```
![S6](/assets/img/ss6.PNG)

GETSEARCH
```
localhost/api-car/api/cars/search?car_name=lambo
```
```PARAMS
car_name "lambo"
```
![S7](/assets/img/ss7.PNG)