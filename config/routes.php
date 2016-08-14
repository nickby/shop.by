<?php

return array(
    'product/(\d+)'             => 'product/view/$1',         // actionView     in ProductController
    'catalog'                   => 'catalog/index',           // actionIndex    in CatalogController
    'category/(\d+)/page-(\d+)' => 'catalog/category/$1/$2',  // actionCategory in CatalogController
    'category/(\d+)'            => 'catalog/category/$1',     // actionCategory in CatalogController
    'cart/add/(\d+)'            => 'cart/add/$1',             // actionAdd      in CartController
    'cart/addAjax/(\d+)'        => 'cart/addAjax/$1',         // actionAddAjax  in CartController
    'cart'                      => 'cart/index',              // actionIndex    in CartController
    'user/register'             => 'user/register',           // actionRegister in UserController
    'user/login'                => 'user/login',              // actionLogin    in UserController
    'user/logout'               => 'user/logout',             // actionLogout   in UserController
    'cabinet/edit'              => 'cabinet/edit',            // actionEdit     in CabinetController
    'cabinet'                   => 'cabinet/index',           // actionIndex    in CabinetController
    'contacts'                  => 'site/contact',            // actionContact  in SiteController
    '.+'                        => 'site/index',              // actionIndex    in SiteController
    ''                          => 'site/index',              // actionIndex    in SiteController
);
