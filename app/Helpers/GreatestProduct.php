<?php


namespace App\Helpers;


class GreatestProduct
{
    public function find(array $input)
    {
        $this->validate($input);

        sort($input);

        return array_pop($input) * array_pop($input);
    }

    private function validate(array $input)
    {
        if(count($input) < 2) {
            throw new \InvalidArgumentException('Input array should contain at least 2 items');
        }
        foreach ($input as $item) {
            if(!is_numeric($item)) {
                throw new \InvalidArgumentException('Found non numeric value');
            }
        }
    }
}
