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
    'ok' => '確定',
    'cancel' => '取消',
    'button_submit' => '提交',
    'button_reset' => '重置',
    'button_revoke' => '撤銷',
    // extend
    'best_goods_empty' => '暫無推薦商品',
    'hot_goods_empty' => '暫無熱賣商品',
    'new_goods_empty' => '暫無最新商品',
    'bonus_mobile_phone_empty' => '無法領取紅包，請先 <a href=\"' . url('mobile/#/login') . '\">綁定手機號</a>',
    'bouns_exist' => '紅包已經贈送過了，不要重複領取哦！',
    'bouns_send_success' => '感謝您的註冊，贈送您一個 :type_money 元紅包',
    'ddcx_empty' => '暫無訂單信息',
    'ddcx_mobile_phone_empty' => '無法查詢訂單，請先 <a href=\"' . url('mobile/#/login') . '\">綁定手機號</a>',
    'ddcx_order_sn' => '訂單號：',
    'ddcx_goods' => '商品信息：',
    'ddcx_total_fee' => '總金額',
    'wechat_order_status' => '訂單狀態：',
    'wechat_shipping_name' => '快遞公司：',
    'wechat_invoice_no' => '物流單號：',
    'wlcx_empty' => '暫無物流信息',
    'wlcx_mobile_phone_empty' => '無法查詢物流，請先 <a href=\"' . url('mobile/#/login') . '\">綁定手機號</a>',
    'wechat_shipping_status' => '配送狀態：',
    'dzp_empty' => '未啟用大轉盤',
    'zjd_empty' => '未啟用砸金蛋',
    'zjd_mobile_phone_empty' => '無法參與砸金蛋，請先 <a href=\"' . url('mobile/#/login') . '\">綁定手機號</a>',
    'ggk_empty' => '未啟用刮刮卡',
    'jfcx_empty' => '暫無積分信息',
    'jfcx_mobile_phone_empty' => '無法查詢積分，請先 <a href=\"'.url('mobile/#/login').'\">綁定手機號</a>',
    'user_money' => '餘額：',
    'rank_points' => '等級積分：',
    'pay_points' => '消費積分：',
    'sign_fail' => '簽到失敗',
    'sign_mobile_phone_empty' => '無法使用簽到，請先 <a href=\"' . url('mobile/#/login') . '\">綁定手機號</a>',
    'sign_empty' => '未啟用簽到送積分',
    'free_mail_coupon' => '免郵優惠券',
    'sign_success' => '簽到成功!',
    'sign_prize' => '連續簽到:config_continue_day天獎勵：',
    'sign_exist' => '今天已經簽過到了，請明天再來',
    'prize_user_info' => '填寫獲獎用戶資料',
    'please_real_info' => '請務必填寫真實有效信息',
    'please_user_name' => '請填寫姓名',
    'mobile_phone' => '手機號',
    'please_mobile_phone' => '請填寫手機號',
    'user_address' => '收貨地址',
    'please_user_address' => '請填寫收貨地址',
    'prize_set' => '獎項設置',
    'get_prize' => '獲得獎品',
    'my_prize_log' => '我的中獎記錄',
    'no_prize_log' => '暫無獲獎記錄',
    'go_to_fill_info' => '完善信息',
    'activity_desc' => '活動說明',
    'prize_log' => '中獎記錄',
    'total' => '共',
    'part' => '份',
    'no_prize' => '謝謝參與',
    'try_again' => '再來一次',
    'congratulation' => '恭喜中了',
    'go_accept_prize' => '快去領獎吧',
    'more' => '更多',
    'user_prize_list' => '我的中獎記錄',
    'nick_name' => '微信暱稱',
    'winner_dateline' => '中獎時間',
    'issue_status' => '是否發放獎品',
    'issue_status_0' => '未發放',
    'issue_status_1' => '已發放',
    // wall
    'activity_is_empty' => '活動不存在',
    'activity_not_start' => '活動尚未開始或者已結束',
    'no_data' => '暫無數據',
    'please_fill_name' => '請填寫姓名',
    'the_name_hasbeen_used' => '該姓名已被使用，請重新填寫',
    'success_to_enter' => '確認成功！即將進入聊天室...',
    'message_is_empty' => '請先登錄或者發表的內容不能為空',
    'message_length_limit' => '內容長度不能超過100個字元',
    'send_success' => '發送成功！',
    'illegal_request' => '請求不合法',
    'user_is_empty' => '用戶不存在',
    'wall_prize_name' => '微信牆活動中獎',
    // redpack
    'redpack_title' => '微信搖一搖',
    'activity_no_start' => '活動未開始',
    'activity_is_end' => '活動已結束',
    'please_subscribe_wechat' => '請先關注微信公眾號',
    'please_wait_4s' => '歇一會，您搖得過於頻繁了！請隔4秒以上再試 ~~',
    'nothing' => '什麼都沒搖到~~~',
    'congratulations_0' => '恭喜獲得紅包！金額隨機，返回公眾號可領取。',
    'congratulations_1' => '恭喜獲得紅包！金額 :total_amount 元，返回公眾號可領取。',
    'redpack_limit' => '單個用戶可領取紅包上線為10個/天,請明天再來！',
    'please_install_wxpay' => '請安裝微信支付！',
    // zjd ggk dzp
    'please_prize' => '請選擇中獎的獎品',
    'please_phone' => '請填寫手機號',
    'please_address' => '請填寫詳細地址',
    'success_please_wait' => '資料提交成功，請等待發放獎品',
    'please_login' => '請先登錄',
    'no_points' => '積分不夠了',
    'no_prize_times' => '你已經用光了抽獎次數',
    'thanks_for' => '謝謝參與',
    'unenough_prize_num' => '獎品數量已抽完',
    // qrpay 收款碼
    'qrpay_not_exist' => '收款碼不存在',
    'share_type' => [
        1 => '分享到朋友圈',
        2 => '分享給朋友',
        3 => '分享到QQ',
        4 => '分享到QQ空間'
    ],
    'from_type' => [
        0 => '微信公眾號關注',
        1 => '微信授權註冊',
        2 => '微信掃碼註冊',
        3 => '微信小程序註冊'
    ],
    'artinfo_type' => '圖文消息',
    'phone' => '手機號',
    'user_name' => '姓名',
    'administrator' => '管理員',
    'give_integral' => '積分贈送',
    'wxapp_auth_failed' => '微信小程序授權登錄失敗',
    // 微信通模板消息 统一语言包
    'order_add_first' => '您的訂單已提交成功,請您儘快完成付款!',
    'order_add_remark' => '感謝您的光臨',
    'order_pay_first' => '您已支付成功訂單,請稍後,我們正在爲您準備發的貨',
    'order_pay_remark' => '歡迎您的再次到來!',
    'order_shipping_first' => '您的訂單已發貨',
    'order_shipping_remark' => '訂單正在配送中，請您耐心等待',
    'order_commission_first' => '恭喜,您獲得了一筆新的分銷佣金',
    'order_commission_remark' => '感謝你的使用,再接再厲哦!',
];
