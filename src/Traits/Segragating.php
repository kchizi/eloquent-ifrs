<?php
/**
 * Eloquent IFRS Accounting
 *
 * @author Edward Mungai
 * @copyright Edward Mungai, 2020, Germany
 * @license MIT
 */
namespace IFRS\Traits;

use Illuminate\Support\Facades\Auth;

use IFRS\Models\Entity;

use IFRS\Scopes\EntityScope;

use IFRS\Exceptions\UnauthorizedUser;

trait Segragating
{

    /**
     * Register EntityScope for Model.
     *
     * @return null
     *
     * @codeCoverageIgnore
     */
    public static function bootSegragating()
    {
        static::addGlobalScope(new EntityScope);

        static::creating(
            function ($model) {

                // only users can be created without requiring to be logged on
                if (!Auth::check() && !is_a($model, "IFRS\Models\User")) {
                    throw new UnauthorizedUser();
                }

                if (Auth::check()) {
                    $model->entity_id = Auth::user()->entity->id;
                }
            }
        );
        return null;
    }

    /**
     * Model's Parent Entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function entity()
    {
        return $this->hasOne(Entity::class);
    }
}
