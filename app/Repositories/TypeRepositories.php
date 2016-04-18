<?php
namespace App\Repositories;

use App\Type;

class TypeRepositories{
    /**
    * Get all data that active
    * @return Type[]
    */
    public function getAllActive(){
        return Type::where(['active' => 1])
                ->orderBy('id', 'asc')
                ->get();
    }

    /**
    * Get all data by selected filter and pagination
    * @return Type[]
    */
    public function getAllFiltered($keyword = ''){
        if(!empty($keyword)){
            $types = Type::where('name', 'like', '%' . $keyword . '%')->paginate(10);
        }else{
            $types = Type::paginate(10);
        }

        return $types;
    }

    /**
    * Find type by id
    * @param $id integer
    * @return Type
    */
    public function findById($id){
        $type = Type::where(['id' => $id])->first();
        return $type;
    }

    /**
    * get all type
    * @return Type[]
    */
    public function getAll(){
      return Type::all();
    }

}
