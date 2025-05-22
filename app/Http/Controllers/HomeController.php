<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $ngay_search = $request->get('ngay_search');
        $keyword = $request->get('keyword');

        $queries = Items::where('deleted_at', null);

        if ($ngay_search) {
            $queries->whereDate('created_at', $ngay_search);
        }
        if ($keyword) {
            $queries->where(function ($q) use ($keyword) {
                $q->where('ten_khach_hang', 'like', '%' . $keyword . '%')
                    ->orWhere('ma_khach_hang', 'like', '%' . $keyword . '%')
                    ->orWhere('ma_don_hang', 'like', '%' . $keyword . '%')
                    ->orWhere('so_dien_thoai', 'like', '%' . $keyword . '%')
                    ->orWhere('nha_cung_cap', 'like', '%' . $keyword . '%')
                    ->orWhere('nhan_vien', 'like', '%' . $keyword . '%')
                    ->orWhere('dich_vu', 'like', '%' . $keyword . '%');
            });
        }
        $items = $queries->orderBy('id', 'desc')->get();
        return view('index', compact('items', 'ngay_search', 'keyword'));
    }
}
