<?php

namespace App\Http\Requests\Superadmin\Expositions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

use Carbon\Carbon;

class StoreExpositionsRequest extends FormRequest
{

    protected $redirectRoute = 'superadmin.expositions.create';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'exposition_name' => 'EXPO名',
            'exposition_start_date' => 'EXPO開催日',
            'exposition_days' => 'EXPO開催期間',
            'slug' => 'URLスラッグ',
            'exposition_active_flag' => '来場者ログインの有効化フラグ',
            'exposition_can_pre_registration_flag' => '事前登録の有効化フラグ',
            'exposition_main_visual' => 'EXPOトップ画像'
        ];
    }

    public function rules()
    {
        return [
            'exposition_name' => ['bail', 'required', 'string', 'max:100'],
            'exposition_start_date' => ['bail', 'required', 'date_format:Y/m/d'],
            'exposition_days' => ['bail', 'required', 'integer', 'min:1'],
            'slug' => ['bail', 'required', 'string', 'regex:/^[a-zA-Z0-9]+$/', 'unique:expositions,slug'],
            'exposition_active_flag' => ['bail', 'nullable', 'string'],
            'exposition_can_pre_registration_flag' => ['bail', 'nullable', 'string'],
            'exposition_main_visual' => ['bail', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attributeは必須項目です',
            'exposition_name.max' => '100文字以内で入力ください',
            'exposition_days.min' => '1以上の整数を入力ください',
            'exposition_days.integer' => ':attributeは半角数字を入力ください',
            'slug.regex' => ':attributeは空白なしの半角英数字を入力ください',
            'slug.unique' => ':attributeは使用されております。他の値を入力ください'
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled(['exposition_active_flag'])  && $this->input('exposition_active_flag') !== 'on') {
                $validator->errors()->add(
                    'exposition_active_flag',
                    '不正な値です'
                );
            }

            if ($this->filled(['exposition_can_pre_registration_flag'])  && $this->input('exposition_can_pre_registration_flag') !== 'on') {
                $validator->errors()->add(
                    'exposition_can_pre_registration_flag',
                    '不正な値です'
                );
            }

            if (empty($this->input('exposition_active_flag')) && $this->input('exposition_can_pre_registration_flag') === 'on') {
                $validator->errors()->add(
                    'exposition_can_pre_registration_flag',
                    '来場者ログインの有効化フラグをONにして下さい'
                );
            }
        });
    }

    public function validated()
    {
        $validated = parent::validated();

        //withValidatorでonを確認しているのでここではkeyがあるかどうかをみている
        if (!empty($validated['exposition_active_flag'])) $validated['exposition_active_flag'] = true;
        if (!empty($validated['exposition_can_pre_registration_flag'])) $validated['exposition_can_pre_registration_flag'] = true;

        // 拡張子の取り出し
        if (!empty($validated['exposition_main_visual'])) {
            $main_visual_path = 'main_visual.' . $this->file('exposition_main_visual')->getClientOriginalExtension();
        }

        return [
            'name' => $validated['exposition_name'],
            'start_date' => Carbon::parse($validated['exposition_start_date'])->format('Y-m-d'),
            'exposition_days' => $validated['exposition_days'],
            'slug' => $validated['slug'],
            'active_flag' => $validated['exposition_active_flag'] ?? false,
            'can_pre_registration_flag' => $validated['exposition_can_pre_registration_flag'] ?? false,
            'main_visual_path' => $main_visual_path ?? null,
        ];
    }
}
