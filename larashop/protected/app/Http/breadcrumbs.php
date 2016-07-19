<?php

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', url('admin/home'));
});

Breadcrumbs::register('categories', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Categories', route('categories'));
});

Breadcrumbs::register('orders', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Orders', route('orders'));
});

Breadcrumbs::register('products', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Products', route('products'));
});

Breadcrumbs::register('tags', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tags', route('tags'));
});

Breadcrumbs::register('review', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Reviews', route('review'));
});

Breadcrumbs::register('information', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Informations', route('information'));
});

Breadcrumbs::register('customers', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Customers', route('customers'));
});

Breadcrumbs::register('customergroups', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Customer Groups', route('customergroups'));
});

Breadcrumbs::register('system.settings', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('System Setting', route('system.settings'));
});

Breadcrumbs::register('backup', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Backup Database', route('backup'));
});

// Home > Blog > [Category] > [Page]
Breadcrumbs::register('page', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('category', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});