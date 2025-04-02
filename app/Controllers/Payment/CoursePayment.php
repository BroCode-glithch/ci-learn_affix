<?php

namespace App\Controllers\Payment;

use App\Controllers\BaseController;
use App\Models\Courses\Courses; // Import your existing Courses model

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
    public function callback()
    {
        // Get reference from the callback URL
        $reference = $this->request->getGet('reference');
        $paymentMethod = $this->request->getGet('payment_method'); // Get the payment method (Paystack or PayPal)

        // Verify the transaction via Paystack API if payment method is Paystack
        if ($paymentMethod == 'paystack') {
            $url = "https://api.paystack.co/transaction/verify/" . $reference;

            // Setup headers for the API request
            $headers = [
                'Authorization: Bearer ' . getenv('PAYSTACK_SECRET_KEY')
            ];

            // Initialize cURL session to verify the payment
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Execute cURL request and capture the response
            $response = curl_exec($ch);

            if(curl_errno($ch)) {
                $error_msg = curl_error($ch);
                log_message('error', 'cURL Error: ' . $error_msg);
            }
            curl_close($ch);

            $response_data = json_decode($response);

            if ($response_data && $response_data->status == 'success') {
                // Payment was successful, update your database and enroll the user
                return view('payment/payment-success', ['reference' => $reference]);
            } else {
                // Payment failed
                return view('payment/payment-failed', ['reference' => $reference]);
            }
        }

        // Handle PayPal callback (if needed)
        if ($paymentMethod == 'paypal') {
            // Add your PayPal verification logic here (API call to PayPal)
            // If successful, return success, otherwise return failure

            return view('payment/payment-success'); // Placeholder for PayPal success page
        }

        return view('payment/payment-failed', ['message' => 'Invalid payment method.']);
    }

    // Process payment selection (for checkout page)
    public function processPayment()
    {
        $paymentMethod = $this->request->getPost('payment_method');
        $courseId = $this->request->getPost('course_id');

        if (!$paymentMethod || !$courseId) {
            return redirect()->to('/checkout')->with('error', 'Invalid payment request.');
        }

        if ($paymentMethod == 'paystack') {
            return redirect()->to('/payment/paystack?course_id=' . $courseId);
        } elseif ($paymentMethod == 'paypal') {
            return redirect()->to('/payment/paypal?course_id=' . $courseId);
        }

        return redirect()->to('/checkout')->with('error', 'Invalid payment method selected.');
    }

    // Controller method to handle Paystack payment initiation
    public function paystack()
    {
        // Get the logged-in user's ID from the session
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'User not logged in.');
        }
    
        // Query the database to get the user's email
        $user = $this->db->table('users') // The name of your table
                        ->where('id', $userId)
                        ->get()
                        ->getRow();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }
    
        $courseId = $this->request->getGet('course_id');
        
        if (!$courseId) {
            return redirect()->to('/courses')->with('error', 'Invalid course selection.');
        }
    
        // Get course details to initialize Paystack payment
        $courseModel = new Courses();
        $course = $courseModel->asObject()->find($courseId);
    
        if (!$course) {
            return redirect()->to('/courses')->with('error', 'Course not found.');
        }
    
        // Paystack initialization
        $paystackUrl = "https://api.paystack.co/transaction/initialize";
        $headers = [
            'Authorization: Bearer ' . env('PAYSTACK_SECRET_KEY'),
            'Content-Type: application/json'
        ];
    
        // Prepare payment data
        $data = [
            'email' => $user->email, 
            'amount' => $course->price * 100, 
            'currency' => 'NGN',
            'callback_url' => base_url('payment/callback'),
        ];
    
        // Initialize cURL to send the payment request to Paystack
        $ch = curl_init($paystackUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        // Execute the request
        $response = curl_exec($ch);
        
        if(curl_errno($ch)) {
            $error_msg = curl_error($ch);
            log_message('error', 'cURL Error: ' . $error_msg);
        }
        curl_close($ch);
    
        // Decode the Paystack response
        $response_data = json_decode($response);
    
        if (isset($response_data->data->authorization_url)) {
            // Log the Paystack response for debugging
            log_message('error', 'Paystack API Response: ' . json_encode($response_data));
    
            // Redirect to Paystack for payment
            return redirect()->to($response_data->data->authorization_url);
        } else {
            // Log Paystack error
            log_message('error', 'Paystack payment initialization failed: ' . json_encode($response_data));
    
            // Redirect with an error message
            return redirect()->to('/courses')->with('error', 'Paystack payment initialization failed.');
        }
    }
    
}
