<?php

namespace drTool;

class File
{

    /**
     * Notes: 递归创建目录或文件,以扩展名作为区分
     * @param $dst
     * @return bool
     */
    static function make($dst) {
        if(!file_exists($dst)){
            if(strstr($dst,'.')){
                mkdir(dirname($dst), 0755, true);
                fopen($dst,'x+');
                return true;
            }
            mkdir($dst, 0755, true);
            return true;
        }
        return false;
    }

    /**
     * Notes: 递归复制目录或文件
     * @param $src
     * @param $dst
     */
    static function copy($src, $dst) {
        if (is_file($src)) {
            !is_dir(dirname($dst)) && mkdir(dirname($dst), 0755, true);
            copy($src, $dst);
        } else {
            !file_exists($dst) && mkdir($dst, 0755, true);
            $files = scandir($src);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $srcf = $src . '/' . $file;
                    $dstf = $dst . '/' . $file;
                    self::copy($srcf, $dstf);
                }
            }
        }
    }

    /**
     * Notes: 递归删除目录或文件
     * @param $path
     * @param array $except 例外
     * @param bool $self 是否删除自身,默认否
     * @return bool
     */
    static function delete($path, $except = [], $self = false) {
        if (!file_exists($path)) {
            return false;
        }
        if (is_file($path) || is_link($path)) {
            return @unlink($path);
        }
        if ($dir = dir($path)) {
            while (false !== $entry = $dir->read()) {
                if ($entry == '.' || $entry == '..' || in_array($entry, $except)) {
                    continue;
                }
                self::delete($path . '/' . $entry, $except, $self);
            }
        }
        $dir->close();
        $self && @rmdir($dir);
        return true;
    }

}