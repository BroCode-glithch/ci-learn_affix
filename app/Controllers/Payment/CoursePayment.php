<?php

namespace App\Controllers\Payment;

use Config\App;
use App\Controllers\BaseController;
use App\Models\Courses\Courses; // Import your existing Courses model
use CodeIgniter\Config\Services;
use CodeIgniter\Shield\Auth;  // Ensure Shield authentication is used

class CoursePayment extends BaseController
{
    // Load the database service
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); // This will give you the database connection
    }

    // Checkout page
    public function checkout()
    {
        // Check if the user is logged in using Shield's Auth service
        $auth = Services::auth();
        if (! $auth->loggedIn()) {  // Use loggedIn() instead of check()
            return redirect()->to('/login')->with('error', 'You need to be logged in to access this page.');
        }
    
        $courseModel = new Courses();
        $courseId = $this->request->getGet('course_id'); // Get course ID from URL query
    
        if (!$courseId) {
            return redirect()->to('/courses')->with('error', 'Invalid course selection.');
        }
    
        $course = $courseModel->find($courseId);
    
        if (!$course) {
            return redirect()->to('/courses')->with('error', 'Course not found.');
        }
    
        // Pass course details to the checkout view
        return view('payment/checkout', ['course' => $course]);
    }
    // Process payment selection (Paystack or PayPal)
    public function pay()
    {
        // Check if the user is logged in using Shield's Auth service
        $auth = Services::auth();
        if (! $auth->check()) {
            return redirect()->to('/login')->with('error', 'You need to be logged in to proceed with payment.');
        }

        $courseId = $this->request->getPost('course_id');
        $paymentMethod = $this->request->getPost('payment_method'); // Paystack or PayPal

        if (!$courseId || !$paymentMethod) {
            return redirect()->to('/checkout')->with('error', 'Invalid payment request.');
        }

        if ($paymentMethod == 'paystack') {
            return redirect()->to('/payment/paystack?course_id=' . $courseId);
        } elseif ($paymentMethod == 'paypal') {
            return redirect()->to('/payment/paypal?course_id=' . $courseId);
        }

        return redirect()->to('/checkout')->with('error', 'Invalid payment method selected.');
    }

    // Handle Paystack callback after payment
// Handle Paystack callback after payment
public function callback()
{
    $reference = $this->request->getGet('reference');
    $paymentMethod = $this->request->getGet('payment_method'); 
    
    log_message('info', 'Callback Reference: ' . $reference);
    
    if (!$reference) {
        log_message('error', 'No reference provided');
        return view('payment/payment-failed', [
            'reference' => 'N/A',
            'course_name' => 'N/A',
            'course_price' => 0,
            'user_name' => 'N/A',
            'message' => 'No reference provided'
        ]);
    }

    if ($paymentMethod == 'paystack') {
        $url = "https://api.paystack.co/transaction/verify/" . $reference;
        
        $headers = [
            'Authorization: Bearer ' . getenv('PAYSTACK_SECRET_KEY')
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        log_message('info', 'Paystack Response: ' . $response);
        log_message('info', 'HTTP Status Code: ' . $http_code);
        
        $response_data = json_decode($response);
        
        if ($http_code === 200 && isset($response_data->data->status)) {
            // ✅ Extract course details and user details
            $course_name = $response_data->data->metadata->course_name ?? 'Unknown Course';
            $course_price = ($response_data->data->amount ?? 0) / 100;
            $user_name = $response_data->data->metadata->user_name ?? 'Unknown User';

            if ($response_data->data->status == 'success') {
                log_message('info', 'Payment successful for reference: ' . $reference);

                // ✅ Store payment in database
                $this->db->table('payments')->insert([
                    'user_id' => $response_data->data->metadata->user_id ?? null,
                    'course_id' => $response_data->data->metadata->course_id ?? null,
                    'reference' => $reference,
                    'amount' => $course_price,
                    'status' => 'paid'
                ]);

                return redirect()->to('/dashboard')->with('success', 'Payment successful!');
            } else {
                log_message('error', 'Payment verification failed: Payment status is not success.');
                return view('payment/payment-failed', [
                    'reference' => $reference,
                    'course_name' => $course_name,
                    'course_price' => $course_price,
                    'user_name' => $user_name,
                    'message' => 'Payment verification failed.'
                ]);
            }
        } else {
            log_message('error', 'Paystack verification API call failed. HTTP Code: ' . $http_code);
            return view('payment/payment-failed', [
                'reference' => $reference,
                'course_name' => 'Unknown',
                'course_price' => 0,
                'user_name' => 'Unknown',
                'message' => 'Could not verify payment. Please try again.'
            ]);
        }
    }

    return view('payment/payment-failed', [
        'reference' => 'N/A',
        'course_name' => 'N/A',
        'course_price' => 0,
        'user_name' => 'N/A',
        'message' => 'Invalid payment method.'
    ]);
}



    // Controller method to handle Paystack payment initiation
    public function paystack()
{
    $auth = Services::auth();
    
    // Ensure the user is logged in
    if (!$auth->loggedIn()) {
        log_message('error', 'Paystack Error: User not logged in.');
        return $this->response->setJSON(['status' => false, 'message' => 'User not logged in.']);
    }

    $user = $auth->user(); // Get the logged-in user

    if (!$user) {
        log_message('error', 'Paystack Error: User not found.');
        return $this->response->setJSON(['status' => false, 'message' => 'User not found.']);
    }

    $courseId = $this->request->getPost('course_id'); // Ensure using POST method

    if (!$courseId) {
        log_message('error', 'Paystack Error: Course ID missing.');
        return $this->response->setJSON(['status' => false, 'message' => 'Invalid course selection.']);
    }

    $courseModel = new Courses();
    $course = $courseModel->asObject()->find($courseId);

    if (!$course) {
        log_message('error', 'Paystack Error: Course not found.');
        return $this->response->setJSON(['status' => false, 'message' => 'Course not found.']);
    }

    // Get Paystack Secret Key
    $paystackSecretKey = getenv('PAYSTACK_SECRET_KEY');
    if (!$paystackSecretKey) {
        log_message('error', 'Paystack Error: Paystack Secret Key is missing.');
        return $this->response->setJSON(['status' => false, 'message' => 'Paystack Secret Key is missing.']);
    }

    $paystackUrl = "https://api.paystack.co/transaction/initialize";
    $headers = [
        'Authorization: Bearer ' . $paystackSecretKey,
        'Content-Type: application/json'
    ];

    $amount = intval($course->price * 100); // Convert amount to kobo
    if ($amount <= 0) {
        log_message('error', 'Paystack Error: Invalid payment amount (' . $amount . ').');
        return $this->response->setJSON(['status' => false, 'message' => 'Invalid payment amount.']);
    }

    $data = [
        'email' => $user->email,
        'amount' => $amount,
        'currency' => 'NGN',
        'callback_url' => base_url('payment/callback'),
    ];

    // Log the request data
    log_message('info', 'Paystack Request Data: ' . json_encode($data));

    $ch = curl_init($paystackUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
    $error = curl_error($ch); // Get any cURL errors
    curl_close($ch);

    // Log Paystack response
    log_message('info', 'Paystack Response: ' . $response);
    log_message('info', 'HTTP Status Code: ' . $httpCode);
    if (!empty($error)) {
        log_message('error', 'cURL Error: ' . $error);
    }

    $response_data = json_decode($response);

    // ✅ FIX: Return `authorization_url` for redirecting users to Paystack payment page
    if ($httpCode === 200 && isset($response_data->data->authorization_url)) {
        // Redirect the user to Paystack's authorization URL
        return redirect()->to($response_data->data->authorization_url);
    } else {
        log_message('error', 'Paystack Error: Failed to initialize payment. Response: ' . $response);
        return $this->response->setJSON(['status' => false, 'message' => 'Failed to initialize payment.']);
    }
}

        
    public function verifyPayment()
    {
        $reference = $this->request->getGet('reference');

        if (!$reference) {
            return redirect()->to('/courses')->with('error', 'Invalid payment reference.');
        }

        $paystackSecretKey = getenv('PAYSTACK_SECRET_KEY') ?: config('App')->paystackSecretKey;
        $verifyUrl = "https://api.paystack.co/transaction/verify/{$reference}";

        $headers = [
            'Authorization: Bearer ' . $paystackSecretKey,
            'Content-Type: application/json'
        ];

        $ch = curl_init($verifyUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response);

        if ($response_data->status && $response_data->data->status == "success") {
            // Payment is successful, update the database
            $this->db->table('payments')->insert([
                'user_id' => $response_data->data->metadata->user_id,
                'course_id' => $response_data->data->metadata->course_id,
                'reference' => $reference,
                'amount' => $response_data->data->amount / 100, // Convert from kobo
                'status' => 'paid'
            ]);

            return redirect()->to('/dashboard')->with('success', 'Payment successful!');
        } else {
            return redirect()->to('/courses')->with('error', 'Payment verification failed.');
        }
    }
}
