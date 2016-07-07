<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaction;
use App\User;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
      $user = auth()->user();
      $isAdmin = false;
      
      if($user->level == 'admin') {
        $isAdmin = true;
      }
      

      if($isAdmin) {
        $transactions = Transaction::with('creator')->latest()->paginate(15);
        // dd($transactions);
      }
      else {
        $transactions = $user->transactions()->latest()->paginate(15);
      }

      return view('transactions', compact('transactions', 'isAdmin'));
    }

    public function getLoan(Request $request) {
      $data = $request->all();

      $user = auth()->user();
      $amount = $user->amount;

      if($amount == 0  && $data['amount'] > 0) {
        $transaction = new Transaction;
        $transaction->user_id = $user->id;
        $transaction->amount = $data['amount'];
        $transaction->save();
        return redirect()->to('/')->withMessage('You have got new loan placed of ' . $data['amount'] . ' !!!'); 
      }

      return redirect()->back()->withMessage('Please check your Loan amount again. Pay your due and then place a new loan.');
    }

    public function payLoan(Request $request) {
      $data = $request->all();

      $user = auth()->user();
      $amount = $user->amount;

      if($data['amount'] <= $amount && $data['amount'] > 0) {
        $user->amount = $amount - $data['amount'];
        $user->save();
        return redirect()->to('/')->withMessage('Thank you for paying amount of ' . $data['amount'] . ' as your loan !!!'); 
      }

      return redirect()->back()->withMessage('Please check again with your pay amount. It should be equal or less than your due amount.');
    }

    public function approve($id){
      $transaction = Transaction::find($id);

      if(!$transaction) {
        return redirect()->to('/transactions')->withMessage('Sorry you selected loan is invalid.');
      }

      $user = auth()->user();
      $isAdmin = false;
      
      if($user->level == 'admin') {
        $isAdmin = true;
      }

      if($isAdmin) {
        // $transaction->creator->amount = $transaction->creator->amount + $transaction->amount;
        
        if(!$transaction->approved) {
          $creator = User::find($transaction->creator->id);
          $creator->amount = $creator->amount + $transaction->amount;
          $creator->save();

          $transaction->approved = true;
          $transaction->save();

          return redirect()->back()->withMessage('Successfully approved the loan.');
        }

        return redirect()->back()->withMessage('You cannot approve the same loan two times.');
      }

      return redirect()->to('/transactions')->withMessage('Only admin are allowed to approve the loan.');
    }

    public function delete($id){
      $transaction = Transaction::find($id);

      if(!$transaction) {
        return redirect()->to('/transactions')->withMessage('Sorry your selected loan does not exists.');
      }

      $user = auth()->user();
      $isAdmin = false;
      
      if($user->level == 'admin') {
        $isAdmin = true;
      }

      if($isAdmin) {
        $transaction->delete();

        return redirect()->back()->withMessage('Successfully deleted the loan.');
      }

      return redirect()->to('/transactions')->withMessage('Only admin are allowed to delete the loan.');
    }
}
