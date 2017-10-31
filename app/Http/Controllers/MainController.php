<?php

namespace App\Http\Controllers;

use App\Category;
use App\Media;
use App\Likes;
use App\CompetitionUnit;
use App\Competition;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use Config;

class MainController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	//$request->user()->authorizeRoles(['Admin', 'Candidate']);
        return view('main');
    }

    public function about(Request $request)
    {
        //$request->user()->authorizeRoles(['Admin', 'Candidate']);
        return view('about');
    }

    public function apply(Request $request)
    {
        //$request->user()->authorizeRoles(['Admin', 'Candidate']);
        return view('apply');
    }

    public function contact(Request $request)
    {
        //$request->user()->authorizeRoles(['Admin', 'Candidate']);
        return view('contact');
    }

    public function publish() {
        $categories = Category::pluck('name','id');
        return view('publish.index',['categories'=>$categories]);
    }

    public function publishStore(Request $request) {
        $user = Auth::User();     
        $userId = $user->id;  
        if($userId) {
            $newFileName = "";
            if( $request->hasFile('image') ) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
                $newFileName = time().'.'.$file->getClientOriginalExtension();
                $path = 'uploads/';
                $file = $file->move($path, $newFileName);
            }
            $request->request->add(['thumbnail'=>$newFileName,'user_id'=>$userId]);
            $media = Media::create($request->all());

            return Redirect::to('published-media');
        }else {
            echo "Please Logged In";
            exit;
        }

    }

    public function publishedMedia() {
        $user = Auth::User();     
        $userId = $user->id;

        $medias = Media::where('user_id',$userId)->paginate(25);
        return View::make('publish.list',['medias'=>$medias]);
    }

    public function getView($media_id) {

    }

    public function calculateViews(Request $request, $media_id) {

        $request->session()->put('medias.ids', $media_id);
        $ViewedIds = $request->session()->get('medias.ids');
        dd($ViewedIds);

    }

    public function view(Request $request, $id) {
        $media = Media::find($id);
        $points = $this->mainCalculatePoints($id);
       // $views = $this->calculateViews($request,$id);  TODO : Need to work on it.
        $vCount = $media->views_count + 1;
        $media->update(['views_count'=>$vCount]);
        $views = $vCount;

        $user = Auth::User();     
        $userId = isset($user->id) ? $user->id : 0;
        $likeStatus = ['like'=>false,'dislike'=>false];
        if($userId != 0) {
            $likeval = Likes::where(['media_id'=>$id,'user_id'=>$userId])->first();
        if($likeval){
           if ($likeval->likes == 1)
                $likeStatus['like'] = true;
            else
                $likeStatus['dislike'] = true;
        }

        }

        return View::make('publish.view',['media'=>$media,'points'=>$points,'views'=>$views,'likeStatus'=>$likeStatus]);
    }



    public function mainCalculatePoints($media_id) {
        $perLike = Config::get('points.points.like');
        $perDisLike = Config::get('points.points.dislike');

        $totalLikes = Likes::where(['media_id'=>$media_id])->sum('likes');
        $totalDisLikes = Likes::where(['media_id'=>$media_id])->sum('dislikes');

        $totalPoints = ($perLike * $totalLikes) - ($perDisLike * $totalDisLikes);

        return  $totalPoints;

    }

    public function likeDislike(Request $request) {

        $user = Auth::User();     
        $userId = $user->id;
        $liked = $this->LikeModel($request);
        if($liked) { //whether like or dislike
            //get all competition also check 
            //Media Points.
            $mediaPoints = $this->mainCalculatePoints($liked->media->id);
            //check media enrolled in any competiton or not
            $competitionUnit = CompetitionUnit::where(['media_id'=>$request['id'], 'status'=> 0])->first(); //status means participated in a competition and competiton didn't finished yet.
            if($competitionUnit) { //means already enrolled in any competition
                echo "already entered in compettion";exit;
            }else {
                //check eligibility to move to competition unit for enrollment
                $category_id = $liked->media->category_id;

                //Random Selection in Competition Based on FCFS
                if(isset($liked->media->media_target) && $liked->media->media_target == 0) {
                    //participate in competition
                   
                    //Get all competition
                    $competitions = Competition::where(['status'=>'1','isstart'=>'0','category_id'=>$category_id])->orderBy('created_at', 'desc')->pluck('minimum_points','id');
                   
                    
                    if($competitions->count() > 0) {
                        foreach($competitions as $competition_id => $singleCompetition) {
                            if($singleCompetition <= $mediaPoints) {
                                //need to enter in competition

                                CompetitionUnit::insert(['media_id'=>$liked->media->id,'user_id'=>$liked->media->user_id,'competition_id'=>$competition_id,'status'=>'0']);
                                $result['competition_id'] = $competition_id;
                                //Need to Generate URL
                                break;

                            }
                        }
                    }      
                }

            }

            //In future for like to competition
            //because initially competition will be start by admin


            //so only return result

            $results['points'] =$mediaPoints;

            return response()->json($results);

        }
         
    }

    private function LikeModel($request) {
        $user = Auth::User();     
        $userId = $user->id;

        $likesObj = Likes::firstOrNew(['media_id'=>$request['id'], 'user_id'=>$userId]);
         if($request['type'] == 'like') {
            $likesObj->likes = 1;
            $likesObj->dislikes = 0;
         }else if($request['type'] == 'dislike') {
            $likesObj->likes = 0;
            $likesObj->dislikes = 1;
         }

         if($likesObj->save()) {
            return $likesObj;
         }
         return false;
    }

    /*public function check*/

}
