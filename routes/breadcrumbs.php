<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as Trail;

Breadcrumbs::for('product.catalog', function (Trail $trail) {
    $trail->push('Katalog', route('product.catalog'));
});

Breadcrumbs::for('product.show', function (Trail $trail, $product) {
    $trail->parent('product.catalog');
    $trail->push($product->name, route('product.show', $product->id));
});
