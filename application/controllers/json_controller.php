<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class json_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Khi ta load model ngay tại đây thì khi muốn dùng json_model thì không cần gọi dòng này ra nữa 
		$this->load->model('json_model');
	}

	public function index()
	{
		//echo "Khơi tạo thành công";
		// $motcontact = array('ten' =>"Khang1",
		// 				'sdt'=>"513616816"
		// 			 );
		// echo "<pre>";
		// //var_dump($motcontact);
		// $caccontact=array();
		// array_push($caccontact, $motcontact);
		// echo "<pre>";
		// //var_dump($caccontact);
		// $motcontact2=array(
		// 			'ten'=>"Giao",
		// 			'sdt'=>"64645654"
		// 	);
		// array_push($caccontact, $motcontact2);
		// //var_dump($caccontact);
		// //mã hoá caccontact thành json bằng hàm json_encode
		// $noidungmahoa=json_encode($caccontact);
		// // echo"<h2>Đây là kiểu json (đã được mã hoá để nhét vào cơ sở dữ liệu)</h2>";
		// // echo "<pre>";
		// // var_dump($noidungmahoa);

		// //Sau đó insert dữ liệu vào cơ sở dữ liệu
		// //sau đó lấy dữ liệu ra bằng cách dùng hàm tên là json_decode()
		// //Khi đã giải mã thì mới có thể dùng vòng lặp để sử dụng
		// // echo "<h2>Đây là kiểu array (đã được giải mã để sử dụng)</h2>";
		// // echo "<pre>";
		// // var_dump(json_decode($noidungmahoa));
		// //Gọi model để insert dữ liệu
		// $this->load->model('json_model');
		// echo $this->json_model->insertData('contact',$noidungmahoa);


		/*Do json_model đã được gọi ở hàm __construct() trong controller nên không cần
		* gọi $this->load->model('json_model');
		*  
		*/
		$ketqua= $this->json_model->showData();
		//echo $ketqua;
		//giải mã bằng json_decode của biến kết quả(để chuyển từ mã json thành dạng mảng)	
		$ketquadagiaima=json_decode($ketqua,true);
		// echo "<pre>";
		// var_dump($ketquadagiaima) ;
		$ketquadagiaima_view=array('ketquachuyenvao'=>$ketquadagiaima);
		$this->load->view('json_view',$ketquadagiaima_view);


		// echo "<pre>";
		// var_dump($ketquadagiaima);
	}

	/* 
	* Viết hàm xoá dữ liệu json
	* $sdt_tra_ve là giá trị được lấy từ json_view ở class="btn btn-danger btn-center" 
	*/
	public function xoa_json($sdt_tra_ve)
	{
		//Lấy dữ liệu ra
		// Sử dụng hàm showData có trong controller để đỡ phải viết lại dữ liệu
		//  $ketquamang là một chuỗi json nên phải decode nó
		$ketquamang = $this->json_model->showData();

		// Tiến hành giải mã để biến $ketquamang thành 1 mảng dữ liệu
		$ketqua_decode_ketquamang = json_decode($ketquamang);

		/* Duyệt các phần tử trong mảng, rồi so sánh xem có phần tử nào có sdt trùng với $sdt_tra_ve
		* Nếu trùng thì dùng hàm unset($tenmang[$key]) để xoá nó đi khỏi mảng gốc
		* $value có 2 giá trị là ten và sdt
		*/
		foreach ($ketqua_decode_ketquamang as $key => $value) {
			if($value->sdt == $sdt_tra_ve)
			{
				//var_dump($sdt_tra_ve);
				//Viết hàm unset để xoá phần tử dulieu
				unset($ketqua_decode_ketquamang[$key]);
			}
		}

		/*Cập nhật sự thay đổi vào tầng dữ liệu -> Viết hàm trong model để cập nhật dữ liệu*/
		 // echo "<pre>";
		 // var_dump($ketqua_decode_ketquamang);
		 
		/*
		* Lúc này $ketqua_decode_ketquamang đang ở dạng array. Trong khi kiểu dữ liệu của trường dulieu trong bàng warehouse1 là kiểu text nên ta phải đổi $ketqua_decode_ketquamang thành dạng text bằng cách mã hoá nó thông qua việc encode
		 */
		$ketqua_encode_ketqua__decode_ketquamang=json_encode($ketqua_decode_ketquamang);

		if($this->json_model->updateData($ketqua_encode_ketqua__decode_ketquamang))
		{
			$this->load->view('thanhcong_view');
		}
	}
	public function add_Data()
	{
		//lấy dữ liệu từ json_view ở [class="form-control btn btn-danger" value="Tạo mới"]
		$ten_update = $this -> input -> post('ten');
		$sdt_update = $this -> input -> post('sdt');

		//Lấy dữ liệu json bằng hàm showData
		//$ketquamang là một json
		$ketquamang=$this->json_model->showData();

		//Giải mã $ketquamang thành một mảng
		$ketqua_decode_ketquamang = json_decode($ketquamang,true);

		//Tạo một mảng để làm cơ sở cho việc update
		$mang_ketqua_decode_ketquamang = array(
			"ten"=>$ten_update,
			"sdt"=>$sdt_update
			);
		array_push($ketqua_decode_ketquamang, $mang_ketqua_decode_ketquamang);
		
		$ketqua_decode_ketquamang=json_encode($ketqua_decode_ketquamang);
		echo '<pre>';
		var_dump($ketqua_decode_ketquamang);
		//$this->json_model->updateData($ketqua_decode_ketquamang);
	}

}

/* End of file json_controller.php */
/* Location: ./application/controllers/json_controller.php */