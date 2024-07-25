<?php




function getcombinedsubjects($data, $class_id, $section_id)
{

	$CI =& get_instance();
	$CI->load->database();

	$combinedsubs = [];
	foreach ($data as $key => $value) {

		$res = $CI->db
			->where('subject1', $value)
			->where('class_id', $class_id)
			->where('section_id', $section_id)
			->get('combined_subject')
			->row_array();



		if ($res) {
			$combinedsubs[] = $res;
		}


	}


	return $combinedsubs;


}

function getsubjectname($id)
{
	$CI =& get_instance();
	$CI->load->database();
	$name = $CI->db->select('subjects.name')->from('subjects')->join('teacher_subjects', 'teacher_subjects.subject_id=subjects.id')->where('teacher_subjects.id', $id)->get()->row();
	return $name->name;
}

function getSubjectHoursByClassAndSection($class_id, $section_id, $subject_id)
{
	$CI =& get_instance();
	$CI->load->database();


	$where_array = [
		'class_id' => $class_id,
		'section_id' => $section_id,
		'subject_id' => $subject_id,
	];

	$hours = $CI->db
		->where($where_array)
		->get('subject_hours')
		->row_array();
	// var_dump($hours);
	return $hours;
}

function get_total_subject_attendence($id, $class_id, $section_id, $subject_id, $date,$type)
{
	$CI =& get_instance();
	$CI->load->database();

	$wherearray = [
		'class_id' => $class_id,
		'section_id' => $section_id,
		'subject_id' => $subject_id,
		'student_id' => $id,
		'type' => $type,

	];
	$daterange = explode('-', $date);


	$month = $daterange[0];
	$year = $daterange[1];

	$start = date("Y/m/01", strtotime("$year-$month-01"));

	$end = date("Y/m/t", strtotime("$year-$month-01"));

	$total = $CI->db->select('*')
		->from('student_period_attendance')
		->where($wherearray)
		->where("STR_TO_DATE(date, '%d/%m/%Y') <=  '$end'")
		->get()->result_array();

// 	print $CI->db->last_query();

	// var_dump(count($total));
	return count($total);
}

function get_total_practical_attendence($id, $class_id, $section_id, $subject_id, $date)
{
	$CI =& get_instance();
	$CI->load->database();

	$wherearray = [
		'subject_id' => $subject_id,
		'student_session_id' => $id,

	];
	$daterange = explode('-', $date);


	$month = $daterange[0];
	$year = $daterange[1];

	$start = date("Y/m/01", strtotime("$year-$month-01"));

	$end = date("Y/m/t", strtotime("$year-$month-01"));

	$total = $CI->db->select('*')
		->from('student_attendences')
		->where($wherearray)
		->where("STR_TO_DATE(date, '%d/%m/%Y') <=  '$end'")
		->where('types', "Practical")
		->get()->result_array();

	// print $CI->db->last_query();


	// var_dump(count($total));
	// exit;
	return count($total);
}



function get_monthly_student_attendance_cm($id, $class_id, $section_id, $subject_id, $date,$type)
{

	$CI =& get_instance();
	$CI->load->database();

	$wherearray = [
		'class_id' => $class_id,
		'section_id' => $section_id,
		'subject_id' => $subject_id,
		'student_id' => $id,
		'attendencetype' => 0,
		'type'=>$type

	];

	$daterange = explode('-', $date);

	$month = $daterange[0];
	$year = $daterange[1];

	$start = date("Y/m/01", strtotime("$year-$month-01"));

	$end = date("Y/m/t", strtotime("$year-$month-01"));

	$pm = $CI->db->select('*')
		->from('student_period_attendance')
		->where($wherearray)
		->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();

	// echo $CI->db->last_query();exit;


	return count($pm);
}
function get_monthly_student_attendance_total($id, $class_id, $section_id, $subject_id, $date,$type)
{
	$CI =& get_instance();
	$CI->load->database();

	$wherearray = [
		'class_id' => $class_id,
		'section_id' => $section_id,
		'subject_id' => $subject_id,
		'student_id' => $id,
		'attendencetype' => 0,
		'type'=>$type

	];
	$daterange = explode('-', $date);


	$month = $daterange[0];
	$year = $daterange[1];

	$start = date("Y/m/01", strtotime("$year-$month-01"));

	$end = date("Y/m/t", strtotime("$year-$month-01"));

	$total = $CI->db->select('*')
		->from('student_period_attendance')
		->where($wherearray)
		->where("STR_TO_DATE(date, '%d/%m/%Y') <=  '$end'")
		->get()->result_array();

	// print $CI->db->last_query();

	return count($total);
	// var_dump(count($total));exit;
}


function getsubjectname_forreport($id)
{
	$CI =& get_instance();
	$CI->load->database();
	$name = $CI->db->select('subjects.name')->from('subjects')->where('subjects.id', $id)->get()->row();

	return $name->name;
	// return $CI->db->last_query();

}
function getsubjectcode($id)
{
	$CI =& get_instance();
	$CI->load->database();
	$code = $CI->db->select('subjects.code')->from('subjects')->where('subjects.id', $id)->get()->row();

	return $code->code;
}

function getperiodreport($id, $period)
{
	$CI =& get_instance();
	$CI->load->database();

	$where_array = [
		'calendar_id' => $id,
		'period' => $period
	];


	$topic = $CI->db->select('period_report.topic')->where($where_array)->get('period_report')->row()->topic;

	return $topic;
}

function set_language($lang)
{
	$CI = get_instance();
	$language_result = $CI->language_model->get($lang);
	$language_array = array('lang_id' => $language_result['id'], 'language' => $language_result['language']);
	$CI->session->userdata['admin']['language'] = $language_array;
	$CI->config->set_item('language', $language_result['language']);
}

function getreturndoc($id, $student_id)
{
	$CI =& get_instance();
	$CI->load->database();
	$array = array('status' => 1, 'documents' => $id, 'student_id' => $student_id);
	//$where = "FIND_IN_SET('".$id."', documents)"; 
	//$CI->db->where($where);
	$CI->db->where($array);
	$CI->db->select('*');
	$query = $CI->db->get('student_returndoc');
	$result = $query->row();
	if ($query->num_rows() > 0) {
		return $result;
	} else {
		return '';
	}
}

function getfullmark($subjectid, $student_id, $type, $exam_id)
{
	$CI =& get_instance();
	$CI->load->database();
	// var_dump($type);
	if ($type == 'theory') {
		$sql = "SELECT subjects.*,teacher_subjects.*,exam_schedules.*,exam_results.* FROM teacher_subjects  INNER JOIN subjects on subjects.id=teacher_subjects.subject_id INNER JOIN exam_schedules on exam_schedules.teacher_subject_id=teacher_subjects.id INNER JOIN exam_results on exam_results.exam_schedule_id=exam_schedules.id where subjects.id=" . $CI->db->escape($subjectid) . " and exam_schedules.exam_id=" . $CI->db->escape($exam_id) . " and exam_results.student_id=" . $CI->db->escape($student_id);
	}
	if ($type == 'practical') {
		$sql = "SELECT subjects.*,teacher_subjects.*,practical_schedules.*,practical_results.* FROM teacher_subjects  INNER JOIN subjects on subjects.id=teacher_subjects.subject_id INNER JOIN practical_schedules on practical_schedules.teacher_subject_id=teacher_subjects.id INNER JOIN practical_results on practical_results.practical_schedule_id=practical_schedules.id where subjects.id=" . $CI->db->escape($subjectid) . " and practical_schedules.exam_id=" . $CI->db->escape($exam_id) . " and practical_results.student_id=" . $CI->db->escape($student_id);
	}
	if ($type == 'viva') {
		$sql = "SELECT subjects.*,teacher_subjects.*,viva_schedules.*,viva_results.* FROM teacher_subjects  INNER JOIN subjects on subjects.id=teacher_subjects.subject_id INNER JOIN viva_schedules on viva_schedules.teacher_subject_id=teacher_subjects.id INNER JOIN viva_results on viva_results.viva_schedules_id=viva_schedules.id where subjects.id=" . $CI->db->escape($subjectid) . " and viva_schedules.exam_id=" . $CI->db->escape($exam_id) . " and viva_results.student_id=" . $CI->db->escape($student_id);
	}
	$query = $CI->db->query($sql);

	$q = $query->result_array();

	$s = $q[0]['get_marks'];
	if ($q[0]['get_marks']) {
		// $dd=print_r($CI->db->last_query());
		return $s;
	} else {
		return 'N/A';
	}
}

function get_studreturn_doc($student_id)
{
	$CI =& get_instance();
	$CI->load->database();
	$array = array('status' => 1, 'student_id' => $student_id);
	//$where = "FIND_IN_SET('".$id."', documents)"; 
	//$CI->db->where($where);
	$CI->db->where($array);
	$CI->db->select('*');
	$query = $CI->db->get('student_returndoc');
	$result = $query->result();
	$ar = array();
	if ($query->num_rows() > 0) {
		foreach ($result as $st) {
			array_push($ar, $st->documents);
		}
		return $ar;
	} else {
		return $ar;
	}
}



function getSectionByClass($class)
{
	$CI =& get_instance();
	$CI->load->database();

	$admin = $CI->session->userdata('admin');
	$centre_id = $admin['centre_id'];
	$CI->db->select('class_sections.id,class_sections.section_id,sections.section');
	$CI->db->from('class_sections');
	$CI->db->join('sections', 'sections.id = class_sections.section_id');
	$CI->db->where('class_sections.class_id', $class);
	$CI->db->where('sections.centre_id', $centre_id);
	$CI->db->order_by('class_sections.id');
	$query = $CI->db->get();

	return ($query->result_array());
}
function getSubjectBySection($section)
{
	$CI =& get_instance();
	$CI->load->database();

	$CI->db->select('teacher_subjects.subject_id,subjects.name,subjects.id');
	$array = array(
		'sections.id' => $section
	);
	$CI->db->where($array);
	$CI->db->from('teacher_subjects');
	$CI->db->join('subjects', 'teacher_subjects.subject_id=subjects.id');
	$CI->db->join('class_sections', 'teacher_subjects.class_section_id=class_sections.id');
	$CI->db->join('sections', 'class_sections.section_id=sections.id');
	return $query = $CI->db->get()->result();
}
function getteacheranme($id)
{
	$CI =& get_instance();
	$CI->load->database();
	if ($id == 0) {
		return '';
	}

	if ($id != '') {
		$teachid = explode(",", $id);
		$CI->db->where_in('id', $teachid);
		$CI->db->select('staff.id,employee_id,department,name,surname');
		$CI->db->group_by('staff.id');
		$query = $CI->db->get('staff');
		$result = $query->result();

		if ($query->num_rows() > 0) {
			return $result;
		} else {
			return '';
		}
	} else {
		return '';
	}

}
function getclassname($id)
{
	$CI =& get_instance();
	$CI->load->database();
	if ($id == 0) {
		return '';
	}

	if ($id != '') {
		$CI->db->select('class');
		$CI->db->where('id', $id);
		$query = $CI->db->get('classes');
		$result = $query->row();

		if ($query->num_rows() > 0) {
			return $result->class;
		} else {
			return '';
		}
	} else {
		return '';
	}

}
function getsectionname($id)
{
	$CI =& get_instance();
	$CI->load->database();
	if ($id == 0) {
		return '';
	}

	if ($id != '') {
		$CI->db->select('section');
		$CI->db->where('id', $id);
		$query = $CI->db->get('sections');
		$result = $query->row();

		if ($query->num_rows() > 0) {
			return $result->section;
		} else {
			return '';
		}
	} else {
		return '';
	}

}
function getdep($id)
{
	$CI =& get_instance();
	$CI->load->database();
	$r = '';
	if ($id != '') {
		$teachid = explode(",", $id);
		$CI->db->where_in('id', $teachid);
		$CI->db->select('department_name');
		//$CI->db->group_by('staff.id');
		$query = $CI->db->get('department');
		$result = $query->result();

		if ($query->num_rows() > 0) {
			//return $result;
			foreach ($result as $val) {
				$r .= $val->department_name . ' ,';
			}
			return $r;
		} else {
			return $r;
		}
	} else {
		return $r;
	}

}
function getsub($id)
{
	$CI =& get_instance();
	$CI->load->database();
	$r = '';
	if ($id != '') {
		$teachid = explode(",", $id);
		$CI->db->where_in('id', $teachid);
		$CI->db->select('name');
		//$CI->db->group_by('staff.id');
		$query = $CI->db->get('subjects');
		$result = $query->result();

		if ($query->num_rows() > 0) {
			//return $result;
			foreach ($result as $val) {
				$r .= $val->name . ' ,';
			}
			return $r;
		} else {
			return $r;
		}
	} else {
		return $r;
	}

}
function fieldexist($table, $data)
{
	$CI =& get_instance();
	$CI->load->database();
	$query = $CI->db->SELECT("*")->where($data)->get($table);

	$res = $query->result_array();
	if (empty($res)) {
		return 0;
	} else {
		return 1;
	}
}
function leavecount($eid, $ltype, $month, $year)
{
	$CI =& get_instance();
	$CI->load->database();
	$from = $year . '-' . $month . '-' . '1';
	// var_dump($eid);
	$to = $year . '-' . $month . '-' . '31';
	//var_dump($to);
	// $sql = "SELECT SUM(leave_days) as leavesum  FROM staff_leave_request where staff_leave_request.staff_id=".$CI->db->escape($eid)." AND month(staff_leave_request.leave_from)=".$CI->db->escape($month)." AND staff_leave_request.leave_type_id=".$CI->db->escape($ltype)." AND  staff_leave_request.leave_from >='$from' AND staff_leave_request.leave_to <='$to' AND staff_leave_request.hod ='approve'";

	$sql = "SELECT staff_leave_request.leave_days FROM staff_leave_request where staff_leave_request.staff_id=" . $CI->db->escape($eid) . " AND month(staff_leave_request.leave_from)=" . $CI->db->escape($month) . " AND staff_leave_request.leave_type_id=" . $CI->db->escape($ltype) . " AND  staff_leave_request.leave_from >='$from' AND staff_leave_request.leave_to <='$to' AND staff_leave_request.hod ='approve'";


	//echo $sql;
	$query = $CI->db->query($sql);
	// $result=$query->result();exit;
	$q = $query->result_array();
	$s = $q[0];
	// var_dump($s);exit;
	if (!empty($s['leave_days'])) {
		return $s['leave_days'];
	} else {
		return 0;
	}
}



function actualwork($eid, $month, $year)
{
	$CI =& get_instance();
	$CI->load->database();
	$from = $year . '-' . $month . '-' . '1';
	$to = $year . '-' . $month . '-' . '31';
	// $sql = "SELECT COUNT(date) as work FROM staff_attendance where staff_attendance.staff_id=".$CI->db->escape($eid)." AND staff_attendance.date>='$from' AND staff_attendance.date<='$to' AND staff_attendance.staff_attendance_type_id='1'";
	$sql = "SELECT COUNT(leave_from) as work FROM staff_leave_request INNER JOIN staff ON staff.id=staff_leave_request.staff_id INNER JOIN staff_attendance ON staff_attendance.staff_id=staff.id where staff_leave_request.staff_id=" . $CI->db->escape($eid) . " AND staff_leave_request.leave_from>='$from' AND staff_leave_request.leave_to<='$to' AND staff_attendance.staff_attendance_type_id='1'";
	//echo $sql;
	$query = $CI->db->query($sql);
	$q = $query->result_array();
	$d = $q[0];
	//echo $d['date'];
	if (isset($d['work'])) {
		return $d['work'];
	} else {
		return 0;
	}


}
function lopmonth($eid, $month, $year)
{
	$CI =& get_instance();
	$CI->load->database();
	$from = $year . '-' . $month . '-' . '1';
	$to = $year . '-' . $month . '-' . '31';
	/*$sql = "SELECT COUNT(date) as work FROM staff_attendance INNER JOIN leave_types on staff_attendance.staff_attendance_type_id=leave_types.id where staff_attendance.staff_id=".$CI->db->escape($eid)." AND staff_attendance.date>='$from' AND staff_attendance.staff_attendance_type_id='3' ";*/
	//echo $sql;
	$sql = "SELECT SUM(leave_days) as work FROM staff_leave_request INNER JOIN leave_types on leave_types.id=staff_leave_request.leave_type_id where staff_leave_request.staff_id=" . $CI->db->escape($eid) . " AND staff_leave_request.leave_from>='$from' AND staff_leave_request.leave_to<='$to' AND staff_leave_request.leave_type_id='3' AND staff_leave_request.hod ='approve'";
	//echo $sql;
	$query = $CI->db->query($sql);
	$q = $query->result_array();
	$d = $q[0];
	//echo $d['date'];
	if (isset($d['work'])) {
		return $d['work'];
	} else {
		return 0;
	}
}

function salarys($eid, $month, $year)
{
	$CI =& get_instance();
	$CI->load->database();
	$from = $year . '-' . $month . '-' . '1';
	$to = $year . '-' . $month . '-' . '31';
	$sql = "SELECT COUNT(date) as work FROM staff_attendance INNER JOIN leave_types on staff_attendance.staff_attendance_type_id=leave_types.id where staff_attendance.staff_id=" . $CI->db->escape($eid) . " AND staff_attendance.date>='$from' AND staff_attendance.staff_attendance_type_id='3' ";
	//echo $sql;
	$query = $CI->db->query($sql);
	$q = $query->result_array();
	$d = $q[0];
	$slry = 31 - $d['work'];
	//echo $slry;
	//echo $d['date'];
	if (isset($d['work'])) {
		return $slry;
	} else {
		return 0;
	}
}

function getsubjectid($id)
{
	$CI =& get_instance();
	$CI->load->database();
	$array = array('id' => $id);
	//$where = "FIND_IN_SET('".$id."', documents)"; 
	//$CI->db->where($where);
	$CI->db->where($array);
	$CI->db->select('*');
	$query = $CI->db->get('teacher_subjects');
	$result = $query->row();
	if ($query->num_rows() > 0) {
		return $result->subject_id;
	} else {
		return 0;
	}
}


function encryptData ($content){
	$CI =& get_instance();
	
	$CI->load->library('encryption');
	$encryptedContent = $CI->encryption->encrypt($content);

	return $encryptedContent;
}


?>