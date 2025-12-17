<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization is handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $residentId = $this->route('resident')?->id;

        return [
            'nik' => 'required|max:16|unique:residents,nik,' . $residentId,
            'name' => 'required|max:255',
            'gender' => 'required|in:male,female',
            'birth_place' => 'required|max:255',
            'birth_date' => 'required|date',
            'address' => 'required',
            'religion' => 'nullable|max:255',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'occupation' => 'nullable|max:255',
            'phone' => 'nullable|max:15',
            'photo' => 'nullable|image|max:2048',
            'status' => 'required|in:active,moved,deceased',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nik.max' => 'NIK maksimal 16 karakter.',
            'name.required' => 'Nama wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'birth_place.required' => 'Tempat lahir wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'marital_status.required' => 'Status pernikahan wajib dipilih.',
            'status.required' => 'Status penduduk wajib dipilih.',
        ];
    }
}
