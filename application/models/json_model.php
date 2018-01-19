<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class json_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function insertData($ten,$dulieu)
	{
		//Tạo mảng dữ liệu
		$mangdulieu=array(
					'ten'=>$ten,
					'dulieu'=>$dulieu
				);
		$this->db->insert('warehouse1',$mangdulieu);
		return $this->db->insert_id();
	}
	public function showData()
	{
		$this->db->select('*');
		//những dữ liệu có trường ten là contact thì lấy dữ liệu ấy ra
		$this->db->where('ten','contact');
		$ketqua=$this->db->get('warehouse1');
		$ketquadangmang=$ketqua->result_array();
		return $ketquadangmang;
		
		// Thay vì return hết các dữ liệu có trong mảng được lấy ra từ MySQL thì ta 
		// chỉ dùng biến dulieu thoi.
		// Ta dùng foreach để thực hiện điều đó
		//foreach ($ketquadangmang as $value) {
		//	$dulieuduoclay=$value['dulieu'];
		//}
		//return $dulieuduoclay;
	}

	/*
	* Viết hàm update dữ liệu sau khi xoá ở json_view thuộc class="btn btn-danger btn-center"  
	* Gía trị của $dulieu_xu_ly chính là giá trị của $ketqua_decode_ketquamang được gửi
	*  từ json_controller ở hàm xoa_json
	*/
	public function updateData($dulieu_xu_ly)
	{
		
		$mang_xu_ly= array(
			'ten' => "contact",
			'dulieu' => $dulieu_xu_ly);

		$this->db->where('ten','contact');

		//update vào mảng dữ liệu của bảng warehouse1
		return $this->db->update('warehouse1', $mang_xu_ly);// return nếu đúng sẽ trả về 1 còn sai thì trả về không

	}


}

/* End of file json_model.php */
/* Location: ./application/models/json_model.php */