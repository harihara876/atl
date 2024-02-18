# Admin

Admin is the user who installs the **Plat4m** app in their smartphone and registers as the main user of the app.

Attribute           | Type   | Editable | Description
------------------- | ------ | -------- | --------------------------
`id`                | int    | no       | Unique ID. Auto generated by the server.
`first_name`        | string | yes      | User first name.
`last_name`         | string | yes      | User last name.
`email`             | string | no       | User email.
`password`          | string | yes [1]  | Hashed password.
`mobile_number`     | string | yes      | Mobile number.
`store_type`        | string | yes      | Store type. LLC, INC etc.
`store_name`        | string | yes      | Store name.
`store_address`     | string | yes      | Store address.
`store_city`        | string | yes      | Store city.
`store_zip`         | string | yes      | ZIP code.
`store_country`     | string | yes      | Country name.
`currency`          | string | yes      | Currency. E.g. INR, USD
`currency_symbol`   | string | yes      | Currency symbol. Unicode points are used if symbol can't be typed. E.g. $, ₹, U+20B9
`paytm_credentials` | string | yes [2]  | Paytm credentials encoded as string.
`created_on`        | string | no       | Date in which user created their account.
`updated_on`        | string | no       | Date in which entity gets updated.

1. A seperate endpoint `/api/v3/admin/password/change` is used to change password.
2. A seperate endpoint `/api/v3/admin/paytm-credentials/update` is used to update Paytm credentails.

**Other attributes**

Few APIs need other attributes which are not part of the model but useful to share information.

Attribute | Type   | Description
----------| ------ | --------------------------
`otp`     | string | One Time Password. Usually a 4 digit numeric code represented as string.
`mid`     | string | Merchant ID in Paytm credentails.
`mkey`    | string | Merchant secret in Paytm credentails.

---

## *Create Admin*

### **POST** `/api/v3/admin/create`

Create a new Admin.

#### Request

    {
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@domain.com",
        "password": "J0hnDoe@123",
        "mobile_number": "+918987678732",
        "store_type": "LLC",
        "store_name": "Everest Supermarket",
        "store_address": "1-234, Patrika Nagar, HITEC City",
        "store_city": "Hyderabad",
        "store_zip": "500082",
        "store_country": "India"
    }

> **Mandatory**: `first_name, last_name, email, password, mobile_number`.

#### Response

    {
        "id": 123,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@domain.com",
        "mobile_number": "+918987678732",
        "store_type": "LLC",
        "store_name": "Everest Supermarket",
        "store_address": "1-234, Patrika Nagar, HITEC City",
        "store_city": "Hyderabad",
        "store_zip": "500082",
        "store_country": "India",
        "created_on": "2021-09-23 12:01:02",
        "updated_on": "2021-09-23 12:01:02"
    }

---

## *Admin Profile*

### **GET** `/api/v3/admin`

Get Admin profile.

No need to pass any Admin ID. It will be accessed from JWT.

#### Request

    Not required.

#### Response

    {
        "id": 123,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@domain.com",
        "mobile_number": "+918987678732",
        "admin_id": 123,
        "role": "storeadmin",
        "paytm_credentials": {
            "merchant_id": "LUfX+OlJ0co7QG...",
            "merchant_key": "NlAg+8Jwt3RtDr..."
        },
        "store_type": "LLC",
        "store_name": "Everest Supermarket",
        "store_address": "1-234, Patrika Nagar, HITEC City",
        "store_city": "Hyderabad",
        "store_zip": "500082",
        "store_country": "India",
        "currency": "IND",
        "currency_symbol": "\u20b9",
        "allowed_cashiers": 1,
        "allowed_logins": 1,
        "registered_app": "com.plat4minc.mystore",
        "created_on": "2021-10-19 18:22:47",
        "updated_on": "2021-10-19 18:22:47"
    }

---

## *Update Admin*

### **PATCH** `/api/v3/admin/update`

Update attributes of an Admin.

Any of the editable attributes can be updated.

#### Request

    {
        "first_name": "Jane",
        "last_name": "Doe",
        "mobile_number": "+919434545342"
    }

#### Response

    {
        "id": 123
        "first_name": "Jane",
        "last_name": "Doe",
        "email": "john.doe@domain.com",
        "mobile_number": "+919434545342",
        "store_type": "LLC",
        "store_name": "Everest Supermarket",
        "store_address": "1-234, Patrika Nagar, HITEC City",
        "store_city": "Hyderabad",
        "store_zip": "500082",
        "store_country": "India",
        "created_on": "2021-09-23 12:01:02",
        "updated_on": "2021-09-23 13:02:03"
    }

---

## *Change Password*

### **POST** `/api/v3/admin/password/change`

Change Admin password.

#### Request

    {
        "password": "J0hnDoe@123",
        "new_password": "JameD0e@456"
    }

#### Response

    Not required.

---

## *Update Paytm Credentials*

### **POST** `/api/v3/admin/paytm-credentials/update`

Update Paytm merchant credentials. Old credentials will be removed from the system.

#### Request

    {
        "mid": "owEsZy7582422735324265",
        "mkey": "jgdlsyfgvblcagliugbva"
    }

#### Response

    Not required.

---

## *List of Cashiers*

### **GET** `/api/v3/admin/cashiers`

List of Cashiers created by Admin.

#### Request

    Not required.

#### Response

    [
        {
            "id": 456,
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe@domain.com",
            "mobile_number": "+918987678732",
            "admin_id": 123,
            "created_on": "2021-09-23 12:01:02",
            "updated_on": "2021-09-23 12:01:02"
        },
        {
            "id": 789,
            "first_name": "Jane",
            "last_name": "Doe",
            "email": "jane.doe@domain.com",
            "mobile_number": "+918987678733",
            "admin_id": 123,
            "created_on": "2021-09-23 12:01:02",
            "updated_on": "2021-09-23 12:01:02"
        }
    ]

---

## *Delete Cashier*

### **DELETE** `/api/v3/admin/cashier/{cashier_id}/delete`

Delete Cashier created by Admin.

#### Request

    Not required.

#### Response

    Not required.