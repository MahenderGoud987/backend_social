<?php
return [
    'bsVersion' => '3.1',
    'bsDependencyEnabled' => false,
    'adminEmail' => 'admin@yourdomain.co',
    'supportEmail' => 'support@yourdomain.co',
    'senderEmail' => 'admin@yourdomain.co',
    'senderName' => 'SayHi',
    
    'siteMode' => 1, // 1 for live, 2 for testing , 3 demo
    'siteUrl' => 'http://thebotx.com',// domain here
    'enventoPurchaseCode' => '6692ad46-e444-4638-94cc-35663f3e422c', // envato purchase code
    'storageSystem'=> 1,//  storage system ( local storage =1, AWS S3=2, AZURE=3)
    's3' => [
        'key' => '#########',
        'secret' => '#######',
        'region' => '#######',
        'defaultBucket' => '#####',
        'storageUrl'=>'######'
        
    ],
    'azureFs' => [
        'accountName' => '#####',
        'accountKey' => '#########',
        'container' => '##########'
        
    ],
    'testOtp' => '1111',
    
    'apiKey.firebaseCloudMessaging'=> '#################', // 
    
    'user.passwordResetTokenExpire' => 3600,

    
    'twilioSid' => '######', /// 
    'twilioToken' => '#######',
    'smsFromTwilio' =>'#######',/// twilo number


];
