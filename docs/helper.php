<?php

if (!function_exists('app_root')) {
    function app_root() {
        return rtrim(__DIR__ . '/' . join('/', array_map(function($v) {
            return trim($v, '/');
        }, func_get_args())), '/');
        /* 
            わかりやすいver
            $args = func_get_args(); // 引数を配列として取得
            foreach ($args as $key => $value) {
                $args[$key] = trim($value); // 全ての引数の首尾の'/'を消す
            }
            $path = join('/', $args); // 配列の要素を'/'で繋げる
            $ret = __DIR__ . '/' . $path; // ルートパスと繋ぐ
            return rtrim($ret, '/'); // 最後の'/'消す（標準化するため）
        */
    }
}