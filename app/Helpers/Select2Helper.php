<?php


namespace App\Helpers;


class Select2Helper
{
    public static function mapData($list, $currentPage, $textKey = 'name', $idKey = 'id')
    {
        ($currentPage < $list->lastPage()) ? $isPaginate = true : $isPaginate = false;
        $results = self::handleData($list,$textKey,$idKey);
        $response = [
            'results' => $results,
            'pagination' => ['more' => $isPaginate]
        ];
        return $response;
    }

    public static function handleData($list, $textKey = 'name',  $idKey = 'id'){
        $results = [];
        foreach ($list as $item) {
            $results[] = [
                'id' => $item->$idKey,
                'text' => $item->$textKey,
            ];
        }
        return $results;
    }

    public static function handleDataConst($list, $textKey = 'name',  $idKey = 'id'){
        $results = [];
        foreach ($list as $key => $item) {
            $results[] = [
                $idKey => $key,
                $textKey => $item,
            ];
        }
        return $results;
    }
}
