<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Courses;
use App\Models\CourseByUser;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function checkout(Courses $course)
    {


        $api_key = env('STRIPE_SECRET');
        // \Stripe\Stripe::setApiKey($api_key);
        $stripe = new \Stripe\StripeClient(env($api_key));

        if ($course->discount_percent > 0) {
            $price = floor($course->buy_price * (100 - $course->discount_percent) / 100);
        } else {
            $price = $course->buy_price;
        }

        $item = [
            'price_data' => [
                'currency' => 'thb',
                'product_data' => [
                    'name' => $course->title,
                    'description' => $course->description ? $course->description : "NO DESCRIPTION",
                ],
                'unit_amount' => $price * 100,
            ],
            'quantity' => 1,
        ];

        // $checkout_session = \Stripe\Checkout\Session::create([
        //     'line_items' => [
        //         $item
        //     ],
        //     'mode' => 'payment',
        //     'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}&course_id=' . $course->id . '&user_id=' . auth()->id(),
        //     'cancel_url' => route('checkout.cancel', [], true) . '?course_id=' . $course->id,
        // ]);
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [
                $item
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}&course_id=' . $course->id . '&user_id=' . auth()->id(),
            'cancel_url' => route('checkout.cancel', [], true) . '?course_id=' . $course->id,
        ]);

        return redirect($checkout_session->url);
    }

    public function success()
    {
        $stripeRefId = request()->get('session_id');
        $courseId = request()->get('course_id');
        $userId = request()->get('user_id');

        CourseByUser::create([
            'course_id' => $courseId,
            'user_id' => $userId,
            'enrolled_at' => now(),
        ]);

        $user = Users::find($userId);
        $course = Courses::find($courseId);

        DB::beginTransaction();

        try {
            // ADD USER'S REWARD POINTS
            $rewardPoints = intval(floor($course->buy_price / 10));
            $user->update([
                'points' => $user->points + $rewardPoints
            ]);

            // ADD TRANSACTION
            Transactions::create([
                'from_user_id' => $userId,
                'course_id' => $courseId,
                'amount' => $course->buy_price,
                'stripe_ref_id' => $stripeRefId,
                'transaction_at' => now(),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'เกิดข้อผิดพลาดในการเพิ่มคะแนนสะสม');
        }

        return redirect('/learn/' . $courseId)->with('success_message', 'คุณได้สมัครเรียนเรียบร้อยแล้ว เริ่มเรียนเลย! (ได้รับแต้มสะสม ' . $rewardPoints . ' แต้ม)');
    }

    public function cancel()
    {
        $courseId = request()->get('course_id');
        return redirect('/courses/' . $courseId)->with('error_message', 'การซื้อไม่สำเร็จ โปรดลองใหม่อีกครั้ง');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
