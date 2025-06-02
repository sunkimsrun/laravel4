<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classroom;

class ClassroomController extends Controller
{
    // Show welcome page
    public function index()
    {
        return view('welcome');
    }

    // Get all students
    public function getStudents()
    {
        return response()->json(classroom::getStudents());
    }

    // Create new student
    public function createStudent(Request $request)
    {
        $body = $request->json()->all();
        $student = classroom::createStudent($body['name'], $body['age']);
        return response()->json(['message' => 'Student created successfully', 'data' => $student], 201);
    }

    // Delete student by id
    public function deleteStudent($id)
    {
        return classroom::deleteStudentById($id)
            ? response()->json(['message' => 'Student deleted'])
            : response()->json(['error' => 'Student not found'], 404);
    }

    // Update student by id
    public function updateStudent(Request $request, $id)
    {
        $body = $request->json()->all();
        $student = classroom::updateStudent($id, $body['name'], $body['age'], email: $body['email']);
        return $student
            ? response()->json(['message' => 'Student updated', 'data' => $student])
            : response()->json(['error' => 'Student not found'], 404);
    }

    // Get all teachers
    public function getTeachers()
    {
        return response()->json(classroom::getTeachers());
    }

    // Create new teacher
    public function createTeacher(Request $request)
    {
        $body = $request->json()->all();
        $teacher = classroom::createTeacher($body['name'], $body['subject']);
        return response()->json(['message' => 'Teacher created successfully', 'data' => $teacher], 201);
    }

    // Delete teacher by id
    public function deleteTeacher($id)
    {
        return classroom::deleteTeacherById($id)
            ? response()->json(['message' => 'Teacher deleted'])
            : response()->json(['error' => 'Teacher not found'], 404);
    }

    // Update teacher by id
    public function updateTeacher(Request $request, $id)
    {
        $body = $request->json()->all();
        $teacher = classroom::updateTeacher($id, $body['name'], $body['subject']);
        return $teacher
            ? response()->json(['message' => 'Teacher updated', 'data' => $teacher])
            : response()->json(['error' => 'Teacher not found'], 404);
    }
}
