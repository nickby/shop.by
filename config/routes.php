<?php

return array(
    'product/(\d+)'              => 'product/view/$1',         // actionView     in ProductController
    'catalog'                    => 'catalog/index',           // actionIndex    in CatalogController
    'category/(\d+)/page-(\d+)'  => 'catalog/category/$1/$2',  // actionCategory in CatalogController
    'category/(\d+)'             => 'catalog/category/$1',     // actionCategory in CatalogController
    'cart/checkout'              => 'cart/checkout',           // actionCheckout in CartController
    'cart/delete/(\d+)'          => 'cart/delete/$1',          // actionDelete   in CartController
    'cart/add/(\d+)'             => 'cart/add/$1',             // actionAdd      in CartController
    'cart/addAjax/(\d+)'         => 'cart/addAjax/$1',         // actionAddAjax  in CartController
    'cart'                       => 'cart/index',              // actionIndex    in CartController
    'user/register'              => 'user/register',           // actionRegister in UserController
    'user/login'                 => 'user/login',              // actionLogin    in UserController
    'user/logout'                => 'user/logout',             // actionLogout   in UserController
    'cabinet/edit'               => 'cabinet/edit',            // actionEdit     in CabinetController
    'admin/product/create'       => 'adminProduct/create',     // actionCreate   in AdminProductController
    'admin/product/update/(\d+)' => 'adminProduct/update/$1',  // actionUpdate   in AdminProductController
    'admin/product/delete/(\d+)' => 'adminProduct/delete/$1',  // actionDelete   in AdminProductController
    'admin/product'              => 'adminProduct/index',      // actionIndex    in AdminProductController
    'admin/order/update/(\d+)'   => 'adminOrder/update/$1',    // actionUpdate   in AdminOrderController
    'admin/order/delete/(\d+)'   => 'adminOrder/delete/$1',    // actionDelete   in AdminOrderController
    'admin/order/view/(\d+)'     => 'adminOrder/view/$1',      // actionView     in AdminOrderController
    'admin/order'                => 'adminOrder/index',        // actionIndex    in AdminOrderController
    'admin/category/create'       => 'adminCategory/create',     // actionCreate   in AdminCategoryController
    'admin/category/update/(\d+)' => 'adminCategory/update/$1',  // actionUpdate   in AdminCategoryController
    'admin/category/delete/(\d+)' => 'adminCategory/delete/$1',  // actionDelete   in AdminCategoryController
    'admin/category'              => 'adminCategory/index',      // actionIndex    in AdminCategoryController
    'admin'                      => 'admin/index',             // actionIndex    in AdminController
    'cabinet'                    => 'cabinet/index',           // actionIndex    in CabinetController
    'contacts'                   => 'site/contact',            // actionContact  in SiteController
    '.+'                         => 'site/index',              // actionIndex    in SiteController
    ''                           => 'site/index',              // actionIndex    in SiteController
);
