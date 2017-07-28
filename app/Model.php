<?php
/**
 * Created by PhpStorm.
 * User: phuang
 * Date: 2017/7/28
 * Time: 14:49
 */

namespace App;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
  protected $guarded = [];//不可注入的字段
}