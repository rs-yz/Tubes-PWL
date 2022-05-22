# Undangan

# Table of Contents

## How to Install

## API Documentations
Version: 0.1
* User Object: <user>
```
{
    name: str
    email: str
    password: str
    role: int | default: 2 (optional)
}
```

* Invitation Object: <invitation>
```
{
  id: uint
  ref: str
  bride_name: str
  bride_nickname: str
  bride_father: str
  bride_mother: str
  bride_child_nth: uint
  bride_photo_url: str
  groom_name: str
  groom_nickname: str
  groom_father: str
  groom_mother: str
  groom_child_nth: uint
  groom_photo_url: str
  thumbnail_url: str
  quote: str
  main_event_datetime: datetime
  main_event_location: str
  bride_first: bool | default: true # bride_name & groom_name
  is_release: bool | default: false
}
```


* Invitation Detail Object: <invitation_detail>
```
{
    cover.event.title: str
    cover.event.couple_name: str {bride_nickname & groom_nickname}
    cover.event.date: datetime
    quote: str
    couple.groom.name: str
    couple.groom.child_nth: int
    couple.groom.parents.name: str {bpknya terus ibunya}
    couple.bride.name: str
    couple.bride.child_nth: int
    couple.bride.parents.name: str {bpknya terus ibunya}
    events.main.datetime: datetime
    events.main.location: str
    events: [<event>]
}
```

* Event <event>
```
{
    id: str
    title: str
    datetime: datetime
    location: str
}
```

* Expression: <expression>
```
{
  id: uint
  name: str
  address: str
  words: str  
}
```


* Theme Object: <theme>
```
{
  id: uint
  name: str
  thumbnail: str
  code: str
}
```

# User
**POST /register**
----
    Create an user
* **URL Params**  
  None
* **Request Body**  
  ```
    {
        <user>
    }
  ```
* **Headers**  
  Content-Type: application/json
* **Success Response:**  
  * **Code:** 201  
  **Content:**  
    ```
    {
        token: str
        message: str
    }
    ```


**POST /login**
----
    Authenticated an user
* **URL Params**  
  None
* **Request Body**  
  ```
    {
        email: str
        password: str
    }
  ```
* **Headers**  
  Content-Type: application/json
* **Success Response:**  
  * **Code:** 201  
  **Content:**  
    ```
    {
        token: str
        message: str
    }
    ```


# Invitation
**GET /invitations**
----
  Returns all invitations in the system.
* **URL Params**  
  None
* **Request Body**  
  None  
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:**  
  * **Code:** 200  
  **Content:**  
    ```
    {
    invitations: [
            {<invitation>},
            {<invitation>},
            {<invitation>}
            ]
    }
    ```

**POST /invitations**
----
  Create an invitation to the system.
* **URL Params**  
  None
* **Request Body**  
  ```
    {
        <invitation>
    }
  ```
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:**  
  * **Code:** 201  
  **Content:**  
    ```
    {
        message: str
    }
    ```

**GET /invitations/:ref**
----
  Returns the specified invitations.
* **URL Params**  
  *Required:* `ref=[str]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:** 
  * **Code:** 200  
    **Content:**  
    ```
    { 
        "theme": <theme>,
        "invitation": <invitation_detail>
    } 
    ```
  * **Error Response:**  
    * **Code:** 404 Not Found  
    **Content:** `{ error : "Invitation doesn't exist" }`  
    OR  
    * **Code:** 401 Unauthorized   
    **Content:** `{ error : "You are unauthorized to make this request." }`


**GET /invitations/me**
----
  Returns all Invitations associated with the specified user.
* **URL Params**  
  None
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:**  
  * **Code:** 200  
    **Content:**  
    ```
    {
        invitations: [
                {<invitations_object>},
                {<invitations_object>},
                {<invitations_object>}
            ]
    }
    ```
  * **Error Response:**  
    * **Code:** 401  
    **Content:** `{ error : error : "You are unauthorized to make this request." }`

**PATCH /invitations/:ref**
----
  Updates fields on the specified invitation and returns the updated object.
* **URL Params**  
  *Required:* `ref=[str]`
* **Request Body**  
    ```
    {
        partial or full field of <invitation>
    }
    ```
* **Headers**  
  Content-Type: application/x-www-form-urlencoded  
  Authorization: Bearer `<Auth Token>`
* **Success Response:** 
* **Code:** 200  
  **Content:**  `{ <invitation> }`  
* **Error Response:**  
  * **Code:** 404  
  **Content:** `{ error : "Invitation doesn't exist" }`  
  OR  
  * **Code:** 401  
  **Content:** `{ error : error : "You are unauthorized to make this request." }`

**DELETE /invitations/:ref**
----
  Deletes the specified invitation.
* **URL Params**  
  *Required:* `ref=[str]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:** 
  * **Code:** 204 
* **Error Response:**  
  * **Code:** 404  
  **Content:** `{ error : "Invitation doesn't exist" }`  
  OR  
  * **Code:** 401  
  **Content:** `{ error : error : "You are unauthorized to make this request." }`

# Expressions
**GET /invitations/:ref/expressions**
----
  Returns all expressions from specified invitation.
* **URL Params**  
  *Required:* `ref=[str]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
* **Success Response:** 
  * **Code:** 200  
    **Content:**  
    ```
    { 
        "expressions": [
            <expression>,
            <expression>,
            ...
        ]
    } 
    ```
  * **Error Response:**  
    * **Code:** 404 Not Found  
    **Content:** `{ error : "Invitation doesn't exist" }`  
    OR  
    * **Code:** 401 Unauthorized   
    **Content:** `{ error : "You are unauthorized to make this request." }`


**GET /expressions**
----
  Returns all expressions (for admin).
* **URL Params**  
  None
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:** 
  * **Code:** 200  
    **Content:**  
    ```
    { 
        "expressions": [
            <expression>,
            <expression>,
            ...
        ]
    } 
    ```
  * **Error Response:**  
    * **Code:** 404 Not Found  
    **Content:** `{ error : "Invitation doesn't exist" }`  
    OR  
    * **Code:** 401 Unauthorized   
    **Content:** `{ error : "You are unauthorized to make this request." }`


**POST /invitations/:ref/expressions**
----
  Create an expression on the specified invitation.
* **URL Params**  
  *Required:* `ref=[str]`
* **Request Body**  
  ```
    {
        name: str
        words: str
        address: str (optional)
    }
  ```
* **Headers**  
  Content-Type: application/json  
* **Success Response:** 
  * **Code:** 200  
    **Content:**  
    ```
    { 
        message: str
    } 
    ```

**DELETE /expressions/:id**
----
  Delete expression
* **URL Params**  
  *Required:* `id=[int]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
* **Success Response:** 
  * **Code:** 204


# Theme
**GET /themes**
----
  Returns all themes in the system.
* **URL Params**  
  None
* **Request Body**  
  None  
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:**  
  * **Code:** 200  
  **Content:**  
    ```
    {
    themes: [
            {<theme>},
            {<theme>},
            {<theme>}
            ]
    }
    ```

**POST /themes**
----
  Create an theme to the system.
* **URL Params**  
  None
* **Request Body**  
  ```
    {
        <theme>
    }
  ```
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:**  
  * **Code:** 201  
  **Content:**  
    ```
    {
        message: str
    }
    ```

**GET /themes/:id**
----
  Returns the specified themes.
* **URL Params**  
  *Required:* `id=[int]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:** 
  * **Code:** 200  
    **Content:**  
    ```
    { 
        <theme>
    } 
    ```
  * **Error Response:**  
    * **Code:** 404 Not Found  
    **Content:** `{ error : "theme doesn't exist" }`  
    OR  
    * **Code:** 401 Unauthorized   
    **Content:** `{ error : "You are unauthorized to make this request." }`

**PATCH /themes/:id**
----
  Updates fields on the specified theme and returns the updated object.
* **URL Params**  
  *Required:* `id=[str]`
* **Request Body**  
    ```
    {
        partial or full field of <theme>
    }
    ```
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:** 
* **Code:** 200  
  **Content:**  `{ <theme> }`  
* **Error Response:**  
  * **Code:** 404  
  **Content:** `{ error : "theme doesn't exist" }`  
  OR  
  * **Code:** 401  
  **Content:** `{ error : "You are unauthorized to make this request." }`

**DELETE /themes/:id**
----
  Deletes the specified theme.
* **URL Params**  
  *Required:* `id=[int]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:** 
  * **Code:** 204 
* **Error Response:**  
  * **Code:** 404  
  **Content:** `{ error : "User doesn't exist" }`  
  OR  
  * **Code:** 401  
  **Content:** `{ error : "You are unauthorized to make this request." }`

# Events
**GET /invitations/:ref/events**
----
  Returns all events from specified invitation.
* **URL Params**  
  *Required:* `ref=[str]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
* **Success Response:** 
  * **Code:** 200  
    **Content:**  
    ```
    { 
        "events": [
            <event>,
            <event>,
            ...
        ]
    } 
    ```
  * **Error Response:**  
    * **Code:** 404 Not Found  
    **Content:** `{ error : "Invitation doesn't exist" }`  
    OR  
    * **Code:** 401 Unauthorized   
    **Content:** `{ error : "You are unauthorized to make this request." }`


**GET /events**
----
  Returns all events (for admin).
* **URL Params**  
  None
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Success Response:** 
  * **Code:** 200  
    **Content:**  
    ```
    { 
        "events": [
            <event>,
            <event>,
            ...
        ]
    } 
    ```
  * **Error Response:**  
    * **Code:** 401 Unauthorized   
    **Content:** `{ error : "You are unauthorized to make this request." }`


**POST /invitations/:ref/events**
----
  Create an event on the specified invitation.
* **URL Params**  
  *Required:* `ref=[str]`
* **Request Body**  
  ```
    {
        <event>
    }
  ```
* **Headers**  
  Content-Type: application/json  
* **Success Response:** 
  * **Code:** 200  
    **Content:**  
    ```
    { 
        message: str
    } 
    ```

**PATCH /events/:id**
----
  Updates fields on the specified evnet and returns the updated object.
* **URL Params**  
  *Required:* `id=[int]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
  Authorization: Bearer `<Auth Token>`
* **Request Body**  
    ```
    {
        partial or full field of <evnt>
    }
    ```

**DELETE /events/:id**
----
  Delete event
* **URL Params**  
  *Required:* `id=[int]`
* **Request Body**  
  None
* **Headers**  
  Content-Type: application/json  
* **Success Response:** 
  * **Code:** 204
