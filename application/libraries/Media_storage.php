<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Media_storage
{

    private $_CI;

    public function __construct()
    {
        $this->_CI = &get_instance();
        $this->_CI->load->library('customlib');

    }

    public function fileupload($media_name, $upload_path = "")
    {
        if (file_exists($_FILES[$media_name]['tmp_name']) && !$_FILES[$media_name]['error'] == UPLOAD_ERR_NO_FILE) {

            $name        = $_FILES[$media_name]['name'];
            $file_name   = time() . "-" . uniqid(rand()) . "!" . $name;
            $destination = $this->_CI->customlib->getFolderPath() . $upload_path . $file_name;

            if (move_uploaded_file($_FILES[$media_name]["tmp_name"], $destination)) {

                return $file_name;
            }

        }

        return null;
    }

public function fileupload1($media_name, $upload_path = "")
{
    if (
        isset($_FILES[$media_name]) &&
        is_uploaded_file($_FILES[$media_name]['tmp_name']) &&
        $_FILES[$media_name]['error'] === UPLOAD_ERR_OK
    ) {
        $name = basename($_FILES[$media_name]['name']);
        $file_name = time() . "-" . uniqid(rand(), true) . "!" . $name;

        $upload_path = rtrim($upload_path, '/') . '/';

      
        $destination_dir = FCPATH . $upload_path; 
        $destination = $destination_dir . $file_name;

        
        if (!is_dir($destination_dir)) {
            mkdir($destination_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES[$media_name]["tmp_name"], $destination)) {
            return $file_name;
        } else {
            error_log("Failed to move file to: $destination");
        }
    }

    return null;
}




    public function filedownload($file_name, $download_path = "")
    {

        $file_url           = $this->_CI->customlib->getFolderPath() . $download_path . "/" . $file_name;
        $download_file_name = substr($file_name, (strpos($file_name, '!') + 1));
        $this->_CI->load->helper('download');
        $data = file_get_contents($file_url);
        force_download($download_file_name, $data);

    }

    public function fileview($file_name)
    {
        if (!IsNullOrEmptyString($file_name)) {

            $download_file_name = substr($file_name, (strpos($file_name, '!') + 1));
            return $download_file_name;
        }
        return null;

    }

    public function getImageURL($file_name)
    {
        if (!IsNullOrEmptyString($file_name)) {

            $download_file_name = $this->_CI->customlib->getBaseUrl() . $file_name . img_time();
            return $download_file_name;
        }
        return null;

    }
    public function get_newImageURL($file_name)
    {
        if (!IsNullOrEmptyString($file_name)) {

            $download_file_name = $this->_CI->customlib->getBaseUrl() . $file_name;
            return $download_file_name;
        }
        return null;

    }

    public function filedelete($file_name, $path = "")
    {
        if (!IsNullOrEmptyString($file_name)) {

            $url = $this->_CI->customlib->getFolderPath() . $path . "/" . $file_name;

            if (file_exists($url)) {

                if (unlink($url)) {
                    return true;
                }

            }
        }

        return false;
    }


    public function ritkfileupload($media_name, $upload_path = "",$key)
    {
        if (file_exists($_FILES[$media_name]['tmp_name'][$key]) && !$_FILES[$media_name]['error'][$key] == UPLOAD_ERR_NO_FILE) {

            $name        = $_FILES[$media_name]['name'][$key];
            $file_name   = time() . "-" . uniqid(rand()) . "!" . $name;
            $destination = $this->_CI->customlib->getFolderPath() . $upload_path . $file_name;

            if (move_uploaded_file($_FILES[$media_name]["tmp_name"][$key], $destination)) {

                return $file_name;
            }

        }

        return null;
    }



}
