<?php
	// Anti-SQLInjection
	function DBEscape($data){
		$conn = DBConnect();
		if(!is_array($data)){
			$data = mysqli_real_escape_string($conn , $data);
		}else{
			$array = $data;

			foreach ($array as $key => $value) {
				$key =mysqli_real_escape_string($conn , $key);
				$value = mysqli_real_escape_string($conn , $value);

				$data[$key] = $value;
			}
		}

		DBClose($conn);
		return $data;
	}

	//função conexão
	function DBConnect(){
		$fail = "Não foi possível se conectar ao Servidor MySql";
		$conn = mysqli_connect(DB_HOSTNAME,DB_USER,DB_PASSWORD,DB_NAME) or die( include 'fail.php');
		$fail = "Charset incompatível";
		mysqli_set_charset($conn ,DB_CHARSET) or die (include 'fail.php');
		return $conn;
	}
	
	//função desconectar
	function DBClose($conn){
		$fail = "Link Sql não encerrado corretamente";
		mysqli_close($conn) or die (mysqli_error($conn));
	}
