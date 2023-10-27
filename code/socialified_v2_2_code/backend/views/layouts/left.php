<aside class="main-sidebar">

    <section class="sidebar">

      
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree',  'data-widget'=> 'tree'],
                'items' => [
                    
                    ['label' => 'Dashboard', 'icon' => 'ion fa-tachometer',  'aria-hidden'=>"true", 'url' => Yii::$app->homeUrl],
                    ['label' => 'Administrators', 'icon' => 'user',  'aria-hidden'=>"true", 'url' => ['/administrator']],
                    

                    [
                        'label' => 'Users',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Users', 'icon' => 'users',  'aria-hidden'=>"true", 'url' => ['/user']],
                            ['label' => 'Reported User', 'icon' => 'ion fa-bell',  'aria-hidden'=>"true", 'url' => ['/user/reported-user']],
                            ['label' => 'User Verification', 'icon' => 'users',  'aria-hidden'=>"true", 'url' => ['/user-verification']],
                            ['label' => 'User Profile Category', 'icon' => 'users',  'aria-hidden'=>"true", 'url' => ['/user-profile-category']],
                           
                            
                        ],
                    ],
                    [
                        'label' => 'Post',
                        'icon' => 'fa-brands fa-wpforms',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Post', 'icon' => 'fa-brands fa-html5',  'aria-hidden'=>"true", 'url' => ['/post']],
                            ['label' => 'Reported Post', 'icon' => 'fa-brands fa-wpforms',  'aria-hidden'=>"true", 'url' => ['/post/reported-post']],
                           
                            
                        ],
                    ],
                    
                    [
                        'label' => 'Competition',
                        'icon' => 'fas fa-assistive-listening-systems',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Create Competition', 'icon' => 'fas fa-assistive-listening-systems',  'aria-hidden'=>"true", 'url' => ['/competition/create']],
                            ['label' => 'Competition', 'icon' => 'fas fa-list-ul',  'aria-hidden'=>"true", 'url' => ['/competition']],
                            
                            
                        ],
                    ],
                    [
                        'label' => 'Club',
                        'icon' => 'fas fa-bullhorn',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Club', 'icon' => 'fas fa-bullhorn',  'aria-hidden'=>"true", 'url' => ['/club']],
                            ['label' => 'Club Categories', 'icon' => 'list-alt',  'aria-hidden'=>"true", 'url' => ['/club-category']],
                            
                        ],
                    ],
                   

                    ['label' => 'Support Request', 'icon' => 'fas fa-ticket',  'aria-hidden'=>"true", 'url' => ['/support-request']],
                    [
                        'label' => 'Payment',
                        'icon' => 'fas fa-money',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Payment Received', 'icon' => 'fas fa-money',  'aria-hidden'=>"true", 'url' => ['/payment']], 
                            ['label' => 'Payment Request', 'icon' => 'fas fa-money',  'aria-hidden'=>"true", 'url' => ['/withdrawal-payment']],
                            ['label' => 'Payout', 'icon' => 'fas fa-money',  'aria-hidden'=>"true", 'url' => ['/withdrawal-payment','type'=>'completed']],        
                        ],
                    ],
                   
                    ['label' => 'Packages', 'icon' => 'fas fa-money',  'aria-hidden'=>"true", 'url' => ['/package']],

                    
                    

                    [
                        'label' => 'Tv Channel',
                        'icon' => 'fas fa-tv',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Tv Channel', 'icon' => 'fas fa-tv',  'aria-hidden'=>"true", 'url' => ['/live-tv']],
                            ['label' => 'Tv Channel Categories', 'icon' => 'list-alt',  'aria-hidden'=>"true", 'url' => ['/live-tv-category']],
                            [
                                'label' => 'Tv Show',
                                'icon' => 'fas fa-tv',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Tv Show', 'icon' => 'list-alt',  'aria-hidden'=>"true", 'url' => ['/tv-show']],
                                    ['label' => 'Tv Show Categories', 'icon' => 'fas fa-tasks',  'aria-hidden'=>"true", 'url' => ['/category','type'=>3]],
                                    
                                ],
                               
                            ],
                            ['label' => 'Tv Banner', 'icon' => 'fas fa-file',  'aria-hidden'=>"true", 'url' => ['/tv-banner']],
                            ['label' => 'Tv Show Episode', 'icon' => 'fas fa-play',  'aria-hidden'=>"true", 'url' => ['/tv-show-episode']],
                        ],
                    ],

                    [
                        'label' => 'Podcast',
                        'icon' => 'fas fa-tv',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Host', 'icon' => 'fas fa-bullhorn',  'aria-hidden'=>"true", 'url' => ['/podcast']],
                            // ['label' => 'Host Categories', 'icon' => 'list-alt',  'aria-hidden'=>"true", 'url' => ['/podcast-category']],
                            [
                                'label' => 'Podcast Show',
                                'icon' => 'fas fa-tv',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Podcast Show', 'icon' => 'list-alt',  'aria-hidden'=>"true", 'url' => ['/podcast-show']],
                                    ['label' => 'Podcast Show Categories', 'icon' => 'fas fa-tasks',  'aria-hidden'=>"true", 'url' => ['/category','type'=>6]],
                                    
                                ],
                            ],
                            ['label' => 'Podcast Banner', 'icon' => 'fas fa-file',  'aria-hidden'=>"true", 'url' => ['/podcast-banner']],
                            ['label' => 'Podcast Episode', 'icon' => 'fas fa-play',  'aria-hidden'=>"true", 'url' => ['/podcast-show-episode']],
                        ],
                    ],

                  
                   
                    [
                        'label' => 'Gift',
                        'icon' => 'fab fa-yelp',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gift', 'icon' => 'fab fa-yelp',  'aria-hidden'=>"true", 'url' => ['/gift']],
                            ['label' => 'Gitf Categories', 'icon' => 'list-alt',  'aria-hidden'=>"true", 'url' => ['/gift-category']],
                            ['label' => 'Timeline Gift', 'icon' => 'fa fa-hourglass',  'aria-hidden'=>"true", 'url' => ['/gift-timeline']],
                            
                        ],
                    ],


                    [
                        'label' => 'FAQs',
                        'icon' => 'fas fa-question-circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'FAQ', 'icon' => 'fas fa-question-circle',  'aria-hidden'=>"true", 'url' => ['/faq']],
                            
                        ],
                    ],
                   
                   
                    [
                        'label' => 'Polls',
                        'icon' => 'fab fa-gg',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Poll', 'icon' => 'fab fa-gg',  'aria-hidden'=>"true", 'url' => ['/poll']],
                            ['label' => 'Poll Categories', 'icon' => 'list-alt',  'aria-hidden'=>"true", 'url' => ['/category','type'=>7]],
                           
                           
                        ],
                    ],
                   
                    [
                        'label' => 'Setting',
                        'icon' => 'ion fa-wrench',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Contact Information', 'icon' => 'ion fa-wrench',  'aria-hidden'=>"true", 'url' => ['/setting']],
                            ['label' => 'General Setting', 'icon' => 'ion fa-wrench',  'aria-hidden'=>"true", 'url' => ['/setting/general-information']],
                            ['label' => 'Payment Setting', 'icon' => 'ion fa-wrench',  'aria-hidden'=>"true", 'url' => ['/setting/payment']],
                            ['label' => 'Social Links', 'icon' => 'ion fa-wrench',  'aria-hidden'=>"true", 'url' => ['/setting/social-links']],
                            ['label' => 'App Settings', 'icon' => 'ion fa-wrench',  'aria-hidden'=>"true", 'url' => ['/setting/app-setting']],
                            ['label' => 'Feature Availability', 'icon' => 'ion fa-wrench',  'aria-hidden'=>"true", 'url' => ['/setting/feature']],
                            ['label' => 'App Theme Setting', 'icon' => 'ion fa-wrench',  'aria-hidden'=>"true", 'url' => ['/setting/app-theme-setting']],
                            
                            
                        ],
                    ],


                ],
            ]
        ) ?>

    </section>

</aside>
