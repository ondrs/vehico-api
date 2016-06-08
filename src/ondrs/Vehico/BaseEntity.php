<?php

namespace ondrs\Vehico;


class BaseEntity
{

    /**
     * @param null|array $data
     */
    public function __construct($data = NULL)
    {
        if($data !== NULL && is_array($data)) {
            $this->fromArray($data);
        }

    }


    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }


    /**
     * @param array $data
     */
    public function fromArray(array $data)
    {
        foreach($data as $key => $value) {
            if(property_exists(get_class($this), $key)) {
                $this->$key = $value;
            }
        }
    }

} 
