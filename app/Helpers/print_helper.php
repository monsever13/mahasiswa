<?php
if (!function_exists('generatePrintUrl')) {
    function generatePrintUrl($baseUrl, $filters = [])
    {
        $queryParams = [];
        
        if (!empty($filters['matakuliah'])) {
            $queryParams[] = 'matakuliah=' . $filters['matakuliah'];
        }
        if (!empty($filters['dosen'])) {
            $queryParams[] = 'dosen=' . $filters['dosen'];
        }
        if (!empty($filters['tahun'])) {
            $queryParams[] = 'tahun=' . $filters['tahun'];
        }
        if (!empty($filters['semester'])) {
            $queryParams[] = 'semester=' . $filters['semester'];
        }
        
        if (empty($queryParams)) {
            return $baseUrl . '/print';
        }
        
        return $baseUrl . '/print?' . implode('&', $queryParams);
    }
}