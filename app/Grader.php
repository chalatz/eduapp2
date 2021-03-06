<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Suggestion;

use App\Http\Utilities\Transliteration;

class Grader extends Model
{
  protected $fillable = [
    'user_id',
    'last_name',
    'first_name',
    'suggestions_count',
    'personal_xp',
    'specialty_id',
    'district_id',
    'county_id',
    'address',
    'desired_category',
    'past_grader',
    'past_grader_more',
    'wants_to_be_grader_b',
    'english',
    'french',
    'german',
    'italian',
    'english_level',
    'french_level',
    'german_level',
    'italian_level',
    'languages_other',
    'languages_other_level',
    'lang_pref_english',
    'lang_pref_french',
    'lang_pref_german',
    'lang_pref_italian',
    'approved',
    'approver_email',
    'approved_at',
    'propose_myself',
    'why_propose_myself',
    'personal_url',
    'personal_url_2',
    'personal_url_3',
    'personal_url_4',
    'comments',
    'personal_cv',
    'teaching_xp',
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function sites()
  {
      return $this->hasMany(Site::class);
  }

  public function addSuggestion()
  {
    $data = [];
    $data['user_id'] = $this->user->id;
    $data['grader_email'] = $this->user->email;
    $data['suggestor_name'] = $this->user->email;
    $data['suggestor_email'] = $this->user->email;
    $data['personal_msg'] = "Self proposed";
    $data['unique_string'] = "Self proposed";
    $data['accepted'] = "yes";
    $data['self_proposed'] = "yes";

    $suggestion = Suggestion::create($data);

    return $suggestion;

  }

  public function code()
  {
        $grader_code = '';

        if($this->user->hasRole('grader_a')){
            $grader_code = 'Α' . sprintf("%03d", $this->id);
        }
        if($this->user->hasRole('grader_b')){
            $grader_code = 'Β' . sprintf("%03d", $this->id);
        }
        if($this->approved && $this->user->hasRole('grader_b')){
            $grader_code = 'Β' . sprintf("%03d", $this->id);
        }
        if($this->user->hasRole('grader_a') && ($this->approved && $this->user->hasRole('grader_b'))){
            $grader_code = 'ΑΒ' . sprintf("%03d", $this->id);
        }
        if($this->user->hasRole('member')){
            $grader_code = 'Γ' . sprintf("%03d", $this->id);
        }

        return $grader_code;

  }

  public function addPersonalCV($request)
  {
      $file = $request->file('personal_cv');

      $originalFileName = $this->id .'--'. time() .'--'. $file->getClientOriginalName();

      $fileName = Transliteration::rename($originalFileName);

      $destinationPath = base_path() . '/storage/grader_files';

      $file->move($destinationPath, $fileName);

      return $fileName;

  }

  public function addPhoto($request)
  {
      $file = $request->file('photo');

      $originalFileName = $this->id .'--'. time() .'--'. $file->getClientOriginalName();

      $fileName = Transliteration::rename($originalFileName);

      $destinationPath = base_path() . '/storage/grader_files';

      $file->move($destinationPath, $fileName);

      return $fileName;

  }

    public function has_to_grade_a(){

        //  the user is grader and has sites to evaluate in Phase A
        if($this->user->hasRole('grader_a') || $this->user->hasRole('grader_b')){
            $evaluation = Evaluation::where('grader_id', $this->id)->first();
            if($evaluation){
                return true;
            }
        }

        return false;

    }

    public function has_to_grade_b(){

        //  the user is grader and has sites to evaluate in Phase B
        if($this->user->hasRole('grader_a') || $this->user->hasRole('grader_b')){
            $evaluation = Evaluation_b::where('grader_id', $this->id)->first();
            if($evaluation){
                return true;
            }
        }

        return false;

    } 

    public function has_to_grade_c(){

        //  the user is grader and has sites to evaluate in Phase B
        if($this->user->hasRole('grader_b')){
            $evaluation = Evaluation_c::where('grader_id', $this->id)->first();
            if($evaluation){
                return true;
            }
        }

        return false;

    }       

    public function scopeAlpha($query)
    {
        $graders = Grader::all();

        $collection = collect([]);

        foreach($graders as $grader){
            if($grader->user->hasRole('grader_b')){
                $collection->push($grader);
            }
        }       

        return $collection;
    }

    public function scopeBeta($query)
    {
        $graders = Grader::all();

        $collection = collect([]);

        foreach($graders as $grader){
            if($grader->user->hasRole('grader_b'))
                $collection->push($grader);
            }       

        return $collection;
    }

    public function hasSite(){
        if(Site::where('grader_id', $this->id)->count() > 0){
            return true;
        } else {
            return false;
        }
           
    }

    // The grader has graded at least once
    public function has_graded(){

        $counter = 0;

        $evaluations_a = Evaluation::where('grader_id', $this->id)->get();
        $evaluations_b = Evaluation_b::where('grader_id', $this->id)->get();
        $evaluations_c = Evaluation_c::where('grader_id', $this->id)->get();

        if($evaluations_a){
            foreach($evaluations_a as $evaluation_a){
                if($evaluation_a->complete()){
                    $counter++;
                }
            }
        }

        if($evaluations_b){
            foreach($evaluations_b as $evaluation_b){
                if($evaluation_b->complete()){
                    $counter++;
                }
            }
        }

        if($evaluations_c){
            foreach($evaluations_c as $evaluation_c){
                if($evaluation_c->complete()){
                    $counter++;
                }
            }
        }                

        if($counter > 0){
            return true;
        }

        return false;                

    }
    

  public static $rules = [
    'password' => 'sometimes|required|confirmed|min:6',
    'last_name' => 'required',
    'first_name' => 'required',
    'specialty_id' => 'required',
    'district_id' => 'required',
    'county_id' => 'required',
    'english_level' => 'required_if:english,1',
    'french_level' => 'required_if:french,1',
    'german_level' => 'required_if:german,1',
    'italian_level' => 'required_if:italian,1',
    'languages_other_level' => 'required_with:languages_other',
    'languages_other' => 'required_with:languages_other_level',
    'why_propose_myself' => 'sometimes|required_if:propose_myself,1',
    'personal_xp' => 'sometimes|required',
    'personal_cv' => 'sometimes|mimes:pdf,doc,docx,odt|max:2048',
    'photo' => 'mimes:jpg,jpeg,png|max:2048',
    'desired_category' => 'required',
    'teaching_xp' => 'required',
  ];

}
