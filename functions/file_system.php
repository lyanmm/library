<?php
function upload()
{
    $file = $_FILES['file'];
    $error = $file['error'];
    switch ($error) {
        case 0:
            $dir = "./upload/";
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }
            $file_name = $file['name'];
            $file_temp = $file['tmp_name'];
            $destination = $dir . $file_name;
            move_uploaded_file($file_temp, $destination);
            return "文件上传成功！";
            break;
        case 1:
            return "上传的文件超过了php.ini中upload_max_filesize选项限制的值！";
            break;
        case 2:
            return "上传的文件的大小超过了FRPOM表单MAX_FILE_SIZE选项指定的值！";
            break;
        case 3:
            return "文件只有部分被上传！";
            break;
        case 4:
            return "没有选择上传的文件！";
            break;
    }
}

function download($file_name)
{
    header("Content-type:text/html;charset=utf-8");
    $file_name = "";
    $file_name = iconv("utf-8", "gb2312", $file_name);
    $file_sub_path = './upload/';
    $file_path = $file_sub_path . $file_name;
    if (!file_exists($file_path)) {
        echo "下载文件不存在！";
        exit;
    }
    $fp = fopen($file_path, "r");
    $file_size = filesize($file_path);
    Header("Content-type: application/octet-stream");
    Header("Accept-Ranges: bytes");
    Header("Accept-Length:" . $file_size);
    Header("Content-Disposition: attachment; filename=" . $file_name);
    $buffer = 1024;
    $file_count = 0;
    while (!feof($fp) && $file_count < $file_size) {
        $file_con = fread($fp, $buffer);
        $file_count += $buffer;
        echo $file_con;
    }
    fclose($fp);
}

?>