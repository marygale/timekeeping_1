<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Model\Project as Project;

class Time extends Model
{
    protected $table = 'time';

    protected $fillable = [
        'user_id', 'project_id','start', 'end'
    ];

    protected $appends = [
        'total_time_spent'
    ];

    public function _user()
    {
        return $this->belongsTo(User::class);
    }

    public function _project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function getTotalTimeSpentAttribute()
    {
        return gmdate('H:i:s',Carbon::parse($this->start)->diffInSeconds(Carbon::parse($this->end)));
    }

    public function getProjectDisplayAttribute()
    {
        return $this->_project->name;
    }

    public function getStartDisplayAttribute()
    {
        return Carbon::parse($this->start)->toDayDateTimeString();
    }

    public function getEndDisplayAttribute()
    {
        return Carbon::parse($this->start)->toDayDateTimeString();
    }



}
