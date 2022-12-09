<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Repositories\StaffRepositoryInterface;

class StaffController extends Controller
{

    // Make Repository Easy for CRUD of Staff
    private $repository;

    public function __construct(StaffRepositoryInterface $staffRepository)
    {
        $this->repository = $staffRepository;
    }

    public function login(Request $request){
        // Check user want login, recover password or cancel
        $loginRecoverCancel = $request->input("loginRecoverCancel");
        // If login
        if (!strcmp($loginRecoverCancel, "Login")) {
            // Validate null input
            $request->validate([
                "email" => "required",
                "password" => "required"
            ]);
            // Get input data
            $email = $request->input("email");
            $password = $request->input("password");

            // Get data from database
            $staff = $this->repository->getByEmail($email);

            if (isset($staff)) {
                // If password are same with database
                if ($password == $staff->password) {
                    // Set session
                    $request->session()->put('User', 'Admin');
                    $request->session()->put('Username', $staff->name);
                    $request->session()->put('Status', "Login");
                    $request->session()->put('StaffID', $staff->staff_id);
                    echo "<script>alert('Login success!')</script>";
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.dashboard', ['staffInfo' => $staffInfo]);
                } else {
                    echo "<script>alert('Password incorrect!')</script>";
                    return view('admin.login');
                }
            } else {
                echo "<script>alert('Account does not exists!')</script>";
                return view('admin.login');
            }
        }
        // If recover
        else if (!strcmp($loginRecoverCancel, "Recover")) {
            // Validate null input
            $request->validate([
                "email" => "required",
            ]);

            $email = $request->input("email");

        }
        // If cancel
        else {
            // Redirect user to index page
            echo "<script>alert('Redirecting to index page!')</script>";
            return view('welcome');
        }
    }

    public function getInfo(Request $request){
        // Get staff info from database
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.updateProfile', ['staffInfo' => $staffInfo]);
    }

    public function updateProfile(Request $request){
        // Check whether user want update or cancel
        $updateCancel = $request->input('updateCancel');
        if (!strcmp($updateCancel, "Update")) {
            $request->validate([
                "name" => "required",
                "email" => "required"
            ]);

            // Get staff_id from session, name and email from input
            $staffID = $request->session()->get('StaffID');
            $name = $request->input("name");

            // Update to database
            $this->repository->updateProfile($staffID, $name);

            // Redirect back to the update profile page
            echo "<script>alert('User profile update successfully!')</script>";
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->repository->getById($staffID);
            return view('admin.updateProfile', ['staffInfo' => $staffInfo]);
        }else{
            // Redirect user to dashboard page
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->repository->getById($staffID);
            return view('admin.dashboard', ['staffInfo' => $staffInfo]);
        }
    }

    public function changePasswordInfo(Request $request){
        // Get staff info from database
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.changePassword', ['staffInfo' => $staffInfo]);
    }

    public function changePassword(Request $request){
        // Check whether user want change or cancel
        $changeCancel = $request->input('changeCancel');
        if (!strcmp($changeCancel, "Change")) {
            $request->validate([
                "oldPassword" => "required",
                "newPassword" => "required",
                "confirmPassword" => "required"
            ]);

            // Get staff_id from session, name and email from input
            $staffID = $request->session()->get('StaffID');
            $oldPassword = $request->input("oldPassword");
            $newPassword = $request->input("newPassword");
            $confirmPassword = $request->input("confirmPassword");

            // Update to database
            $staffID = $request->session()->get('StaffID');
            $staffData = $this->repository->getById($staffID);

            if($oldPassword == $staffData->password){
                if($newPassword == $confirmPassword){
                    echo "<script>alert('Your password change successfully!')</script>";
                    $this->repository->changePassword($staffID, $newPassword);
                    // Get the latest data from database
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.dashboard', ['staffInfo' => $staffInfo]);
                }else{
                    // Display error message
                    echo "<script>alert('Your new password is different with confirm password!')</script>";
                    // Get staff info from database
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.changePassword', ['staffInfo' => $staffInfo]);
                }
            }else{
                // Display error message
                echo "<script>alert('Your old password is not correct!')</script>";
                // Get staff info from database
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->repository->getById($staffID);
                return view('admin.changePassword', ['staffInfo' => $staffInfo]);
            }
        }else{
            // Redirect user to dashboard page
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->repository->getById($staffID);
            return view('admin.dashboard', ['staffInfo' => $staffInfo]);
        }
    }

    public function dashboardStaffInfo(Request $request){
        // Get staff info from database
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.dashboard', ['staffInfo' => $staffInfo]);
    }

    public function dashboardBack(Request $request){
        // Get staff info from database
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.dashboard', ['staffInfo' => $staffInfo]);
    }

    public function profile(Request $request){
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.profile', ['staffInfo' => $staffInfo]);
    }

    public function addAdminInfo(Request $request){
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.addAdmin', ['staffInfo' => $staffInfo]);
    }

    public function logout(Request $request)
    {
        // Remove all session and redirect user to login page
        $request->session()->forget('User');
        $request->session()->forget('Username');
        $request->session()->forget('Status');
        $request->session()->forget('StaffID');
        echo "<script>alert('Logout Success!')</script>";
        return view('admin.login');
    }

    public function addAdmin(Request $request){
        // Check whether user want add or cancel
        $addCancel = $request->input('AddCancel');
        if (!strcmp($addCancel, "Add")) {
            $request->validate([
                "name" => "required",
                "email" => "required",
                "password" => "required",
                "gender" => "required",
                "date_of_birth" => "required",
                "phone_no" => "required",
                "role" => "required"
            ]);

            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $gender = $request->input('gender');
            $date_of_birth = $request->input('date_of_birth');
            $phone_no = $request->input('phone_no');
            $role = $request->input('role');

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Add data to database
                $data = ["name"=>$name, "email"=>$email, "password"=>$password, "gender"=>$gender,
                "date_of_birth"=>$date_of_birth, "phone_no"=>$phone_no, "role"=>$role];
                $this->repository->create($data);

                // Redirect to printing method list
                echo "<script>alert('Add successfully! You can login to the new account now!')</script>";
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->repository->getById($staffID);
                return view('admin.dashboard', ['staffInfo'=>$staffInfo]);
            } else {
                echo "<script>alert('Email is not valid!')</script>";
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->repository->getById($staffID);
                return view('admin.addAdmin', ['staffInfo'=>$staffInfo]);
            }
        }else{
            // Redirect user to dashboard page
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->repository->getById($staffID);
            return view('admin.dashboard', ['staffInfo' => $staffInfo]);
        }
    }

}
