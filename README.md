# api-car
 cartrack exam
https://documenter.getpostman.com/view/15713926/TzXzCwiD


***Software Used:***
### [Link](https://www.apachefriends.org/download.html) xampp-windows-x64-7.4.12-0-VC15-installer.exe ###

### [Link](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads) postgresql-13.3-2-windows-x64.exe    ###

#INSTALLATION
```
git clone https://github.com/markperdon/api-car.git
```
or copy to C:\xampp\htdocs

### Enable extension pgsql ###
![S1](/assets/img/ss1.png)
![S2](/assets/img/ss2.png)


# API DOCUMENTATION #

POST CREATE
```javascript
localhost/api-car/api/create
```
BODY raw
```javascript
{
    "name":"ford",
    "car_type" : "sedan",
    "car_model" : "ford focus"
}
```
GET READ
```javascript
localhost/api-car/api/read
```
GET READ SINGLE
```javascript
localhost/api-car/api/update?id=7
```
PARAMS
id 7


PUT UPDATE
```javascript
localhost/api-car/api/update?id=8
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
    "name":"ford",
    "car_type" : "sedan",
    "car_model" : "ford focus",
    "id" : "7"
}
```

DEL DELETE
```javascript
localhost/api-car/api/delete?id=8
```
```HEADERS
Content-Type
application/json
```
```PARAMS
id 8
```
BODY raw
```javascript
{
    "id" : "8"
}   
```