<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\HtmlFacade as Html;
use Collective\Html\FormFacade as Form;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'created_by', 'name', 'description'
    ];

    public function _users()
    {
        return $this->belongsTo(User::class);
    }

    public function getEditButtonAttribute()
    {
        return html_entity_decode(Html::link(action('ProjectController@edit',["project" => $this->id]),Form::button('Edit', ['class' => 'btn btn-warning btn-sm'])));
    }

    public function getDeleteButtonAttribute()
    {
        return html_entity_decode(Html::link(action('ProjectController@destroy',["project" => $this->id]),Form::button('Delete', ['class' => 'btn btn-danger btn-sm'])));
    }

}
