<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionsRequest;
use App\Http\Resources\PermissionResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    private string $routeResourceName = 'permissions';

    public function index(Request $request)
    {
        $roles = Permission::query()
                     ->select([
                        'id',
                        'name',
                        'created_at',
                     ])
                     ->when($request->name, fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
                     ->latest('id')
                     ->paginate(10);

        return Inertia::render('Permission/Index', [
            'title' => 'Pemissions', 
            'items' => PermissionResource::collection($roles),
            'headers' => [
                [
                    'label' => 'Name',
                    'name'  => 'name'  
                ],
                [
                    'label' => 'Created At',
                    'name'  => 'created_at'  
                ],
                [
                    'label' => 'Actions',
                    'name'  => 'actions'  
                ]
            ],
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function create()
    {
        return Inertia::render('Permission/Create', [
            'edit' => false,
            'title' => 'Add Permission',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(PermissionsRequest $request)
    {
        Permission::create($request->validated());

        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $Permission)
    {
        return Inertia::render('Permission/Create', [
            'edit' => true,
            'title' => 'Edit Permission',
            'item' => new PermissionResource($Permission),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(PermissionsRequest $request, Permission $Permission)
    {
        $Permission->update($request->validated());

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $Permission)
    {
        $Permission->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}