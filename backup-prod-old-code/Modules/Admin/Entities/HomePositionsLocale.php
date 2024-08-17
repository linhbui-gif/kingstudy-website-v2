<?php
namespace Modules\Admin\Entities;

use App\Helpers\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class HomePositionsLocale extends Model
{
    use HasCompositePrimaryKeyTrait;

    protected $table = 'home_positions_locale';
    protected $primaryKey = ['home_position_id', 'locale'];

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_position_id',
        'locale',
        'title',
        'content',
        'description',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function getDataLocales($id) {
        $query = $this->select('*')
            ->where('home_position_id', $id);

        $objects = $query->get();

        $result = [];
        foreach ($objects as $item) {
            $result[$item['locale']] = $item;
        }

        return $result;
    }
}
