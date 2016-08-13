<?php

return array(
    'product/(\d+)'             => 'product/view/$1',         // actionView     in ProductController
    'catalog'                   => 'catalog/index',           // actionIndex    in CatalogController
    'category/(\d+)/page-(\d+)' => 'catalog/category/$1/$2',  // actionCategory in CatalogController
    'category/(\d+)'            => 'catalog/category/$1',     // actionCategory in CatalogController
    'user/register'             => 'user/register',           // actionRegister in UserController
    '.+'                        => 'site/index',              // actionIndex    in SiteController
    ''                          => 'site/index',              // actionIndex    in SiteController
);
