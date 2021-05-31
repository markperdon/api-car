# api-car
 cartrack exam
https://documenter.getpostman.com/view/15713926/TzXzCwiD



#API DOCUMENTATION

POST CREATE
localhost/api-car/api/create

BODY raw
{
    "name":"ford",
    "car_type" : "sedan",
    "car_model" : "ford focus"
}

GET READ
localhost/api-car/api/read

GET READ SINGLE
localhost/api-car/api/update?id=7

PARAMS
id 7


PUT UPDATE
localhost/api-car/api/update?id=8

HEADERS
Content-Type
application/json

PARAMS
id 7
BODY raw
{
    "name":"ford",
    "car_type" : "sedan",
    "car_model" : "ford focus",
    "id" : "7"
}


DEL DELETE
localhost/api-car/api/delete?id=8
HEADERS
Content-Type
application/json
PARAMS
id 8
BODY raw
{
    "id" : "8"
}   