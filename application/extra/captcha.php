<?php

return [
    // 验证码字体大小(px)
    'fontSize'    =>    38,
    // 验证码位数
    'length'      =>    5,
    // 关闭验证码杂点
    'useNoise'    =>    false,
    // 验证码过期时间（s）
    'expire'    =>    1800,
    // 是否添加杂点
    'useNoise'    =>    false,
    // 使用中文验证码
    'useZh'    =>    false,
    //使用背景图片
    'useImgBg'    =>	false,
    //是否画混淆曲线
    'useCurve'    =>	true,
    // 验证码图片高度，设置为0为自动计算
    'imageH'    =>    0,
    // 验证码图片宽度，设置为0为自动计算
    'imageW'    =>    0,
    // 验证码字体，不设置是随机获取
    //'fontttf'   =>  null,
    // 背景颜色	[243, 251, 254]
    //'bg'    =>
    // 验证成功后是否重置
    'reset' =>  true,
];