<?php

namespace App\Nova\Filters;

use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Laravel\Nova\Filters\Filter;
use Spatie\Permission\Models\Role;

class RoleFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public $name = 'Filter by Role';

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value): Builder
    {
        return $query->join('model_has_roles', 'model_id', '=', 'users.id', null)
            ->join('roles', 'roles.id', '=', 'role_id', null)
            ->select(['users.id', 'profile_photo_path', 'users.name', 'users.email', 'roles.name as role_name'])
            ->where('roles.id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        $roles = DB::table('roles')->select(['id', 'name'])->get();
        $array = [];
        foreach ($roles as $role) {
            $array += [$role->name => $role->id];
        }
        return $array;
    }
}
