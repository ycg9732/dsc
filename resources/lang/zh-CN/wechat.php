<?php

return [

    /*
    |--------------------------------------------------------------------------
    | wechat Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the wechat
    |
    */
    'ok' => '确定',
    'cancel' => '取消',
    'button_submit' => '提交',
    'button_reset' => '重置',
    'button_revoke' => '撤销',
    // extend
    'best_goods_empty' => '暂无推荐商品',
    'hot_goods_empty' => '暂无热卖商品',
    'new_goods_empty' => '暂无最新商品',
    'bonus_mobile_phone_empty' => '无法领取红包，请先 <a href=\"' . url('mobile/#/login') . '\">绑定手机号</a>',
    'bouns_exist' => '红包已经赠送过了，不要重复领取哦！',
    'bouns_send_success' => '感谢您的注册，赠送您一个 :type_money 元红包',
    'ddcx_empty' => '暂无订单信息',
    'ddcx_mobile_phone_empty' => '无法查询订单，请先 <a href=\"' . url('mobile/#/login') . '\">绑定手机号</a>',
    'ddcx_order_sn' => '订单号：',
    'ddcx_goods' => '商品信息：',
    'ddcx_total_fee' => '总金额',
    'wechat_order_status' => '订单状态：',
    'wechat_shipping_name' => '快递公司：',
    'wechat_invoice_no' => '物流单号：',
    'wlcx_empty' => '暂无物流信息',
    'wlcx_mobile_phone_empty' => '无法查询物流，请先 <a href=\"' . url('mobile/#/login') . '\">绑定手机号</a>',
    'wechat_shipping_status' => '配送状态：',
    'dzp_empty' => '未启用大转盘',
    'zjd_empty' => '未启用砸金蛋',
    'zjd_mobile_phone_empty' => '无法参与砸金蛋，请先 <a href=\"' . url('mobile/#/login') . '\">绑定手机号</a>',
    'ggk_empty' => '未启用刮刮卡',
    'jfcx_empty' => '暂无积分信息',
    'jfcx_mobile_phone_empty' => '无法查询积分，请先 <a href=\"' . url('mobile/#/login') . '\">绑定手机号</a>',
    'user_money' => '余额：',
    'rank_points' => '成长值：',
    'pay_points' => '消费积分：',
    'sign_fail' => '签到失败',
    'sign_mobile_phone_empty' => '无法使用签到，请先 <a href=\"' . url('mobile/#/login') . '\">绑定手机号</a>',
    'sign_empty' => '未启用签到送积分',
    'free_mail_coupon' => '免邮优惠券',
    'sign_success' => '签到成功!',
    'sign_prize' => '连续签到:config_continue_day天奖励：',
    'sign_exist' => '今天已经签过到了，请明天再来',
    'prize_user_info' => '填写获奖用户资料',
    'please_real_info' => '请务必填写真实有效信息',
    'please_user_name' => '请填写姓名',
    'mobile_phone' => '手机号',
    'please_mobile_phone' => '请填写手机号',
    'user_address' => '收货地址',
    'please_user_address' => '请填写收货地址',
    'prize_set' => '奖项设置',
    'get_prize' => '获得奖品',
    'my_prize_log' => '我的中奖记录',
    'no_prize_log' => '暂无获奖记录',
    'go_to_fill_info' => '完善信息',
    'activity_desc' => '活动说明',
    'prize_log' => '中奖记录',
    'total' => '共',
    'part' => '份',
    'no_prize' => '谢谢参与',
    'try_again' => '再来一次',
    'congratulation' => '恭喜中了',
    'go_accept_prize' => '快去领奖吧',
    'more' => '更多',
    'user_prize_list' => '我的中奖记录',
    'nick_name' => '微信昵称',
    'winner_dateline' => '中奖时间',
    'issue_status' => '是否发放奖品',
    'issue_status_0' => '未发放',
    'issue_status_1' => '已发放',
    // wall
    'activity_is_empty' => '活动不存在',
    'activity_not_start' => '活动尚未开始或者已结束',
    'no_data' => '暂无数据',
    'please_fill_name' => '请填写姓名',
    'the_name_hasbeen_used' => '该姓名已被使用，请重新填写',
    'success_to_enter' => '确认成功！即将进入聊天室...',
    'message_is_empty' => '请先登录或者发表的内容不能为空',
    'message_length_limit' => '内容长度不能超过100个字符',
    'send_success' => '发送成功！',
    'illegal_request' => '请求不合法',
    'user_is_empty' => '用户不存在',
    'wall_prize_name' => '微信墙活动中奖',
    // redpack
    'redpack_title' => '微信摇一摇',
    'activity_no_start' => '活动未开始',
    'activity_is_end' => '活动已结束',
    'please_subscribe_wechat' => '请先关注微信公众号',
    'please_wait_4s' => '歇一会，您摇得过于频繁了！请隔4秒以上再试 ~~',
    'nothing' => '什么都没摇到~~~',
    'congratulations_0' => '恭喜获得红包！金额随机，返回公众号可领取。',
    'congratulations_1' => '恭喜获得红包！金额 :total_amount 元，返回公众号可领取。',
    'redpack_limit' => '单个用户可领取红包上线为10个/天,请明天再来！',
    'please_install_wxpay' => '请安装微信支付！',
    // zjd ggk dzp
    'please_prize' => '请选择中奖的奖品',
    'please_phone' => '请填写手机号',
    'please_address' => '请填写详细地址',
    'success_please_wait' => '资料提交成功，请等待发放奖品',
    'please_login' => '请先登录',
    'no_points' => '积分不够了',
    'no_prize_times' => '你已经用光了抽奖次数',
    'thanks_for' => '谢谢参与',
    'unenough_prize_num' => '奖品数量已抽完',
    // qrpay 收款码
    'qrpay_not_exist' => '收款码不存在',
    'share_type' => [
        1 => '分享到朋友圈',
        2 => '分享给朋友',
        3 => '分享到QQ',
        4 => '分享到QQ空间'
    ],
    'from_type' => [
        0 => '微信公众号关注',
        1 => '微信授权注册',
        2 => '微信扫码注册',
        3 => '微信小程序注册'
    ],
    'artinfo_type' => '图文消息',
    'phone' => '手机号',
    'user_name' => '姓名',
    'administrator' => '管理员',
    'give_integral' => '积分赠送',
    'wxapp_auth_failed' => '微信小程序授权登录失败',
    // 微信通模板消息 统一语言包
    'order_add_first' => '您的订单已提交成功,请您尽快完成付款！',
    'order_add_remark' => '感谢您的光临',
    'order_pay_first' => '您已支付成功订单，请稍后，我们正在为您准备发货',
    'order_pay_remark' => '欢迎您的再次到来！',
    'order_shipping_first' => '您的订单已发货',
    'order_shipping_remark' => '订单正在配送中，请您耐心等待',
    'order_commission_first' => '恭喜，您获得了一笔新的分销佣金',
    'order_commission_remark' => '感谢你的使用，再接再厉哦！',
];
