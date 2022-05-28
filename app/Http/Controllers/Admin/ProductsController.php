<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Illuminate\Http\Request;
use App\Models\Product as MyModel;
use App\Http\Controllers\Controller;

class ProductsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    protected $__rulesforindex = ['name' => 'required', 'price' => 'required', 'qty' => 'required'];

    public function index(Request $request) {
        try {
            if ($request->ajax()) {
                $adminusers = MyModel::orderBy('id')->latest();
                // dd($adminusers);
                return Datatables::of($adminusers)
                                ->addIndexColumn()
                                ->addColumn('action', function($item) {
                                    $return = '';
                                    $return .= "<a href=" . url('/admin/products/' . $item->id) . " title='View User'><button class='btn btn-primary btn-sm'><i class='fas fa-eye' aria-hidden='true'></i> View </button></a>
                                    <a href=" . url('/admin/products/' . $item->id.'/edit') . " title='View User'><button class='btn btn-info btn-sm'><i class='fas fa-eye' aria-hidden='true'></i> Edit </button></a>
                                        
                                <button class='btn btn-danger btn-sm btnDelete' type='submit' data-remove='" . url('/admin/products/' . $item->id) . "'><i class='fas fa-trash' aria-hidden='true'></i> Delete </button>";
                                    return $return;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
            }
            return view('admin.products.index', ['rules' => array_keys($this->__rulesforindex)]);
        } catch (Exception $ex) {
            return redirect('admin/products')->with('error', $ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create() {
        try {
            return view('admin.products.create');
        } catch (Exception $ex) {
            return redirect('admin/products')->with('error', $ex->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request) {

        try {

             $rules = ['name' => 'required|alpha',
                    'qty' => 'required|integer',
                    'price' => 'required|integer',
                    'description' => 'required',
                    'image' => 'required|mimes:jpeg,jpg,png'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        // return $validateAttributes
        if ($validateAttributes):
            $error = $validateAttributes->getData();
            return redirect('admin/products/create')->withInput()->with('error',$error->error);
        endif;
           $data = $request->all();
           if (isset($request->image)){
            $data['image'] = parent::__uploadImage($request->file('image'), public_path('uploads/products'));
        }
           
            // dd($data);
            MyModel::create($data);
            return redirect('admin/products')->with('flash_message', 'Product added successfully..');
        } catch (Exception $ex) {
            return redirect('admin/products')->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id) {
        try {
            $product = MyModel::findOrFail($id);
            // dd($product);
            return view('admin.products.show', compact('product'));
        } catch (Exception $ex) {
            return redirect('admin/products')->with('error', $ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id) {
        try {
            $product = MyModel::findOrFail($id);
            return view('admin.products.edit', compact('product'));
        } catch (Exception $ex) {
            return redirect('admin/products')->with('error', $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id) {

        $rules = ['name' => 'required|alpha',
        'qty' => 'required|integer',
        'price' => 'required|integer',
        'description' => 'required',
        'image' => 'required|mimes:jpeg,jpg,png'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        // return $validateAttributes
        if ($validateAttributes):
            $error = $validateAttributes->getData();
            return redirect('admin/products/create')->withInput()->with('error', $error->error);
        endif;
        try {
//dd($data);
            $data = $request->all();
            $topics = MyModel::findOrFail($id);
            if (isset($request->image)){
                $data['image'] = parent::__uploadImage($request->file('image'), public_path('uploads/products'));
            }
            // dd(data);
            $topics->update($data);
            return redirect('admin/products')->with('flash_message', 'Product updated successfully..');
        } catch (Exception $ex) {
            return redirect('admin/products')->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id) {
        try {
            if (MyModel::destroy($id)) {
                $data = 'Success';
            } else {
                $data = 'Failed';
            }
            return response()->json($data);
        } catch (Exception $ex) {
            return redirect('admin/products')->with('error', $ex->getMessage());
        }
    }
}
