<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function show(): View
    {
        $departments = Department::all();

        return view('employees.employee.department')->with('departments', DepartmentResource::collection($departments)->toArray(request()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDepartmentRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        try {
            $department = Department::create($request->validated());

            if ($department) {
                return redirect()->route('departments.show')->with('message', 'Department Created successfully');
            } else {
                return back()->withError('Something went wrong!');
            }
        } catch (Exception $ex) {
            return back()->withError('Something went wrong!');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  UpdateDepartmentRequest  $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department): RedirectResponse
    {
        try {
            $department->update($request->validated());

            if ($department) {
                return redirect()->route('departments.show')->with('message', 'Department Updated successfully');
            } else {
                return back()->withError('Something went wrong!');
            }
        } catch (Exception $ex) {
            return back()->withError('Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department): RedirectResponse

    {
        try {
            $is_deleted = $department->delete();
            if ($is_deleted) {
                return redirect()->route('department.destroy')->with('message', 'Department Deleted Successfully');
            } else {
                return back()->withError('Something went wrong!');
            }
        } catch (Exception $ex) {
            return back()->withError('Something went wrong!');
        }
    }
}
