<?php
require_once("parent.php");

class akun extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function gantiPassword(string $username, string $password, string $new_password)
    {
        $sql = "SELECT password FROM akun WHERE username = ?";

        $stmt = $this->mysqli->prepare($sql);

        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if (password_verify($password, $row['password'])) {
            $sqlGanti = "UPDATE akun SET password = ? WHERE username = ?";
            $stmtGanti = $this->mysqli->prepare($sqlGanti);

            $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmtGanti->bind_param("ss", $hash_password, $username);

            $stmtGanti->execute();
            $stmtGanti->close();

            return "success";
        } else {
            return "password_salah";
        }
    }
}
