<?php

namespace App\Http\Controllers;

use App\Competition;
use App\CompetitionUnit;
use App\Category;
use App\Level;
use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = Competition::paginate(25);
        /*CompetitionUnit::where(['status'=>'0'])
        Competition::where(['isstart'=>'0','isend'=>'0']);*/
        return View::make('admin.competitions.index',['competitions'=>$competitions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id');
        return View::make('admin.competitions.add',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newFileName = "";
        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $newFileName = time().'.'.$file->getClientOriginalExtension();
            $path = 'uploads/';
            $file = $file->move($path, $newFileName);
        }
        $request->request->add(['filename'=>$newFileName]);
        $competition = Competition::create($request->all());


        //Levels Section pending
        if(isset($request->levels) && count($request->levels) > 0) {
            $data = [];
            $i=0;
            foreach($request->levels as $single) {
                $data[] = [
                            'title'=> $single['title'],
                            'end_date' => $single['end_date'],
                            'end_time' => $single['end_time'],
                            'minimum_candidate' => $single['minimum_candidate'],
                            'minimum_points' => $single['minimum_points'],
                            'competition_id' => $competition->id,
                            'sequence_order' => $i
                        ];
                $i++;
            }
            Level::insert($data);

        }

        return Redirect::route('competitions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        $categories = Category::pluck('name','id');
        return View::make('admin.competitions.add',['categories' => $categories,'competition'=>$competition]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        $newFileName = "";
        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $newFileName = time().'.'.$file->getClientOriginalExtension();
            $path = 'uploads/';
            $file = $file->move($path, $newFileName);
        }else {
            $newFileName = Input::get('filename');
        }

        $request->request->add(['filename'=>$newFileName]);
        $competition->update($request->all());

         //Levels Section pending
        if(isset($request->levels) && count($request->levels) > 0) {
            $data = [];
            $IncludeLevels = [];
            $i=0;
            foreach($request->levels as $single) {
                if(isset($single['id']) && $single['id'] != ""){
                    Level::find($single['id'])->update(
                       [
                                'title'=> $single['title'],
                                'end_date' => $single['end_date'],
                                'end_time' => $single['end_time'],
                                'minimum_candidate' => $single['minimum_candidate'],
                                'minimum_points' => $single['minimum_points'],
                                'competition_id' => $competition->id,
                                'sequence_order' => $i
                            ] 
                    );
                    $IncludeLevels[] = $single['id'];
                }else {
                    $data[] = [
                                'title'=> $single['title'],
                                'end_date' => $single['end_date'],
                                'end_time' => $single['end_time'],
                                'minimum_candidate' => $single['minimum_candidate'],
                                'minimum_points' => $single['minimum_points'],
                                'competition_id' => $competition->id,
                                'sequence_order' => $i
                            ];
                }
                $i++;
            }
            //delete other deleted levels
            Level::where('competition_id',$competition->id)->whereNotIn('id',$IncludeLevels)->delete();

            Level::insert($data);

        }else {

            Level::where('competition_id',$competition->id)->delete();

        }


     return Redirect::route('competitions.index');   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        Level::where('competition_id',$competition->id)->delete();
        $competition->delete(); 
        return Redirect::to('competitions');
    }

    public function ongoingCompetition(Request $request, $competition_id, $media_id) {

        $media = Media::find($media_id);
        //$points = $this->CalculatePoints($media_id);


    }

}
