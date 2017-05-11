<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 06-Apr-17
 * Time: 2:45 PM
 */

//upload image
function uploadImage($upload_path = '', $obj_file = '', $is_submit = 0, $max_size = 2048, $file_type = []){
    //target_dir = "upload/";
    $uploadOk =1;
    $result = ['message' => 'default', 'uploadOk' => $uploadOk, 'newNameImage' => ''];
    $result['message'] = 'default';
    $target_dir = $upload_path;

    $newNameImage = wp_modify_uploaded_file_names($obj_file['avatar-reg']['name']);
    $result['newNameImage'] = $newNameImage;
    $target_file = $target_dir.basename($newNameImage);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    //check file exist
    if(file_exists($target_dir.$newNameImage)){
        $uploadOk = 0;
        $result['message'] = 'Image file existed, Please choice other file !';
        $result['uploadOk'] = $uploadOk;
        return $result;
    }

    //check if image file is a actual image or fake image
    if($is_submit){
        $check = getimagesize($obj_file['avatar-reg']['tmp_name']);
        if($check !== false){
            $uploadOk = 1;
            $result['message'] = "File is an image - ".$check['mime'].".";
            $result['uploadOk'] = $uploadOk;

        }else{

            $uploadOk = 0;
            $result['message'] = 'File is not an image';
            $result['uploadOk'] = $uploadOk;
        }
    }

    //check file size
    if($obj_file['avatar-reg']['size'] > $max_size){

        $uploadOk = 0;
        $result['message'] = 'Sorry, your file is too large';
        $result['uploadOk'] = $uploadOk;
    }

    //Allow certain file format
    if(!in_array($imageFileType,$file_type)){

        $uploadOk = 0;
        $result['message'] = 'Sorry, only image files are allowed';
        $result['uploadOk'] = $uploadOk;
    }

    //check if $upload is set to 0 by an error
    if($uploadOk == 0) {

        $result['message'] = 'Sorry, your file did not upload';
        $result['uploadOk'] = $uploadOk;
        //if everything is OK, try to upload file
    }else{
        if(move_uploaded_file($obj_file['avatar-reg']['tmp_name'], $target_file)){
            $result['message'] = 'The file '.basename($obj_file['avatar-reg']['name']).' was uploaded';
        }else{
            $result['message'] = 'Sorry, there was an error uploading your file.';
        }
        return $result;
    }
}

/*Doi ten file*/
function wp_modify_uploaded_file_names($image_name) {
    // Get the parent post ID, if there is one
    $cut = explode(('.'),$image_name);
    $name = $cut[0];
    $type = $cut[1];
    $now = getdate();
    $year = $now['year'];
    $mon = $now['mon'];
    $day = $now['mday'];
    $hour = $now['hours'];
    $min = $now['minutes'];
    $sec = $now['seconds'];
    $rand=rand(1, 99999);
    $link = $year.$mon.$day.$hour.$min.$hour.$sec.$rand;
    $newname = $name.'_'.$link.'.'.$type;
    return $newname;

}


//Pagination
function pagination($current_page = 1, $allData = array(), $number_records, $table_name = '',$link = '', $model_obj, $search = '', $join = ''){

    $from = ($current_page - 1)*$number_records;

    $result = array('paging' => '', 'data' => array());
    if(count($allData) > $number_records){

        $end = floor(count($allData)/$number_records);

        if(count($allData)%$number_records != 0){
            $end++;
        }

        $query = 'select * from '.$table_name.' '.$join.' limit '.$from.','.$number_records;

        $result['data'] = $model_obj->executeQuery($query);


        $preview = '';
        $pages = '';
        $next = '';
        $search_html = '';
        if($search != ''){
            $search_html = '&search_data='.$search;
        }

        if($current_page != 1){
            $preview = '<li class="paginate_button previous" id="example2_previous">
                            <a href="'.$link.($current_page - 1).$search_html.'" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a>
                        </li>';
        }else{
            $preview = '<li class="paginate_button previous disabled" id="example2_previous">
                            <a href="" aria-controls="example2" data-dt-idx="0" tabindex="0" disabled="">Previous</a>
                        </li>';
        }

        if($current_page != $end){
            $next = '<li class="paginate_button next" id="example2_next">
                            <a href="'.$link.($current_page + 1).$search_html.'" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a>
                     </li>';
        }else{
            $next = '<li class="paginate_button next disabled" id="example2_next">
                            <a href="" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a>
                     </li>';
        }

        for ($i=1; $i<= $end; $i++){
            if($current_page == $i){
                $pages .= '<li class="paginate_button active">
                                <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">'.$i.'</a>
                           </li>';
            }else{
                $pages .= '<li class="paginate_button ">
                                <a href="'. $link . $i .$search_html. '" aria-controls="example2" data-dt-idx="' . $i . '" tabindex="0">' . $i . '</a>
                            </li>';
            }
        }

        $paging = '
            <div class="col-sm-7">
                 <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    <ul class="pagination">
                        '.$preview.'
                        '.$pages.'
                        '.$next.' 
                    </ul>
                    </div>
            </div>  ';

        $result['paging'] =$paging;
    }
    return $result;
}

function convert_vi_to_en($str)
{
    $str = preg_replace("/(à | á | ạ | ả | ã | â | ầ | ấ | ậ | ẩ | ẫ | ă | ằ | ắ | ặ | ẳ | ẵ) /", 'a', $str);
  $str = preg_replace("/(è | é | ẹ | ẻ | ẽ | ê | ề | ế | ệ | ể | ễ) /", 'e', $str);
  $str = preg_replace("/(ì | í | ị | ỉ | ĩ) /", 'i', $str);
  $str = preg_replace("/(ò | ó | ọ | ỏ | õ | ô | ồ | ố | ộ | ổ | ỗ | ơ | ờ | ớ | ợ | ở | ỡ) /", 'o', $str);
  $str = preg_replace("/(ù | ú | ụ | ủ | ũ | ư | ừ | ứ | ự | ử | ữ) /", 'u', $str);
  $str = preg_replace("/(ỳ | ý | ỵ | ỷ | ỹ) /", 'y', $str);
  $str = preg_replace("/(đ) /", 'd', $str);
  $str = preg_replace("/(À | Á | Ạ | Ả | Ã | Â | Ầ | Ấ | Ậ | Ẩ | Ẫ | Ă | Ằ | Ắ | Ặ | Ẳ | Ẵ) /", 'A', $str);
  $str = preg_replace("/(È | É | Ẹ | Ẻ | Ẽ | Ê | Ề | Ế | Ệ | Ể | Ễ) /", 'E', $str);
  $str = preg_replace("/(Ì | Í | Ị | Ỉ | Ĩ) /", 'I', $str);
  $str = preg_replace("/(Ò | Ó | Ọ | Ỏ | Õ | Ô | Ồ | Ố | Ộ | Ổ | Ỗ | Ơ | Ờ | Ớ | Ợ | Ở | Ỡ) /", 'O', $str);
  $str = preg_replace("/(Ù | Ú | Ụ | Ủ | Ũ | Ư | Ừ | Ứ | Ự | Ử | Ữ) /", 'U', $str);
  $str = preg_replace("/(Ỳ | Ý | Ỵ | Ỷ | Ỹ) /", 'Y', $str);
  $str = preg_replace("/(Đ) /", 'D', $str);
  //$str = str_replace(” ", "-”, str_replace("&*#39;”,”",$str));
  return $str;
}

//upload Many image
function uploadManyImage($upload_path = '', $obj_file = '', $is_submit = 0, $max_size = 2048, $file_type = []){
    //target_dir = "upload/";
    for($i = 0; $i < sizeof($obj_file['p-image']['name']); $i++) {
        $uploadOk = 1;
        $result[$i] = ['message' => 'default', 'uploadOk' => $uploadOk, 'newNameImage' => ''];
        $result['message'][$i] = 'default';
        $target_dir = $upload_path;

        $newNameImage = wp_modify_uploaded_file_names($obj_file['p-image']['name'][$i]);
        $result['newNameImage'][$i] = $newNameImage;
        $target_file = $target_dir . basename($newNameImage);

        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        //check file exist
        if (file_exists($target_dir . $newNameImage)) {
            $uploadOk = 0;
            $result['message'][$i] = 'Image file existed, Please choice other file !';
            $result['uploadOk'][$i] = $uploadOk;
            return $result;
        }

        //check if image file is a actual image or fake image
        if ($is_submit) {
            $check = getimagesize($obj_file['p-image']['tmp_name'][$i]);
            if ($check !== false) {
                $uploadOk = 1;
                $result['message'][$i] = "File is an image - " . $check['mime'] . ".";
                $result['uploadOk'][$i] = $uploadOk;

            } else {
                $uploadOk = 0;
                $result['message'][$i] = 'File is not an image';
                $result['uploadOk'][$i] = $uploadOk;
            }
        }

        //check file size
        if ($obj_file['p-image']['size'][$i] > $max_size) {

            $uploadOk = 0;
            $result['message'][$i] = 'Sorry, your file is too large';
            $result['uploadOk'][$i] = $uploadOk;
        }

        //Allow certain file format
        if (!in_array($imageFileType, $file_type)) {

            $uploadOk = 0;
            $result['message'][$i] = 'Sorry, only image files are allowed';
            $result['uploadOk'][$i] = $uploadOk;
        }

        //check if $upload is set to 0 by an error
        if ($uploadOk == 0) {
            $result['message'] = 'Sorry, your file did not upload';
            $result['uploadOk'][$i] = $uploadOk;
            //if everything is OK, try to upload file
        } else {

            $tmpFilePath = $obj_file['p-image']['tmp_name'][$i];
            if (move_uploaded_file($tmpFilePath, $target_file)) {
                $result['message'][$i] = 'The file ' . basename($obj_file['p-image']['name'][$i]) . ' was uploaded';
            } else {
                $result['message'][$i] = 'Sorry, there was an error uploading your file.';
            }
        }
    }
    return $result;
}


//convert vi to en
/*function seoname($str){
    if(!$str) return false;
    $unicode = array(
        'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ'),
        'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'),
        'd'=>array('đ'),
        'D'=>array('Đ'),
        'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'),
        'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'),
        'i'=>array('í','ì','ỉ','ĩ','ị'),
        'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
        'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ'),
        'O'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'),
        'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự'),
        'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'),
        'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
        'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
        '-'=>array(' ','&quot;','.','-–-')
    );
    foreach($unicode as $nonUnicode=>$uni){
        foreach($uni as $value)
            $str = @str_replace($value,$nonUnicode,$str);
        $str = preg_replace("/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/","-",$str);
        $str = preg_replace("/-+-/","-",$str);
        $str = preg_replace("/^\-+|\-+$/","",$str);
    }
    return strtolower($str);
}*/
