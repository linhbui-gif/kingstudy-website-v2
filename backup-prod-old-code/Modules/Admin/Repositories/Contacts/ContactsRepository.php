<?php
namespace Modules\Admin\Repositories\Contacts;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\Contacts;

class ContactsRepository extends BaseRepository implements VimeosRepositoryInterface
{
    public function getModel()
    {
        return Contacts::class;
    }
}
