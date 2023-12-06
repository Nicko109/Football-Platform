<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'is_active' => 'nullable|boolean',
            'score' => 'nullable|int',
            'points' => 'nullable|int',
            'win' => 'nullable|in:team_id,opponent_id,null',
            'team_id' => 'nullable|integer|exists:teams,id',
            'opponent_id' => 'nullable|different:team_id|exists:teams,id',
        ];
    }

    public function messages()
    {
        return [
            'points.int' => 'Данные должны соответствовать числовому типу',
            'opponent_id.different' => 'Выберите разные команды',
            'win.required' => 'Выберите результат игры',
            'date.required' => 'Выберите дату игры',
        ];
    }
}
