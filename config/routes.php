<?php

return array(
    'product/(\d+)'             => 'product/view/$1',         // actionView     in ProductController
    'catalog'                   => 'catalog/index',           // actionIndex    in CatalogController
    'category/(\d+)/page-(\d+)' => 'catalog/category/$1/$2',  // actionCategory in CatalogController
    'category/(\d+)'            => 'catalog/category/$1',     // actionCategory in CatalogController
    'user/register'             => 'user/register',           // actionRegister in UserController
    'user/login'                => 'user/login',              // actionLogin    in UserController
    'user/logout'               => 'user/logout',             // actionLogout   in UserController
    'cabinet/edit'              => 'cabinet/edit',            // actionEdit     in CabinetController
    'cabinet'                   => 'cabinet/index',           // actionIndex    in CabinetController
    '.+'                        => 'site/index',              // actionIndex    in SiteController
    ''                          => 'site/index',              // actionIndex    in SiteController
);
