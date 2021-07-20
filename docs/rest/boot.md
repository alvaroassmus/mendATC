[Go Back](https://github.com/alvaroassmus/mendATC#readme)

**Boot**
----
Starts the ATC system.

* **URL**

  /boot

* **Method:**

  `POST`

*  **URL Params**

   None

* **Data Params**

  None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:** `{ data : on, msg : "SYSTEM BOOTED CORRECTLY" }`

* **Error Response:**

  None
  
    * **Code:** 404 NOT FOUND <br />
      **Content:** `{ error : "User doesn't exist" }`

  OR

    * **Code:** 401 UNAUTHORIZED <br />
      **Content:** `{ error : "You are unauthorized to make this request." }`

* **Sample Call:**

  ```javascript
    $.ajax({
        url: "/boot",
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
