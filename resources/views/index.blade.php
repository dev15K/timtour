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

        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title"><label for="inlineFormInputGroup">Tìm kiếm</label>
                    </h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-start align-items-center gap-4 w-100">
                            <div class="col-md-4 form-group">
                                <div class="d-flex justify-content-start align-items-center gap-2">
                                    <label for="ngay_search">Ngày: </label>
                                    <input type="date" class="form-control" id="ngay_search"
                                           value="" name="ngay_search">
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="keyword" name="keyword"
                                           placeholder="" value="">
                                    <label for="keyword" class="input-group-prepend">
                                        <button type="button" class="input-group-text">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-end align-items-center">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.items.create') }}">Thêm mới</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-12">
            <div class="card recent-sales overflow-auto">

                <div class="card-body">

                    <table class="table table-hover " style="min-width: 4000px">
                        <colgroup>
                            <col width="50px">
                            <col width="140px">
                            <col width="140px">
                            <col width="220px">
                            <col width="140px">
                            <col width="220px">
                            <col width="140px">
                            <col width="140px">
                            <col width="140px">
                            <col width="140px">
                            <col width="220px">
                            <col width="140px">
                            <col width="140px">
                            <col width="140px">
                            <col width="140px">
                            <col width="140px">
                            <col width="140px">
                            <col width="220px">
                            <col width="220px">
                            <col width="140px">
                            <col width="140px">
                            <col width="140px">
                            <col width="100px">
                            <col width="140px">
                            <col width="x">
                            <col width="160px">
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Mã KH</th>
                            <th scope="col">Tên KH</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Email</th>
                            <th scope="col">MST (Mã số thuế)</th>
                            <th scope="col">Dịch vụ</th>
                            <th scope="col">Nhà cung cấp</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Người đại diện</th>
                            <th scope="col">Quốc tịch</th>
                            <th scope="col">CCCD</th>
                            <th scope="col">Loại DV (Loại dịch vụ)</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Loại tiền</th>
                            <th scope="col">Tỉ giá</th>
                            <th scope="col">Quy đổi</th>
                            <th scope="col">VAT</th>
                            <th scope="col">Nhân viên xử lí</th>
                            <th scope="col">Phải trả</th>
                            <th scope="col">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $item->ma_khach_hang }}</td>
                                <td>
                                    <a href="{{ route('admin.items.view', $item->id) }}">
                                        <h5>{{ $item->ten_khach_hang }}</h5>
                                    </a>
                                </td>
                                <td>{{ $item->so_dien_thoai }}</td>
                                <td>{{ $item->dia_chi }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mst }}</td>
                                <td>{{ $item->dich_vu }}</td>
                                <td>{{ $item->nha_cung_cap }}</td>
                                <td>{{ number_format($item->tong_tien, 0) }} VND</td>
                                <td>{{ $item->nguoi_dai_dien }}</td>
                                <td>{{ $item->quoc_tich }}</td>
                                <td>{{ $item->cccd }}</td>
                                <td>{{ $item->loai_dich_vu }}</td>
                                <td>{{ $item->noi_dung }}</td>
                                <td>{{ number_format($item->so_luong, 0) }}</td>
                                <td>{{ number_format($item->don_gia, 0) }} VND</td>
                                <td>{{ number_format($item->thanh_tien, 0) }} VND</td>
                                <td>{{ $item->loai_tien }}</td>
                                <td>{{ number_format($item->ti_gia, 0) }}</td>
                                <td>{{ number_format($item->quy_doi, 0) }} VND</td>
                                <td>{{ $item->vat }} %</td>
                                <td>{{ $item->nhan_vien }}</td>
                                <td>{{ number_format($item->phai_tra, 0) }} VND</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('admin.items.detail', $item->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="{{ route('admin.items.view', $item->id) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="#"
                                           class="btn btn-warning btn-sm">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <a href="#"
                                           class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $items->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </section>
@endsection
