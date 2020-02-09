<?php

if (!function_exists('app_root')) {
    function app_root() {
        return rtrim(__DIR__ . '/' . join('/', array_map(function($v) {
            return trim($v, '/');
        }, func_get_args())), '/');
        /* 
            �킩��₷��ver
            $args = func_get_args(); // ������z��Ƃ��Ď擾
            foreach ($args as $key => $value) {
                $args[$key] = trim($value); // �S�Ă̈����̎����'/'������
            }
            $path = join('/', $args); // �z��̗v�f��'/'�Ōq����
            $ret = __DIR__ . '/' . $path; // ���[�g�p�X�ƌq��
            return rtrim($ret, '/'); // �Ō��'/'�����i�W�������邽�߁j
        */
    }
}