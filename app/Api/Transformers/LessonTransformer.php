<?php
/**
 * Created by PhpStorm.
 * User: phuang
 * Date: 2017/7/21
 * Time: 15:46
 */

namespace App\Api\Transformers;

use App\Lesson;
use League\Fractal\TransformerAbstract;

class LessonTransformer extends TransformerAbstract
{
    public function transform(Lesson $lesson) {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['body'],
            'is_free' => (boolean)$lesson['free']
        ];
    }
}