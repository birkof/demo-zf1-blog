ZF1-Blog
==========

> ZF1-Blog - Yet another Zend Framework 1 blogging platform
	
	This software it is intended to be used for evaluation and demonstration purposes only.
	It provides ideas and examples on how to solve a specific problem or how to use a specific technology.
	No support is provided for this software type. Commercial use of it is not permitted.

## Install

## Usage

## Development

### Requirements
To run this application on your machine, you need at least:

* PHP >=5.4
* MySQL >= 5.5
* Apache Web Server with mod rewrite enabled or Nginx Web Server

### Install dependencies
You can clone the repository and then install dependencies using make:

    $ make install

### Database 
You'll need to create the database and initialize schema:

    echo 'CREATE DATABASE taskmanager CHARSET=utf8 COLLATE=utf8_unicode_ci' | mysql -u root
    cat schema/taskmanager.sql | mysql -u root taskmanager

### Run tests

    $ make test

## License

(The GPLv3 License)
see LICENSE file for details...
