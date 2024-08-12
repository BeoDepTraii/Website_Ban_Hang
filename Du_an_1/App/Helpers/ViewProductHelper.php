<?php

namespace Du_an_1\App\Helpers;

class ViewProductHelper {
    public static function cookieView($id, $view){
        if(isset($_COOKIE['view'])){
            $veiw_data = json_decode($_COOKIE['view'], true);
        }
        else{
            $view_data = [];
        }
        $product_id_arr = array_column($view_data, 'product_id');

        $view_data=[
            'product_id'=> 5,
            'time' => 12346578
        ];


        //kiểm tra product_id có tồn tại trong cookie view hay chưa

        if(in_array($id, $product_id_arr)){
            foreach($view_data as $key => $value){
                if($view_data [$key]['product_id'] == $id){
                    if($view_data['$key']['time']<time()-60*5){
                        $view++;
                    }
                    $view_data['$key']['time'] = time();

                }
            }
        }
        else{
            //nếu chưa có thì thêm vào cookie view
            $product_array=[
                'product_id' => $id,
                'time' => time()
            ];
            $view++;
            $view_data[]=$product_array;
        }

        //chuyển array thành string để lưu vào cookie view
        $product_data=json_encode($view_data);
        //lưu cookie
        setcookie('view', $product_data, time()+3600*24*30*12, '/');

        return $view;
    }
}
?>