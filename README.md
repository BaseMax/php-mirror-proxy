# PHP Mirror Proxy

A simple PHP script that mirrors incoming HTTP requests to a specified target URL, maintaining the same HTTP method, headers, and body content. This proxy supports GET, POST, PUT, DELETE, PATCH, and other HTTP methods, forwarding them to the desired endpoint using cURL.

## Features

- Mirrors requests with any HTTP method (GET, POST, PUT, DELETE, PATCH, OPTIONS, etc.)
- Passes request headers, body content, and handles redirects
- Handles timeouts with a default value of 30 seconds
- Validates the target URL

## Usage

To use the proxy, make a request to `mirror.php` and pass the target URL as a GET parameter.

Example URL:

```
http://yourserver.com/mirror.php?url=http://example.com
```

The proxy will then forward the request to http://example.com and return the response.

## Installation

Clone the repository:

```bash
git clone https://github.com/BaseMax/php-mirror-proxy.git
```

Deploy the script to your web server.

Make sure the web server is configured to allow PHP execution.

Access `mirror.php` with the url parameter.

## Example Requests

**GET Request**

```bash
curl "http://yourserver.com/mirror.php?url=http://example.com"
```

**POST Request**

```bash
curl -X POST -d "param1=value1&param2=value2" "http://yourserver.com/mirror.php?url=http://example.com"
```

**PUT Request**

```bash
curl -X PUT -d '{"name":"example"}' "http://yourserver.com/mirror.php?url=http://example.com" -H "Content-Type: application/json"
```

**DELETE Request**

```bash
curl -X DELETE "http://yourserver.com/mirror.php?url=http://example.com/resource/1"
```

## License

This project is licensed under the GNU General Public License v3.0. See the LICENSE file for details.

Copyright 2024, Max Base
