@extends('layouts.master')
@section('title')
    {{ __('admin.Dashboard') }}
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Quản lý Khách hàng và Dịch vụ</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('admin.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">Quản lý Khách hàng và Dịch vụ</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <form method="post" action="{{ route('admin.items.update', $item) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="ma_khach_hang">Mã khách hàng</label>
                    <input type="text" class="form-control" id="ma_khach_hang" name="ma_khach_hang"
                           value="{{ old('ma_khach_hang', $item->ma_khach_hang ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="ten_khach_hang">Tên khách hàng</label>
                    <input type="text" class="form-control" id="ten_khach_hang" name="ten_khach_hang"
                           value="{{ old('ten_khach_hang', $item->ten_khach_hang ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="so_dien_thoai">Số điện thoại</label>
                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                           value="{{ old('so_dien_thoai', $item->so_dien_thoai ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="dia_chi">Địa chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi"
                           value="{{ old('dia_chi', $item->dia_chi ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                           value="{{ old('email', $item->email ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="mst">Mã số thuế</label>
                    <input type="text" class="form-control" id="mst" name="mst"
                           value="{{ old('mst', $item->mst ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="dich_vu">Dịch vụ</label>
                    <input type="text" class="form-control" id="dich_vu" name="dich_vu"
                           value="{{ old('dich_vu', $item->dich_vu ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="loai_dich_vu">Loại dịch vụ</label>
                    <input type="text" class="form-control" id="loai_dich_vu" name="loai_dich_vu"
                           value="{{ old('loai_dich_vu', $item->loai_dich_vu ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nha_cung_cap">Nhà cung cấp</label>
                    <input type="text" class="form-control" id="nha_cung_cap" name="nha_cung_cap"
                           value="{{ old('nha_cung_cap', $item->nha_cung_cap ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="tong_tien">Tổng tiền</label>
                    <input type="text" class="form-control onlyNumber" id="tong_tien" name="tong_tien"
                           value="{{ old('tong_tien', $item->tong_tien ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nguoi_dai_dien">Người đại diện</label>
                    <input type="text" class="form-control" id="nguoi_dai_dien" name="nguoi_dai_dien"
                           value="{{ old('nguoi_dai_dien', $item->nguoi_dai_dien ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="quoc_tich">Quốc tịch</label>
                    <input type="text" class="form-control" id="quoc_tich" name="quoc_tich"
                           value="{{ old('quoc_tich', $item->quoc_tich ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="cccd">CCCD</label>
                    <input type="text" class="form-control" id="cccd" name="cccd"
                           value="{{ old('cccd', $item->cccd ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="so_luong">Số lượng</label>
                    <input type="text" class="form-control onlyNumber" id="so_luong" name="so_luong"
                           value="{{ old('so_luong', $item->so_luong ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="don_gia">Đơn giá</label>
                    <input type="text" class="form-control onlyNumber" id="don_gia" name="don_gia"
                           value="{{ old('don_gia', $item->don_gia ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="thanh_tien">Thành tiền</label>
                    <input type="text" class="form-control onlyNumber bg-secondary bg-opacity-10" id="thanh_tien"
                           name="thanh_tien" value="{{ old('thanh_tien', $item->thanh_tien ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="loai_tien">Loại tiền</label>
                    <input type="text" class="form-control" id="loai_tien" name="loai_tien"
                           value="{{ old('loai_tien', $item->loai_tien ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="ti_gia">Tỉ giá</label>
                    <input type="text" class="form-control onlyNumber" id="ti_gia" name="ti_gia"
                           value="{{ old('ti_gia', $item->ti_gia ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="quy_doi">Quy đổi</label>
                    <input type="text" class="form-control onlyNumber" id="quy_doi" name="quy_doi"
                           value="{{ old('quy_doi', $item->quy_doi ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="vat">VAT</label>
                    <input type="text" class="form-control onlyNumber" id="vat" name="vat"
                           value="{{ old('vat', $item->vat ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nhan_vien">Nhân viên</label>
                    <input type="text" class="form-control" id="nhan_vien" name="nhan_vien"
                           value="{{ old('nhan_vien', $item->nhan_vien ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="phai_tra">Phải trả</label>
                    <input type="text" class="form-control onlyNumber" id="phai_tra" name="phai_tra"
                           value="{{ old('phai_tra', $item->phai_tra ?? '') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="noi_dung">Nội dung</label>
                <textarea class="form-control" id="noi_dung" name="noi_dung"
                          rows="4">{{ old('noi_dung', $item->noi_dung ?? '') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lưa thay đổi</button>
        </form>
    </section>
    <script>
        $(document).ready(function () {
            $('#thanh_tien').val($('#don_gia').val() * $('#so_luong').val());
            $('#don_gia').on('input', function () {
                $('#thanh_tien').val($(this).val() * $('#so_luong').val());
            });
            $('#so_luong').on('input', function () {
                $('#thanh_tien').val($('#don_gia').val() * $(this).val());
            });
        });
    </script>
@endsection
