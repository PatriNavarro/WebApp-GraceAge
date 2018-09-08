<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 07/11/2017
 * Time: 20:21
 */

date_default_timezone_set('UTC');

class AccountViewModel {
    public function createViewModel($row) {
        $temp = array(
            'id' => $row->id,
            'username' => $row->username,
            'display_name' => $row->display_name,
            'description' => $row->description,
            'email' => $row->email,
            'user_type' => $row->user_type,
            'preferred_language' => $row->preferred_language,
            'created_date' => date('Y/m/d', strtotime($row->created_date)),
            'depending_user_id' => $row->depending_user_id
        );

        foreach ($temp as $key => $value) {
            if (is_null($value)) {
                $temp[$key] = "";
            }
        }
        return (object)$temp;
    }
    public function createDataModel($from_client) {
        $filtered_data = array_filter($from_client);
        $temp = array(
            'id' => $this->validateField($from_client, 'id'),
            'username' => $this->validateField($from_client, 'username'),
            'password' => md5($this->validateField($from_client, 'password')),
            'display_name' => $this->validateField($from_client, 'display_name'),
            'description' => $this->validateField($from_client, 'description'),
            'email' => $this->validateField($from_client, 'email'),
            'user_type' => $this->validateField($from_client, 'user_type'),
            'preferred_language' => $this->validateField($from_client, 'preferred_language'),
        );
        if ($this->validateField($from_client, 'depending_user_id') != '')
            $temp['depending_user_id']= $this->validateField($from_client, 'depending_user_id');
        return $temp;
    }
    private function validateField($data, $key) {
        if (isset($data[$key]))
            return $data[$key];
        return '';
    }
}