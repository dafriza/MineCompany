<?php

namespace App\Http\Controllers;

use App\DataTables\RoleManagement\RoleManagementTablesDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function index(RoleManagementTablesDataTable $dataTable) {
        return $dataTable->render('RoleManagement.tables');
    }
}
