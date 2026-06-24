<?php

if(! function_exists('family_constant_option')){
    function family_constant_option($option_name=null){
        $records = [
            'live_status' => [
                1 => 'Live',
                2 => 'Late',
                3 => 'Unknown',
            ],
            'marital_status' => [
                1 => 'Unmarried',
                2 => 'Married',
                3 => 'Widowed',
                4 => 'Divorced',
            ],
            'marital_status_bn' => [
                1 => 'অবিবাহিত',
                2 => 'বিবাহিত',
                3 => 'বিধবা/বিপত্নীক',
                4 => 'তালাকপ্রাপ্ত',
            ],
        ];
        if ($option_name) {
            return $records[$option_name];
        } else {
            return $records;
        }
        
    }
}

if(! function_exists('family_marital_status_label')){
    function family_marital_status_label($status = null, $lang = 'en'){
        $labels = [
            'en' => [
                1 => 'Unmarried',
                2 => 'Married',
                3 => 'Widowed',
                4 => 'Divorced',
            ],
            'bn' => [
                1 => 'অবিবাহিত',
                2 => 'বিবাহিত',
                3 => 'বিধবা/বিপত্নীক',
                4 => 'তালাকপ্রাপ্ত',
            ],
        ];

        $statusMap = [
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            'single' => 1,
            'unmarried' => 1,
            'married' => 2,
            'widowed' => 3,
            'widower' => 3,
            'divorced' => 4,
            'অবিবাহিত' => 1,
            'বিবাহিত' => 2,
            'বিধবা' => 3,
            'বিপত্নীক' => 3,
            'তালাকপ্রাপ্ত' => 4,
        ];

        if (is_string($status)) {
            $normalized = strtolower(trim($status));
            $status = $statusMap[$normalized] ?? ($statusMap[$status] ?? null);
        }

        $lang = in_array($lang, ['en', 'bn']) ? $lang : 'en';
        return $labels[$lang][$status] ?? '';
    }
}

if(! function_exists('family_live_status')){
    function family_live_status($status=1){
        switch ($status) {
            case 1:
                return '';
                break;

            case 2:
                return 'Late';
                break;

            case 3:
                return 'Unknown';
                break;
            
            default:
                return '';
                break;
        }
    }
}
