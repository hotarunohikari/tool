# a php tool
## Arr
    /**
     * Notes: 是否为关联数组
     * @param $array
     * @return bool
     */
    public static function isMap($array)

    /**
     * Notes: 查询数组中所有的键,递归
     * @param $array
     * @return mixed
     */
    public static function keys($array)

    /**
     * Notes: 查询数组中所有的值,递归
     * @param $array
     * @param array $result
     * @return array
     */
    public static function values($array, $result = [])

    /**
     * Notes: 查找数组中是否含有指定的键
     * @param $array
     * @param $key
     * @param bool $recursive 递归查找,默认否
     * @return bool
     */
    public static function hasKey($array, $key, $recursive = false)
    
    /**
     * Notes: 查找数组中是否含有指定的值
     * @param $array
     * @param $value
     * @param bool $recursive 递归查找,默认否
     * @return bool
     */
    public static function hasValue($array, $value, $recursive = false)

    /**
     * Notes: 只保留数组中指定键集合的键值对(非递归)
     * @param $array
     * @param $keys_array
     * @return array
     */
    public static function onlyKeys($array, $keys_array)

    /**
     * Notes: 只保留数组中指定值集合的键值对(非递归)
     * @param $array
     * @param $values_array
     * @return array
     */
    public static function onlyValues($array, $values_array)

    /**
     * Notes: 只保留数组中与指定键值集合相同的键值对(非递归)
     * @param $array
     * @param $rule_array
     * @return array
     */
    public static function onlySame($array, $rule_array)

    /**
     * Notes: 移除数组中指定键集合的键值对(非递归)
     * @param $array
     * @param $keys_array
     * @return array
     */
    public static function exceptKeys($array, $keys_array)
    
    /**
     * Notes: 移除数组中指定值集合的键值对(非递归)
     * @param $array
     * @param $values_array
     * @return array
     */
    public static function exceptValues($array, $values_array)

    /**
     * Notes: 移除数组中与指定键值集合相同的键值对(非递归)
     * @param $array
     * @param $rule_array
     * @return array
     */
    public static function exceptSame($array, $rule_array)

    /**
     * Notes: 向数组前端追加元素,支持['k'=>'v']和'v','k'两种方式
     * @param $array
     * @param $value
     * @param null $key
     * @return array
     */
    public static function unshift($array, $value, $key = null)

    /**
     * Notes: 向数组末端追加元素,支持['k'=>'v']和'v','k'两种方式
     * @param $array
     * @param $value
     * @param null $key
     * @return array
     */
    public static function shift($array, $value, $key = null)

    /**
     * Notes: 拆分数组的键和值
     * @param $array
     * @return array
     */
    public static function divide($array)
    
    /**
     * Notes: 数组转为querystring
     * @param $array
     * @return string
     */
    public static function toQueryString($array)

    /**
     * Notes: 数组转为json串
     * @param $array
     * @return string
     */
    public static function toJson($array)

    /**
     * Notes: 数组转字符串
     * @param $array
     * @param string $glue 分隔符
     * @return string
     */
    public static function toString($array, $glue = ',')

    /**
     * Notes: 数组转对象,便于使用->方式进行访问
     * @param $array
     * @return object
     */
    public static function toObject($array)

    /**
     * Notes: 多维数组合并为一维数组,同样的值合并为数组
     * @param array $array
     * @return mixed
     */
    public static function to1($array = [])

    /**
     * Notes: 重排数组,以指定的key作为索引,用于整理查询结果集
     * @param $array
     * @param $key
     * @return array
     */
    public static function toTable($array, $key)

    /**
     * Notes: 整理数组为树形结构,用于整理查询结果集
     * @param $items
     * @param string $id
     * @param string $pid
     * @param string $son
     * @return array
     */
    public static function toTree($items, $id = 'id', $pid = 'pid', $son = 'son')

## File

    /**
     * Notes: 递归创建目录或文件,以扩展名作为区分
     * @param $dst
     * @return bool
     */
    static function make($dst)
    
    /**
     * Notes: 递归复制目录或文件
     * @param $src
     * @param $dst
     */
    static function copy($src, $dst)

    /**
     * Notes: 递归删除目录或文件
     * @param $path
     * @param array $except 例外
     * @param bool $self 是否删除自身,默认否
     * @return bool
     */
    static function delete($path, $except = [], $self = false)
    
## File

    /**
     * 时区操作
     * @param string $area 时区名
     * @return string
     */
    static function timezone($area = null)
    
    /**
     * 统计指定月份年份的当月天数
     * @param int|string $month
     * @param int|string $year
     * @return int
     */
    static function countDaysInMonth($month, $year)
    
    /**
     * 检查指定日期是否合法
     * @param int|string $year
     * @param int|string $month
     * @param int|string $day
     * @return bool
     */
    static function isLegalDate($year, $month, $day)
    
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
    static function isLegalDateTime($year, $month, $day, $hour = "00", $minute = "00", $second = "00")

    /**
     * 检查形如 "Y-m-d H:i:s" 的字符串是否为合法时间
     * @param string $timestr
     * @return bool
     */
    static function isLegaldateTimeStr($timestr)

    /**
     * 给定日期字符串转换为统一格式
     * @param string $raw 字符串,形如 2018-11-13 、2018、2017/04/05、2015.5 等不规范的格式
     * @param string $delimiter 分隔符,当前函数能够识别 横线- 点.和斜杠/ 三种格式
     * @return string 一个格式统一化的字符串, 用横线-分隔开
     */
    static function fixDate($raw, $delimiter = null)

    /**
     * 给定时间字符串转换为统一格式
     * @param string $raw 字符串,形如 19 、19.5、8/2/3、15-5 等不规范的格式
     * @param string $delimiter 分隔符,当前函数能够识别 横线- 点. 斜杠/ 和冒号 四种格式
     * @return string 一个格式统一化的字符串, 用横线-分隔开
     */
    static function fixTime($raw, $delimiter = null)

    /**
     * 给定日期时间字符串转换为统一格式
     * @param string $raw 字符串,形如 19 、19.5、8/2/3、15-5 等不规范的格式
     * @return string 格式统一化的字符串, 格式为 Y-m-d H:i:s 或 H:i:s
     */
    static function fixDateTime($raw)

    /**
     * 转化为时间戳
     * @param int|string $raw 时间戳/时间串, 字符串形如 2018-11-13 8:05:06 或 8:05:06
     * @return int 返回时间戳,如果输入的是时分秒,则返回当天时分秒的时间戳,格式错误返回0
     */
    static function toTimestamp($raw = null)
    
    /**
     * 转化为时间字符串
     * @param int|string $raw 时间戳/时间串, 字符串形如 2018-11-13 8:05:06 或 8:05:06
     * @param string $format 字符串格式
     * @return int 返回时间戳,如果输入的是时分秒,则返回当天时分秒的时间戳,格式错误返回原内容
     */
    static function toDateTimeStr($raw = null, $format = self::SF)

    /**
     * 指定时间点是否早于指定日期
     * @param string|int $date_point 作为标准的时间点,支持字符串和时间戳
     * @param string|int|null $date_time 用于比较的时间点，默认当前时间
     * @return bool
     */
    static function isBefore($date_point, $date_time = null)
    
    /**
     * 指定时间点是否晚于指定日期
     * @param string|int $date_point 作为标准的时间点,支持字符串和时间戳
     * @param string|int|null $date_time 用于比较的时间点，默认当前时间
     * @return bool
     */
    static function isAfter($date_point, $date_time = null)

    /**
     * 指定时间戳是否在给定日期区域内
     * @param string $start 起始日期 "2019-10-11"
     * @param string $end 结束日期 "2019-12-31"
     * @param int|string|null $date_time 时间戳/时间串,默认当前时间
     * @return bool
     */
    static function isBetween($start, $end, $date_time = null)

    /**
     * 指定时间是否同一天
     * @param int|string $date_time1 时间戳/时间串
     * @param int|string $date_time2 时间戳/时间串
     * @return bool
     */
    static function isSameDay($date_time1, $date_time2)

    /**
     * 指定时间戳是否在给定时间区域内
     * @param string $start 起始时间,形如 "09:00" 或 "09:00:00"
     * @param string $end 结束时间，形如 "17:00" 或 "17:00:00"
     * @param int|string $date_time 时间戳/时间串,默认当前时间
     * @return bool
     */
    static function inRange($start, $end, $date_time = null)

    /**
     * 指定时间戳是否早于指定时间
     * @param string|int $time_point 形如 "09:00" 或 给定一个时间戳
     * @param string|int $date_time 时间戳/时间串,默认当前时间
     * @return bool
     */
    static function isEarly($time_point, $date_time = null)
    
    /**
     * 指定时间戳是否晚于指定时间
     * @param string|int $time_point 形如 "09:00" 或 给定一个时间戳
     * @param string|int $date_time 时间戳/时间串,默认当前时间
     * @return bool
     */
    static function isLate($time_point, $date_time = null)
    
    /**
     * 判断指定日期是某周的第几天,0为周日,1为周一,最大为6
     * @param null $date_time
     * @return false|string
     */
    static function whichDayOfWeek($date_time = null)
    
    /**
     * 判断指定日期是某月的第几天
     * @param null $date_time
     * @return false|string
     */
    static function whichDayOfMonth($date_time = null)

    /**
     * 判断指定日期是某年的第几天
     * @param null $date_time
     * @return false|string
     */
    static function whichDayOfYear($date_time = null)

    /**
     * 判断两个指定时间点的间隔
     * @param int|string $time_point 日期1
     * @param null $date_time 日期2 默认当前时间
     * @param int $unit 单位,默认为秒
     * @return string|null
     */
    static function step($time_point, $date_time = null, $unit = self::SECOND)

    /**
     * 判断指定年份是否为闰年
     * @param int|string $year 指定年份
     * @return bool
     */
    static function isLeapYear($year)
    
## Str

    /**
     * 检查字符串中是否包含某些字符串
     * @param string $haystack
     * @param string|array $needles
     * @return bool
     */
    public static function contains(string $haystack, $needles)

    /**
     * 检查字符串是否以某些字符串结尾
     *
     * @param string $haystack
     * @param string|array $needles
     * @return bool
     */
    public static function endsWith(string $haystack, $needles)

    /**
     * 检查字符串是否以某些字符串开头
     *
     * @param string $haystack
     * @param string|array $needles
     * @return bool
     */
    public static function startsWith(string $haystack, $needles)

    /**
     * 获取指定长度的随机字母数字组合的字符串
     *
     * @param int $length
     * @param int $type
     * @param string $addChars
     * @return string
     */
    public static function random(int $length = 6, int $type = null, string $addChars = '')

    /**
     * 字符串转小写
     *
     * @param $string
     * @return string
     */
    public static function lower($string)

    /**
     * 字符串转大写
     *
     * @param $string
     * @return string
     */
    public static function upper($string)

    /**
     * 获取字符串的长度
     *
     * @param $string
     * @return int
     */
    public static function length($string)

    /**
     * 截取字符串
     *
     * @param string $string
     * @param int $start
     * @param int|null $length
     * @return string
     */
    public static function substr(string $string, int $start, int $length = null)
    
    /**
     * 驼峰转下划线
     *
     * @param $string
     * @param string $delimiter
     * @return string
     */
    public static function snake($string, string $delimiter = '_')

    /**
     * 下划线转驼峰(首字母小写)
     *
     * @param $string
     * @return string
     */
    public static function camel($string)

    /**
     * 下划线转驼峰(首字母大写)
     *
     * @param $string
     * @return string
     */
    public static function studly($string)

    /**
     * 字符串转数组,优先尝试json转字符串,其次尝试使用分隔符转数组
     * @param $string
     * @param string $glue
     * @return mixed
     */
    public static function toArr($string,$glue = ',')
    
    /**
     * 生成uuid
     * @param string $prefix
     * @return string
     */
    static function uuid($prefix = '')

    /**
     * 去除所有的空格
     * @param $string
     * @return string|string[]
     */
    static function nospace($string)
