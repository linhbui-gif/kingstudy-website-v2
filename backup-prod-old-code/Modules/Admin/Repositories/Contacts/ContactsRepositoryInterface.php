<?php
namespace Modules\Admin\Repositories\Contacts;

interface ContactsRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
