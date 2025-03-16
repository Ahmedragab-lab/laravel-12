<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
class ProductController2 extends Controller
{
    
  public function index()
  {
     return view('admin.products2.index');
  }

}
