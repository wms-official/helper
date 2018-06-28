<?php

if (!function_exists('array_filter_recursive')) {

    /**
     * Рекурсивно удалить все пустые элементы массива
     *
     * @param array $array
     * @return array
     */
    function array_filter_recursive(array $array): array {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = array_filter_recursive($value);
            }
        }

        return array_filter($array);
    }
}

if (!function_exists('only_number')) {

    /**
     * Оставить в строке только цифры
     *
     * @param string
     * @return string
     */
    function only_number(string $value): string {
        return preg_replace('/[^0-9]/', '', $value);
    }
}

if (!function_exists('delete_line_breaks')) {

    /**
     * Удалить перенос строк и табуляцию
     *
     * @param string
     * @return string
     */
    function delete_line_breaks(string $value): string {
        return trim(str_replace([ "\r\n", "\n", "\r", "\t" ], '', $value));
    }
}

if (!function_exists('keys_exists')) {

    /**
     * Аналог php-функции key_exists(), только несколько ключей
     *
     * @param array $keys
     * @param array $array
     * @return bool
     */
    function keys_exists(array $keys, array $array): bool {
        return count(array_intersect_key(array_flip($keys), $array)) === count($keys);
    }
}

if (!function_exists('prupal')) {

    /**
     * Склонение слов в зависимости от числа
     *
     * @param int $number
     * @param array $array [пример: 1 комментарий, 2 комментария, 5 комментариев]
     * @return string
     * @throws Exception
     */
    function plural(int $number, array $array): string {
        if (count($array) <> 3) {
            throw new Exception('Нужно передать 3 элемента в массив. Пример: ["комментарий","комментария","комментариев"]');
        }
        $cases = [ 2, 0, 1, 1, 1, 2 ];
        return $array[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }
}