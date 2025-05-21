<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function detail($id, Request $request)
    {
        $item = Items::where('id', $id)->where('deleted_at', null)->first();
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy khách hàng và dịch vụ');
        }
        return view('pages.items.detail', compact('item'));
    }

    public function view($id, Request $request)
    {
        $item = Items::where('id', $id)->where('deleted_at', null)->first();
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy khách hàng và dịch vụ');
        }
        return view('pages.items.view', compact('item'));
    }

    public function create(Request $request)
    {
        return view('pages.items.create');
    }

    public function store(Request $request)
    {
        try {
            $item = new Items();

            $item = $this->saveItem($request, $item);
            $item->save();

            return redirect()->back()->with('success', 'Thêm mới Khách hàng và Dịch vụ thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function saveItem(Request $request, Items $item)
    {
        if (!$request->input('ma_don_hang')) {
            if (!$item->ma_don_hang) {
                do {
                    $ma_don_hang = 'VS' . generateRandomNumber(6);
                } while (Items::where('ma_don_hang', $ma_don_hang)->exists());
                $item->ma_don_hang = $ma_don_hang;
            }
        } else {
            $item->ma_don_hang = $request->input('ma_don_hang');
        }
        $item->ma_khach_hang = $request->input('ma_khach_hang');
        $item->ten_khach_hang = $request->input('ten_khach_hang');
        $item->so_dien_thoai = $request->input('so_dien_thoai');
        $item->dia_chi = $request->input('dia_chi');
        $item->email = $request->input('email');
        $item->mst = $request->input('mst');
        $item->dich_vu = $request->input('dich_vu');
        $item->loai_dich_vu = $request->input('loai_dich_vu');
        $item->nha_cung_cap = $request->input('nha_cung_cap');
        $item->tong_tien = $request->input('tong_tien');
        $item->nguoi_dai_dien = $request->input('nguoi_dai_dien');
        $item->quoc_tich = $request->input('quoc_tich');
        $item->cccd = $request->input('cccd');
        $item->so_luong = $request->input('so_luong');
        $item->don_gia = $request->input('don_gia');
        $item->thanh_tien = $request->input('thanh_tien');
        $item->loai_tien = $request->input('loai_tien');
        $item->ti_gia = $request->input('ti_gia');
        $item->quy_doi = $request->input('quy_doi');
        $item->vat = $request->input('vat');
        $item->nhan_vien = $request->input('nhan_vien');
        $item->phai_tra = $request->input('phai_tra');
        $item->noi_dung = $request->input('noi_dung');

        return $item;
    }

    public function update($id, Request $request)
    {
        try {
            $item = Items::where('id', $id)->where('deleted_at', null)->first();
            if (!$item) {
                return redirect()->back()->with('error', 'Không tìm thấy khách hàng và dịch vụ');
            }

            $item = $this->saveItem($request, $item);
            $item->save();

            return redirect()->back()->with('success', 'Chỉnh sửa Khách hàng và Dịch vụ thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $item = Items::where('id', $id)->where('deleted_at', null)->first();
            if (!$item) {
                return redirect()->back()->with('error', 'Không tìm thấy khách hàng và dịch vụ');
            }
            $item->delete();

            return redirect()->back()->with('success', 'Đã xoá Khách hàng và Dịch vụ thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
