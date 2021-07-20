[Go Back](https://github.com/alvaroassmus/mendATC#readme)

**List**
----
Loads all the queues of the ATC system.

* **URL**

  /list

* **Method:**

  `POST`

*  **URL Params**

   None

*  **Data Params**

   **Required:**

   `_token: X-CSRF-TOKEN`

* **Success Response:**

    * **Code:** 200 <br />
      **Content:** `{ data : Object { queues }, msg : "The list of queues" }`

* **Error Response:**

    * **Code:** 403 <br />
      **Content:** `{ ERR-MSG : "You must initialize the system before using it. ERR_ATCQ_BAS" }`

* **Sample Call:**

  ```javascript
    $.ajax({
        url: "/list",
        type: 'POST',
        dataType: "json",
        data: {
            _token: "THE_TOKEN"
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
