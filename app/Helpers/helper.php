<?php

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

if (!function_exists('returnMessage')) {
    /**
     * @param int $type
     * @param mixed $data
     * @param string $message
     * @return array
     */
    function returnMessage(int $type, mixed $data, string $message): array
    {
        if ($type === 1) {
            $data = [
                'type' => 'success',
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ];
        } else {
            $data = [
                'type' => 'error',
                'status' => 'error',
                'message' => $message,
                'data' => $data,
            ];
        }

        return $data;
    }
}

if (!function_exists('setting')) {
    function setting(): ?Setting
    {
        if (Schema::hasTable('settings')) {
            return Setting::first();
        }

        return null;
    }
}

if (!function_exists('getRoleUser')) {
    function getRoleUser()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $role_user = RoleUser::where('user_id', $user->id)->first();
            if ($role_user) {
                $role = Role::where('id', $role_user->role_id)->first();
                return $role->name;
            }
        }

        return null;
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuyvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateRandomNumber($length): string
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('convertNumber')) {
    function convertNumber($num): string
    {
        if ($num >= 1 && $num <= 10) {
            return '000' . $num;
        } elseif ($num >= 11 && $num <= 99) {
            return '00' . $num;
        } elseif ($num >= 100 && $num <= 999) {
            return '0' . $num;
        } else {
            return (string)$num;
        }
    }

    function generateCode($num): string
    {
        return 'DH' . convertNumber($num);
    }

    function generateProductCode($num): string
    {
        return 'TTH' . convertNumber($num);
    }

    function generateLSXCode($num): string
    {
        return 'LSX' . convertNumber($num);
    }

    function generateLHXCode($num): string
    {
        return 'LH' . convertNumber($num);
    }
}

if (!function_exists('updateTonKho')) {
    function updateTonKho(): ?string
    {
        if (Schema::hasTable('lich_su_ton_khos')) {
            return 'ok';
        }

        return null;
    }
}

if (!function_exists('parseNumber')) {
    function parseNumber($num): ?string
    {
        if (!is_numeric($num)) {
            return 0;
        }

        // Ép kiểu về float để xử lý phần thập phân
        $num = (float)$num;

        // Nếu là số nguyên
        if (fmod($num, 1) == 0) {
            return number_format($num, 0);
        }

        // Tách phần thập phân
        $decimalPart = explode('.', (string)$num)[1] ?? '';

        // Loại bỏ số 0 ở cuối phần thập phân
        $decimalPart = rtrim($decimalPart, '0');

        // Đếm số chữ số thập phân còn lại (tối đa 3)
        $decimalLength = min(strlen($decimalPart), 3);

        return number_format($num, $decimalLength);
    }
}

if (!function_exists('convert_number_to_words')) {
    function convert_number_to_words($number)
    {
        $hyphen = ' ';
        $conjunction = ' ';
        $separator = ' ';
        $negative = 'âm ';
        $decimal = ' phẩy ';
        $dictionary = [
            0 => 'không',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín',
            10 => 'mười',
            11 => 'mười một',
            12 => 'mười hai',
            13 => 'mười ba',
            14 => 'mười bốn',
            15 => 'mười lăm',
            16 => 'mười sáu',
            17 => 'mười bảy',
            18 => 'mười tám',
            19 => 'mười chín',
            20 => 'hai mươi',
            30 => 'ba mươi',
            40 => 'bốn mươi',
            50 => 'năm mươi',
            60 => 'sáu mươi',
            70 => 'bảy mươi',
            80 => 'tám mươi',
            90 => 'chín mươi',
            100 => 'trăm',
            1000 => 'nghìn',
            1000000 => 'triệu',
            1000000000 => 'tỷ'
        ];

        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = '';

        if (strpos((string)$number, '.') !== false) {
            list($number, $fraction) = explode('.', (string)$number);
        } else {
            $fraction = null;
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    if ($units == 1) $string .= $conjunction . 'mốt';
                    else if ($units == 5) $string .= $conjunction . 'lăm';
                    else $string .= $conjunction . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = (int)($number / 100);
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' trăm';
                if ($remainder) {
                    if ($remainder < 10) {
                        $string .= $conjunction . 'lẻ ' . convert_number_to_words($remainder);
                    } else {
                        $string .= $conjunction . convert_number_to_words($remainder);
                    }
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $separator . convert_number_to_words($remainder);
                }
                break;
        }

        if ($fraction !== null) {
            $string .= $decimal;
            $words = [];
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return trim($string);
    }

}
