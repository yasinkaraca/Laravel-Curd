<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Student;

class MainController extends Controller
{
    static $students, $nextnumber, $column = 'no', $asc = 'asc', $page = 1, $where = '';

    public function index(Request $request)
    {
        return view('listtable', $this -> prepareData($request));
    }
    
    public function prepareData(Request $request)
    {
        $this->getInputs($request);
        $this->getStudents(json_decode(self::$where));

        return ['students' => self::$students, 'nextnumber' => self::$nextnumber, 'column' => self::$column, 'asc' => self::$asc, 'page' => self::$students -> currentPage(), 'where' => self::$where];
    }

    public function getInputs(Request $request)
    {
        self::$column = $request -> input('col', 'no');
        self::$asc = $request -> input('asc', 'asc');
        self::$page = $request -> input('page', 1);
        self::$where = $request -> input('where', '');
        
    }

    public function getStudents($where)
    {
        self::$students = Student::orderBy(self::$column, self::$asc);

        if(!empty($where)){
			$no = $where[0];
			$name = $where[1];
			$surname = $where[2];
			$department = $where[3];
			
			if($no != "")
                self::$students = self::$students -> where('no', '==', $no);
			if($name != "")
                self::$students = self::$students -> where('name', 'LIKE', '%' . $name . '%');
			if($surname != "")
                self::$students = self::$students -> where('surname', 'LIKE', '%' . $surname . '%');
            if($department != "")
                self::$students = self::$students -> where('department', 'LIKE', '%' . $department . '%');
				
        }
        $page = self::$page;
        $empty = self::$students -> paginate(5) -> isEmpty();

        if($page > 1)
            Paginator::currentPageResolver(function() use ($page, $empty) {
                if($empty)
                    return $page - 1;
                return $page;
            });

        self::$students = self::$students -> paginate(5) -> setPath('') -> appends(['col' => self::$column, 'asc' => self::$asc, 'where' => self::$where]);
        
        $table = DB::select("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='university' AND TABLE_NAME='students'");
        self::$nextnumber = $table[0]->AUTO_INCREMENT;
    }

    public function newForm(Request $request)
    {
        return view('new', $this -> prepareData($request));
    }

    public function newStudent(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $department = $request->input('department');
        if($name == '' && $surname == '' && $department == '')
            return redirect()->back()->with('failure', 'Please enter information');

        Student::create($request->all());

        $this->getInputs($request);

        return redirect('/?col=' . self::$column . '&asc=' . self::$asc . '&page=' . self::$page)->with('success','Student added successfully');
    }

    public function delete($no)
    {
        Student::destroy($no);
        return redirect()->back()->with('success', 'Student deleted successfully');
    }

    public function form(Request $request, $no)
    {
        $student = Student::find($no);
        $data = $this -> prepareData($request);
        $data['student'] = $student;
        return view('form', $data);
    }

    public function update(Request $request, $no)
    {
        $name = $request->get('name');
        $surname = $request->get('surname');
        $department = $request->get('department');
        if($name == "" && $surname == "" && $department == "")
            return redirect()->back()->with('failure', 'Please enter information');
            
        $student = Student::find($no);

        $oldname = $student->name;
        $oldsurname = $student->surname;
        $olddepartment = $student->department;

        if($name == $oldname && $surname == $oldsurname && $department == $olddepartment)
            return redirect()->back()->with('failure', 'No fields have been changed');
        
        if($name != '')
            $student->name = $name;
        if($surname != '')
            $student->surname = $surname;
        if($department != '')
            $student->department = $department;
        $student->save();

        $this->getInputs($request);

        return redirect('/?col=' . self::$column . '&asc=' . self::$asc . '&page=' . self::$page)->with('success', 'Updated successfully');
    }
    
}