<?php
    namespace Search\Model\Filter;

    use Cake\I18n\Time;

    class DateBetween extends Base {

        /**
         * Process dates conditions
         *
         * @return void
         */
        public function process() {
            if ($this->skip()) {
                return;
            }

            $range_field = $this->args()[$this->name()];
            /*foreach ($range_field as &$item) {
                $item = array_filter($item, 'strlen');
            }
            $range_field = array_filter($range_field, 'count');*/

            if (!empty($range_field['from']) > 0) {
//                $from_array = $range_field['from'];
                $timeFrom   = new Time($range_field['from']);
//                $timeFrom->setDateTime($from_array['year'], $from_array['month'], $from_array['day'], $from_array['hour'], $from_array['minute']);
                $this->query()->andWhere([$this->name() . ' >=' => $timeFrom]);
            }
            if (!empty($range_field['to']) > 0) {
//                $to_array = $range_field['to'];
                $timeTo   = new Time($range_field['to']);
//                $timeTo->setDateTime($to_array['year'], $to_array['month'], $to_array['day'], $to_array['hour'], $to_array['minute']);
                $this->query()->andWhere([$this->name() . ' <=' => $timeTo]);
            }
        }
    }
