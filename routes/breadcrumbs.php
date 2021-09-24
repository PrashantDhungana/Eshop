
<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
     $trail->push('Home', route('product.index'));
});

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail,$product) {
    $trail->parent('home');
    $trail->push('Products', route('product.index'));
    $trail->push($product->name, route('product.show',$product->slug));

});

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });