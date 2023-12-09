<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $messages = ContactMessage::all();
        return view('admin.message.index', ['messages' => $messages]);
    }
    public function show($id){
        $message = ContactMessage::findOrFail(decrypt($id));

        if($message->status == 'unread'){
            $message->update([
                'status' => 'read',
            ]);
        }

        return view('admin.message.show', ['message' => $message]);

    }
    public function archive($id){

        ContactMessage::where('id', decrypt($id))->update([
            'status' => 'archive']);
        return redirect()->back();

    }
    public function create()
    {
        return view('contact');
    }

    public function store(ContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return redirect()->route('contact')->with('success', 'Wiadomość została wysłana pomyślnie.');
    }

    public function destroy($id){

        $decryptId = decrypt($id);

        $message = ContactMessage::findOrFail($decryptId);

        $message->delete();

        return redirect()->back()->with('success', 'This message has been deleted');

    }
}
