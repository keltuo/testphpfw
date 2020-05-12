<?php


namespace App\Helpers;

/**
 * Class MemoryCheck
 */
class MemoryCheck {
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->formatBytes(memory_get_peak_usage());
    }

    /**
     * @param $bytes
     * @param int $precision
     * @return string
     */
    public function formatBytes($bytes, $precision = 2) {
        $units = array("b", "kb", "mb", "gb", "tb");

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . " " . $units[$pow];
    }

}
