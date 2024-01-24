<?php

use TomatoPHP\TomatoMenus\Services\MenuRenderBase;

return [
    /**
     * you can add a new Menus Class that generated by tomato:menu MENU_NAME here to register
     * the menu to the tomato-admin menu system
     */
    "menus" => [
        //
    ],

    /**
     * you can provide your own menu class to render the menu
     * the class must return a full rendered menu.
     */
    "menu_provider" => null,

    /**
     * if you need to change the main menu with your own menu file
     */
    "menu_file" => null,

    /**
     * if you need to change the route prefix
     */
    "route_perfix" => "admin",

    /**
     * if you need to disable the register route
     */
    "register" => true,

    /**
     * if you need to change the route middlewares
     */
    "route_middlewares" => [
        "web"
    ],

    /**
     * if you need to change the route path for global search
     */
    "global_search_route" => null,

    "langs" => [
        [
            "key" => "ar",
            "label" =>  "Arabic",
            "flag" => "🇪🇬"
        ],
        [
            "key" => "en",
            "label" => "English",
            "flag" => "🇺🇸"
        ],
        [
            "key" => "gr",
            "label" => "Germany",
            "flag" => "🇩🇪"
        ]
    ]
];
