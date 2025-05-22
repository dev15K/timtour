<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>

    @include('inc.head')

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <style>
        .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>

<body>

<!-- ======= Header ======= -->
@include('layouts.header')
<!-- End Header -->

<!-- ======= Sidebar ======= -->
@include('layouts.sidebar')
<!-- End Sidebar-->

@include('sweetalert::alert')

<!-- ======= Main ======= -->
<main id="main" class="main">

    @yield('content')

</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
@include('layouts.footer')
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script>
    $(document).ready(function () {
        $(document).on('click', '.btnShowOrHide', function (e) {
            e.preventDefault();
            const text = $(this).text();
            if (text === 'Mở rộng') {
                $(this).text('Thu gọn');
                $(this).parent().parent().find('form').removeClass('d-none');
            } else {
                $(this).text('Mở rộng');
                $(this).parent().parent().find('form').addClass('d-none');
            }
        });

        $('.onlyNumber').on('keypress', function (e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9.]/.test(char)) {
                e.preventDefault(); // Chặn ký tự không hợp lệ
            }
        }).on('input', function () {
            $(this).val(function (i, val) {
                return val.replace(/[^0-9.]/g, ''); // Xoá ký tự không hợp lệ
            });
        });
    })
</script>
<script>
    function printItems() {
        const html = $('#print').clone();

        const printWindow = window.open("", "_blank");

        printWindow.document.open();
        printWindow.document.write(`
        <html>
        <head>
            <title>In phiếu</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <style>
                @media print {
                    body {
                        margin: 0;
                        padding: 10px;
                       zoom: 0.9;
                        transform-origin: top left;
                    }

                    .print {
                        width: 100%;
  font-size: 0.8em !important;
            box-sizing: border-box;
            overflow-wrap: break-word;
            word-wrap: break-word;
                    }

.header_info{
text-wrap: nowrap;
}

                    table {
                        width: 100% !important;
                        table-layout: fixed;
                    }
.d-flex {
        display: flex !important;
    }

    .justify-content-between {
        justify-content: space-between !important;
    }

    .d-flex > div {
        width: 48%;
        word-break: break-word;
    }

                    th, td {
                        word-wrap: break-word;
                        white-space: normal;
                    }

                    * {
                        box-sizing: border-box;
                    }
                }

                body {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    padding: 20px;
                }

                .small {
                    font-size: 0.5em !important;
                }
.signature {
margin-bottom: 100px !important;
}
            </style>
        </head>
        <body>
            ${html.html()}
        </body>
        </html>
    `);

        printWindow.document.close();

        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    }
</script>
<!-- Vendor JS Files -->
<script src="{{ asset('admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('admin/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('admin/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('admin/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('admin/js/main.js') }}"></script>
</body>

</html>
