# magento-2-simple-antispam
A customizeable and simple Magento 2 extension for blocking (russian) spam bots creating new customer accounts.

## installation
    1. $ composer require kus/magento2-simple-antispam
    2. $ ./bin/magento module:enable KuS_Antispam
    3. $ ./bin/magento setup:upgrade
    4. Profit.

## usage
This extension is very simple. By default it won't perform a registration request when some registration fields contain special strings on a blacklist:

    $spamContent = array(
        "http://",
        "https://",
        "www.",
        ".com",
        ".de",
        ".ru",
        ".cn",
        ".net"
    );

default registration fields:

    $formFieldsToCheck = array(
        'firstname',
        'lastname'
    );


You can change the whole extension behaviour by your need. Just edit this file:

    ./Plugin/Customer/Controller/Account/CreatePostPlugin.php

## how it works
It's a simple interceptor plugin which wraps the \Magento\Customer\Controller\Account\CreatePost::Execute() method into an around method.
It will serach all specified form fields for the spam content by a simple iteration. The original Execute() method will only be called if there was no spam string detected.

## Notice:
This Extension is meant to be used as a skeleton by developers. It is very primitive and may need customization.
When installing via Composer, further upgrades will eliminiate your customizations. Make sure to write an interceptor plugin by yourself, don't upgrade or use it as a local extension in the /app/code/ folder.

Propably there will be a future version, capable of defining blacklisted strings and form fields via Magento Admin when there's a demand for it. Just let us know or make the neccesary changey by yourself and leave a pull request.
We're happy about every contribution :)