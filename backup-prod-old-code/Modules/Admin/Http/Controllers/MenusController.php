<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenusController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $repo;
    protected $view;
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->data['controllerName'] = 'admin::menus';
    } 
    public function index(Request $request, $type='home')
    {
        $this->data['title'] = 'Menus';
        return view("{$this->data['controllerName']}.index", $this->data);
    }

}
