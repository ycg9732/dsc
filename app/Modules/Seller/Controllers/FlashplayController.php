<?php

namespace App\Modules\Seller\Controllers;

/**
 * 程序说明
 */
class FlashplayController extends InitController
{
    public function index()
    {
        $uri = $this->dsc->seller_url();
        $allow_suffix = ['gif', 'jpg', 'png', 'jpeg', 'bmp'];

        /*------------------------------------------------------ */
        //-- 系统
        /*------------------------------------------------------ */
        if ($_REQUEST['act'] == 'list') {
            /* 判断系统当前设置 如果为用户自定义 则跳转到自定义 */
            if ($GLOBALS['_CFG']['index_ad'] == 'cus') {
                return dsc_header("Location: flashplay.php?act=custom_list\n");
            }

            $playerdb = $this->get_flash_xml();
            foreach ($playerdb as $key => $val) {
                if (strpos($val['src'], 'http') === false) {
                    $playerdb[$key]['src'] = $uri . $val['src'];
                }
            }

            /* 标签初始化 */
            $group_list = [
                'sys' => ['text' => $GLOBALS['_LANG']['system_set'], 'url' => ''],
                'cus' => ['text' => $GLOBALS['_LANG']['custom_set'], 'url' => 'flashplay.php?act=custom_list']
            ];


            $flash_dir = storage_public('data/flashdata/');

            $this->smarty->assign('current', 'sys');
            $this->smarty->assign('group_list', $group_list);
            $this->smarty->assign('group_selected', $GLOBALS['_CFG']['index_ad']);
            $this->smarty->assign('uri', $uri);
            $this->smarty->assign('ur_here', $GLOBALS['_LANG']['flashplay']);
            $this->smarty->assign('action_link_special', ['text' => $GLOBALS['_LANG']['add_new'], 'href' => 'flashplay.php?act=add']);
            $this->smarty->assign('flashtpls', $this->get_flash_templates($flash_dir));
            $this->smarty->assign('current_flashtpl', $GLOBALS['_CFG']['flash_theme']);
            $this->smarty->assign('playerdb', $playerdb);
            return $this->smarty->display('flashplay_list.dwt');
        } elseif ($_REQUEST['act'] == 'del') {
            admin_priv('flash_manage');

            $id = (int)$_GET['id'];
            $flashdb = $this->get_flash_xml();
            if (isset($flashdb[$id])) {
                $rt = $flashdb[$id];
            } else {
                $links[] = ['text' => $GLOBALS['_LANG']['go_url'], 'href' => 'flashplay.php?act=list'];
                return sys_msg($GLOBALS['_LANG']['id_error'], 0, $links);
            }

            if (strpos($rt['src'], 'http') === false) {
                @unlink(storage_public($rt['src']));
            }
            $temp = [];
            foreach ($flashdb as $key => $val) {
                if ($key != $id) {
                    $temp[] = $val;
                }
            }
            $this->put_flash_xml($temp);
            $this->set_flash_data($GLOBALS['_CFG']['flash_theme'], $error_msg = '');
            return dsc_header("Location: flashplay.php?act=list\n");
        } elseif ($_REQUEST['act'] == 'add') {
            admin_priv('flash_manage');

            if (empty($_POST['step'])) {
                $url = isset($_GET['url']) ? $_GET['url'] : 'http://';
                $src = isset($_GET['src']) ? $_GET['src'] : '';
                $sort = 0;
                $rt = ['act' => 'add', 'img_url' => $url, 'img_src' => $src, 'img_sort' => $sort];
                $width_height = $this->get_width_height();

                if (isset($width_height['width']) || isset($width_height['height'])) {
                    $this->smarty->assign('width_height', sprintf($GLOBALS['_LANG']['width_height'], $width_height['width'], $width_height['height']));
                }

                $this->smarty->assign('action_link', ['text' => $GLOBALS['_LANG']['go_url'], 'href' => 'flashplay.php?act=list']);
                $this->smarty->assign('rt', $rt);
                $this->smarty->assign('ur_here', $GLOBALS['_LANG']['add_picad']);
                return $this->smarty->display('flashplay_add.dwt');
            } elseif ($_POST['step'] == 2) {
                if (!empty($_FILES['img_file_src']['name'])) {
                    if (!get_file_suffix($_FILES['img_file_src']['name'], $allow_suffix)) {
                        return sys_msg($GLOBALS['_LANG']['invalid_type']);
                    }
                    $name = local_date('Ymd');
                    for ($i = 0; $i < 6; $i++) {
                        $name .= chr(mt_rand(97, 122));
                    }
                    $name .= '.' . end(explode('.', $_FILES['img_file_src']['name']));
                    $target = storage_public(DATA_DIR . '/afficheimg/' . $name);
                    if (move_upload_file($_FILES['img_file_src']['tmp_name'], $target)) {
                        $src = DATA_DIR . '/afficheimg/' . $name;
                    }
                } elseif (!empty($_POST['img_src'])) {
                    $src = $_POST['img_src'];

                    if (strstr($src, 'http') && !strstr($src, request()->server('SERVER_NAME'))) {
                        $src = $this->get_url_image($src);
                    }
                } else {
                    $links[] = ['text' => $GLOBALS['_LANG']['add_new'], 'href' => 'flashplay.php?act=add'];
                    return sys_msg($GLOBALS['_LANG']['src_empty'], 0, $links);
                }

                if (empty($_POST['img_url'])) {
                    $links[] = ['text' => $GLOBALS['_LANG']['add_new'], 'href' => 'flashplay.php?act=add'];
                    return sys_msg($GLOBALS['_LANG']['link_empty'], 0, $links);
                }

                // 获取flash播放器数据
                $flashdb = $this->get_flash_xml();

                // 插入新数据
                array_unshift($flashdb, ['src' => $src, 'url' => $_POST['img_url'], 'text' => $_POST['img_text'], 'sort' => $_POST['img_sort']]);

                // 实现排序
                $flashdb_sort = [];
                $_flashdb = [];
                foreach ($flashdb as $key => $value) {
                    $flashdb_sort[$key] = $value['sort'];
                }
                asort($flashdb_sort, SORT_NUMERIC);
                foreach ($flashdb_sort as $key => $value) {
                    $_flashdb[] = $flashdb[$key];
                }
                unset($flashdb, $flashdb_sort);

                $this->put_flash_xml($_flashdb);
                $this->set_flash_data($GLOBALS['_CFG']['flash_theme'], $error_msg = '');
                $links[] = ['text' => $GLOBALS['_LANG']['go_url'], 'href' => 'flashplay.php?act=list'];
                return sys_msg($GLOBALS['_LANG']['edit_ok'], 0, $links);
            }
        } elseif ($_REQUEST['act'] == 'edit') {
            admin_priv('flash_manage');

            $id = (int)$_REQUEST['id']; //取得id
            $flashdb = $this->get_flash_xml(); //取得数据
            if (isset($flashdb[$id])) {
                $rt = $flashdb[$id];
            } else {
                $links[] = ['text' => $GLOBALS['_LANG']['go_url'], 'href' => 'flashplay.php?act=list'];
                return sys_msg($GLOBALS['_LANG']['id_error'], 0, $links);
            }
            if (empty($_POST['step'])) {
                $rt['act'] = 'edit';
                $rt['img_url'] = $rt['url'];
                $rt['img_src'] = $rt['src'];
                $rt['img_txt'] = $rt['text'];
                $rt['img_sort'] = empty($rt['sort']) ? 0 : $rt['sort'];

                $rt['id'] = $id;
                $this->smarty->assign('action_link', ['text' => $GLOBALS['_LANG']['go_url'], 'href' => 'flashplay.php?act=list']);
                $this->smarty->assign('rt', $rt);
                $this->smarty->assign('ur_here', $GLOBALS['_LANG']['edit_picad']);
                return $this->smarty->display('flashplay_add.dwt');
            } elseif ($_POST['step'] == 2) {
                if (empty($_POST['img_url'])) {
                    //若链接地址为空
                    $links[] = ['text' => $GLOBALS['_LANG']['return_edit'], 'href' => 'flashplay.php?act=edit&id=' . $id];
                    return sys_msg($GLOBALS['_LANG']['link_empty'], 0, $links);
                }

                if (!empty($_FILES['img_file_src']['name'])) {
                    if (!get_file_suffix($_FILES['img_file_src']['name'], $allow_suffix)) {
                        return sys_msg($GLOBALS['_LANG']['invalid_type']);
                    }
                    //有上传
                    $name = local_date('Ymd');
                    for ($i = 0; $i < 6; $i++) {
                        $name .= chr(mt_rand(97, 122));
                    }
                    $name .= '.' . end(explode('.', $_FILES['img_file_src']['name']));
                    $target = storage_public(DATA_DIR . '/afficheimg/' . $name);

                    if (move_upload_file($_FILES['img_file_src']['tmp_name'], $target)) {
                        $src = DATA_DIR . '/afficheimg/' . $name;
                    }
                } elseif (!empty($_POST['img_src'])) {
                    $src = $_POST['img_src'];

                    if (strstr($src, 'http') && !strstr($src, request()->server('SERVER_NAME'))) {
                        $src = $this->get_url_image($src);
                    }
                } else {
                    $links[] = ['text' => $GLOBALS['_LANG']['return_edit'], 'href' => 'flashplay.php?act=edit&id=' . $id];
                    return sys_msg($GLOBALS['_LANG']['src_empty'], 0, $links);
                }

                if (strpos($rt['src'], 'http') === false && $rt['src'] != $src) {
                    @unlink(storage_public($rt['src']));
                }
                $flashdb[$id] = ['src' => $src, 'url' => $_POST['img_url'], 'text' => $_POST['img_text'], 'sort' => $_POST['img_sort']];

                // 实现排序
                $flashdb_sort = [];
                $_flashdb = [];
                foreach ($flashdb as $key => $value) {
                    $flashdb_sort[$key] = $value['sort'];
                }
                asort($flashdb_sort, SORT_NUMERIC);
                foreach ($flashdb_sort as $key => $value) {
                    $_flashdb[] = $flashdb[$key];
                }
                unset($flashdb, $flashdb_sort);

                $this->put_flash_xml($_flashdb);
                $this->set_flash_data($GLOBALS['_CFG']['flash_theme'], $error_msg = '');
                $links[] = ['text' => $GLOBALS['_LANG']['go_url'], 'href' => 'flashplay.php?act=list'];
                return sys_msg($GLOBALS['_LANG']['edit_ok'], 0, $links);
            }
        } elseif ($_REQUEST['act'] == 'install') {
            $check_auth = check_authz_json('flash_manage');
            if ($check_auth !== true) {
                return $check_auth;
            }
            $flash_theme = trim($_GET['flashtpl']);
            if ($GLOBALS['_CFG']['flash_theme'] != $flash_theme) {
                $sql = "UPDATE " . $this->dsc->table('shop_config') . " SET value = '$flash_theme' WHERE code = 'flash_theme'";
                if ($this->db->query($sql, 'SILENT')) {
                    clear_all_files(); //清除模板编译文件

                    $error_msg = '';
                    if ($this->set_flash_data($flash_theme, $error_msg)) {
                        return make_json_error($error_msg);
                    } else {
                        return make_json_result($flash_theme, $GLOBALS['_LANG']['install_success']);
                    }
                } else {
                    return make_json_error($this->db->error());
                }
            } else {
                return make_json_result($flash_theme, $GLOBALS['_LANG']['install_success']);
            }
        }

        /*------------------------------------------------------ */
        //-- 用户自定义
        /*------------------------------------------------------ */

        elseif ($_REQUEST['act'] == 'custom_list') {
            /* 标签初始化 */
            $group_list = [
                'sys' => ['text' => $GLOBALS['_LANG']['system_set'], 'url' => ($GLOBALS['_CFG']['index_ad'] == 'cus') ? 'javascript:system_set();void(0);' : 'flashplay.php?act=list'],
                'cus' => ['text' => $GLOBALS['_LANG']['custom_set'], 'url' => '']
            ];

            /* 列表 */
            $ad_list = $this->ad_list();
            $this->smarty->assign('ad_list', $ad_list['ad']);


            $width_height = $this->get_width_height();
//        if(isset($width_height['width'])|| isset($width_height['height']))
//        {
            $this->smarty->assign('width_height', sprintf($GLOBALS['_LANG']['width_height'], $width_height['width'], $width_height['height']));
//        }
            $this->smarty->assign('full_page', 1);
            $this->smarty->assign('current', 'cus');
            $this->smarty->assign('group_list', $group_list);
            $this->smarty->assign('group_selected', $GLOBALS['_CFG']['index_ad']);
            $this->smarty->assign('uri', $uri);
            $this->smarty->assign('ur_here', $GLOBALS['_LANG']['flashplay']);
            $this->smarty->assign('action_link_special', ['text' => $GLOBALS['_LANG']['add_flash'], 'href' => 'flashplay.php?act=custom_add']);

            /* 添加 */
            $ad = ['ad_name' => '', 'ad_type' => 0, 'ad_url' => 'http://', 'htmls' => '',
                'ad_status' => '1', 'ad_id' => '0', 'url' => 'http://'];
            $this->smarty->assign('ad', $ad);
            $this->smarty->assign('form_act', 'custom_insert');

            return $this->smarty->display('flashplay_custom.dwt');
        }

        /*------------------------------------------------------ */
        //-- 用户自定义添加
        /*------------------------------------------------------ */

        elseif ($_REQUEST['act'] == 'custom_add') {
            /* 标签初始化 */
            $group_list = [
                'sys' => ['text' => $GLOBALS['_LANG']['system_set'], 'url' => ($GLOBALS['_CFG']['index_ad'] == 'cus') ? 'javascript:system_set();void(0);' : 'flashplay.php?act=list'],
                'cus' => ['text' => $GLOBALS['_LANG']['custom_set'], 'url' => '']
            ];

            /* 列表 */
            $ad_list = $this->ad_list();
            $this->smarty->assign('ad_list', $ad_list['ad']);


            $width_height = $this->get_width_height();
//        if(isset($width_height['width'])|| isset($width_height['height']))
//        {
            $this->smarty->assign('width_height', sprintf($GLOBALS['_LANG']['width_height'], $width_height['width'], $width_height['height']));
//        }
            $this->smarty->assign('full_page', 1);
            $this->smarty->assign('current', 'cus');
            $this->smarty->assign('group_list', $group_list);
            $this->smarty->assign('group_selected', $GLOBALS['_CFG']['index_ad']);
            $this->smarty->assign('uri', $uri);
            $this->smarty->assign('ur_here', $GLOBALS['_LANG']['add_ad']);
            $this->smarty->assign('action_link_special', ['text' => $GLOBALS['_LANG']['add_flash'], 'href' => 'flashplay.php?act=custom_add']);
            $this->smarty->assign('action_link', ['text' => $GLOBALS['_LANG']['ad_play_url'], 'href' => 'flashplay.php?act=custom_list']);
            /* 添加 */
            $ad = ['ad_name' => '', 'ad_type' => 0, 'ad_url' => 'http://', 'htmls' => '',
                'ad_status' => '1', 'ad_id' => '0', 'url' => 'http://'];
            $this->smarty->assign('ad', $ad);
            $this->smarty->assign('form_act', 'custom_insert');

            return $this->smarty->display('flashplay_custom_add.dwt');
        }



        /*------------------------------------------------------ */
        //-- 用户自定义 添加广告�        �库
        /*------------------------------------------------------ */

        elseif ($_REQUEST['act'] == 'custom_insert') {
            admin_priv('flash_manage');

            /* 定义当前时间 */
            define('GMTIME_UTC', gmtime()); // 获取 UTC 时间戳

            if (empty($_POST['ad']) || empty($_POST['content']) || empty($_POST['ad']['ad_name'])) {
                $links[] = ['text' => $GLOBALS['_LANG']['back'], 'href' => 'flashplay.php?act=custom_list'];
                return sys_msg($GLOBALS['_LANG']['form_none'], 0, $links);
            }

            $filter = [];
            $filter['ad'] = $_POST['ad'];
            $filter['content'] = $_POST['content'];
            $ad_img = $_FILES;

            /* 配置接收文件类型 */
            switch ($filter['ad']['ad_type']) {
                case '0':
                    break;

                case '1':
                    $allow_suffix[] = 'swf';
                    break;
            }

            /* 接收文件 */
            if ($ad_img['ad_img']['name'] && $ad_img['ad_img']['size'] > 0) {
                /* 检查文件合法性 */
                if (!get_file_suffix($ad_img['ad_img']['name'], $allow_suffix)) {
                    return sys_msg($GLOBALS['_LANG']['invalid_type']);
                }

                /* 处理 */
                $name = local_date('Ymd');
                for ($i = 0; $i < 6; $i++) {
                    $name .= chr(mt_rand(97, 122));
                }
                $name .= '.' . end(explode('.', $ad_img['ad_img']['name']));
                $target = storage_public(DATA_DIR . '/afficheimg/' . $name);

                if (move_upload_file($ad_img['ad_img']['tmp_name'], $target)) {
                    $src = DATA_DIR . '/afficheimg/' . $name;
                }
            } elseif (!empty($filter['content']['url'])) {
                /* 来自互联网图片 不可以是服务器地址 */
                if (strstr($filter['content']['url'], 'http') && !strstr($filter['content']['url'], request()->server('SERVER_NAME'))) {
                    /* 取互联网图片至本地 */
                    $src = $this->get_url_image($filter['content']['url']);
                } else {
                    return sys_msg($GLOBALS['_LANG']['web_url_no']);
                }
            }

            /* 入库 */
            switch ($filter['ad']['ad_type']) {
                case '0':

                case '1':
                    $filter['content'] = $src;
                    break;

                case '2':

                case '3':
                    $filter['content'] = $filter['content']['htmls'];
                    break;
            }
            $ad = ['ad_type' => $filter['ad']['ad_type'],
                'ad_name' => $filter['ad']['ad_name'],
                'add_time' => GMTIME_UTC,
                'content' => $filter['content'],
                'url' => $filter['ad']['url'],
                'ad_status' => $filter['ad']['ad_status']
            ];
            $this->db->autoExecute($this->dsc->table('ad_custom'), $ad, 'INSERT', '', 'SILENT');
            $ad_id = $this->db->insert_id();

            /* 修改状态 */
            $this->modfiy_ad_status($ad_id, $filter['ad']['ad_status']);

            /* 状态为启用 清除模板编译文件 */
            if ($filter['ad']['ad_status'] == 1) {
                clear_all_files();
            }

            $links[] = ['text' => $GLOBALS['_LANG']['back_custom_set'], 'href' => 'flashplay.php?act=custom_list'];
            return sys_msg($GLOBALS['_LANG']['edit_ok'], 0, $links);
        }

        /*------------------------------------------------------ */
        //-- 用户自定义 删除广告
        /*------------------------------------------------------ */

        elseif ($_REQUEST['act'] == 'custom_del') {
            admin_priv('flash_manage');

            $id = empty($_GET['id']) ? 0 : intval(trim($_GET['id']));
            if (!$id) {
                $links[] = ['text' => $GLOBALS['_LANG']['back_custom_set'], 'href' => 'flashplay.php?act=custom_list'];
                return sys_msg($GLOBALS['_LANG']['form_none'], 0, $links);
            }

            /* 修改状态 */
            $this->modfiy_ad_status($id, 0);

            /* 清除模板编译文件 */
            clear_all_files();

            $query = $this->db->query("DELETE FROM " . $this->dsc->table('ad_custom') . " WHERE ad_id = $id");

            $links[] = ['text' => $GLOBALS['_LANG']['back_custom_set'], 'href' => 'flashplay.php?act=custom_list'];
            if ($query) {
                return sys_msg($GLOBALS['_LANG']['edit_ok'], 0, $links);
            } else {
                return sys_msg($GLOBALS['_LANG']['edit_no'], 0, $links);
            }
        }

        /*------------------------------------------------------ */
        //-- 用户自定义 启用与�        �闭广告
        /*------------------------------------------------------ */

        elseif ($_REQUEST['act'] == 'custom_status') {
            $check_auth = check_authz_json('flash_manage');
            if ($check_auth !== true) {
                return $check_auth;
            }

            $ad_status = empty($_GET['ad_status']) ? 1 : 0;
            $id = empty($_GET['id']) ? 0 : intval(trim($_GET['id']));
            $is_ajax = $_GET['is_ajax'];
            if (!$id || $is_ajax != '1') {
                return make_json_error($GLOBALS['_LANG']['edit_no']);
            }

            /* 修改状态 */
            $links[] = ['text' => $GLOBALS['_LANG']['back_custom_set'], 'href' => 'flashplay.php?act=custom_list'];
            if ($this->modfiy_ad_status($id, $ad_status)) {
                /* 清除模板编译文件 */
                clear_all_files();

                /* 标签初始化 */
                $sql = "SELECT  value FROM " . $this->dsc->table("shop_config") . " WHERE id =337";
                $shop_config = $this->db->getRow($sql);
                $group_list = [
                    'sys' => ['text' => $GLOBALS['_LANG']['system_set'], 'url' => ($shop_config['value'] == 'cus') ? 'javascript:system_set();void(0);' : 'flashplay.php?act=list'],
                    'cus' => ['text' => $GLOBALS['_LANG']['custom_set'], 'url' => '']
                ];

                /* 列表 */
                $ad_list = $this->ad_list();
                $this->smarty->assign('ad_list', $ad_list['ad']);
                $this->smarty->assign('current', 'cus');
                $this->smarty->assign('group_list', $group_list);
                $this->smarty->assign('group_selected', $GLOBALS['_CFG']['index_ad']);
                $this->smarty->assign('uri', $uri);
                $this->smarty->assign('ur_here', $GLOBALS['_LANG']['flashplay']);
                $this->smarty->assign('action_link_special', ['text' => $GLOBALS['_LANG']['add_flash'], 'href' => 'flashplay.php?act=custom_add']);
                /* 添加 */
                $ad = ['ad_name' => '', 'ad_type' => 0, 'ad_url' => 'http://', 'htmls' => '',
                    'ad_status' => '1', 'ad_id' => '0', 'url' => 'http://'];
                $this->smarty->assign('ad', $ad);
                $this->smarty->assign('form_act', 'custom_insert');

                $this->smarty->fetch('flashplay_custom.dwt');

                return make_json_result($this->smarty->fetch('flashplay_custom.dwt'));
            } else {
                return make_json_error($GLOBALS['_LANG']['edit_no']);
            }
        }

        /*------------------------------------------------------ */
        //-- 用户自定义 修改
        /*------------------------------------------------------ */

        elseif ($_REQUEST['act'] == 'custom_edit') {
            $id = empty($_GET['id']) ? 0 : intval(trim($_GET['id']));

            /* 查询自定义广告信息 */
            $sql = "SELECT ad_id, ad_type, content, url, ad_status, ad_name FROM " . $this->dsc->table("ad_custom") . " WHERE ad_id = $id LIMIT 0, 1";
            $ad = $this->db->getRow($sql);


            $width_height = $this->get_width_height();
            $this->smarty->assign('width_height', sprintf($GLOBALS['_LANG']['width_height'], $width_height['width'], $width_height['height']));

            $this->smarty->assign('group_selected', $GLOBALS['_CFG']['index_ad']);
            $this->smarty->assign('uri', $uri);
            $this->smarty->assign('ur_here', $GLOBALS['_LANG']['flashplay']);
            $this->smarty->assign('action_link', ['text' => $GLOBALS['_LANG']['ad_play_url'], 'href' => 'flashplay.php?act=custom_list']);
            $this->smarty->assign('ur_here', $GLOBALS['_LANG']['edit_ad']);

            /* 添加 */
            $this->smarty->assign('ad', $ad);
            return $this->smarty->display('flashplay_ccustom_edit.dwt');
        }

        /*------------------------------------------------------ */
        //-- 用户自定义 更新数据库
        /*------------------------------------------------------ */

        elseif ($_REQUEST['act'] == 'custom_update') {
            admin_priv('flash_manage');

            if (empty($_POST['ad']) || empty($_POST['content']) || empty($_POST['ad']['ad_name']) || empty($_POST['ad']['id'])) {
                $links[] = ['text' => $GLOBALS['_LANG']['back'], 'href' => 'flashplay.php?act=custom_list'];
                return sys_msg($GLOBALS['_LANG']['form_none'], 0, $links);
            }

            $filter = [];
            $filter['ad'] = $_POST['ad'];
            $filter['content'] = $_POST['content'];
            $ad_img = $_FILES;

            /* 查询自定义广告信息 */
            $sql = "SELECT ad_id, ad_type, content, url, ad_status, ad_name FROM " . $this->dsc->table("ad_custom") . " WHERE ad_id = " . $filter['ad']['id'] . " LIMIT 0, 1";
            $ad_info = $this->db->getRow($sql);

            /* 配置接收文件类型 */
            switch ($filter['ad']['ad_type']) {
                case '0':
                    break;

                case '1':
                    $allow_suffix[] = 'swf';
                    break;
            }

            /* 接收文件 */
            if ($ad_img['ad_img']['name'] && $ad_img['ad_img']['size'] > 0) {
                /* 检查文件合法性 */
                if (!get_file_suffix($ad_img['ad_img']['name'], $allow_suffix)) {
                    return sys_msg($GLOBALS['_LANG']['invalid_type']);
                }

                /* 处理 */
                $name = local_date('Ymd');
                for ($i = 0; $i < 6; $i++) {
                    $name .= chr(mt_rand(97, 122));
                }
                $name .= '.' . end(explode('.', $ad_img['ad_img']['name']));
                $target = storage_public(DATA_DIR . '/afficheimg/' . $name);

                if (move_upload_file($ad_img['ad_img']['tmp_name'], $target)) {
                    $src = DATA_DIR . '/afficheimg/' . $name;
                }
            } elseif (!empty($filter['content']['url'])) {
                /* 来自互联网图片 不可以是服务器地址 */
                if (strstr($filter['content']['url'], 'http') && !strstr($filter['content']['url'], request()->server('SERVER_NAME'))) {
                    /* 取互联网图片至本地 */
                    $src = $this->get_url_image($filter['content']['url']);
                } else {
                    return sys_msg($GLOBALS['_LANG']['web_url_no']);
                }
            }

            /* 入库 */
            switch ($filter['ad']['ad_type']) {
                case '0':

                case '1':
                    $filter['content'] = !is_file(storage_public($src)) && (trim($src) == '') ? $ad_info['content'] : $src;
                    break;

                case '2':

                case '3':
                    $filter['content'] = $filter['content']['htmls'];
                    break;
            }
            $ad = ['ad_type' => $filter['ad']['ad_type'],
                'ad_name' => $filter['ad']['ad_name'],
                'content' => $filter['content'],
                'url' => $filter['ad']['url'],
                'ad_status' => $filter['ad']['ad_status']
            ];
            $this->db->autoExecute($this->dsc->table('ad_custom'), $ad, 'UPDATE', 'ad_id = ' . $ad_info['ad_id'], 'SILENT');

            /* 修改状态 */
            $this->modfiy_ad_status($ad_info['ad_id'], $filter['ad']['ad_status']);

            /* 状态为启用 清除模板编译文件 */
            if ($filter['ad']['ad_status'] == 1) {
                clear_all_files();
            }

            $links[] = ['text' => $GLOBALS['_LANG']['back_custom_set'], 'href' => 'flashplay.php?act=custom_list'];
            return sys_msg($GLOBALS['_LANG']['edit_ok'], 0, $links);
        }
    }

    private function get_flash_xml()
    {
        $flashdb = [];
        if (file_exists(storage_public(DATA_DIR . '/flash_data.xml'))) {
            $flash_data = read_static_flie_cache('flash_data', 'xml', storage_public(DATA_DIR . '/'));
            // 兼容v2.7.0及以前版本
            if (!preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"\ssort="([^"]*)"/', $flash_data, $t, PREG_SET_ORDER)) {
                preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"/', $flash_data, $t, PREG_SET_ORDER);
            }

            if (!empty($t)) {
                foreach ($t as $key => $val) {
                    $val[4] = isset($val[4]) ? $val[4] : 0;
                    $flashdb[] = ['src' => $val[1], 'url' => $val[2], 'text' => $val[3], 'sort' => $val[4]];
                }
            }
        }
        return $flashdb;
    }

    private function put_flash_xml($flashdb)
    {
        if (!empty($flashdb)) {
            $xml = '<?xml version="1.0" encoding="' . EC_CHARSET . '"?><bcaster>';
            foreach ($flashdb as $key => $val) {
                $xml .= '<item item_url="' . $val['src'] . '" link="' . $val['url'] . '" text="' . $val['text'] . '" sort="' . $val['sort'] . '"/>';
            }
            $xml .= '</bcaster>';

            write_static_file_cache('flash_data', $xml, 'xml', storage_public(DATA_DIR . '/'));
        } else {
            @unlink(storage_public(DATA_DIR . '/flash_data.xml'));
        }
    }

    private function get_url_image($url)
    {
        $ext = strtolower(end(explode('.', $url)));
        if ($ext != "gif" && $ext != "jpg" && $ext != "png" && $ext != "bmp" && $ext != "jpeg") {
            return $url;
        }

        $name = local_date('Ymd');
        for ($i = 0; $i < 6; $i++) {
            $name .= chr(mt_rand(97, 122));
        }
        $name .= '.' . $ext;
        $target = storage_public(DATA_DIR . '/afficheimg/' . $name);

        $tmp_file = DATA_DIR . '/afficheimg/' . $name;
        $filename = storage_public($tmp_file);

        $img = file_get_contents($url);

        $fp = @fopen($filename, "a");
        fwrite($fp, $img);
        fclose($fp);

        return $tmp_file;
    }

    private function get_width_height()
    {
        $curr_template = $GLOBALS['_CFG']['template'];
        $path = storage_public('themes/' . $curr_template . '/library/');
        $template_dir = @opendir($path);

        $width_height = [];
        while ($file = readdir($template_dir)) {
            if ($file == 'index_ad.lbi') {
                $string = file_get_contents($path . $file);
                $pattern_width = '/var\s*swf_width\s*=\s*(\d+);/';
                $pattern_height = '/var\s*swf_height\s*=\s*(\d+);/';
                preg_match($pattern_width, $string, $width);
                preg_match($pattern_height, $string, $height);
                if (isset($width[1])) {
                    $width_height['width'] = $width[1];
                }
                if (isset($height[1])) {
                    $width_height['height'] = $height[1];
                }
                break;
            }
        }

        return $width_height;
    }

    private function get_flash_templates($dir)
    {
        $flashtpls = [];
        $template_dir = @opendir($dir);
        while ($file = readdir($template_dir)) {
            if ($file != '.' && $file != '..' && is_dir($dir . $file) && $file != '.svn' && $file != 'index.dwt') {
                $flashtpls[] = $this->get_flash_tpl_info($dir, $file);
            }
        }
        @closedir($template_dir);
        return $flashtpls;
    }

    private function get_flash_tpl_info($dir, $file)
    {
        $info = [];
        if (is_file($dir . $file . '/preview.jpg')) {
            $info['code'] = $file;
            $info['screenshot'] = '../data/flashdata/' . $file . '/preview.jpg';
            $arr = array_slice(file($dir . $file . '/cycle_image.js'), 1, 2);
            $info_name = explode(':', $arr[0]);
            $info_desc = explode(':', $arr[1]);
            $info['name'] = isset($info_name[1]) ? trim($info_name[1]) : '';
            $info['desc'] = isset($info_desc[1]) ? trim($info_desc[1]) : '';
        }
        return $info;
    }

    private function set_flash_data($tplname, &$msg)
    {
        $flashdata = $this->get_flash_xml();
        if (empty($flashdata)) {
            $flashdata[] = [
                'src' => 'data/afficheimg/20081027angsif.jpg',
                'text' => 'ecmoban',
                'url' => 'http://www.ecmoban.com'
            ];
            $flashdata[] = [
                'src' => 'data/afficheimg/20081027wdwd.jpg',
                'text' => 'wdwd',
                'url' => 'http://www.wdwd.com'
            ];
            $flashdata[] = [
                'src' => 'data/afficheimg/20081027xuorxj.jpg',
                'text' => 'dscmall',
                'url' => 'http://help.dscmall.cn'
            ];
        }
        switch ($tplname) {
            case 'uproll':
                $msg = $this->set_flash_uproll($tplname, $flashdata);
                break;
            case 'redfocus':
            case 'pinkfocus':
            case 'dynfocus':
                $msg = $this->set_flash_focus($tplname, $flashdata);
                break;
            case 'default':
            default:
                $msg = $this->set_flash_default($tplname, $flashdata);
                break;
        }
        return $msg !== true;
    }

    private function set_flash_uproll($tplname, $flashdata)
    {
        $data_file = storage_public(DATA_DIR . '/flashdata/' . $tplname . '/data.xml');
        $xmldata = '<?xml version="1.0" encoding="' . EC_CHARSET . '"?><myMenu>';
        foreach ($flashdata as $data) {
            $xmldata .= '<myItem pic="' . $data['src'] . '" url="' . $data['url'] . '" />';
        }
        $xmldata .= '</myMenu>';

        write_static_file_cache('data', $xmldata, 'xml', storage_public(DATA_DIR . '/flashdata/' . $tplname . '/'));

        return true;
    }

    private function set_flash_focus($tplname, $flashdata)
    {
        $data_file = storage_public(DATA_DIR . '/flashdata/' . $tplname . '/data.js');
        $jsdata = '';
        $jsdata2 = ['url' => 'var pics=', 'txt' => 'var texts=', 'link' => 'var links='];
        $count = 1;
        $join = '';
        foreach ($flashdata as $data) {
            $jsdata .= 'imgUrl' . $count . '="' . $data['src'] . '";' . "\n";
            $jsdata .= 'imgtext' . $count . '="' . $data['text'] . '";' . "\n";
            $jsdata .= 'imgLink' . $count . '=escape("' . $data['url'] . '");' . "\n";
            if ($count != 1) {
                $join = '+"|"+';
            }
            $jsdata2['url'] .= $join . 'imgUrl' . $count;
            $jsdata2['txt'] .= $join . 'imgtext' . $count;
            $jsdata2['link'] .= $join . 'imgLink' . $count;
            ++$count;
        }

        write_static_file_cache('data', $jsdata . "\n" . $jsdata2['url'] . ";\n" . $jsdata2['link'] . ";\n" . $jsdata2['txt'] . ";", 'js', storage_public(DATA_DIR . '/flashdata/' . $tplname . '/'));

        return true;
    }

    private function set_flash_default($tplname, $flashdata)
    {
        $xmldata = '<?xml version="1.0" encoding="' . EC_CHARSET . '"?><bcaster>';
        foreach ($flashdata as $data) {
            $xmldata .= '<item item_url="' . $data['src'] . '" link="' . $data['url'] . '" />';
        }
        $xmldata .= '</bcaster>';

        write_static_file_cache('data', $xmldata, 'xml', storage_public(DATA_DIR . '/flashdata/' . $tplname . '/'));

        return true;
    }

    /**
     *  获取用户自定义广告列表信息
     *
     * @access  public
     * @param
     *
     * @return void
     */
    private function ad_list()
    {
        $result = get_filter();
        if ($result === false) {
            $aiax = isset($_GET['is_ajax']) ? $_GET['is_ajax'] : 0;
            $filter = [];
            $filter['sort_by'] = 'add_time';
            $filter['sort_order'] = 'DESC';

            /* 过滤信息 */
            $where = 'WHERE 1 ';

            /* 查询 */
            $sql = "SELECT ad_id, CASE WHEN ad_type = 0 THEN '" . lang('seller/common.imgage') . "'
                                   WHEN ad_type = 1 THEN '" . lang('seller/flashplay.flash') . "'
                                   WHEN ad_type = 2 THEN '" . lang('seller/flashplay.code') . "'
                                   WHEN ad_type = 3 THEN '" . lang('seller/flashplay.words') . "'
                                   ELSE '' END AS type_name, ad_name, add_time, CASE WHEN ad_status = 1 THEN '" . lang('seller/common.enabled') . "' ELSE '" . lang('seller/common.close') . "' END AS status_name, ad_type, ad_status
                FROM " . $this->dsc->table("ad_custom") . "
                $where
                ORDER BY " . $filter['sort_by'] . " " . $filter['sort_order'] . " ";

            set_filter($filter, $sql);
        } else {
            $sql = $result['sql'];
            $filter = $result['filter'];
        }

        $row = $this->db->getAll($sql);

        /* 格式化数据 */
        foreach ($row as $key => $value) {
            $row[$key]['add_time'] = local_date($GLOBALS['_CFG']['time_format'], $value['add_time']);
        }

        $arr = ['ad' => $row, 'filter' => $filter];

        return $arr;
    }

    /**
     * 修改自定义相状态
     *
     * @param int $ad_id 自定义广告 id
     * @param int $ad_status 自定义广告 状态 0，关闭；1，开启。
     * @access  private
     * @return  Bool
     */
    private function modfiy_ad_status($ad_id, $ad_status = 0)
    {
        $return = false;

        if (empty($ad_id)) {
            return $return;
        }

        /* 查询自定义广告信息 */
        $sql = "SELECT ad_type, content, url, ad_status FROM " . $this->dsc->table("ad_custom") . " WHERE ad_id = $ad_id LIMIT 0, 1";
        $ad = $this->db->getRow($sql);

        if ($ad_status == 1) {
            /* 如果当前自定义广告是关闭状态 则修改其状态为启用 */
            if ($ad['ad_status'] == 0) {
                $sql = "UPDATE " . $this->dsc->table("ad_custom") . " SET ad_status = 1 WHERE ad_id = $ad_id";
                $this->db->query($sql);
            }

            /* 关闭 其它自定义广告 */
            $sql = "UPDATE " . $this->dsc->table("ad_custom") . " SET ad_status = 0 WHERE ad_id <> $ad_id";
            $this->db->query($sql);

            /* 用户自定义广告开启 */
            $sql = "UPDATE " . $this->dsc->table("shop_config") . " SET value = 'cus' WHERE id =337";
            $this->db->query($sql);
        } else {
            /* 如果当前自定义广告是关闭状态 则检查是否存在启用的自定义广告 */
            /* 如果无 则启用系统默认广告播放器 */
            if ($ad['ad_status'] == 0) {
                $sql = "SELECT COUNT(ad_id) FROM " . $this->dsc->table("ad_custom") . " WHERE ad_status = 1";
                $ad_status_1 = $this->db->getOne($sql);
                if (empty($ad_status_1)) {
                    $sql = "UPDATE " . $this->dsc->table("shop_config") . " SET value = 'sys' WHERE id =337";
                    $this->db->query($sql);
                } else {
                    $sql = "UPDATE " . $this->dsc->table("shop_config") . " SET value = 'cus' WHERE id =337";
                    $this->db->query($sql);
                }
            } else {
                /* 当前自定义广告是开启状态 关闭之 */
                /* 如果无 则启用系统默认广告播放器 */
                $sql = "UPDATE " . $this->dsc->table("ad_custom") . " SET ad_status = 0 WHERE ad_id = $ad_id";
                $this->db->query($sql);

                $sql = "UPDATE " . $this->dsc->table("shop_config") . " SET value = 'sys' WHERE id =337";
                $this->db->query($sql);
            }
        }

        return $return = true;
    }
}
