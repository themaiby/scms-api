<?php

namespace App\Models;

use App\Enums\RoleType;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @mixin Eloquent
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property bool $active
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|User whereActive($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @property-read Collection|Permission[] $permissions
 * @property-read Collection|Role[] $roles
 * @method static Builder|User permission($permissions)
 * @method static Builder|User role($roles, $guard = null)
 * @property-read Collection|Vendor[] $vendors
 * @property-read Collection|Component[] $components
 * @property string $currency
 * @method static Builder|User whereCurrency($value)
 * @property-read Collection|Partner[] $partners
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;
    use HasPermissions;

    /**
     * @var string
     */
    protected $guard_name = 'api';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime'];

    /**
     * @return HasMany
     */
    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }

    /**
     * @return HasMany
     */
    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }

    /**
     * @return HasMany
     */
    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * Return all the permissions the model has, both directly and via roles.
     *
     * @throws Exception
     */
    public function getAllPermissions(): \Illuminate\Support\Collection
    {
        if ($this->hasRole(RoleType::ADMINISTRATOR)) {
            return Permission::all()->sort()->values();
        }

        $permissions = $this->permissions;

        if ($this->roles) {
            $permissions = $permissions->merge($this->getPermissionsViaRoles());
        }

        return $permissions->sort()->values();
    }
}
