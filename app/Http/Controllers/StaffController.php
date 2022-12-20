<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
                if (Hash::check($password, $staff->password)) {
                    // Set session
                    $request->session()->put('User', 'Admin');
                    $request->session()->put('Username', $staff->name);
                    $request->session()->put('Status', "Login");
                    $request->session()->put('StaffID', $staff->staff_id);
                    echo "<script>alert('Login success!')</script>";

                    $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
                    $currentCompetition = $this->repository->dashboardCurrentCompetition();
                    $currentOrder = $this->repository->dashboardCurrentOrder();
                    $currentDelivery = $this->repository->dashboardCurrentDelivery();

                    $orderList = $this->repository->dashboardOrderList();
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
                    'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
                    , ['staffInfo' => $staffInfo]);
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

    public function forgotPassword(Request $request){

        $passwordRecovery = $request->input('passwordRecovery');

        if(!strcmp($passwordRecovery, "Recover")){

            $request->validate([
                "email" => "required|email|exists:staff"
            ]);

            $email = $request->input('email');
            $recoverToken = random_int(100000, 999999);

            $this->repository->forgotPasswordAdd($email, $recoverToken);

            Mail::send('admin.tokenDisplay', ['token' => $recoverToken], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return view('admin.passwordRecovery', ["email"=>$email]);

        }else{
            return view('admin.login');
        }
    }

    public function passwordRecovery(Request $request){
        $passwordRecovery = $request->input('passwordRecovery');

        if(!strcmp($passwordRecovery, "Confirm")){
            $email = $request->input('email');
            $pincode = $request->input('pincode');
            $recoverEmailToken = $this->repository->getPasswordRecoveryEmail($email);
            if($recoverEmailToken->token == $pincode){
                return view('admin.passwordRecoveryForm', ["email"=>$email]);
            }else{
                echo "<script>alert('Pincode invalid!')</script>";
                return view('admin.passwordRecovery', ["email"=>$email]);
            }
        }else{
            $this->repository->forgotPasswordDelete();
            return view('admin.login');
        }
    }

    public function passwordRecoverySubmit(Request $request){
        $updateCancel = $request->input('updateCancel');

        if(!strcmp($updateCancel, "Update")){
            $email = $request->input('email');
            $password = $request->input('password');
            $confirmPassword = $request->input('confirmPassword');

            if($password == $confirmPassword){
                $this->repository->updateByEmail($email, Hash::make($password));
                $this->repository->forgotPasswordDelete();
                echo "<script>alert('Update successfully!')</script>";
                return view('admin.login', ["email"=>$email]);
            }else{
                echo "<script>alert('Password and confirm password are different!')</script>";
                return view('admin.passwordRecoveryForm', ["email"=>$email]);
            }

        }else{
            $this->repository->forgotPasswordDelete();
            return view('admin.login');
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
                "gender" => "required",
                "date_of_birth" => "required",
                "phone_no" => "required"
            ]);

            // Get staff_id from session, name and email from input
            $staffID = $request->session()->get('StaffID');
            $name = $request->input("name");
            $gender = $request->input("gender");
            $date_of_birth = $request->input("date_of_birth");
            $phone_no = $request->input("phone_no");

            $phone_regex = "/^(01)[0-46-9]*[0-9]{7,8}$/";

            if(preg_match($phone_regex, $phone_no)){
                // Update to database
                $this->repository->updateProfile($staffID, $name, $gender, $date_of_birth, $phone_no);

                // Redirect back to the update profile page
                echo "<script>alert('User profile update successfully!')</script>";
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->repository->getById($staffID);
                return view('admin.updateProfile', ['staffInfo' => $staffInfo]);
            }else{
                echo "<script>alert('Phone number is invalid!')</script>";
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->repository->getById($staffID);
                return view('admin.updateProfile', ['staffInfo' => $staffInfo]);
            }
        }else{
            // Redirect user to dashboard page
            $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
            $currentCompetition = $this->repository->dashboardCurrentCompetition();
            $currentOrder = $this->repository->dashboardCurrentOrder();
            $currentDelivery = $this->repository->dashboardCurrentDelivery();

            $orderList = $this->repository->dashboardOrderList();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->repository->getById($staffID);
            return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
            'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
            , ['staffInfo' => $staffInfo]);
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

            if(Hash::check($oldPassword, $staffData->password)){
                if($newPassword == $confirmPassword){
                    echo "<script>alert('Your password change successfully!')</script>";
                    $this->repository->changePassword($staffID, Hash::make($newPassword));
                    // Get the latest data from database
                    $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
                    $currentCompetition = $this->repository->dashboardCurrentCompetition();
                    $currentOrder = $this->repository->dashboardCurrentOrder();
                    $currentDelivery = $this->repository->dashboardCurrentDelivery();

                    $orderList = $this->repository->dashboardOrderList();
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
                    'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
                    , ['staffInfo' => $staffInfo]);
                }else{
                    // Display error message
                    echo "<script>alert('Your new password is different with confirm password!')</script>";
                    // Get staff info from database
                    $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
                    $currentCompetition = $this->repository->dashboardCurrentCompetition();
                    $currentOrder = $this->repository->dashboardCurrentOrder();
                    $currentDelivery = $this->repository->dashboardCurrentDelivery();

                    $orderList = $this->repository->dashboardOrderList();
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
                    'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
                    , ['staffInfo' => $staffInfo]);
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
            $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
            $currentCompetition = $this->repository->dashboardCurrentCompetition();
            $currentOrder = $this->repository->dashboardCurrentOrder();
            $currentDelivery = $this->repository->dashboardCurrentDelivery();

            $orderList = $this->repository->dashboardOrderList();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->repository->getById($staffID);
            return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
            'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
            , ['staffInfo' => $staffInfo]);
        }
    }

    public function dashboardStaffInfo(Request $request){
        // Get staff info from database
        $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
        $currentCompetition = $this->repository->dashboardCurrentCompetition();
        $currentOrder = $this->repository->dashboardCurrentOrder();
        $currentDelivery = $this->repository->dashboardCurrentDelivery();

        $orderList = $this->repository->dashboardOrderList();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
        'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
        , ['staffInfo' => $staffInfo]);
    }

    public function dashboardBack(Request $request){
        // Get staff info from database
        $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
        $currentCompetition = $this->repository->dashboardCurrentCompetition();
        $currentOrder = $this->repository->dashboardCurrentOrder();
        $currentDelivery = $this->repository->dashboardCurrentDelivery();

        $orderList = $this->repository->dashboardOrderList();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
        'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
        , ['staffInfo' => $staffInfo]);
    }

    public function profile(Request $request){
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.profile', ['staffInfo' => $staffInfo]);
    }

    public function addAdminInfo(Request $request){
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->repository->getById($staffID);
        return view('admin.addAdmin',
        ['name'=>'', 'email'=>'', 'password'=>'', 'gender'=>'', 'date_of_birth'=>'',
        'phone_no'=>'', 'role'=>''], ['staffInfo' => $staffInfo]);
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

            $phone_regex = "/^(01)[0-46-9]*[0-9]{7,8}$/";

            $allAdmin = $this->repository->getAll();


            foreach($allAdmin as $admin){
                if($admin->email == $email){
                    echo "<script>alert('Email existed!')</script>";
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.addAdmin',
                    ['name'=>$name, 'email'=>$email, 'password'=>$password, 'gender'=>$gender, 'date_of_birth'=>$date_of_birth,
                    'phone_no'=>$phone_no, 'role'=>$role] , ['staffInfo' => $staffInfo]);
                }
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(preg_match($phone_regex, $phone_no)){
                    // Add data to database
                    $data = ["name"=>$name, "email"=>$email, "password"=>Hash::make($password), "gender"=>$gender,
                    "date_of_birth"=>$date_of_birth, "phone_no"=>$phone_no, "role"=>$role];
                    $this->repository->create($data);

                    // Redirect to printing method list
                    echo "<script>alert('Add successfully! You can login to the new account now!')</script>";
                    $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
                    $currentCompetition = $this->repository->dashboardCurrentCompetition();
                    $currentOrder = $this->repository->dashboardCurrentOrder();
                    $currentDelivery = $this->repository->dashboardCurrentDelivery();

                    $orderList = $this->repository->dashboardOrderList();
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
                    'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
                    , ['staffInfo' => $staffInfo]);
                }else{
                    echo "<script>alert('Phone number is not valid!')</script>";
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->repository->getById($staffID);
                    return view('admin.addAdmin',
                    ['name'=>$name, 'email'=>$email, 'password'=>$password, 'gender'=>$gender, 'date_of_birth'=>$date_of_birth,
                    'phone_no'=>$phone_no, 'role'=>$role], ['staffInfo'=>$staffInfo]);
                }
            } else {
                echo "<script>alert('Email is not valid!')</script>";
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->repository->getById($staffID);
                return view('admin.addAdmin',
                ['name'=>$name, 'email'=>$email, 'password'=>$password, 'gender'=>$gender, 'date_of_birth'=>$date_of_birth,
                'phone_no'=>$phone_no, 'role'=>$role], ['staffInfo'=>$staffInfo]);
            }
        }else{
            // Redirect user to dashboard page
            $currentBannedDesign = $this->repository->dashboardCurrentBannedDesign();
            $currentCompetition = $this->repository->dashboardCurrentCompetition();
            $currentOrder = $this->repository->dashboardCurrentOrder();
            $currentDelivery = $this->repository->dashboardCurrentDelivery();

            $orderList = $this->repository->dashboardOrderList();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->repository->getById($staffID);
            return view('admin.dashboard', ['orderList'=>$orderList, 'currentBannedDesign'=>$currentBannedDesign,
            'currentCompetition'=>$currentCompetition, 'currentOrder'=>$currentOrder, 'currentDelivery'=>$currentDelivery]
            , ['staffInfo' => $staffInfo]);
        }
    }

}
