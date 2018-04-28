<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Comments;
use Mail;
use App\Models\Posts;
use App\Models\User;
use App\Http\Controllers\Auth;

class CommentsController extends Controller {

    public function getComments() {
        return datatables(Comments::select('id', 'name', 'email', 'view'))->toJson();
    }

    public function index() {
        return view('admin.comments.index');
    }

    public function view(Request $request) {
        $comment = new Comments();
        $comment->find($request->id)->update(['view' => 'S']);

        $var['comment'] = Comments::where('id', $request->id)->with('post')->get();

        $var['commentsLst'] = Comments::where('comments_id', $request->id)->get();

        return view('admin.comments.view', compact('var'));
    }

    public function store(Request $request) {
        $data = $request->all();

        $comment = new Comments();

        if (isset($data['name'])) {
            $comment->name = $data['name'];
            $comment->email = $data['email'];
        } else {
            $comment->name = User::getName();
            $comment->email = User::getEmail();
        }

        $comment->comments_id = $data['comments_id'];
        $comment->body = $data['body'];
        $comment->posts_id = $data['posts_id'];
        $comment->active = 'S';
        $comment->view = null;
        $comment->save();

        $post = Posts::where('id', $data['posts_id'])->get();


        //        //Send email
        \Mail::send('emails.contact', ['nome'=>$comment->name], function ($message) use ($comment, $post, $data) {

            $message->from($comment->email, 'Trip a Três');

            if (isset($data['name'])) {
                $message->to('jonathansc92@gmail.com');
                $message->subject('Trip a três - Comentário post ' . $post[0]->title);
            } else {
                $message->to($data['EmailDestiny']);
                $message->subject('Trip a três - Resposta post ' . $post[0]->title);
            }
        });


        flash('Mensagem enviada')->success();
        return redirect()->back();
    }

    public function sendComment(Request $request) {

        try {

            if (!isset($request->email)) {
                return response()->json(['status' => false, 'title' => 'Ops :(', 'mensagem' => 'Você esqueceu de preencher algo?']);
            }

//            Save message in db
            $comment = new Comments();
            $comment->name = $request->name;
            $comment->body = $request->msg;
            $comment->email = $request->email;
            $comment->posts_id = $request->post_id;
            $comment->active = 'N';
            $comment->view = 'N';
            $comment->comments = NULL;
            $comment->save();

            $post = Posts::find($request->post_id);

            $user = User::first();

            //Send email
            \Mail::send('emails.contact', array('name' => $user->name), function ($message) {
                $message->from('jonathansc92@gmail.com', 'Trip a Três');
                $message->to('jonathansc92@gmail.com');
                $message->subject('Trip a três - Mensagem recebida');
            });

            return response()->json(['status' => true, 'title' => 'Agradecimentos', 'mensagem' => 'Obrigado <b>' . $request->name . "</b> pela sua mensagem, teremos o prazer em ler e responder você! :D"]);
        } catch (Exception $e) {

            return response()->json(['status' => false, 'title' => '', 'mensagem' => $e->getMessage()]);
        }
    }

}
