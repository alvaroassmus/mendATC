[Go Back](https://github.com/alvaroassmus/mendATC#readme)

**Enqueue**
----
Adds an Aircraft to the queue.

* **URL**

  /enqueue

* **Method:**

  `POST`

*  **URL Params**

   None

* **Data Params**

  **Required:**

  `_token: X-CSRF-TOKEN`

  `['type'] : string`
  
  `['size'] : string`

* **Success Response:**

    * **Code:** 200 <br />
      **Content:** `{ data : Object { aircraft }, msg : "Aircraft added" }`

* **Error Response:**

    * **Code:** 400 <br />
      **Content:** `{ ERR-MSG : "The type is required" }`

      OR

    * **Code:** 400 <br />
      **Content:** `{ ERR-MSG : "The size is required" }`

      OR

    * **Code:** 403 <br />
      **Content:** `{ ERR-MSG : "You must initialize the system before using it. ERR_ATCQ_BAS" }`

* **Type and Size values:**
  
  * **Sizes**
  
    - L : large
    - S : small
    
  * **Types**
  
    - E : emergency
    - V : vip
    - P : people
    - C : cargo

* **Sample Call:**

  ```javascript
    $.ajax({
        url: "/enqueue",
        type: 'POST',
        dataType: "json",
        data: {
            _token: "THE_TOKEN",
            type: 'C',
            size: 'L'
        },
        success: function (data) {
            console.log(1, data);
        },
        error: function (error) {
            console.error(2, error);
        }
    });
  ```
* **THE_TOKEN**

Install Postman Interceptor if not already installed, and turn it on
Then, in your browser log into the site (you need to be authorised), and either inspect element or view source to retrieve the token
In Postman, set GET/POST etc as needed, and in your header create a new pair 

<a href="https://gist.github.com/ethanstenis/3cc78c1d097680ac7ef0" target="_blank">More detailed here</a>

  ```
    X-CSRF-TOKEN        tokenvaluetobeinserted235kwgeiOIulgsk
  ```
