<?php

/**
 * 
 */
class Homework_model extends CI_model
{

    public function add($data)
    {

        if (isset($data["id"])) {

            $this->db->where("id", $data["id"])->update("homework", $data);
        } else {

            $this->db->insert("homework", $data);
            return $this->db->insert_id();
        }
    }
    public function updatestatus($student_id, $homework_id)
    {

        $where = array(
            'student_id' => $student_id,
            "homework_id" => $homework_id
        );
        $update = array(
            'status' => 1
        );



        $this->db->where($where)->update("homework_upload", $update);




    }

    public function get($id = null)
    {

        if (!empty($id)) {

            $query = $this->db->where("id", $id)->get("homework");
            return $query->row_array();
        } else {

            $query = $this->db->select("homework.*,homework_evaluation.date,classes.class,sections.section,subjects.name")->join("classes", "classes.id = homework.class_id")->join("sections", "sections.id = homework.section_id")->join("subjects", "subjects.id = homework.subject_id", "left")->join("homework_evaluation", "homework.id = homework_evaluation.homework_id", "left")->group_by("homework.id")->get("homework");

            return $query->result_array();
        }
    }

    public function search_homework($class_id, $section_id, $subject_id)
    {

        if ((!empty($class_id)) && (!empty($section_id)) && (!empty($subject_id))) {

            $this->db->where(array('homework.class_id' => $class_id, 'homework.section_id' => $section_id, 'homework.subject_id' => $subject_id));
        } else if ((!empty($class_id)) && (empty($section_id)) && (empty($subject_id))) {

            $this->db->where(array('homework.class_id' => $class_id));
        } else if ((!empty($class_id)) && (!empty($section_id)) && (empty($subject_id))) {

            $this->db->where(array('homework.class_id' => $class_id, 'homework.section_id' => $section_id));
        }
        $query = $this->db->select("homework.*,classes.class,sections.section,subjects.name")->join("classes", "classes.id = homework.class_id")->join("sections", "sections.id = homework.section_id")->join("subjects", "subjects.id = homework.subject_id", "left")->get("homework");

        return $query->result_array();
        // echo $this->db->last_query();exit;
    }

    public function getRecord($id = null)
    {

        $query = $this->db->select("homework.*,classes.class,sections.section,subjects.name")->join("classes", "classes.id = homework.class_id")->join("sections", "sections.id = homework.section_id")->join("subjects", "subjects.id = homework.subject_id", "left")->where("homework.id", $id)->get("homework");
        // echo $this->db->last_query();
        return $query->row_array();
    }

    public function getStudents($class_id, $section_id,$homework_id=null)
    {
        
        $query = $this->db
            ->select("students.id, students.firstname, students.lastname, students.admission_no, homework_upload.uploads,homework_upload.student_id,homework_upload.homework_id,homework_upload.status")
            ->from("students")
            ->join("student_session", "students.id = student_session.student_id")
            ->join('homework_upload', 'homework_upload.student_id = students.id', 'left')
            ->where(
                array(
                    'student_session.class_id' => $class_id,
                    'student_session.section_id' => $section_id,
                    'students.is_active' => "yes"
                )
            )
            ->where('homework_upload.homework_id',$homework_id)
            ->get();

        // The result of the query is now stored in the $query variable

        return $query->result_array();
    }

    public function delete($id)
    {

        $this->db->where("id", $id)->delete("homework");

        $this->db->where("homework_id", $id)->delete("homework_evaluation");
    }

    public function addEvaluation($data)
    {

        $this->db->insert("homework_evaluation", $data);
    }

    public function searchHomeworkEvaluation($class_id, $section_id, $subject_id)
    {

        if ((!empty($class_id)) && (!empty($section_id)) && (!empty($subject_id))) {
            $this->db->where(array('homework.class_id' => $class_id, 'homework.section_id' => $section_id, 'homework.subject_id' => $subject_id));
        } else if ((!empty($class_id)) && (empty($section_id)) && (empty($subject_id))) {
            $this->db->where(array('homework.class_id' => $class_id));
        } else if ((!empty($class_id)) && (!empty($section_id)) && (empty($subject_id))) {

            $this->db->where(array('homework.class_id' => $class_id, 'homework.section_id' => $section_id));
        }
        $query = $this->db->select("homework.*,classes.class,sections.section,subjects.name")->join("classes", "classes.id = homework.class_id")->join("sections", "sections.id = homework.section_id")->join("subjects", "subjects.id = homework.subject_id", "left")->group_by("homework.id")->get("homework");
        // echo $this->db->last_query();exit;
        return $query->result_array();
    }

    public function getEvaluationReport($id)
    {

        $query = $this->db->select("homework.*,classes.class,subjects.name,sections.section")->join("classes", "classes.id = homework.class_id")->join("sections", "sections.id = homework.section_id")->join("subjects", "subjects.id = homework.subject_id")->where("homework.id", $id)->get("homework");
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function getEvaStudents($id, $class_id, $section_id)
    {

        $query = $this->db->select("students.*,homework_evaluation.student_id,homework_evaluation.date,homework_evaluation.status,classes.class,subjects.name,sections.section")->join("classes", "classes.id = homework.class_id")->join("sections", "sections.id = homework.section_id")->join("subjects", "subjects.id = homework.subject_id")->join("homework_evaluation", "homework.id = homework_evaluation.homework_id")->join("students", "students.id = homework_evaluation.student_id", "left")->where("homework.id", $id)->get("homework");
        return $query->result_array();
    }

    public function delete_evaluation($prev_students)
    {

        if (!empty($prev_students)) {

            $this->db->where_in("id", $prev_students)->delete("homework_evaluation");
        }
    }

    public function count_students($class_id, $section_id)
    {

        $query = $this->db->select("*")->join("student_session", "students.id = student_session.student_id")->where(array('student_session.class_id' => $class_id, 'student_session.section_id' => $section_id, 'students.is_active' => "yes"))->group_by("student_session.student_id")->get("students");

        return $query->num_rows();
    }

    public function count_evalstudents($id, $class_id, $section_id)
    {

        $query = $this->db->select("students.*,homework_evaluation.student_id,homework_evaluation.date,homework_evaluation.status,classes.class,subjects.name,sections.section")->join("classes", "classes.id = homework.class_id")->join("sections", "sections.id = homework.section_id")->join("subjects", "subjects.id = homework.subject_id")->join("homework_evaluation", "homework.id = homework_evaluation.homework_id")->join("students", "students.id = homework_evaluation.student_id", "left")->where("homework.id", $id)->get("homework");
        return $query->num_rows();
    }

    public function getStudentHomework($class_id, $section_id)
    {

        $query = $this->db->select("homework.*,subjects.name,sections.section,classes.class")->join("classes", "classes.id = homework.class_id",'left')->join("homework_upload", "homework_upload.id = homework.id",'left')->join("sections", "sections.id = homework.section_id",'left')->join("subjects", "subjects.id = homework.subject_id",'left')->where(array('homework.class_id' => $class_id, 'homework.section_id' => $section_id))->order_by('homework_date')->get("homework");
        // echo $this->db->last_query();exit;
        return $query->result_array();


 
    }

    public function getEvaluationReportForStudent($id, $student_id)
    {
        $query = $this->db->select("homework.*,homework_upload.student_id,homework_upload.id as evalid,homework_upload.status,homework_upload.student_id,classes.class,subjects.name,sections.section")->join("classes", "classes.id = homework.class_id")->join("sections", "sections.id = homework.section_id")->join("subjects", "subjects.id = homework.subject_id")->join("homework_upload", "homework.id = homework_upload.homework_id")->where("homework.id", $id)->where("homework_upload.student_id", $student_id)->get("homework");
        //->where("homework_evaluation.student_id", $student_id)
        $result = $query->result_array();

           return $result;
        
// echo $this->db->last_query();
        //return $query->result_array();
    }

}

?>