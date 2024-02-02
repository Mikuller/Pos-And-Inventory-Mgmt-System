<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Exception;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;




class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = AuditLog::latest()->paginate(15);
        
        return view('staff.audit-log', compact('logs'));
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuditLog $auditLog)
    {
       // dd($auditLog);
       try {
        //dd($auditLog);
        $auditLog->delete();
        return back()->with('success',"Deletion Was Successful");

      
       } catch (\Throwable $e) {
        return back()->with('error',$e);
       }
    
    
       
    }
}
