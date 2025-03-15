<?php

use Illuminate\Support\Facades\Storage;

function store_file($file,$path)
{
    $name = time().$file->getClientOriginalName();
    return $value = $file->storeAs($path, $name, 'uploads');
}
function delete_file($file)
{
    if($file!='' and !is_null($file) and Storage::disk('uploads')->exists($file)){
        unlink('uploads/'.$file);
    }
}
function display_file($name)
{
    return asset('uploads').'/'.$name;
}

function formatTimeForDisplay($dateTimeString){
    $time = date("h:i", strtotime($dateTimeString));
    $newDateTime = date("A", strtotime($dateTimeString));
    $newDateTimeType = ($newDateTime === 'AM') ? 'صباحا' : 'مساء';
    return $time . ' ' . $newDateTimeType;
 }

// livewire sorting function
function getSortIcon($sortBy, $sortDir,$name)
{
    if ($sortBy !== $name ) {
        return '<i class="fa fa-sort"></i>';
    } elseif ($sortDir === 'ASC') {
        return '<i class="fa fa-sort-asc"></i>';
    } else {
        return '<i class="fa fa-sort-desc"></i>';
    }
}







// {{ ucwords(terbilang($invoice->total). __('site.R.S')) }} in blade
function terbilang($angka)
{
    $angka = abs($angka);
    $baca = [
        '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
        'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
    ];

    $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    if ($angka < 20) {
        $terbilang = ' ' . $baca[$angka];
    } elseif ($angka < 100) {
        $terbilang = ' ' . $tens[(int)($angka / 10)];
        if ($angka % 10 !== 0) {
            $terbilang .= ' ' . $baca[$angka % 10];
        }
    } elseif ($angka < 1000) {
        $terbilang = ' ' . $baca[(int)($angka / 100)] . ' Hundred';
        if ($angka % 100 !== 0) {
            $terbilang .= ' and' . terbilang($angka % 100);
        }
    } elseif ($angka < 1000000) {
        $terbilang = terbilang((int)($angka / 1000)) . ' Thousand';
        if ($angka % 1000 !== 0) {
            $terbilang .= terbilang($angka % 1000);
        }
    } elseif ($angka < 1000000000) {
        $terbilang = terbilang((int)($angka / 1000000)) . ' Million';
        if ($angka % 1000000 !== 0) {
            $terbilang .= terbilang($angka % 1000000);
        }
    } elseif ($angka < 1000000000000) {
        $terbilang = terbilang((int)($angka / 1000000000)) . ' Billion';
        if ($angka % 1000000000 !== 0) {
            $terbilang .= terbilang($angka % 1000000000);
        }
    } else {
        $terbilang = 'Number is too large to convert.';
    }

    return $terbilang;
}

