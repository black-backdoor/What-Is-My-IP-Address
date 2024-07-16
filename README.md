# What's My IP Address API
This repository contains a simple PHP script to create an API that returns the client's IP address. The API supports both plaintext and JSON responses and categorizes IP addresses into IPv4 and IPv6.



## Features
- Returns the client's IP address in plaintext or JSON format.
- Supports both IPv4 and IPv6.
- JSON response includes all potential client IPs categorized by type.



## Setup

### Prerequisites
- A web server (Apache, Nginx, etc.) with PHP installed.

### Installation
Installation may vary depending on your web server configuration.

1. **Download the ip.php script:**
   ```sh
   wget https://github.com/black-backdoor/What-Is-My-IP-Address/raw/main/ip.php
   ```
   or you can download the file manually from the repository.


2. **Deploy the PHP script:**
   Copy the `ip.php` file to your web server's document root. For example, on an Apache server:

   ```sh
   cp ip.php /var/www/html/
   ```

3. **Verify the setup:**
   Ensure your web server is running and navigate to the script's URL in your web browser or using `curl`.

   ```sh
   http://yourdomain.com/ip.php
   ```



## Usage

### Plaintext Response
To get the client's IP address in plaintext format, make a GET request to the API without any parameters:

```sh
curl http://yourdomain.com/ip.php
```

### JSON Response
To get the client's IP address and all possible IPs in JSON format, add the `mode=json` query parameter to your GET request:

```sh
curl http://yourdomain.com/ip.php?mode=json
```

### Example JSON Response
```json
{
  "ip": "192.168.1.1",
  "all_ips": {
    "IPv4": [
      "192.168.1.1"
    ],
    "IPv6": [
      "fe80::1ff:fe23:4567:890a"
    ]
  }
}
```

## Contributing
Contributions are welcome! Please open an issue or submit a pull request with any improvements or bug fixes.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
