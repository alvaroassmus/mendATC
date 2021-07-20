[Go Back](https://github.com/alvaroassmus/mendATC#readme)

**Dequeue**
----
Removes an Aircraft from a specific queue.

* **URL**

  /dequeue

* **Method:**

  `POST`

*  **URL Params**

   None

* **Data Params**

  **Required:**

  `_token: X-CSRF-TOKEN`
  
  `['queueName'] : string`

* **Success Response:**

    * **Code:** 200 <br />
      **Content:** `{ data : Object { aircraft }, msg : "Aircraft removed" }`

* **Error Response:**

    * **Code:** 400 <br />
      **Content:** `{ ERR-MSG : "The queueName is required" }`

      OR

    * **Code:** 403 <br />
      **Content:** `{ ERR-MSG : "You must initialize the system before using it. ERR_ATCQ_BAS" }`

      OR

    * **Code:** 406 <br />
      **Content:** `{ ERR-MSG : "The selected QUEUE has no aircrafts to dequeue" }`

* **queueName values:**

  - emergencyLarge
  - emergencySmall
  - vipLarge
  - vipSmall
  - peopleLarge
  - peopleSmall
  - cargoLarge
  - cargoSmall

* **Sample Call:**

  ```javascript
    $.ajax({
        url: "/dequeue",
        type: 'POST',
        dataType: "json",
        data: {
            _token: "THE_TOKEN",
            queueName: 'cargoSmall'
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
