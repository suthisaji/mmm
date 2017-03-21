<?php
namespace App\Repositories;
use App\Student;
use Hash;
use Exception;
class StudentRepository implements StudentRepositoryInterface{
    function getAllStudent(){
        return Student::orderBy('created_at')->get();
    }

    function findById($id){
        return Student::where('student_id',$id)->first();
    }

    function addStudent($student_id,$student_name,$student_tel){ // รับเป็น array
        $data = array(
            'student_id'=>$student_id,
            'student_name'=>$student_name,
            'student_tel'=>$student_tel,
            'student_password'=>Hash::make(str_random(32))
        );
        try{
            $result = Student::create($data);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    function getLimitStudent($limit){
        return Student::limit($limit)->get(); //select * from students limit 5;
    }

    function deleteStudent($student_id){
        $result =  Student::where('student_id','=',$student_id)->delete();
        if($result > 0){
            return true;
        }else{
            return false;
        }
    }

    function updateStudent($student_id,$student_name,$student_tel){
        $data = array(
            'student_name'=>$student_name,
            'student_tel'=>$student_tel
        );
        $result = Student::where('studentid',$student_id)->update($data);
        if($result > 0){
            return true;
        }else{
            return false;
        }
    }
      function loginStudent($student_id,$student_password){
            $student = Student::where('student_id',$student_id)->where('student_password',$student_password);
            if(count($student->first()) > 0){
                return true;
            }else{
                return false;
            }
            //[{'student_id':'11111'},{'student_id':'11111'}]  //->get()
            //{'student_id':'11111'}   //->first()
      }

}