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
