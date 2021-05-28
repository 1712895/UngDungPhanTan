<?php


class PostModel
{
    public $header;
    public $detail;
    public $id_User;
    function __construct()
    {
        $this->header = "";
        $this->detail = "";
        $this->id_User = "";
    }
    public static function listAll() {


        $db = connect();
        $result = $db->Post->findOne();

        //$dssv = array();
//        if ($result)
//        {
//            foreach ($result as $row) {
//                $sv = new SinhVienModel();
//                $sv->HOTEN = $row["HoTen"];
//                $sv->MSSV = $row["MSSV"];
//                $dssv[] = $sv; //add an item into array
//            }
//        }
        return $result;
    }
}

/*var_dump(PostModel::listAll());*/
?>