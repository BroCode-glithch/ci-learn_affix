<?php

namespace App\Controllers\Newsletter;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Subscriber\SubscriberModel;
use Config\Services;

class NewsletterController extends BaseController
{
    public function index()
    {
        //
    }

    public function subscribe()
    {
        $email = $this->request->getPost('email');
    
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Invalid email address.');
        }
    
        $model = new SubscriberModel();
    
        // Check if email is already subscribed
        if ($model->where('email', $email)->first()) {
            return redirect()->back()->with('error', 'You are already subscribed!');
        }
    
        // Save the email to the database
        $model->save(['email' => $email]);
    
        // Send the confirmation email
        $emailService = Services::email();

        // Configure the sender (your admin email)
        $emailService->setFrom('admin@learnaffix.com.ng', 'Learn Affix');

        // Configure the recipient (the email address that just subscribed)
        $emailService->setTo($email);

        // Set the subject for the email
        $emailService->setSubject('Subscription Confirmation');

        // Set the HTML content for the email
        $body = view('emails/confirm_subscription', ['email' => $email]);
        $emailService->setMessage($body);

        // Attempt to send the email
        if ($emailService->send()) {
            return redirect()->back()->with('success', 'Thanks for subscribing! Please check your email to confirm your subscription.');
        } else {
            return redirect()->back()->with('error', 'There was an error sending the confirmation email. Please try again.');
        }
    }

    public function unsubscribe()
    {
        $email = $this->request->getGet('email');

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/')->with('error', 'Invalid email address.');
        }

        $model = new SubscriberModel();
        $subscriber = $model->where('email', $email)->first();

        if (! $subscriber) {
            return redirect()->to('/')->with('error', 'Email not found.');
        }

        $model->where('email', $email)->delete();

        return redirect()->to('/')->with('success', 'You have been unsubscribed.');
    }
    
}
