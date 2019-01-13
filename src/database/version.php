<?php
/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 04/01/2019
 */

//for seeds
$seedLink = '<iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ac&ref=tf_til&ad_type=product_link&tracking_id=1234567890bfd-20&marketplace=amazon&region=US&placement=B07DL1Y4GV&asins=B07DL1Y4GV&linkId=e351543d7684bf1fd507fe66acbca7fa&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe>';

/*
 * This is The Migrations Array
 * each version is migration or seed and
 * used by console command: php AppInstall
 */
return [
    '1.0' => [
        'msg' => 'Create Categories Table',             //console message
        'sql' => [                                      // sql
            'CREATE TABLE Categories(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,title VARCHAR(30) NOT NULL)',
        ],
    ],
    '1.1' => [
        'msg' => 'Create Products Table',
        'sql' => [
            'CREATE TABLE Products (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,link TEXT NOT NULL,category_id int(6) UNSIGNED)',
        ],
    ],
    '1.2' => [
        'msg' => 'Seed Categories Table',
        'sql' => [
            'INSERT INTO Categories (title)VALUES ( "Electronics")',
            'INSERT INTO Categories (title)VALUES ( "Home & Garden")',
            'INSERT INTO Categories (title)VALUES ( "Gadgets")',
        ],
    ],
    '1.3' => [
        'msg' => 'Seed Products Table',
        'sql' => [
            "INSERT INTO Products (category_id,link)VALUES ( 1,'$seedLink')",
            "INSERT INTO Products (category_id,link)VALUES ( 2,'$seedLink')",
            "INSERT INTO Products (category_id,link)VALUES ( 3,'$seedLink')",
        ],
    ]
];