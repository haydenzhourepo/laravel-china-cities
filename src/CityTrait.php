<?php
namespace HaydenZhou\LaravelChinaCities;

trait CityTrait {
    public function parent()
    {
        if ($this->parent_code) {
            return self::where('code', $this->parent_code)->first();
        }

        return false;
    }

    public function children(){
        return self::where('parent_code', $this->code)->get();
    }

    public function allChildren()
    {
        $children = $this->getChildren($this->code);
        if ($children->count()) {
            foreach ($children as $child) {
                $thischild = $this->getChildren($child->code);
                if ($thischild) {
                    foreach ($thischild as $item) {
                        $children->push($item);
                    }
                }
            }
        }
        $children->push($this);

        return $children;
    }

    public function getCityByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function getPath($path, $code)
    {
        if ($code) {
            $parent = $this->getCityByCode($code);
            if ($parent) {
                return $this->getPath($parent->name. '-'. $path, $parent->parent_code);
            }
        }

        return $path;
    }

    public function getFullPath()
    {
        $path = $this->name;

        return $this->getPath($path, $this->parent_code);
    }
}