<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
 
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Users', route('users.index'));
});