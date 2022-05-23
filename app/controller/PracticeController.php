<?php
namespace app\Controller;

class PracticeController{

    /**
     * 测试curl多线程
     */
    public function curlHandle(){
        $timeout = 10;
        $array = array(
            "http://www.weibo.com/",
            "http://www.renren.com/",
            "http://www.qq.com/"
        );
        //创建curl句柄组
        $mh = curl_multi_init();
        foreach ($array as $k=>$v){
            $conn[$k] = curl_init();
            curl_setopt($conn[$k],CURLOPT_TIMEOUT,$timeout);
            curl_setopt($conn[$k],CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
            curl_setopt($conn[$k],CURLOPT_MAXREDIRS,7);    //最大重定向次数
            curl_setopt($conn[$k],CURLOPT_HEADER,0);   //去掉header提高效率
            curl_setopt($conn[$k], CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
            curl_setopt($conn[$k],CURLOPT_RETURNTRANSFER,1);
            //向句柄组添加单独的会话
            curl_multi_add_handle($mh,$conn[$k]);
        }


        // 执行批处理句柄
        $active = null;
        do{
            $mrc = curl_multi_exec($mh,$active);//当无数据，active=true
        }while($mrc == CURLM_CALL_MULTI_PERFORM);//当正在接受数据时
        while($active && $mrc == CURLM_OK){//当无数据时或请求暂停时，active=true
//        if(curl_multi_select($mh) != -1){
            do{
                $mrc = curl_multi_exec($mh, $active);
            }while($mrc == CURLM_CALL_MULTI_PERFORM);
//        }
        }

        //关闭一组句柄
        //curl_multi_close($mh);
        foreach ($array as $k => $url) {
            curl_error($conn[$k]);
            $res[$k]=curl_multi_getcontent($conn[$k]);//获得返回信息
            $header[$k]=curl_getinfo($conn[$k]);//返回头信息
            curl_close($conn[$k]);//关闭句柄
            curl_multi_remove_handle($mh  , $conn[$k]);//释放资源
        }

        curl_multi_close($mh);
        var_dump($res);

    }

}