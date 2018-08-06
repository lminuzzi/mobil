<?php

class User extends Model
{
    protected $id;
    protected $login;
    protected $email;

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['uid']) && is_numeric($_SESSION['uid'])) {
            $this->id = $_SESSION['uid'];
        }
    }
    public function auth($user, $pass)
    {
        $sql = $this->db->prepare('SELECT * FROM USERS WHERE login = :user AND password = :pass');
        $sql->bindValue(':user', $user);
        $sql->bindValue(':pass', $pass);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $result = $sql->fetch();
            $this->id = $result['id'];
            $this->login = $result['login'];
            $this->email = $result['email'];
            $_SESSION['uid'] = $this->id;
            return true;
        } else {
            $_SESSION['erro'] = 'Usuário ou senha inválidos';
            return false;
        }
    }
    public function getInfo($id = null)
    {
        if (!is_numeric($id)) {
            return false;
        } else {
            $sql = $this->db->query("SELECT * FROM USERS WHERE id = $id");
            if ($sql->rowCount() > 0) {
                $result = $sql->fetch();
                $this->login = $result['login'];
                $this->email = $result['email'];
            }
        }
    }
    public function isLoggedIn()
    {
        return isset($this->id);
    }

    public function cadUser($data)
    {
        $login = $data['login'];
        $sql = "SELECT * FROM USERS WHERE (login = '$login')";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return false;
        }

        $keys = array();
        foreach ($data as $a => $k) {
            $data[$a] = addslashes($k);
            if ($a == 'password') {
                $data[$a] = md5($data[$a]);
            }
                $keys[] = $a;
        }

        $sql = 'INSERT INTO USERS('.implode(',', $keys).') VALUES(\''.implode("','", $data).'\')';
        $sql = @$this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = $this->db->query("SELECT id, login, nome, email, 
            CASE 
                WHEN perfil = 'A' THEN 'ADMINISTRADOR'
                WHEN perfil = 'C' THEN 'CLIENTE'
                WHEN perfil = 'I' THEN 'INSPEÇÃO'
                ELSE ''
            END AS perfil 
            FROM USERS");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getClientes()
    {
        $sql = $this->db->query("SELECT * FROM USERS WHERE perfil = 'C'");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function del($id)
    {
        if (is_numeric($id)) {
            $sql = "DELETE FROM USERS WHERE id = '$id'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function updatePassword($id, $pass)
    {
        $pass = md5($pass);
        $id = addslashes($id);
        $sql = $this->db->query("UPDATE users SET password = '$pass' WHERE id = $id");
        return true;
    }
}
