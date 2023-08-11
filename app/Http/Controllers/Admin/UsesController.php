<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsesController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
