<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function AdminAllReports(){
        return view('admin.backend.report.all_report');
    }
}
