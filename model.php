<?php

include 'data.php';

class Model
{
    public function getContacts($data){
        return $this->data['contact']['users'];
    }


    public function getTitle($page,$data){
        return $this->data[$page]['title'];
    }


    public function getContent($page,$data){
        return $this->data[$page]['content'];
    }
}