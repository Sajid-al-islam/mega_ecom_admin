user management

1. all data api te by default query parameter gulo validation kora
2. sob all api te ofset, limit egula common paginate hobe
3. all api te select_fields coumn nai
4. query params validation with exists condition
5. filter filter_criteria bad gece
6. search hobe search_key
7. all data er sathe active data count and deactive data count send korte hobe
8. scope inactive
9. api er status fix kora
10. next item slug
11. previous item slug on details api
12. sob delete route post hobe
13. user delete banan vul

brand management

1. all api te with and condition request theke nite hobe
2. brand search only title
3. is featured saving line add kora
   1. if(request()->is_featured){
            $data->is_featured = 1;
        }
    2. image save kora
       1. if(request()->hasFile('image')){
                    $data->image = Storage::put('uploads/brands', request()->file('image'));
                }
4. /make-as-featured api lagbe
5. /set-serial api lagbe
6. all api er sateh active count inactive count
   1. return entityResponse([
                ...$data->toArray(),
                "active_data_count" => self::$model::active()->count(),
                "inactive_data_count" => self::$model::inactive()->count(),
            ]);
        public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }
7. delete route hobe post method
8. brands/empty-trash post method e api lagbe sob inactiv remove hoye jabe
9. brands/destroy-multiple id[] pathano hobe sob delete hoye jabe
10. serial validation off

Manufacturers
1. active not active count
2. public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }
3. search and filter
   1. if(request()->has('condition')){
        $condition = request()->condition;
    }

    if(request()->has('with')){
        $with = request()->with;
    }
4. all with count
   1. return entityResponse([
            ...$data->toArray(),
            "active_data_count" => self::$model::active()->count(),
            "inactive_data_count" => self::$model::inactive()->count(),
        ]);
5. validation fixed
6. image upload
7. count total product with each manufactures
8. with, search and condition check

varients
1. values return korbe
   1. public function values(){
        return $this->hasMany(\App\Modules\ProductManagement\ProductVarient\Models\Model::class,'product_varient_id');
    }
2. total product return korbe
3. update store and update 
   1. $requestData['product_varient_group_id'] = json_decode(request()->product_varient_group_id)[0];
4. show api return with group info

product unit and unit group
    1. all api er sathe product count hobe
    2. product unit e group er sathe relation hobe
       1. use App\Modules\ProductManagement\ProductUnitGroup\Models\Model as ProductUnitGroup;
       2. public function group()
        {
            return $this->belongsTo(ProductUnitGroup::class, 'product_unit_group_id');
        }
    3. store and update action update
       1.  $requestData['product_unit_group_id'] = json_decode(request()->product_unit_group_id)[0];
    4. unit details api te group info asbe  

product color and size alada table

product varient
    1. all api selecte fields set
    2. show api te relation set kora
    3. total total_products count lagbe accessor hisebe
    4. store action update
       1.  $requestData['product_varient_group_id'] = null;
            $requestData['product_varient_id'] = json_decode(request()->product_varient_id)[0];
            $v = ProductVarient::where('id',$requestData['product_varient_id'])->first();
            if($v){
                $requestData['product_varient_group_id'] = $v->product_varient_group_id;
            }

tag management not connected to main route

category api
    1. make as featured and nav api
    2. 
