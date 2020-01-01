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

#Admin account management


APIs for managing admin account
<!-- START_a925a8d22b3615f12fca79456d286859 -->
## Login and get a JWT via given credentials.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"mohamed@test.com","password":"dalzkjlk"}'

```

```javascript
const url = new URL(
    "http://localhost/api/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "mohamed@test.com",
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


> Example response (200):

```json
{
    "access_token": "eyJ0eXAiOi",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 1,
        "name": "user1",
        "email": "mohamed@test.com",
        "email_verified_at": null,
        "created_at": "2019-11-27 00:49:25",
        "updated_at": "2019-11-27 00:49:25"
    }
}
```
> Example response (401):

```json
{
    "message": "Wrong email or password"
}
```

### HTTP Request
`POST api/auth/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of the admin.
        `password` | string |  required  | The password name of the admin.
    
<!-- END_a925a8d22b3615f12fca79456d286859 -->

<!-- START_19ff1b6f8ce19d3c444e9b518e8f7160 -->
## api/auth/logout
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost/api/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"lmkfmelzkf"}'

```

```javascript
const url = new URL(
    "http://localhost/api/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "lmkfmelzkf"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Successfully logged out"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`POST api/auth/logout`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | The token of the admin.
    
<!-- END_19ff1b6f8ce19d3c444e9b518e8f7160 -->

#Student management


APIs for managing Student
<!-- START_9f0dcc254d2b0cd7cebe4aa8618cee26 -->
## Display a listing of the students.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/auth/student" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"lmkfmelzkf"}'

```

```javascript
const url = new URL(
    "http://localhost/api/auth/student"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "lmkfmelzkf"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "first_name": "Mohamed",
            "last_name": "Habi",
            "adress": "Setif",
            "birth_place": "Setif",
            "birth_day": "1999-12-11",
            "level": "1CS",
            "email": "Habi1@esi.dz"
        }
    ]
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`GET api/auth/student`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | The token of the admin.
    
<!-- END_9f0dcc254d2b0cd7cebe4aa8618cee26 -->

<!-- START_42ac6d88f335fea584679b667155a9d4 -->
## Store a newly created student in storage.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost/api/auth/student" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"lmkfmelzkf","firt_name":"Mohamed","last_name":"Habi","level":"1cs","birth_place":"Setif","birth_day":"1999-12-11","adress":"Setif"}'

```

```javascript
const url = new URL(
    "http://localhost/api/auth/student"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "lmkfmelzkf",
    "firt_name": "Mohamed",
    "last_name": "Habi",
    "level": "1cs",
    "birth_place": "Setif",
    "birth_day": "1999-12-11",
    "adress": "Setif"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "birth_day": [
            "The birth day field is required."
        ]
    }
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`POST api/auth/student`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | The token of the admin.
        `firt_name` | string |  required  | The firt name of the student.
        `last_name` | string |  required  | The last name of the student.
        `level` | string |  required  | The level of the student.
        `birth_place` | string |  required  | The birth place of the student.
        `birth_day` | date |  required  | The birth day of the student.
        `adress` | string |  required  | The adress of the student.
    
<!-- END_42ac6d88f335fea584679b667155a9d4 -->

<!-- START_e57b99e5a20f664b81ce6870d52b4c00 -->
## Remove the specified student from storage.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/auth/student/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"lmkfmelzkf"}'

```

```javascript
const url = new URL(
    "http://localhost/api/auth/student/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "lmkfmelzkf"
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "message": "student deleted"
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
`DELETE api/auth/student/{student}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | The token of the admin.
    
<!-- END_e57b99e5a20f664b81ce6870d52b4c00 -->


