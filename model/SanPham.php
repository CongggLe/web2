<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SanPham
 *
 * @author DELL
 */
class SanPham {

    //put your code here
    public $maSP;
    public $tenSP;
    public $giaSP;
    public $moTaSP;
    public $soLuongSP;
    public $imgSP;

    public function __construct($ma, $ten, $gia, $sl, $mota, $img) {
      
        $this->maSP = $ma;
        $this->tenSP = $ten;
        $this->giaSP = $gia;
        $this->soLuongSP = $sl;
        $this->moTaSP = $mota;
        $this->imgSP = $img;
        
    }
    
    public function xuat(){
        echo  $this->maSP."-".$this->tenSP;
    }

   

    public function getMaSP() {
        return $this->maSP;
    }

    public function getTenSP() {
        return $this->tenSP;
    }

    public function getGiaSP() {
        return $this->giaSP;
    }

    public function getMoTaSP() {
        return $this->moTaSP;
    }

    public function setMaSP($maSP) {
        $this->maSP = $maSP;
    }

    public function setTenSP($tenSP) {
        $this->tenSP = $tenSP;
    }

    public function setGiaSP($giaSP) {
        $this->giaSP = $giaSP;
    }

    public function setMoTaSP($moTaSP) {
        $this->moTaSP = $moTaSP;
    }

    public function getSoLuongSP() {
        return $this->soLuongSP;
    }

    public function setSoLuongSP($soLuongSP) {
        $this->soLuongSP = $soLuongSP;
    }

    public function getImgSP() {
        return $this->imgSP;
    }

    public function setImgSP($imgSP) {
        $this->imgSP = $imgSP;
    }
    
    public function insertProduct($arr_param) {
       // $sql = "INSERT INTO product(productname, email, password, sex, prefer, avatar, role) values(:productname, :email, :password, :sex, :prefer, :avatar, :role)";

        $dbCon = new MySQLUtils();
        $dbCon->connect();
        $dbCon->insertData($sql, $arr_param);
        $dbCon->disconnect();
    }

    public function deleteProduct($arr_param) {
        $sql = "DELETE FROM product WHERE productname = :productname";
        $dbCon = new MySQLUtils();
        $dbCon->connect();
        $dbCon->deleteData($sql, $arr_param);
        $dbCon->disconnect();
    }

    public function getAllProduct() {
         $sql = "SELECT * FROM tbl_product";
        $arrProduct = array();
        $dbCon = new MySQLUtils();
        $dbCon->connect();
        $arrProduct = $dbCon->getAllData($sql);
        $dbCon->disconnect();
        return $arrProduct;
    }

    public function updateProduct($arr_param) {
        $sql = "UPDATE product SET email=:email where id = :id";
        $dbCon = new MySQLUtils();
        $dbCon->connect();
        $dbCon->updateData($sql, $arr_param);
        $dbCon->disconnect();
    }

    public function getProduct($arr = array()) {
        $sql = "SELECT id,productname,email FROM product where id = :id";
        $product = array();
        $dbCon = new MySQLUtils();
        $dbCon->connect();
        $product = $dbCon->getData($sql, $arr);
        $dbCon->disconnect();
        return $product;
    }
    
    
     public function getAllProductByID($maSPList) {
        $sql = "SELECT * FROM tbl_product where product_id IN (".$maSPList.")";
        $arrProduct = array();
        $dbCon = new MySQLUtils();
        $dbCon->connect();
        $arrProduct = $dbCon->getAllData($sql);
        $dbCon->disconnect();
        return $arrProduct;
    }
    

}
