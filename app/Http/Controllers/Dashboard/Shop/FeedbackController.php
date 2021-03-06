<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\ErrorLog;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Http\Controllers\Controller;


class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = \Auth::user()->shop()->first();
        if(\Auth::user()->is_superAdmin == 1)
        $feedbacks = \Auth::user()->shop()->first()->feedbacks()->withTrashed()->get();
        else
        $feedbacks = \Auth::user()->shop()->first()->feedbacks;
        SEOTools::setTitle($shop->name . ' | بازخورد مشتریان');
        SEOTools::setDescription($shop->name);
        SEOTools::opengraph()->addProperty('type', 'website');
        return view('dashboard.shop.feedback' , compact('feedbacks' , 'shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request)
    {
      switch ($request->input('action')) {
        //save and close modal
          case 'justSave':
        $feedback = \Auth::user()->shop()->first()->feedbacks()->create($request->except(['_token', 'action', 'continue', 1, 'shop']));
        alert()->success('بازخورد برای فروشگاه شما با موفقیت اضافه شد.', 'انجام شد');
        return redirect()->route('feedback.index');
        break;

          case 'saveAndContinue':
        $feedback = \Auth::user()->shop()->first()->feedbacks()->create($request->except(['_token', 'action', 'continue', 1, 'shop']));
        session()->flash('flashModal');
        alert()->success('بازخورد برای فروشگاه شما با موفقیت اضافه شد.', 'انجام شد');
        return redirect()->route('feedback.index');
        break;
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(FeedbackRequest $request, $id)
    {
      $feedback = \Auth::user()->shop()->first()->feedbacks()->where('id',$id)->get()->first()->update($request->except(['_token','shop']));


      alert()->success('سوال شما با موفقیت ویرایش شد', 'ثبت شد');
      return redirect()->route('feedback.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $request->validate([
        'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
  ]);
      $feedback = Feedback::find($request->id);

      if ($feedback->shop->user_id !== \Auth::user()->id) {
              alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
              return redirect()->back();
            }
               $feedback->delete();
               alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
               return redirect()->back();
   }


   public function restore(Request $request){

     $request->validate([
   'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
     ]);
     $feedback = Feedback::withTrashed()->find($request->id);
     if (\Auth::user()->is_superAdmin != 1) {
         alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
         return redirect()->back();
         }
          $feedback->restore();
          alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
          return redirect()->back();
        }




    }
