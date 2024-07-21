<?php

use Illuminate\Support\Str;

if (!function_exists('all')) {
    function all($moduleName)
    {

        $formated_module = explode('/', $moduleName);

        // dd($formated_module);

        if (count($formated_module) > 1) {
            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
        <?php

        namespace App\\Modules\\{$moduleName}\\Actions;

        class All
        {
            static \$model = \App\Modules\\{$moduleName}\\Models\\Model::class;

            public static function execute(\$request)
            {
                try {
                    \$pageLimit = request()->input('limit') ?? 10;
                    \$orderByColumn = request()->input('sort_by_col');
                    \$orderByType = request()->input('sort_type');
                    \$status = request()->input('status');
                    \$fields = request()->input('fields');
                    \$with = [];
                    \$condition = [];

                    \$data = self::\$model::query();

                    if (request()->has('search') && request()->input('search')) {
                        \$searchKey = request()->input('search');
                        \$data = \$data->where(function (\$q) use (\$searchKey) {
                            \$q->where('title', \$searchKey);
                            \$q->orWhere('description', 'like', '%' . \$searchKey . '%');
                        });
                    }

                    if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                        \$data = \$data
                            ->with(\$with)
                            ->select(\$fields)
                            ->where(\$condition)
                            ->where('status', \$status)
                            ->limit(\$pageLimit)
                            ->orderBy(\$orderByColumn, \$orderByType)
                            ->get();
                    } else {
                        \$data = \$data
                            ->with(\$with)
                            ->select(\$fields)
                            ->where(\$condition)
                            ->where('status', \$status)
                            ->orderBy(\$orderByColumn, \$orderByType)
                            ->paginate(\$pageLimit);
                    }
                    return entityResponse(\$data);
                } catch (\Exception \$e) {
                    return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                }
            }
        }
        EOD;

        return $content;
    }
}


if (!function_exists('bulkActions')) {
    function bulkActions($moduleName)
    {

        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
        <?php

        namespace App\\Modules\\{$moduleName}\\Actions;

        class BulkActions
        {
            static \$model = \App\Modules\\{$moduleName}\\Models\\Model::class;

            public static function execute()
            {
                try {
                    if (request()->input('action') == 'active') {
                        if (request()->input('ids') && count(request()->input('ids'))) {
                            \$ids = request()->input('ids');
                            self::\$model::whereIn('id', \$ids)->update(['status' => 'active']);
                        }
                        return messageResponse("Items are activeted Successfully ");
                    }
                    if (request()->input('action') == 'inactive') {
                        if (request()->input('ids') && count(request()->input('ids'))) {
                            \$ids = request()->input('ids');
                            self::\$model::whereIn('id', \$ids)->update(['status' => 'inactive']);
                            return messageResponse("Items are inactiveted Successfully ");
                        }
                    }

                    if (request()->input('action') == 'delete') {
                        if (request()->input('ids') && count(request()->input('ids'))) {
                            \$ids = request()->input('ids');
                            self::\$model::whereIn('id', \$ids)->delete();
                            return messageResponse("Items are deleted Successfully ");
                        }
                    }


                } catch (\Exception \$e) {
                    return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                }
            }
        }

        EOD;

        return $content;
    }
}




if (!function_exists('store')) {
    function store($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Actions;

            class Store
            {
                static \$model = \App\\Modules\\{$moduleName}\\Models\\Model::class;

                public static function execute(\$request)
                {
                    try {
                        \$requestData = \$request->validated();
                        if (\$data = self::\$model::query()->create(\$requestData)) {
                            return messageResponse('Item added successfully', \$data, 201);
                        }
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        // $content = str_replace('{moduleName}', $moduleName, $content);
        return $content;
    }
}

if (!function_exists('update')) {
    function update($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Actions;

            class Update
            {
                static \$model = \App\\Modules\\{$moduleName}\\Models\\Model::class;

                public static function execute(\$request,\$slug)
                {
                    try {
                        if (!\$data = self::\$model::query()->where('slug', \$slug)->first()) {
                            return messageResponse('Data not found...',\$data, 404, 'error');
                        }
                        \$requestData = \$request->validated();
                        \$data->update(\$requestData);
                        return messageResponse('Item updated successfully',\$data, 201);
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        // $content = str_replace('{moduleName}', $moduleName, $content);
        return $content;
    }
}

if (!function_exists('show')) {
    function show($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Actions;



            class Show
            {
                static \$model = \App\\Modules\\{$moduleName}\\Models\\Model::class;

                public static function execute(\$slug)
                {
                    try {
                        \$with = [];
                        \$fields = request()->input('fields') ?? [];
                        if (empty(\$fields)) {
                            \$fields = ['*'];
                        }
                        if (!\$data = self::\$model::query()->with(\$with)->select(\$fields)->where('slug', \$slug)->first()) {
                            return messageResponse('Data not found...',\$data, 404, 'error');
                        }
                        return entityResponse(\$data);
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        // $content = str_replace('{moduleName}', $moduleName, $content);
        return $content;
    }
}

if (!function_exists('softDelete')) {
    function softDelete($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Actions;

            class SoftDelete
            {
                static \$model = \App\\Modules\\{$moduleName}\\Models\\Model::class;

                public static function execute()
                {
                    try {
                        if (!\$data = self::\$model::where('slug', request()->slug)->first()) {
                            return messageResponse('Data not found...', \$data, 404, 'error');
                        }
                        \$data->status = 'inactive';
                        \$data->update();
                        return messageResponse('Item Successfully soft deleted', [], 200, 'success');
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        return $content;
    }
}
if (!function_exists('restore')) {
    function restore($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Actions;

            class Restore
            {
                static \$model = \App\\Modules\\{$moduleName}\\Models\\Model::class;

                public static function execute()
                {
                    try {
                        if (!\$data = self::\$model::where('slug', request()->slug)->first()) {
                            return messageResponse('Data not found...', \$data, 404, 'error');
                        }
                        \$data->status = 'active';
                        \$data->update();
                        return messageResponse('Item Successfully  Restored', \$data, 200, 'success');
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        return $content;
    }
}

if (!function_exists('import')) {
    function import($moduleName, $fields)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }



        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Actions;

            class Import
            {
                static \$model = \App\\Modules\\{$moduleName}\\Models\\Model::class;

                public static function execute()
                {
                    try {
                        foreach (request()->data as \$row) {
                             self::\$model::create([
            EOD;

        foreach ($fields as $field) {
            $content .= <<<EOD

                                "$field[0]" => \$row['$field[0]'],\n
            EOD;
        }

        $content .= <<<EOD

                            ]);
                        }
                        return messageResponse('Item Successfully updated', [], 200, 'success');
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        return $content;
    }
}

if (!function_exists('destroy')) {
    function destroy($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Actions;

            class Destroy
            {
                static \$model = \App\\Modules\\{$moduleName}\\Models\\Model::class;

                public static function execute(\$slug)
                {
                    try {
                        if (!\$data=self::\$model::where('slug', \$slug)->first()) {
                            return messageResponse('Data not found...',\$data, 404, 'error');
                        }
                        \$data->delete();
                        return messageResponse('Item Successfully deleted',[], 200, 'success');
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        return $content;
    }
}

if (!function_exists('validation')) {
    function validation($moduleName, $fields)
    {


        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $formatField = [];
        if (count($fields)) {
            foreach ($fields as $field) {
                $formatField[] = [
                    $field[0] => 'required'
                ];
            }
        }
        // dd($formatField);

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Validations;

            use Illuminate\Contracts\Validation\Validator;
            use Illuminate\Foundation\Http\FormRequest;
            use Illuminate\Http\Exceptions\HttpResponseException;
            use Illuminate\Validation\Rule;

            class Validation extends FormRequest
            {
                /**
                 * Determine if the  is authorized to make this request.
                 */
                public function authorize(): bool
                {
                    return true;
                }
                /**
                 * validateError to make this request.
                 */
                public function validateError(\$data)
                {
                    \$errorPayload =  \$data->getMessages();
                    return response(['status' => 'validation_error', 'errors' => \$errorPayload], 422);
                }

                protected function failedValidation(Validator \$validator)
                {
                    throw new HttpResponseException(\$this->validateError(\$validator->errors()));
                    if (\$this->wantsJson() || \$this->ajax()) {
                        throw new HttpResponseException(\$this->validateError(\$validator->errors()));
                    }
                    parent::failedValidation(\$validator);
                }

                /**
                 * Get the validation rules that apply to the request.
                 *
                 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
                 */
                public function rules(): array
                {
                    return [

            EOD;

        // Now, let's dynamically add rules from $formatField
        if (count($formatField)) {
            foreach ($formatField as $fieldName => $rule) {
                if (is_array($rule)) {
                    foreach ($rule as $field => $validation) {
                        $content .= "            '$field' => '$validation | sometimes',\n";
                    }
                }
            }
        }
        $content .= <<<EOD
                        'status' => ['sometimes', Rule::in(['active', 'inactive'])],
                    ];
                }
            }
            EOD;

        return $content;
    }
}
if (!function_exists('BulkActionsValidation')) {
    function BulkActionsValidation($moduleName, $fields)
    {


        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $formatField = [];
        if (count($fields)) {
            foreach ($fields as $field) {
                $formatField[] = [
                    $field[0] => 'required'
                ];
            }
        }
        // dd($formatField);

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Validations;

            use Illuminate\Contracts\Validation\Validator;
            use Illuminate\Foundation\Http\FormRequest;
            use Illuminate\Http\Exceptions\HttpResponseException;
            use Illuminate\Validation\Rule;

            class BulkActionsValidation extends FormRequest
            {
                /**
                 * Determine if the  is authorized to make this request.
                 */
                public function authorize(): bool
                {
                    return true;
                }
                /**
                 * validateError to make this request.
                 */
                public function validateError(\$data)
                {
                    \$errorPayload =  \$data->getMessages();
                    return response(['status' => 'validation_error', 'errors' => \$errorPayload], 422);
                }

                protected function failedValidation(Validator \$validator)
                {
                    throw new HttpResponseException(\$this->validateError(\$validator->errors()));
                    if (\$this->wantsJson() || \$this->ajax()) {
                        throw new HttpResponseException(\$this->validateError(\$validator->errors()));
                    }
                    parent::failedValidation(\$validator);
                }

                /**
                 * Get the validation rules that apply to the request.
                 *
                 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
                 */
                public function rules(): array
                {
                    return [
                        'action' => 'required|sometimes|in:active,inactive,delete',
                        'ids' => [
                            'array',
                            function (\$attribute, \$value, \$fail) {
                                if (empty(\$value)) {
                                    \$fail('The ' . \$attribute . ' must contain at least one item.');
                                }
                            },
                        ],
                    ];
                }
            }
            EOD;

        return $content;
    }
}
if (!function_exists('GetAllValidation')) {
    function GetAllValidation($moduleName, $fields)
    {


        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }



        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Validations;

            use Illuminate\Contracts\Validation\Validator;
            use Illuminate\Foundation\Http\FormRequest;
            use Illuminate\Http\Exceptions\HttpResponseException;
            use Illuminate\Validation\Rule;

            class GetAllValidation extends FormRequest
            {
                /**
                 * Determine if the  is authorized to make this request.
                 */
                public function authorize(): bool
                {
                    return true;
                }
                /**
                 * validateError to make this request.
                 */
                public function validateError(\$data)
                {
                    \$errorPayload =  \$data->getMessages();
                    return response(['status' => 'validation_error', 'errors' => \$errorPayload], 422);
                }

                protected function failedValidation(Validator \$validator)
                {
                    throw new HttpResponseException(\$this->validateError(\$validator->errors()));
                    if (\$this->wantsJson() || \$this->ajax()) {
                        throw new HttpResponseException(\$this->validateError(\$validator->errors()));
                    }
                    parent::failedValidation(\$validator);
                }

                /**
                 * Get the validation rules that apply to the request.
                 *
                 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
                 */
                public function rules(): array
                {
                    return [
                        'limit' => 'required|sometimes',
                        'page' => 'required|sometimes',
                        'fields' => 'required|sometimes',
                        'sort_by_col' => 'required|sometimes',
                        'sort_type' => 'required|sometimes',
                        'status' => 'required|sometimes',

                    ];
                }
            }
            EOD;

        return $content;
    }
}
if (!function_exists('api')) {
    function api($moduleName)
    {
        $route_name = Str::plural((Str::kebab($moduleName)));

        $content = <<<"EOD"
        @protocol = http://
        # @hostname =
        @hostname = 127.0.0.1:8000
        @endpoint = api/v1/{$route_name}
        @url = {{protocol}}{{hostname}}/{{endpoint}}
        @token = Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5YTFjMWRmZC04MWU3LTQ1ODgtYjVhMi0xOTA1ODNiNjZhNmUiLCJqdGkiOiIyYWIxMTMzZjJkMDE3YmE0ZDNmZDk3NzI3NWJlZDY5YjUyMjk1N2M3OGFlYzIxNTA2NTQ5NTUyYTA1M2ZmNzEyMDM4NzU2N2U3ZTRkMzlkNiIsImlhdCI6MTY5NDU3NjcyOC4xOTQ4OTgsIm5iZiI6MTY5NDU3NjcyOC4xOTQ5LCJleHAiOjE3MjYxOTkxMjguMTg2ODc2LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.gJZW7MbPkwIdJw7kXhPuRK6bMkuiSTPhFXxzoXxcBzX2cT9Nj7ozj7oZXQG_9cDdKe1LIQFxr2DvapUqGMvBfenrhifvWTU0_wrNIhbBQCsS3gaWWfxuvoKkCrQwKqm7wJSB5yN2LszrdqWPgMR9EBpNiUjhXxgrZUdzskjiqG35FZzZkoHOvPxV5LP2QKtekiUv_ekQoMHxeOwOC43XXiLk9cH_XNvyRjSGibh3hZHUvtLEZ0NAfWL1eZlbge8GoQYMJxN-LO72HYCSnrG2bEmWT624iAU13U-t_cEyVDb-HFPaIXOAjOnKwNUJqfwwC1lVBvd6hNyJwODZ6iZevvwUScW3_UuoUnww46Td_A6CI7QfFywQdFolu0vDkHgQMmSmPu-QNDG8HrvSh5W1d4ve-wPaNauISsvVCVXPgdDWW9n4aKI8qAv_RCEZZYa3s9zmRdjweDxG0VeISlaPg6hLzlpO1He83onbjoPSzEWJWC7bb2nUR57zppDHgKKSBP-WW_OHH7fruavkG44_7NuNmvrTFtDclGe4E3XuqZFvno154daJpKKRPzUkbeCp6Cc3X2Qp5k-ORq1cx1NfFYmpM6ZmzFZ3bNV8IV3Cp2HgZMRKHfXWRlxiVAL73sLnSBmvn1iRswMXftl2cm9xiUMQnpJKBq_MDUilRlBTiWE
        @createdAt = {{\$timestamp}}
        # @modifiedBy = {{\$processEnv {$moduleName}NAME}}

        #                                               #
        #------------------ Modules TESTING ----------------#
        #                                               #

        ### get all data without pagination
        ### will return:  {  }
        GET {{url}} HTTP/1.1
        content-type: application/json
        # Authorization: {{token}}

        ### get single data
        # @prompt id enter id
        GET {{url}}/{{id}} HTTP/1.1
        content-type: application/json
        # Authorization: {{token}}

        ### store data
        ### @prompt title enter title
        POST {{url}} HTTP/1.1
        content-type: application/json

        {
            "title": "Title"
        }


        ### store data canvas
        ### @prompt title enter title
        PATCH {{url}}/1 HTTP/1.1
        content-type: application/json
        # Authorization: {{token}}

        {
            "title": "Title update"
        }


        #### soft delete
        # @prompt id enter id
        POST {{url}}/soft-delete HTTP/1.1
        content-type: application/json

        {
            "id": "{{id}}"
        }

        #### permenently delete
        # @prompt id enter id
        DELETE {{url}}/{{id}} HTTP/1.1
        content-type: application/json

        {
            "id": "{{id}}"
        }

        ### restore
        # @prompt id enter id
        POST {{url}}/restore HTTP/1.1
        content-type: application/json
        # Authorization: {{token}}

        {
            "id": "{{id}}"
        }
        EOD;
        // $route = Str::plural((Str::kebab($moduleName)));
        // $content = str_replace('{route_name}', $route, $content);
        return $content;
    }
}
if (!function_exists('model')) {
    function model($moduleName, $class_name)
    {

        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $table_name = Str::plural((Str::snake($class_name)));



        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\{$moduleName}\\Models;

            use Illuminate\Database\Eloquent\Model as EloquentModel;
            use Illuminate\Support\Str;

            class Model extends EloquentModel
            {
                protected \$table = "{$table_name}";
                protected \$guarded = [];

                protected static function booted()
                {
                    static::created(function (\$data) {
                        \$random_no = random_int(100, 999) . \$data->id . random_int(100, 999);
                        \$slug = \$data->title . " " . \$random_no;
                        \$data->slug = Str::slug(\$slug); //use Illuminate\Support\Str;
                        if (strlen(\$data->slug) > 150) {
                            \$data->slug = substr(\$data->slug, strlen(\$data->slug) - 150, strlen(\$data->slug));
                        }
                        if (auth()->check()) {
                            \$data->creator = auth()->user()->id;
                        }
                        \$data->save();
                    });
                }

                public function scopeActive(\$q)
                {
                    return \$q->where('status', 'active');
                }
            }
            EOD;

        return $content;
    }
}

if (!function_exists('migration')) {
    function migration($moduleName, $fields)
    {

        $table_name = '';
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {


            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
            $table_name = Str::plural((Str::snake($formated_module[count($formated_module) - 1])));
        } else {
            $table_name = Str::plural((Str::snake($moduleName)));
            $moduleName = Str::replace("/", "\\", $moduleName);
            // dd($moduleName);
        }

        // dd($table_name);



        $content = <<<"EOD"
        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration
        {
            /**
             php artisan migrate --path='\App\\Modules\\{$moduleName}\\Database\\create_{$table_name}_table.php'
             * Run the migrations.
             */
            public function up(): void
            {
                Schema::create('{$table_name}', function (Blueprint \$table) {
                    \$table->id();

        EOD;
        if (count($fields)) {
            foreach ($fields as $fieldName) {
                $stringLimit = 100;

                if (count($fieldName) == 1) {
                    $content .= "            \$table->string('{$fieldName[0]}, {$stringLimit}')}')->nullable();\n";
                }
                if (count($fieldName) > 1) {
                    $type = $fieldName[1];
                    //enum value set
                    $enumvalue = [];

                    $position = strpos($type, '-');

                    if ($position == 4) {
                        $enumType = explode('-', $type);
                        $type = $enumType[0];
                        $enumvalue = explode('.', $enumType[1]);
                    }

                    if ($position == 6) {
                        $limit = explode('-', $type);
                        $limit = explode('.', $limit[1]);
                        $stringLimit = $limit[0];
                    }

                    //enum value set end
                    if ($type == 'string') {
                        $type = 'string';
                    } elseif (in_array($type, ['longtext', 'text'])) {
                        $type = 'text';
                    } elseif (in_array($type, ['number', 'integer', 'intiger', 'int'])) {
                        $type = 'integer';
                    } elseif (in_array($type, ['bigint', 'biginteger'])) {
                        $type = 'bigInteger';
                    } elseif (in_array($type, ['boolean', 'tinyint'])) {
                        $type = 'tinyInteger';
                    } elseif ($type == 'date') {
                        $type = 'date';
                    } elseif ($type == 'datetime') {
                        $type = 'datetime';
                    } elseif ($type == 'json') {
                        $type = 'json';
                    } elseif ($type == 'enum') {
                        $type = 'enum';
                    } elseif ($type == 'float') {
                        $type = 'float';
                    } else {
                        $type = 'string';
                    }

                    if ($type == 'enum') {
                        $enumString = implode("','", $enumvalue);
                        $content .= "            \$table->{$type}('{$fieldName[0]}', ['{$enumString}'])->nullable();\n";
                    } else if ($type == 'string') {
                        $content .= "            \$table->string('{$fieldName[0]}', {$stringLimit})->nullable();\n";
                    } else if ($type == 'tinyInteger') {
                        $content .= "            \$table->tinyInteger('{$fieldName[0]}')->default(0);\n";
                    } else {
                        $content .= "            \$table->{$type}('{$fieldName[0]}')->nullable();\n";
                    }
                }
            }
        }
        $content .= <<<EOD

                    \$table->bigInteger('creator')->unsigned()->nullable();
                    \$table->string('slug', 50)->nullable();
                    \$table->enum('status', ['active', 'inactive'])->default('active');
                    \$table->timestamps();
                });
            }

            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::dropIfExists('{$table_name}');
            }
        };
        EOD;

        return $content;
    }
}


if (!function_exists('seeder')) {
    function seeder($moduleName, $module_Name, $fields)
    {

        $formated_module = explode('/', $moduleName);
        if (count($formated_module) > 1) {
            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $formatField = [];
        if (count($fields)) {
            foreach ($fields as $field) {
                $formatField[] = [
                    $field[0] => $field[0]
                ];
            }
        }




        $content = <<<"EOD"
        <?php
        namespace App\\Modules\\{$moduleName}\\Database;

        use Illuminate\Database\Seeder as SeederClass;

        class Seeder extends SeederClass
        {
            /**
             * Run the database seeds.
             php artisan db:seed --class="\App\\Modules\\{$moduleName}\\Database\\Seeder"
             */
            static \$model = \App\\Modules\\{$moduleName}\\Models\\Model::class;
            public function run(): void
            {

                self::\$model::truncate();
                for (\$i = 1; \$i < 100; \$i++) {
                self::\$model::create([

        EOD;
        if (count($formatField)) {
            foreach ($formatField as $fieldName => $rule) {
                if (is_array($rule)) {
                    foreach ($rule as $field => $value) {
                        $content .= "            '$field' => facker()->name,\n";
                    }
                }
            }
        }
        $content .= <<<EOD
                    ]);
                }
            }
        }
        EOD;
        return $content;
    }
}


if (!function_exists('controller')) {
    function controller($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
        <?php

        namespace App\\Modules\\{$moduleName};

        use App\\Modules\\{$moduleName}\\Actions\All;
        use App\\Modules\\{$moduleName}\\Actions\Destroy;
        use App\\Modules\\{$moduleName}\\Actions\Show;
        use App\\Modules\\{$moduleName}\\Actions\Store;
        use App\\Modules\\{$moduleName}\\Actions\Update;
        use App\\Modules\\{$moduleName}\\Actions\SoftDelete;
        use App\\Modules\\{$moduleName}\\Actions\Restore;
        use App\\Modules\\{$moduleName}\\Actions\Import;
        use App\\Modules\\{$moduleName}\\Validations\\BulkActionsValidation;
        use App\\Modules\\{$moduleName}\\Validations\\GetAllValidation;
        use App\\Modules\\{$moduleName}\\Validations\\Validation;
        use App\\Modules\\{$moduleName}\\Actions\BulkActions;
        use App\Http\Controllers\Controller as ControllersController;


        class Controller extends ControllersController
        {

            public function index(GetAllValidation \$request)
            {
                \$data = All::execute(\$request);
                return \$data;
            }

            public function store(Validation \$request)
            {
                \$data = Store::execute(\$request);
                return \$data;
            }

            public function show(\$slug)
            {
                \$data = Show::execute(\$slug);
                return \$data;
            }

            public function update(Validation \$request, \$slug)
            {
                \$data = Update::execute(\$request, \$slug);
                return \$data;
            }

            public function softDelete()
            {
                \$data = SoftDelete::execute();
                return \$data;
            }
            public function destroy(\$slug)
            {
                \$data = Destroy::execute(\$slug);
                return \$data;
            }
            public function restore()
            {
                \$data = Restore::execute();
                return \$data;
            }
            public function import()
            {
                \$data = Import::execute();
                return \$data;
            }
            public function bulkAction(BulkActionsValidation \$request)
            {
                \$data = BulkActions::execute(\$request);
                return \$data;
            }

        }
        EOD;
        return $content;
    }
}
if (!function_exists('routeContent')) {
    function routeContent($moduleName, $class_name)
    {

        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $route_name = Str::plural((Str::kebab($class_name)));


        $content = <<<"EOD"
            <?php

            use App\\Modules\\{$moduleName}\\Controller;
            use Illuminate\Support\Facades\Route;

            Route::prefix('v1')->group(function () {
                Route::prefix('{$route_name}')->group(function () {
                    Route::get('', [Controller::class,'index']);
                    Route::get('{slug}', [Controller::class,'show']);
                    Route::post('store', [Controller::class,'store']);
                    Route::post('update/{slug}', [Controller::class,'update']);
                    Route::post('soft-delete', [Controller::class,'softDelete']);
                    Route::delete('destroy/{slug}', [Controller::class,'destroy']);
                    Route::post('restore', [Controller::class,'restore']);
                    Route::post('import', [Controller::class,'import']);
                    Route::post('bulk-action', [Controller::class, 'bulkAction']);
                });
            });
            EOD;

        return $content;
    }
}
