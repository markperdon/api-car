# api-car
 cartrack exam
https://documenter.getpostman.com/view/15713926/TzXzCwiD


***Software Used:***
### [Link](https://www.apachefriends.org/download.html) xampp-windows-x64-7.4.12-0-VC15-installer.exe ###

### [Link](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads) postgresql-13.3-2-windows-x64.exe    ###

# INSTALLATION #
```
git clone https://github.com/markperdon/api-car.git
```
or copy to C:\xampp\htdocs

### Enable extension pgsql ###
![S1](/assets/img/ss1.png)
![S2](/assets/img/ss2.png)


# PRODUCT API DOCUMENTATION #

POST CREATE
```javascript
localhost/api-car/api/products/create
```
BODY raw
```javascript
{
    "product_name":"iphone 5c",
    "product_desc" : "colorful iphope",
    "product_price" : 1400
}
```
GET READ
```javascript
localhost/api-car/api/products/read
```
GET READ SINGLE
```javascript
localhost/api-car/api/products/update?id=7
```
PARAMS
id 7


PUT UPDATE
```javascript
localhost/api-car/api/products/update?id=8
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
    "product_name":"lambo",
    "product_desc" : "sports car",
    "product_price" : 150000,
    "product_sid" : "6"
}
```

DEL DELETE
```javascript
localhost/api-car/api/products/delete?id=8
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
    "product_sid" : "8"
}   
```