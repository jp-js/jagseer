<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Illuminate\Http\Request;
use App\Models\Order as MyModel;
use App\Http\Controllers\Controller;

class OrdersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    protected $__rulesforindex = ['user_id' => 'required'];

    public function index(Request $request) {
        try {
            if ($request->ajax()) {
                $adminusers = MyModel::orderBy('id')->latest();
                // dd($adminusers);
                return Datatables::of($adminusers)
                                ->addIndexColumn()
                                ->addColumn('action', function($item) {
                                    $return = '';
                                    $return .= "<a href=" . url('/admin/orders/' . $item->id) . " title='View User'><button class='btn btn-primary btn-sm'><i class='fas fa-eye' aria-hidden='true'></i> View </button></a>";
                                    return $return;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
            }
            return view('admin.orders.index', ['rules' => array_keys($this->__rulesforindex)]);
        } catch (Exception $ex) {
            return redirect('admin/orders')->with('error', $ex->getMessage());
        }
    }


   
    public function show($id) {
        try {
            $order = MyModel::with(['order_items','users'])->findOrFail($id);
            // dd($product);
            return view('admin.orders.show', compact('order'));
        } catch (Exception $ex) {
            return redirect('admin/orders')->with('error', $ex->getMessage());
        }
    }

   
    
    public function destroy($id) {
        try {
            if (MyModel::destroy($id)) {
                $data = 'Success';
            } else {
                $data = 'Failed';
            }
            return response()->json($data);
        } catch (Exception $ex) {
            return redirect('admin/orders')->with('error', $ex->getMessage());
        }
    }

   
}
