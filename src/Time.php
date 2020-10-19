<?php

namespace drTool;

class Time
{
    const G      = CAL_GREGORIAN;
    const F      = "%Y-%m-%d %H:%M:%S"; //strftime 中的格式用的是大写M和大写S表示分秒,而不是小写i和小写s
    const SF     = "Y-m-d H:i:s";
    const DAY    = 86400;
    const HOUR   = 3600;
    const MINUTE = 60;
    const SECOND = 1;

    /**
     * 时区操作
     * @param string $area 时区名
     * @return string
     */
    static function timezone($area = null) {
        return is_null($area) ? date_default_timezone_get() : date_default_timezone_set($area);
    }

    /**
     * 统计指定月份年份的当月天数
     * @param int|string $month
     * @param int|string $year
     * @return int
     */
    static function countDaysInMonth($month, $year) {
        return cal_days_in_month(static::G, $month, $year);
    }

    /**
     * 检查指定日期是否合法
     * @param int|string $year
     * @param int|string $month
     * @param int|string $day
     * @return bool
     */
    static function isLegalDate($year, $month, $day) {
        return checkdate($month, $day, $year);
    }

    /**
     * 检查指定时间是否为合法时间
     * @param int|string $year
     * @param int|string $month
     * @param int|string $day
     * @param int|string $hour
     * @param int|string $minute
     * @param int|string $second
     * @return bool
     */
    static function isLegalDateTime($year, $month, $day, $hour = "00", $minute = "00", $second = "00") {
        $fmonth  = str_pad($month, 2, 0, STR_PAD_LEFT);
        $fday    = str_pad($day, 2, 0, STR_PAD_LEFT);
        $fhour   = str_pad($hour, 2, 0, STR_PAD_LEFT);
        $fminute = str_pad($minute, 2, 0, STR_PAD_LEFT);
        $fsecond = str_pad($second, 2, 0, STR_PAD_LEFT);
        // 利用 mktime 都会对越界参数进行自动修正原理
        return "$year-$fmonth-$fday $fhour:$fminute:$fsecond" == strftime(self::F, mktime($hour, $minute, $second, $month, $day, $year));
    }

    /**
     * 检查形如 "Y-m-d H:i:s" 的字符串是否为合法时间
     * @param string $timestr
     * @return bool
     */
    static function isLegaldateTimeStr($timestr) {
        $timestamp = strtotime(str_replace(' ', '', $timestr));
        if (!$timestamp) {
            return false;
        }
        return date(self::SF, $timestamp) == $timestr;
    }

    /**
     * 给定日期字符串转换为统一格式
     * @param string $raw 字符串,形如 2018-11-13 、2018、2017/04/05、2015.5 等不规范的格式
     * @param string $delimiter 分隔符,当前函数能够识别 横线- 点.和斜杠/ 三种格式
     * @return string 一个格式统一化的字符串, 用横线-分隔开
     */
    static function fixDate($raw, $delimiter = null) {
        if ($delimiter) {
            $raw_arr = explode($delimiter, $raw);
        } else {
            if (strstr($raw, '.')) {
                $raw_arr = explode('.', $raw);
            } else if (strstr($raw, '/')) {
                $raw_arr = explode('/', $raw);
            } else {
                $raw_arr = explode('-', $raw);
            }
        }
        $raw_arr = array_pad($raw_arr, 3, '00');
        $raw_arr = array_map(function ($str) {
            return str_pad(str_replace(' ', '', $str), 2, 0, STR_PAD_LEFT);
        }, $raw_arr);
        return implode('-', $raw_arr);
    }

    /**
     * 给定时间字符串转换为统一格式
     * @param string $raw 字符串,形如 19 、19.5、8/2/3、15-5 等不规范的格式
     * @param string $delimiter 分隔符,当前函数能够识别 横线- 点. 斜杠/ 和冒号 四种格式
     * @return string 一个格式统一化的字符串, 用横线-分隔开
     */
    static function fixTime($raw, $delimiter = null) {
        if ($delimiter) {
            $raw_arr = explode($delimiter, $raw);
        } else {
            if (strstr($raw, '.')) {
                $raw_arr = explode('.', $raw);
            } else if (strstr($raw, '/')) {
                $raw_arr = explode('/', $raw);
            } else if (strstr($raw, '-')) {
                $raw_arr = explode('-', $raw);
            } else {
                $raw_arr = explode(':', $raw);
            }
        }
        $raw_arr = array_pad($raw_arr, 3, '00');
        $raw_arr = array_map(function ($str) {
            return str_pad(str_replace(' ', '', $str), 2, 0, STR_PAD_LEFT);
        }, $raw_arr);
        return implode(':', $raw_arr);
    }

    /**
     * 给定时间字符串转换为统一格式
     * @param string $raw 字符串,形如 19 、19.5、8/2/3、15-5 等不规范的格式
     * @return string 格式统一化的字符串, 格式为 Y-m-d H:i:s 或 H:i:s
     */
    static function fixDateTime($raw) {
        $hyphen_pos = strpos($raw, '-');
        $colon_pos  = strpos($raw, ':');
        if ($hyphen_pos && $colon_pos) {
            $raw_arr = explode(' ', $raw);
            return self::fixDate($raw_arr[0]) . ' ' . self::fixTime($raw_arr[1] ?? '');
        }
        if ($hyphen_pos && !$colon_pos) {
            return self::fixDate($raw);
        }
        if (!$hyphen_pos && $colon_pos) {
            return self::fixTime($raw);
        }
        return $raw;
    }

    /**
     * 转化为时间戳
     * @param int|string $raw 时间戳/时间串, 字符串形如 2018-11-13 8:05:06 或 8:05:06
     * @return int 返回时间戳,如果输入的是时分秒,则返回当天时分秒的时间戳,格式错误返回0
     */
    static function toTimestamp($raw = null) {
        $trimed_raw = str_replace(' ', '', $raw);
        if (!$raw) {
            return time();
        }
        if (is_numeric($trimed_raw)) {
            return $trimed_raw;
        }
        $fixed_raw = self::fixDateTime($raw);
        if (self::isLegaldateTimeStr($fixed_raw)) {
            return strtotime($fixed_raw);
        }
        if (self::isLegaldateTimeStr($fixed_raw . ' ' . '00:00:00')) {
            return strtotime($fixed_raw);
        }
        if (self::isLegaldateTimeStr(date('Y-m-d') . ' ' . $fixed_raw)) {
            return strtotime(date('Y-m-d') . ' ' . $fixed_raw);
        }
        return 0;
    }

    /**
     * 转化为时间字符串
     * @param int|string $raw 时间戳/时间串, 字符串形如 2018-11-13 8:05:06 或 8:05:06
     * @param string $format 字符串格式
     * @return int 返回时间戳,如果输入的是时分秒,则返回当天时分秒的时间戳,格式错误返回原内容
     */
    static function toDateTimeStr($raw = null, $format = self::SF) {
        $trimed_raw = str_replace(' ', '', $raw);
        if (!$raw || is_numeric($trimed_raw)) {
            return date($format);
        }
        $fixed_raw = self::fixDateTime($trimed_raw);
        if (self::isLegaldateTimeStr($fixed_raw)) {
            return strtotime($fixed_raw);
        }
        if (self::isLegaldateTimeStr(date('Y-m-d') . ' ' . $fixed_raw)) {
            return date($format, strtotime($fixed_raw));
        }
        return $raw;
    }

    /**
     * 指定时间点是否早于指定日期
     * @param string|int $date_point 作为标准的时间点,支持字符串和时间戳
     * @param string|int|null $date_time 用于比较的时间点，默认当前时间
     * @return bool
     */
    static function isBefore($date_point, $date_time = null) {
        return self::toTimestamp($date_time) > self::toTimestamp($date_point);
    }

    /**
     * 指定时间点是否晚于指定日期
     * @param string|int $date_point 作为标准的时间点,支持字符串和时间戳
     * @param string|int|null $date_time 用于比较的时间点，默认当前时间
     * @return bool
     */
    static function isAfter($date_point, $date_time = null) {
        return self::toTimestamp($date_time) > self::toTimestamp($date_point);
    }

    /**
     * 指定时间戳是否在给定日期区域内
     * @param string $start 起始日期 "2019-10-11"
     * @param string $end 结束日期 "2019-12-31"
     * @param int|string|null $date_time 时间戳/时间串,默认当前时间
     * @return bool
     */
    static function isBetween($start, $end, $date_time = null) {
        $timestamp = self::toTimestamp($date_time);
        return (self::toTimestamp($start) < $timestamp && self::toTimestamp($end) > $timestamp);
    }

    /**
     * 指定时间是否同一天
     * @param int|string $date_time1 时间戳/时间串
     * @param int|string $date_time2 时间戳/时间串
     * @return bool
     */
    static function isSameDay($date_time1, $date_time2) {
        return date('Y-m-d', self::toTimestamp($date_time1)) == date('Y-m-d', self::toTimestamp($date_time2));
    }

    /**
     * 指定时间戳是否在给定时间区域内
     * @param string $start 起始时间,形如 "09:00" 或 "09:00:00"
     * @param string $end 结束时间，形如 "17:00" 或 "17:00:00"
     * @param int|string $date_time 时间戳/时间串,默认当前时间
     * @return bool
     */
    static function inRange($start, $end, $date_time = null) {
        $trimed_start = self::fixTime($start);
        $trimed_end   = self::fixTime($end);
        $timestamp    = self::toTimestamp($date_time);
        $date_str     = date('Y-m-d', $timestamp);
        $timeBegin    = strtotime($date_str . ' ' . $trimed_start);
        $timeEnd      = strtotime($date_str . ' ' . $trimed_end);
        return ($timestamp >= $timeBegin && $timestamp <= $timeEnd);
    }

    /**
     * 指定时间戳是否早于指定时间
     * @param string|int $time_point 形如 "09:00" 或 给定一个时间戳
     * @param string|int $date_time 时间戳/时间串,默认当前时间
     * @return bool
     */
    static function isEarly($time_point, $date_time = null) {
        return self::inRange('00:00:00', $time_point, $date_time);
    }

    /**
     * 指定时间戳是否晚于指定时间
     * @param string|int $time_point 形如 "09:00" 或 给定一个时间戳
     * @param string|int $date_time 时间戳/时间串,默认当前时间
     * @return bool
     */
    static function isLate($time_point, $date_time = null) {
        return self::inRange($time_point, '23:59:59', $date_time);
    }

    /**
     * 判断指定日期是某周的第几天,0为周日,1为周一,最大为6
     * @param null $date_time
     * @return false|string
     */
    static function whichDayOfWeek($date_time = null) {
        return date("w", $date_time ?? time());
    }

    /**
     * 判断指定日期是某月的第几天
     * @param null $date_time
     * @return false|string
     */
    static function whichDayOfMonth($date_time = null) {
        return date("d", $date_time ?? time());
    }

    /**
     * 判断指定日期是某年的第几天
     * @param null $date_time
     * @return false|string
     */
    static function whichDayOfYear($date_time = null) {
        return date("z", $date_time ?? time());
    }

    /**
     * 判断两个指定时间点的间隔
     * @param int|string $time_point 日期1
     * @param null $date_time 日期2 默认当前时间
     * @param int $unit 单位,默认为秒
     * @return string|null
     */
    static function step($time_point, $date_time = null, $unit = self::SECOND) {
        $timestamp1 = self::toTimestamp($time_point);
        $timestamp2 = self::toTimestamp($date_time);
        $step       = bcdiv(abs($timestamp1 - $timestamp2), $unit, 2);
        return $step;
    }

    /**
     * 判断指定年份是否为闰年
     * @param int|string $year 指定年份
     * @return bool
     */
    static function isLeapYear($year) {
        $time = mktime(2, 2, 2, 2, 1, $year);
        return date("t", $time) == 29;
    }

}