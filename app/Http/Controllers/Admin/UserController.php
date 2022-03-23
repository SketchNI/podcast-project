<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Exceptions\ForbiddenException;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        try {
            if ($request->user()->can('admin.view')) {
                $users = User::paginate(15);
                return Inertia::render('Admin/User/Index', compact('users'));
            }
            throw new ForbiddenException("You do not have permission to perform this action.");
        } catch (ForbiddenException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }
}
