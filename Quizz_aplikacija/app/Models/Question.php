<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
   protected $guarded = [];

    public function questionnaire(){
        return $this.belongsTo(Questionaire::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }

}
