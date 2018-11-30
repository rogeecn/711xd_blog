<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Post as PostModel;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Post extends FormRequest
{
    /** @var \App\Model\Post */
    private $model;

    public function prepareForValidation()
    {
        $this->parseData();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->route("id");
        if (!$id) return true;

        $this->model = PostModel::whereId($id)
//            ->where('author', auth()->user()->id)
            ->first();

        return !is_null($this->model);
    }

    public function getModel()
    {
        return $this->model ?? new PostModel($this->validated());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'content' => 'required',
            'description' => 'required',
            'title' => 'required',
            'layout' => [
                'required',
                Rule::in(array_keys(app(PostModel::class)->layoutList())),
            ],
            'type' => [
                'required',
                Rule::in(array_keys(app(PostModel::class)->typeList())),
            ],
            'tags' => [
                'required',
            ],
            'status' => [
                'required',
                Rule::in(array_keys(app(PostModel::class)->statusList())),
            ],
        ];

        // valate custom slug
        if (strlen($this->request->get("slug"))) {
            $rules['slug'] = 'max:255|alpha_dash|unique:post,slug,' . $this->route("id");
        }
        return $rules;
    }

    public function generateDescription($content)
    {
        $keyChars = "[========]";

        if (str_contains($content, $keyChars)) {
            return str_before($content, $keyChars);
        }
        return "";
    }

    public function tags()
    {
        $tagList = explode(",", $this->get("tags"));
        return collect($tagList)->map(function ($item) {
            return trim($item);
        })->filter()->toArray();
    }

    private function parseData()
    {
        $content = $this->get("raw_content");
        if (!str_contains($content, PostModel::META_BREAKER)) {
            return "";
        }
        $converter = [
            '：' => ':',
            '，' => ',',
        ];

        $metaData = strtr(str_before($content, PostModel::META_BREAKER), $converter);
        $content = trim(str_after($content, PostModel::META_BREAKER));

        $this->request->set('description', $this->generateDescription($content));
        $this->request->set('content', $content);


        $request = $this->request;
        collect(explode("\r\n", $metaData))->filter()->each(function ($item) use ($request) {
            $item = ltrim($item, "- ");
            if (empty($item)) {
                return;
            }

            list($key, $value) = explode(":", $item);
            $key = strtolower(trim($key));
            $value = trim($value);

            if ($key == 'status') {
                $value = array_flip(app(PostModel::class)->humanStatusMap())[$value];
            }

            if (strlen($value)) {
                $request->set($key, $value);
            }
        });
    }
}
