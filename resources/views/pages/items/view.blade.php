@extends('layouts.master')
@section('title')
    {{ __('admin.Dashboard') }}
@endsection
@section('content')
    <style>
        .scale-container {
            width: 100%;
            transform-origin: top left;
            transition: transform 0.2s ease-in-out;
        }

        @media screen and (min-width: 1200px) {
            .scale-container {
                transform: scale(0.7);
            }
        }

        @media screen and (max-width: 1199px) {
            .scale-container {
                transform: scale(0.6);
            }
        }
    </style>

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

        <div class="col-12" style="max-height: 70vh; overflow: auto">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-primary mt-3" onclick="printItems()">
                            <i class="bi bi-printer"></i>
                        </button>
                    </div>
                    <div class="scale-container pt-5 pb-5 mx-4">
                        <div id="print" class="print small">
                            <div class="d-flex justify-content-center mb-3">
                                <div class="">
                                    <p class="h2 fw-bold">INBOUND VIETNAM TRAVEL CO., LTD</p>
                                    <p><strong>Địa chỉ</strong>: No 16 Nguyen Van Ngoc Street, Cong Vi, Ba Dinh, Hanoi
                                    </p>
                                    <p><strong>Điện thoại</strong>: 0243.5533.999 - <strong>Hotline</strong>: 19000039
                                    </p>
                                    <p class="h3 text-center fw-bold mt-5 mb-4">
                                        PHIẾU DỊCH VỤ TƯ VẤN<br>
                                        (CONSULTING SERVICE RECEIPT)
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div class="">
                                    <strong class="me-4">Mã đơn hàng/Order code:</strong> {{ $item->ma_don_hang }}
                                </div>
                                <div class="">
                                    <strong
                                        class="me-4">Ngày/Date:</strong> {{ \Carbon\Carbon::parse($item->created_at)->format('h:m d/m/Y') }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div class="">
                                    <strong class="me-4">Khách hàng/Customer:</strong> {{ $item->ten_khach_hang }}
                                </div>
                                <div class="">
                                    <strong class="me-4">Điện thoại/Mobile:</strong> {{ $item->so_dien_thoai }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2 mb-5">
                                <div class="">
                                    <strong class="me-4">Địa chỉ/Address:</strong> {{ $item->dia_chi }}
                                </div>
                                <div class="">
                                    <strong class="me-4">Email:</strong> {{ $item->email }}
                                </div>
                            </div>

                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="12%">
                                    <col width="8%">
                                    <col width="9%">
                                    <col width="9%">
                                    <col width="9%">
                                    <col width="6%">
                                    <col width="7%">
                                    <col width="10%">
                                    <col width="6%">
                                    <col width="11%">
                                    <col width="4%">
                                    <col width="x">
                                </colgroup>
                                <tr class="text-center align-middle">
                                    <th>Tên khách<br>(Customer)</th>
                                    <th>Quốc tịch<br>(Nationality)</th>
                                    <th>Hộ chiếu<br>(Passport)</th>
                                    <th>Loại visa<br>(Visa type)</th>
                                    <th>Mục đích<br>(Purpose)</th>
                                    <th>Số lượng<br>(Q'ty)</th>
                                    <th>Đơn giá<br>(Unit price)</th>
                                    <th>Thành tiền<br>(Amount)</th>
                                    <th>Loại tiền<br>(Currency)</th>
                                    <th>Quy đổi<br>(Converted money)</th>
                                    <th>VAT</th>
                                    <th>Phải trả<br>(Total amount)</th>
                                </tr>
                                <tr class="align-middle">
                                    <td>{{ $item->ten_khach_hang }}</td>
                                    <td>{{ $item->quoc_tich }}</td>
                                    <td>{{ $item->cccd }}</td>
                                    <td>{{ $item->loai_dich_vu }}</td>
                                    <td>{{ $item->dich_vu }}</td>
                                    <td>{{ number_format($item->so_luong, 0) }}</td>
                                    <td>{{ number_format($item->don_gia, 0) }} VND</td>
                                    <td>{{ number_format($item->thanh_tien, 0) }} VND</td>
                                    <td>{{ $item->loai_tien }}</td>
                                    <td>{{ number_format($item->quy_doi, 0) }} VND</td>
                                    <td>{{ $item->vat }} %</td>
                                    <td>{{ number_format($item->phai_tra, 0) }} VND</td>
                                </tr>
                                <tr class="align-middle">
                                    <td colspan="10" style="text-align: start;"><strong>Tổng</strong></td>
                                    <td><strong></strong></td>
                                    <td><strong>{{ number_format($item->phai_tra, 0) }} VND</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="12" style="text-align: right;">
                                    <span class="fw-bold">
                                        <u class="me-1">Viết bằng chữ:</u> <i>{{ convert_number_to_words($item->phai_tra) }} đồng</i>
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="12" style="text-align: right;">
                                        <strong>Tỷ giá: {{ $item->loai_tien }} = {{ number_format($item->ti_gia, 0) }}
                                            VND</strong>
                                    </td>
                                </tr>
                            </table>

                            <p class="text-end" style="margin-top: 2.5%">Ngày {{ \Carbon\Carbon::now()->get('day') }}
                                tháng {{ \Carbon\Carbon::now()->get('month') }}
                                năm {{ \Carbon\Carbon::now()->get('year') }}</p>
                            <table class="w-100 mt-3" style="margin-bottom: 10%">
                                <colgroup>
                                    <col width="33%">
                                    <col width="33%">
                                    <col width="33%">
                                </colgroup>
                                <tr class="text-center">
                                    <td>
                                        <strong>Người lập phiếu<br>(Salesman)</strong>
                                    </td>
                                    <td>
                                        <strong>Khách hàng xác nhận<br>(Payer)</strong>
                                    </td>
                                    <td>
                                        <strong>Thủ Quỹ<br>(Treasurer)</strong>
                                    </td>
                                </tr>
                            </table>

                            <div class="">
                                <p><i>Xin trân trọng cảm ơn! Thank you!</i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
