<?php

namespace app\common\validate;
use think\Validate;

class MemberValidate extends Validate
{
    protected $rule = [
        ['account', 'unique:member', '该会员已经存在']
    ];

}