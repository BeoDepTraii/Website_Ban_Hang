<?php

namespace App\Models;

class comment extends BaseModel
{
    protected $table = 'comments';
    protected $id = 'id';

    public function getAllcomment()
    {
        return $this->getAll();
    }
    public function getOnecomment($id)
    {
        return $this->getOne($id);
    }

    public function createcomment($data)
    {
        return $this->create($data);
    }
    public function updatecomment($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletecomment($id)
    {
        return $this->delete($id);
    }
    public function getAllcommentByStatus()
    {
        return $this->getAllByStatus();
    }
    public function getAllCommentJoinProductAndUser()
    {
        $result = [];
        try {
            $sql = "SELECT comments.*, products.name AS product_name, users.username FROM comments INNER JOIN products ON comments.product_id=products.id INNER JOIN users ON comments.user_id=users.id;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOneCommentJoinProductAndUser(int $id)
    {
        try {
            $sql = "SELECT comments.*, products.name AS product_name, users.username FROM comments INNER JOIN products ON comments.product_id=products.id INNER JOIN users ON comments.user_id=users.id
            WHERE comments.id=?;";
          
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
}
