<?php
namespace Search\Model\Filter;

use Cake\ORM\Query;

class Matching extends Base
{

    /**
     * Option to filter date range
     *
     * @return void
     */
    public function process()
    {
        if ($this->skip()) {
            return;
        }

        if (strlen($this->value())) {
            $exploded = explode('.', $this->config('field'));
            if (count($exploded) > 1) {
                $name = implode('.', array_slice($exploded, 0, -1));
                $where = implode('.', array_slice($exploded, -2, 2));

                $this->query()->matching($name, function ($q) use ($where) {
                    /* @var $q Query */
                    return $q->where([$where => $this->value()]);
                });
            }
        }
    }
}
