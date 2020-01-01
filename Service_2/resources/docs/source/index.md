---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Login the student .

> Example request:

```bash
curl -X POST \
    "http://localhost/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"Habi1@esi.dz.com","password":"dalzkjlk"}'

```

```javascript
const url = new URL(
    "http://localhost/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "Habi1@esi.dz.com",
    "password": "dalzkjlk"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Wrong email or password"
}
```

### HTTP Request
`POST api/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of the admin.
        `password` | string |  required  | The password name of the admin.
    
<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_3c538401dbd9e9bac317e4440ae9f3e6 -->
## Display the specified student.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/show/1 " \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/show/1 "
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "data": {
        "id": 1,
        "first_name": "Mohamed",
        "last_name": "Habi",
        "adress": "Setif",
        "birth_place": "Setif",
        "birth_day": "1999-12-11",
        "level": "1CS",
        "email": "Habi1@esi.dz"
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "student not found"
}
```

### HTTP Request
`GET api/show/{id} `


<!-- END_3c538401dbd9e9bac317e4440ae9f3e6 -->


