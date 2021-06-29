<?php


namespace Topdot\Core\Traits;


trait HasSorting
{
    public string $sortOrder = 'DESC';
    public string $orderBy = 'id';
    public string $sortArrow = '';

    public function sort($column)
    {
        if ( $this->orderBy != $column ){
            $this->orderBy = $column;
            $this->setArrowUp();
            return;
        }

        if ( $this->sortOrder == 'ASC' ){
            $this->sortOrder = 'DESC';
            $this->setArrowDown();
            return;
        }

        if ( $this->sortOrder == 'DESC' ){
            $this->sortOrder = 'ASC';
            $this->setArrowUp();
            return;
        }

        $this->setArrowDown();
        $this->sortOrder = 'DESC';
    }

    private function setArrowUp()
    {
        $this->sortArrow = '<i class="fa fa-arrow-up"></i>';
    }

    private function setArrowDown()
    {
        $this->sortArrow = '<i class="fa fa-arrow-down"></i>';
    }

    public function sortingInfo($name)
    {
        if ( $this->orderBy == $name ){
            return $this->sortArrow;
        }
        return '';
    }
}
