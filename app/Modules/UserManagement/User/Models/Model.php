<?php

namespace App\Modules\UserManagement\User\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Model extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    static $userRoleModel = \App\Modules\UserManagement\UserRole\Models\Model::class;
    static $userPermissionModel = \App\Modules\UserManagement\UserPermission\Models\Model::class;
    static $userAddressModel = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userAddressContactPersonModel = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    static $userCustomerInformationModel = \App\Modules\UserManagement\User\Models\UserCustomerInformationModel::class;
    static $userSupplierInformationModel = \App\Modules\UserManagement\User\Models\UserSupplierInformationModel::class;
    static $userEmployeeInformationModel = \App\Modules\UserManagement\User\Models\UserEmployeeInformationModel::class;
    static $userRetailerInformationModel = \App\Modules\UserManagement\User\Models\UserRetailerInformationModel::class;

    protected $table = "users";
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->name . " " . $random_no;
            $data->slug = Str::slug($slug); //use Illuminate\Support\Str;
            if (strlen($data->slug) > 150) {
                $data->slug = substr($data->slug, strlen($data->slug) - 150, strlen($data->slug));
            }
            if (auth()->check()) {
                $data->creator = auth()->user()->id;
            }
            $data->save();
        });
    }


    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }

    public function role()
    {
        return $this->belongsTo(self::$userRoleModel, 'role_id', 'serial');
    }

    public function permissions()
    {
        return $this->belongsToMany(self::$userPermissionModel, 'user_user_permission', 'user_id', 'user_permission_id', 'id', 'permission_serial'); //user::id
    }

    public function user_address()
    {
        return $this->hasMany(self::$userAddressModel, 'user_id', 'id');
    }
    public function user_delivery_address()
    {
        return $this->hasOne(self::$userAddressModel, 'user_id', 'id')->where('address_types', 'delivery');
    }
    public function user_address_contact_person()
    {
        return $this->hasMany(self::$userAddressContactPersonModel, 'user_id', 'id');
    }
    public function user_customer_information()
    {
        return $this->hasMany(self::$userCustomerInformationModel, 'user_id', 'id');
    }
    public function user_supplier_information()
    {
        return $this->hasMany(self::$userSupplierInformationModel, 'user_id', 'id');
    }
    public function user_employee_information()
    {
        return $this->hasMany(self::$userEmployeeInformationModel, 'user_id', 'id');
    }
    public function user_retailer_information()
    {
        return $this->hasMany(self::$userRetailerInformationModel, 'user_id', 'id');
    }
}
