<?php

namespace drTool;

class Arr
{

    /**
     * Notes: 是否为关联数组
     * @param $array
     * @return bool
     */
    public static function isMap($array) {
        $keys = array_keys($array);
        return array_keys($keys) !== $keys;
    }

    /**
     * Notes: 查询数组中所有的键
     * @param $array
     * @return mixed
     */
    public static function keys($array) {
        static $result;
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                $result[] = $k;
                if (is_array($v)) {
                    self::keys($v);
                }
            }
        }
        return $result;
    }

    /**
     * Notes: 查询数组中所有的值
     * @param $array
     * @param array $result
     * @return array
     */
    public static function values($array, $result = []) {
        if (is_array($array)) {
            array_walk_recursive($array, function ($value) use (&$result) {
                array_push($result, $value);
            });
        }
        return $result;
    }

    /**
     * Notes: 查找数组中是否含有指定的键
     * @param $array
     * @param $key
     * @param bool $recursive 递归查找,默认否
     * @return bool
     */
    public static function hasKey($array, $key, $recursive = false) {
        return $recursive ? in_array($key, self::keys($array)) : array_key_exists($key, $array);
    }

    /**
     * Notes: 查找数组中是否含有指定的值
     * @param $array
     * @param $value
     * @param bool $recursive 递归查找,默认否
     * @return bool
     */
    public static function hasValue($array, $value, $recursive = false) {
        return $recursive ? in_array($value, self::values($array)) : in_array($value, $array);
    }

    /**
     * Notes: 只保留数组中指定键集合的键值对(非递归)
     * @param $array
     * @param $keys_array
     * @return array
     */
    public static function onlyKeys($array, $keys_array) {
        return array_intersect_key($array, array_flip((array)$keys_array));
    }

    /**
     * Notes: 只保留数组中指定值集合的键值对(非递归)
     * @param $array
     * @param $values_array
     * @return array
     */
    public static function onlyValues($array, $values_array) {
        return array_intersect($array, (array)$values_array);
    }

    /**
     * Notes: 只保留数组中与指定键值集合相同的键值对(非递归)
     * @param $array
     * @param $rule_array
     * @return array
     */
    public static function onlySame($array, $rule_array){
        return array_intersect_assoc($array, (array)$rule_array);
    }

    /**
     * Notes: 移除数组中指定键集合的键值对(非递归)
     * @param $array
     * @param $keys_array
     * @return array
     */
    public static function exceptKeys($array, $keys_array) {
        return array_diff_key($array, array_flip((array)$keys_array));
    }

    /**
     * Notes: 移除数组中指定值集合的键值对(非递归)
     * @param $array
     * @param $values_array
     * @return array
     */
    public static function exceptValues($array, $values_array) {
        return array_diff($array, (array)$values_array);
    }

    /**
     * Notes: 移除数组中与指定键值集合相同的键值对(非递归)
     * @param $array
     * @param $rule_array
     * @return array
     */
    public static function exceptSame($array, $rule_array){
        return array_diff_assoc($array, (array)$rule_array);
    }

    /**
     * Notes: 向数组前端追加元素,支持['k'=>'v']和'v','k'两种方式
     * @param $array
     * @param $value
     * @param null $key
     * @return array
     */
    public static function unshift($array, $value, $key = null) {
        if (is_array($value)) {
            return $value + $array;
        }
        if (is_null($key)) {
            array_unshift($array, $value);
        } else {
            $array = [$key => $value] + $array;
        }
        return $array;
    }

    /**
     * Notes: 向数组末端追加元素,支持['k'=>'v']和'v','k'两种方式
     * @param $array
     * @param $value
     * @param null $key
     * @return array
     */
    public static function shift($array, $value, $key = null) {
        if (is_array($value)) {
            return $array + $value;
        }
        if (is_null($key)) {
            array_push($array, $value);
        } else {
            $array = $array + [$key => $value];
        }
        return $array;
    }

    /**
     * Notes: 拆分数组的键和值
     * @param $array
     * @return array
     */
    public static function divide($array) {
        return [
            array_keys($array),
            array_values($array)
        ];
    }

    /**
     * Notes: 数组转为querystring
     * @param $array
     * @return string
     */
    public static function toQueryString($array) {
        return http_build_query($array, null, '&', PHP_QUERY_RFC3986);
    }

    /**
     * Notes: 数组转为querystring
     * @param $array
     * @return string
     */
    public static function toJson($array) {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Notes: 数组转字符串
     * @param $array
     * @param string $glue
     * @return string
     */
    public static function toString($array, $glue = ',') {
        return implode($glue, $array);
    }

    /**
     * Notes: 数组转对象,便于使用->方式进行访问
     * @param $array
     * @return object
     */
    public static function toObject($array) {
        if (!is_array($array)) {
            return $array;
        }
        foreach ($array as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $array[$k] = (object)self::toObject($v);
            }
        }
        return (object)$array;
    }

    /**
     * Notes: 多维数组合并为一维数组,同样的值合并为数组
     * @param array $array
     * @return mixed
     */
    public static function to1($array = []) {
        static $result;
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    $result = self::to1($v);
                } else {
                    $result[$k] = key_exists($k, $result) ? array_merge([$result[$k]], [$v]) : $v;
                }
            }
        }
        return $result;
    }

    /**
     * Notes: 重排数组,以指定的key作为索引,用于整理查询结果集
     * @param $array
     * @param $key
     * @return array
     */
    public static function toTable($array, $key) {
        $result = [];
        foreach ($array as $k => $v) {
            $result[$v[$key]] = $v;
        }
        return $result;
    }

    /**
     * Notes: 整理数组为树形结构,用于整理查询结果集
     * @param $items
     * @param string $id
     * @param string $pid
     * @param string $son
     * @return array
     */
    public static function toTree($items, $id = 'id', $pid = 'pid', $son = 'son') {
        $tree   = [];
        $tmpMap = [];
        foreach ($items as $item) {
            $tmpMap[$item[$id]] = $item;
        }
        foreach ($items as $item) {
            if (isset($tmpMap[$item[$pid]])) {
                $tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
            } else {
                $tree[] = &$tmpMap[$item[$id]];
            }
        }
        unset($tmpMap);
        return $tree;
    }

}