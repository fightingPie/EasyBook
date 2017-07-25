<?php
/**
 * Created by PhpStorm.
 * User: phuang
 * Date: 2017/7/21
 * Time: 11:30
 */

namespace App\Transformer;


class LessonTransformer extends Transformer
{
    public function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['body'],
            'is_free' => (boolean)$lesson['free']
        ];
    }
}