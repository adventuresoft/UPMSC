<?php

if(! function_exists('people_constant_option')){
    function people_constant_option($option_name=null){
        $records = [
            'birth_place' => [
                1 => 'Inside of Country',
                2 => 'Outside of Country',
            ],
            'gender' => [
                1 => 'Male',
                2 => 'Female',
                3 => 'Others'
            ],
            'religion' => [
                1 => 'Islam',
                2 => 'Hindu',
                3 => 'Buddhist',
                4 => 'Christian',
                5 => 'Others'
            ],

            'blood_group' => [
                1 => 'A+',
                2 => 'A-',
                3 => 'B+',
                4 => 'B-',
                5 => 'AB+',
                6 => 'AB-',
                7 => 'O+',
                8 => 'O-'
            ],

        ];
        if ($option_name) {
            return $records[$option_name];
        } else {
            return $records;
        }

    }
}

if (! function_exists('certificate_user')) {
    function certificate_user($certificate)
    {
        return $certificate->user ?? null;
    }
}

if (! function_exists('certificate_address_info')) {
    function certificate_address_info($certificate)
    {
        return certificate_user($certificate)?->addressInfo;
    }
}

if (! function_exists('certificate_location_name')) {
    function certificate_location_name($certificate, string $type, string $language = 'en'): string
    {
        $address = certificate_address_info($certificate);
        $user = certificate_user($certificate);
        $field = $language === 'bn' ? 'bn_name' : 'name';

        $location = match ($type) {
            'union' => $address?->permanentUnion ?: $user?->institute?->union,
            'thana' => $address?->permanentThana ?: $address?->permanentUnion?->thana ?: $user?->institute?->union?->thana,
            'district' => $address?->permanentDistrict ?: $address?->permanentThana?->district ?: $address?->permanentUnion?->thana?->district ?: $user?->institute?->union?->thana?->district,
            default => null,
        };

        return (string) ($location?->{$field} ?? $location?->name ?? '');
    }
}

if (! function_exists('certificate_union_name')) {
    function certificate_union_name($certificate, string $language = 'en'): string
    {
        return certificate_location_name($certificate, 'union', $language);
    }
}

if (! function_exists('certificate_thana_name')) {
    function certificate_thana_name($certificate, string $language = 'en'): string
    {
        return certificate_location_name($certificate, 'thana', $language);
    }
}

if (! function_exists('certificate_district_name')) {
    function certificate_district_name($certificate, string $language = 'en'): string
    {
        return certificate_location_name($certificate, 'district', $language);
    }
}
