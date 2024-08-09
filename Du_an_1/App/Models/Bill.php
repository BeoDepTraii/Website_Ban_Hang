<?php

namespace App\Models;

class Bill extends BaseModel
{
    protected $table = 'bill';
    protected $id = 'id';

    public function getAllBill()
    {
        return $this->getAll();
    }
    public function getOneBill($id)
    {
        return $this->getOne($id);
    }

    public function createBill($data)
    {
        return $this->create($data);
    }
    public function updateBill($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteBill($id)
    {
        return $this->delete($id);
    }
    public function getAllBillByStatus()
    {
        $result = [];
        try {
        $sql = "SELECT * FROM $this->table WHERE status=" . self::STATUS_ENABLE;
        $sql = "SELECT products.* FROM products INNER JOIN categories ON products.category_id=categories.id WHERE products.status=".self::STATUS_ENABLE." AND categories.status=".self::STATUS_ENABLE;
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
        
        } catch (\Throwable $th) {
        error_log('Lỗi khi lấy loại sản phẩm bằng tên: ' . $th->getMessage());
        return $result;
    }
    }

    public function getOneBillByName($name)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE name=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $name);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy loại sản phẩm bằng tên: ' . $th->getMessage());
            return $result;
        }
    }


    public function getAllBillJoinCategory()
    {
        $result = [];
        try {
            $sql = "SELECT products.*,categories.name AS category_name 
            FROM products INNER JOIN categories 
            ON products.category_id=categories.id;";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllBillByCategoryAndStatus(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name FROM products 
            INNER JOIN categories ON products.category_id=categories.id 
            WHERE products.status=".self::STATUS_ENABLE.
            " AND categories.status=".self::STATUS_ENABLE . " AND products.category_id=?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql); 

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOneBillByStatus(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name FROM products 
            INNER JOIN categories ON products.category_id=categories.id 
            WHERE products.status=".self::STATUS_ENABLE.
            " AND categories.status=".self::STATUS_ENABLE . " AND products.id=?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql); 

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countTotalPrduct(){
        return $this->countTotal();
    } 

    public function getBillByUserAndProduct()
    {
        $result = [];
        try {
            $sql = "SELECT bill.* FROM bill INNER JOIN 
            users ON bill.user_id=users.id INNER JOIN 
            products ON bill.product_id=products.id;";            
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiện thị dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

}
