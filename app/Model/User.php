<?php


namespace App\Model;

use App\Model\Role;
use Collective\Html\HtmlFacade;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Collective\Html\HtmlFacade as Html;
use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const roles_map = [
        "user" => "User",
        "admin" => "Administrator",
        "super_admin" => "Super Admin"
    ];

    const badge_map = [
        "user" => "badge-primary",
        "admin" => "badge-success",
        "super_admin" => "badge-info"
    ];

    protected $appends = ['roles'];

    public function _roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function _time()
    {
        return $this->hasMany(Time::class,'user_id','id');
    }

    public function _project()
    {
        return $this->hasMany(Project::class,'created_by','id');
    }

    public function total_time_spent()
    {
        return $this->_time()
            ->select(DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end, start))) as total_time'),'project_id')
            ->groupBy('project_id');
    }

    public function total_time_spent_report($month,$year)
    {
        return $this->_time()
            ->whereMonth('created_at','=',$month)
            ->whereYear('created_at', $year)
            ->select(DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end, start))) as total_time'),'project_id')
            ->groupBy('project_id')
            ->get()
            ;
    }

    public function overall_time_spent()
    {
        return gmdate('H:i:s',collect($this->total_time_spent)->sum('total_time'));
    }

    public function hasRole($role)
    {
        return null !== $this->_roles()->where('name', $role)->first();
    }

    public function isUser()
    {
        return $this->_roles()->whereName('user')->exists();
    }

    public function isAdmin()
    {
        return $this->_roles()->whereName('admin')->exists();
    }

    public function isSuperAdmin()
    {
        return $this->_roles()->whereName('super_admin')->exists();
    }

    public function authorizeRoles($roles)
    {
        if(is_array($roles)){
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->_roles()->whereIn('name', $roles)->first();
    }

    public function getRolesAttribute()
    {
        return html_entity_decode("<span class=\"badge ". self::badge_map[$this->_roles()->first()->name] ."\">".self::roles_map[$this->_roles()->first()->name]."</span>");
    }

    public function getEditButtonAttribute()
    {
        return html_entity_decode(Html::link(action('UserController@edit',["user" => $this->id]),Form::button('Edit', ['class' => 'btn btn-warning btn-sm'])));
    }

    public function getDeleteButtonAttribute()
    {
        return html_entity_decode(Html::link(action('UserController@destroy',["user" => $this->id]),Form::button('Delete', ['class' => 'btn btn-danger btn-sm'])));
    }

}
