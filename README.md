gmailproxy
==========

This is a Gmail proxy (relay) server configured in a docker container, which may be useful to Gmail users in China.

## Features

* Relay IMAP traffic to Google's IMAP server.
* SSL/TLS enabled by default. (The SSL certificate included in the repo is a self-signed one, you need to have your own certificate corresponding to your server's domain name)

## Usage

1. Install Docker.
2. Replace `ssl.cert` and `ssl.key` with your own certificate and key files.
3. Run `sudo docker build`.
4. Run the container by `sudo docker run -d -p 993:993 [your_image_name]`.
5. Replace `imap.google.com` by your server's domain in your mail client.
